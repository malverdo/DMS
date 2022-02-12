<?php

namespace App\Infrastructure\Repository\BaseRepository\Contracts;


use App\Domain\Provider\Contracts\ProviderCriteriaInterface;

/**
 * Class RepositoryInterface
 * @package App\Infrastructure\Repository\BaseRepository\Contracts
 */
interface RepositoryInterface
{

    /**
     * @return RepositoryCriteriaInterface
     */
    public function getCriteria(): RepositoryCriteriaInterface;

    /**
     * @return EntityInterface
     */
    public function getModel(): EntityInterface;

    /**
     * @param RepositoryCriteriaInterface $criteria
     * @return int
     */
    public function countByCriteria(RepositoryCriteriaInterface $criteria): int;

    /**
     * @param RepositoryCriteriaInterface $criteria
     * @return CollectionInterface|null
     */
    public function findById(RepositoryCriteriaInterface $criteria): ?CollectionInterface;



    /**
     * @param RepositoryCriteriaInterface $criteria
     * @return CollectionInterface
     */
    public function findByCriteria(RepositoryCriteriaInterface $criteria): CollectionInterface;

    /**
     * @param EntityInterface $entity
     */
    public function save(EntityInterface $entity): void;

    /**
     * @param EntityInterface $entity
     */
    public function delete(EntityInterface $entity): void;

}