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
        $dsn = $dbConfig['driver'] . ':host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['database'];
        try {
            $this->pdo = new PDO(
                $dsn,
                $dbConfig['user'],
                $dbConfig['password']
            );
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function __call(string $name, array $arguments)
    {
        call_user_func_array([$this->pdo, $name], $arguments);
    }
}
