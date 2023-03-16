<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\DatabaseConnection;
use App\DataObjects\DataTableParametersDto;
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

    public function getPaginated(DataTableParametersDto $params):
    array {
        $orderBy = in_array($params->orderDir, ['text']) ? $params->orderBy : 'text';
        $orderDir = strtolower($params->orderDir) === 'asc' ? 'asc' : 'desc';

        $query = "SELECT * FROM blog";

        $search = htmlspecialchars($params->search);

        if (! empty($search)) {
            $query .= " WHERE text LIKE '%$search%'";
        }

        $query .= " ORDER BY $orderBy $orderDir LIMIT :limit OFFSET :offset";

        $stmt = $this->connection->prepare($query);

        $stmt->execute([
            ':limit' => $params->length,
            ':offset' => $params->start,
        ]);

        return $stmt->fetchAll();
    }

    public function create(string $text): bool
    {
        $query = "INSERT INTO blog(`text`, `userid`) VALUES(:text, :userId);";

        $stmt = $this->connection->prepare($query);

        return $stmt->execute([
            ':text' => $text,
            ':userId' => 1,
        ]);
    }

    public function count(): int
    {
        $result = $this->connection->query("SELECT COUNT(*) FROM blog;");

        return $result->fetchColumn();
    }

    public function delete(int $id): bool
    {
        $stmt = $this->connection->prepare("DELETE FROM blog WHERE id = :id");

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}
