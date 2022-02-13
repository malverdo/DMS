<?php

namespace App\Infrastructure\Repository\User;

use App\Domain\User\Contracts\UserRepositoryInterface;
use App\Infrastructure\Entity\User;
use App\Infrastructure\Repository\BaseRepository\AbstractRepository;
use App\Infrastructure\Repository\BaseRepository\Contracts\CollectionInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\EntityInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\RepositoryCriteriaInterface;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 */
class UserRepository  extends AbstractRepository implements UserRepositoryInterface
{
    public function getModel(): EntityInterface
    {
        return new User();
    }

    public function getCriteria(): RepositoryCriteriaInterface
    {
        return UserCriteria::create();
    }

    public function getTableName(): string
    {
        return '"User"';
    }

    public function getTableAlias(): string
    {
        return 'us';
    }

    public function getKeyName(): string
    {
        return 'id';
    }

    public function getKeyNameLogin(): string
    {
        return 'login';
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function findByCriteria(RepositoryCriteriaInterface $criteria): CollectionInterface
    {
        $dbCriteria = $this->dbConnection->createQueryBuilder();

        $this->modify($dbCriteria, $criteria);
        $this->addWhereLogin($dbCriteria, $criteria);
        $this->modifySort($dbCriteria, $criteria);

        $results = $dbCriteria->executeQuery()->fetchAllAssociative();

        return new UserCollection($this->deserialize($results, User::class));
    }

    /**
     * @param QueryBuilder $dbCriteria
     * @param RepositoryCriteriaInterface $criteria
     */
    protected function addWhereLogin(QueryBuilder $dbCriteria, RepositoryCriteriaInterface $criteria): void
    {
        if ($criteria->getFilterByLogin() !== null) {
            $dbCriteria
                ->where(sprintf('%s.%s = :login', $this->getTableAlias(), $this->getKeyNameLogin()))
                ->setParameter('login', $criteria->getFilterByLogin());
        }
    }

}
