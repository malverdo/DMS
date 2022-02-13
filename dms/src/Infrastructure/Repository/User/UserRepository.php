<?php

namespace App\Infrastructure\Repository\User;

use App\Domain\User\Contracts\UserRepositoryInterface;
use App\Infrastructure\Entity\User;
use App\Infrastructure\Repository\BaseRepository\AbstractRepository;
use App\Infrastructure\Repository\BaseRepository\Contracts\CollectionInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\EntityInterface;
use App\Infrastructure\Repository\BaseRepository\Contracts\RepositoryCriteriaInterface;

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

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function findByCriteria(RepositoryCriteriaInterface $criteria): CollectionInterface
    {
        $dbCriteria = $this->dbConnection->createQueryBuilder();

        $this->modifyQuery($dbCriteria, $criteria);
        $this->modifySort($dbCriteria, $criteria);

        $results = $dbCriteria->executeQuery()->fetchAllAssociative();

        return new UserCollection($this->deserialize($results, User::class));
    }
}
