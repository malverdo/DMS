<?php

namespace App\Infrastructure\Repository\BaseRepository\Contracts;


use Doctrine\DBAL\Connection;

/**
 * Interface DataBaseConnectionInterface
 * @package App\Infrastructure\Repository\BaseRepository\Contracts
 */
interface DataBaseConnectionInterface
{

    /**
     * @return Connection
     */
    public function getConnection(): Connection;
}