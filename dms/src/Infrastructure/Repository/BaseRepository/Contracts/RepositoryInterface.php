<?php

namespace App\Infrastructure\Repository\BaseRepository\Contracts;


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
     * @param string $id
     * @return CollectionInterface|null
     */
    public function findById(string $id): ?CollectionInterface;

    /**
     * @param object $object
     * @return CollectionInterface|null
     */
    public function findByAll(object $object): ?CollectionInterface;

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