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

    public function getPaginated(DataTableParametersDto $params): array
    {
        $orderBy = in_array($params->orderBy, ['text', 'username']) ? $params->orderBy : 'text';
        $orderDir = strtolower($params->orderDir) === 'asc' ? 'asc' : 'desc';

        $query = "SELECT b.id, b.text, u.username FROM blog b INNER JOIN user u on b.userid = u.userid";

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
            ':text' => htmlspecialchars($text),
            ':userId' => getCurrentUser()['userid'],
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

    public function isAuthor(int $blogId): bool
    {
        if (! isAuth()) {
            return false;
        }

        $stmt = $this->connection->prepare("SELECT userid FROM blog WHERE id = ?");
        $stmt->execute([$blogId]);
        $userId = $stmt->fetchColumn();

        return $userId === (int)getCurrentUser()['userid'];
    }
}
