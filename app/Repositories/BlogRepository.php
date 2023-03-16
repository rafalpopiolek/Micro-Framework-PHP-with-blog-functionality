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
        $query = "SELECT * FROM blog LIMIT 100;";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll();

        if ($result) {
            return $result;
        } else {
            return [];
        }
    }

    public function getPaginated(
        int $start,
        int $length,
        string $search,
        string $orderBy,
        string $orderDir = 'ASC'
    ):
    array {
        $orderBy = in_array($orderDir, ['text']) ? $orderBy : 'text';
        $orderDir = strtolower($orderDir) === 'asc' ? 'asc' : 'desc';

        $query = "SELECT * FROM blog";

        $search = htmlspecialchars($search);

        if (! empty($search)) {
            $query .= " WHERE text LIKE '%$search%'";
        }

        $query .= " ORDER BY $orderBy $orderDir LIMIT :limit OFFSET :offset";

        $stmt = $this->connection->prepare($query);

        $stmt->execute([
            ':limit' => $length,
            ':offset' => $start,
        ]);

        return $stmt->fetchAll();
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

    public function count(): int
    {
        $result = $this->connection->query("SELECT COUNT(*) FROM blog;");

        return $result->fetchColumn();
    }
}
