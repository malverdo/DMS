<?php

namespace App\Infrastructure\Repository\BaseRepository;


use App\Infrastructure\Repository\BaseRepository\Contracts\DataBaseConnectionInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

/**
 * Class PostgresConnection
 * @package App\Infrastructure\Repository\BaseRepository
 */
class PostgresConnection implements DataBaseConnectionInterface
{

    static private $dbConnection;

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function __construct()
    {
        $connectionParams = array(
            'dbname' => $_ENV['POSTGRES_DB'],
            'user' => $_ENV['POSTGRES_USER'],
            'password' => $_ENV['POSTGRES_PASSWORD'],
            'host' => $_ENV['POSTGRES_HOST'],
            'port' => $_ENV['POSTGRES_PORT'],
            'driver' => 'pdo_pgsql',
        );

        if (!self::$dbConnection) {
            self::$dbConnection = DriverManager::getConnection($connectionParams);
        }
    }

    /**
     * @return Connection
     */
    public function getConnection(): Connection
    {
        return self::$dbConnection;
    }
}