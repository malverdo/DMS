<?php

namespace App\Infrastructure\Repository\BaseRepository\Contracts;


/**
 * Interface EntityInterface
 * @package App\Infrastructure\Repository\BaseRepository\Contracts
 */
interface EntityInterface
{
    /**
     * @return string|int|null
     */
    public function getId();

    /**
     * @return bool
     */
    public function isNew(): bool;

    /**
     * @param bool $new
     * @return mixed
     */
    public function setNew(bool $new);
}