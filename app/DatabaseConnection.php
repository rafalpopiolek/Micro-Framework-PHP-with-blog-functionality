<?php

declare(strict_types = 1);

namespace App;

use PDO;
use PDOException;

/**
 * @mixin PDO
 */
class DatabaseConnection
{
    private PDO $pdo;

    public function __construct(array $dbConfig)
    {
        $config = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $dsn = $dbConfig['driver'] . ':host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['database'];
        try {
            $this->pdo = new PDO(
                $dsn,
                $dbConfig['user'],
                $dbConfig['password'],
                $dbConfig['options'] ?? $config,
            );
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->pdo, $name], $arguments);
    }
}
