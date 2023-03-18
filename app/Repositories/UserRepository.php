<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\DatabaseConnection;
use App\Repositories\Contracts\UserRepositoryInterface;

readonly class UserRepository implements UserRepositoryInterface
{
    public function __construct(private DatabaseConnection $connection)
    {
    }

    public function findByName(string $username): mixed
    {
        $query = "SELECT userid, username, password, permission, readonly FROM user WHERE username = ?";
        $stmt = $this->connection->prepare($query);
        if ($stmt->execute([$username])) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }

    public function register(string $username, string $password, string $permission, string $readonly): bool
    {
        $query = <<<'EOF'
            INSERT INTO user (username, password, permission, readonly) 
            VALUES (:username, :password, :permission, :readonly);
        EOF;

        $stmt = $this->connection->prepare($query);

        return $stmt->execute([
            ':username' => $username,
            ':password' => $password,
            ':permission' => $permission,
            ':readonly' => $readonly,
        ]);
    }
}
