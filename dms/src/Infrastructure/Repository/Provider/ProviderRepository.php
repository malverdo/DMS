<?php

namespace App\Infrastructure\Repository\Provider;

use App\Domain\Provider\Contracts\ProviderEntityInterface;
use App\Domain\Provider\Contracts\ProviderRepositoryInterface;
use App\Infrastructure\Entity\ProviderEntity;
use App\Infrastructure\Repository\BaseRepository\AbstractRepository;
use App\Infrastructure\Repository\BaseRepository\Contracts\CollectionInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\EntityInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\RepositoryCriteriaInterface;
use App\Infrastructure\Repository\Provider\ProviderCriteria;
use Yii;

class ProviderRepository extends AbstractRepository implements ProviderRepositoryInterface
{
    public function getModel(): EntityInterface
    {
        return new ProviderEntity();
    }

    public function getCriteria(): RepositoryCriteriaInterface
    {
        return ProviderCriteria::create();
    }

    public function getTableName(): string
    {
        return '"Provider"';
    }

    public function getTableAlias(): string
    {
        return 'ps';
    }

    public function getKeyName(): string
    {
        return 'id';
    }



    // use ProviderBuilderTrait;

    /**
     * @param $customerId
     * @return ProviderEntityInterface[]|void
     * @throws \CException
     */
    public function findByCustomerId($customerId)
    {
        $result = [];
        $sql = "select `p`.*, GROUP_CONCAT(`s`.sender) as senders ".
            "FROM {{providers}} `p` INNER JOIN {{providers_senders}} `s` on `s`.provider_id = `p`.id ".
                "WHERE `p`.customer_id =" . (int)$customerId . " GROUP BY `p`.id";

        $rows = Yii::app()->db->createCommand($sql)->queryAll();

        /**
         * @var ProviderEntity $row
         */
        foreach ($rows as $row) {
            $result [] = $this->buildEntity($row['id'], $row);
        }

        return $result;
    }

    /**
     * @param RepositoryCriteriaInterface $criteria
     * @return CollectionInterface
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function findByCriteria(RepositoryCriteriaInterface $criteria): CollectionInterface
    {
        $dbCriteria = $this->dbConnection->createQueryBuilder();

        $this->modifyQuery($dbCriteria, $criteria);
        $this->modifySort($dbCriteria, $criteria);

        $results = $dbCriteria->executeQuery()->fetchAllAssociative();

        return new ProviderCollection($this->deserialize($results, ProviderEntity::class));
    }


}