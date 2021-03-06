<?php

namespace App\Infrastructure\Repository\BaseRepository;

use App\Infrastructure\Repository\BaseRepository\Contracts\CollectionInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\DataBaseConnectionInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\EntityInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\RepositoryCriteriaInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\RepositoryInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\TableIdentificationInterface;
use Doctrine\DBAL\Query\QueryBuilder;
use JMS\Serializer\ContextFactory\CallableSerializationContextFactory;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

/**
 * Class AbstractRepository
 * @package App\Infrastructure\Repository\BaseRepository
 */
abstract class AbstractRepository implements RepositoryInterface, TableIdentificationInterface
{
    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @var DataBaseConnectionInterface
     */
    protected $dbConnection;

    public function __construct(DataBaseConnectionInterface $connection)
    {
        $this->dbConnection = $connection->getConnection();
        $this->serializer = new SerializerBuilder;
        $this->serializer->setSerializationContextFactory(new CallableSerializationContextFactory(function() {
            $context = new SerializationContext();
            $context->setSerializeNull(true);
            $context->setGroups(['save']);
            return $context;
        }));
        $this->serializer = SerializerBuilder::create()->build();
    }

    public function getDbConnection()
    {
        return $this->dbConnection;
    }

    /**
     * @return EntityInterface
     */
    abstract public function getModel(): EntityInterface;

    /**
     * @return RepositoryCriteriaInterface
     */
    abstract public function getCriteria(): RepositoryCriteriaInterface;

    /**
     * @return string
     */
    abstract public function getTableName(): string;

    /**
     * @return string
     */
    abstract public function getTableAlias(): string;

    /**
     * @return string
     */
    abstract public function getKeyName(): string;

    /**
     * @param RepositoryCriteriaInterface $criteria
     * @return int
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function countByCriteria(RepositoryCriteriaInterface $criteria): int
    {
        $dbCriteria = $this->dbConnection->createQueryBuilder();
        $this->modifyQuery($dbCriteria, $criteria);
        $result = $dbCriteria
            ->select(sprintf('COUNT(%s.%s) as c', $this->getTableAlias(), $this->getKeyName()))
            ->execute();
        return $result->fetchOne();
    }

    /**
     * @param RepositoryCriteriaInterface $criteria
     * @return CollectionInterface|null
     */
    public function findById(RepositoryCriteriaInterface $criteria): ?CollectionInterface
    {
        return  $this->findByCriteria($criteria);
    }



    /**
     * @param QueryBuilder $dbCriteria
     * @param RepositoryCriteriaInterface $criteria
     */
    protected function modifyQuery(QueryBuilder $dbCriteria, RepositoryCriteriaInterface $criteria): void
    {
        $dbCriteria
            ->select('*')
            ->from($this->getTableName(), $this->getTableAlias())
            ->setFirstResult($criteria->getOffset())
            ->setMaxResults($criteria->getPageSize());

        if ($criteria->getFilterById() !== null) {
            $dbCriteria
                ->where(sprintf('%s.%s = :id', $this->getTableAlias(), $this->getKeyName()))
                ->setParameter('id', $criteria->getFilterById());
        }
    }

    /**
     * @param QueryBuilder $dbCriteria
     * @param RepositoryCriteriaInterface $criteria
     */
    protected function modify(QueryBuilder $dbCriteria, RepositoryCriteriaInterface $criteria): void
    {
        $dbCriteria
            ->select('*')
            ->from($this->getTableName(), $this->getTableAlias())
            ->setFirstResult($criteria->getOffset())
            ->setMaxResults($criteria->getPageSize());
    }


    /**
     * @param QueryBuilder $dbCriteria
     * @param RepositoryCriteriaInterface $criteria
     */
    protected function modifySort(QueryBuilder $dbCriteria, RepositoryCriteriaInterface $criteria): void
    {
        if ($criteria->getSortById() !== null) {
            $dbCriteria->addOrderBy(sprintf('%s.%s', $this->getTableAlias(), $this->getKeyName()), $criteria->getSortById());
        }
    }

    /**
     * @param EntityInterface $entity
     */
    public function save(EntityInterface $entity): void
    {
        $data = $this->prepareData(
            $this->serialize($entity)
        );

        try {
            if (is_a($this->dbConnection->getDriver(), \FOD\DBALClickHouse\Driver::class)) {
                $this->insert($data);
            } elseif ($entity->isNew() === true) {
                $this->insert($data);
                if ($entity->getId() === null) {
                    $last = $this->dbConnection->lastInsertId();
                    $entity->setId($last);
                }
            } else {
                $this->update($data, $entity->getId());
            }

            $this->afterSave($entity);

            $entity->setNew(false);

        } catch (\Exception $ex) {
            throw new RepositoryException($ex->getMessage());
        }
    }

    /**
     * @param array $data
     */
    public function massSave(array $data): void
    {
        $start = microtime(true);
        \DMS::log('?????????? ???????????? massSave: ' . round(microtime(true) - $start, 4) . ' ??????.');
        if (is_a($this->dbConnection->getDriver(), \FOD\DBALClickHouse\Driver::class)) {
            /** @var Smi2CHClient $rawClient */
            $rawClient = $this->dbConnection->getWrappedConnection()->getRawClient();
            $statement = $rawClient->insertAssocBulk($this->getTableName(), array_map(function(EntityInterface $entity) {
                return $this->serialize($entity);
            }, $data));

            \DMS::log('?????????? ?????????? ?????????????? ?? clickhouse: ' . round(microtime(true) - $start, 4) . ' ??????.');

            if (!$statement->error()) {
                foreach ($data as $item) {
                    $this->afterSave($item);
                }
            }
            \DMS::log('?????????? ?????????? ???????????????????? ?????????????????? ??????????????????: ' . round(microtime(true) - $start, 4) . ' ??????.');
        }
        else{
            foreach ($data as $item) {
                $this->save($item);
            }
        }
    }

    public function afterSave(EntityInterface $entity){}

    /**
     * @param array $data
     * @return array
     */
    private function prepareData(array $data): array
    {

        $prepareData = [];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $prepareData['"' . $key . '"'] = json_encode($value);
            } else {
                $prepareData['"' . $key . '"'] = $value;
            }
        }
        return $prepareData;
    }

    /**
     * @param array $prepareData
     * @throws \Doctrine\DBAL\Exception
     */
    private function insert(array $prepareData): void
    {
        $this->dbConnection->insert($this->getTableName(), $prepareData);
    }

    /**
     * @param array $prepareData
     * @param $key
     * @throws \Doctrine\DBAL\Exception
     */
    private function update(array $prepareData, $key): void
    {
        $this->dbConnection->update($this->getTableName(), $prepareData, [
            sprintf('%s.%s', $this->getTableName(), $this->getKeyName()) => $key
        ]);
    }

    /**
     * @param EntityInterface $entity
     * @return array
     */
    protected function serialize(EntityInterface $entity): array
    {
        return json_decode($this->serializer->serialize($entity, 'json'), true);
    }

    /**
     * @param EntityInterface $entity
     */
    public function delete(EntityInterface $entity): void
    {
        try {
            $this->dbConnection->delete($this->getTableName(), [
                sprintf('%s.%s', $this->getTableName(), $this->getKeyName()), $entity->getId()
            ]);
        } catch (\Exception $ex) {
            throw new RepositoryException($ex->getMessage());
        }
    }

    /**
     * @param array $results
     * @param string $className
     * @return array
     */
    protected function deserialize(array $results, string $className): array
    {
        return $this->serializer->deserialize(json_encode($results), 'array<' . $className . '>', 'json');
    }
}