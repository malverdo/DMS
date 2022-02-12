<?php

namespace App\Infrastructure\Repository\BaseRepository\Contracts;


/**
 * Class CollectionInterface
 * @package App\Infrastructure\Repository\BaseRepository\Contracts
 */
interface CollectionInterface extends \Iterator, \ArrayAccess, \Countable
{
    /**
     * @param EntityInterface $value
     * @return CollectionInterface
     */
    public function push(EntityInterface $value): CollectionInterface;

    /**
     * @return array
     */
    public function getEntities(): array;
}