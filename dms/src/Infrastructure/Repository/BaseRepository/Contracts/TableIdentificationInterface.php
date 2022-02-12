<?php

namespace App\Infrastructure\Repository\BaseRepository\Contracts;


/**
 * Interface TableIdentificationInterface
 * @package App\Infrastructure\Repository\BaseRepository\Contracts
 */
interface TableIdentificationInterface
{

    /**
     * @return string
     */
    public function getTableName(): string;

    /**
     * @return string
     */
    public function getKeyName(): string;

    /**
     * @return string
     */
    public function getTableAlias(): string;

}