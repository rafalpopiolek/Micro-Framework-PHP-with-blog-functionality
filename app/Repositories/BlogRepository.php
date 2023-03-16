<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\DatabaseConnection;
use App\Repositories\Contracts\BlogRepositoryInterface;

readonly class BlogRepository implements BlogRepositoryInterface
{
    public function __construct(private DatabaseConnection $connection)
    {
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM blog;";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll();

        if ($result) {
            return $result;
        } else {
            return [];
        }
    }

    public function create(string $text): bool
    {
        $query = "INSERT INTO blog(`text`, `userid`) VALUES(:text, :userId);";

        $stmt = $this->connection->prepare($query);

        $result = $stmt->execute([
            ':text' => $text,
            ':userId' => 1,
        ]);

        return true;
    }
}
