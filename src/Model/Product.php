<?php
declare(strict_types=1);

namespace App\Model;

use App\Database\Database;
use PDO;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read float $price
 * @property-read string|null $availability_date
 * @property-read string|null $description
 * @property-read string|null $image_path
 * @property-read int|null $in_stock
 */
class Product
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function all(string $search = '', int $page = 1, int $perPage = 10): array
    {
        $offset = ($page - 1) * $perPage;

        $sql = "
            SELECT *
            FROM products
        ";

        if ($search !== '') {
            $sql .= " WHERE name LIKE :search";
        }

        $sql .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);

        if ($search !== '') {
            $stmt->bindValue(':search', '%' . $search . '%');
        }

        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        try {
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function count(string $search = ''): int
    {
        $sql = "SELECT COUNT(*) FROM products";

        if ($search !== '') {
            $sql .= " WHERE name LIKE :search";
        }

        $stmt = $this->db->prepare($sql);

        if ($search !== '') {
            $stmt->bindValue(':search', '%' . $search . '%');
        }

        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    public function find(int $productId): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM products WHERE id = :id"
        );

        $stmt->bindValue(':id', $productId, PDO::PARAM_INT);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        return $product !== false ? $product : null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO products (
                name,
                price,
                availability_date,
                description,
                image_path,
                in_stock
            ) VALUES (
                :name,
                :price,
                :availability_date,
                :description,
                :image_path,
                :in_stock
            )
        ");

        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':price', $data['price']);
        $stmt->bindValue(':availability_date', $data['availability_date']);
        $stmt->bindValue(':description', $data['description']);
        $stmt->bindValue(':image_path', $data['image_path']);
        $stmt->bindValue(':in_stock', $data['in_stock'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function update(int $productId, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE products
            SET
                name = :name,
                price = :price,
                availability_date = :availability_date,
                description = :description,
                image_path = :image_path,
                in_stock = :in_stock
            WHERE id = :id
        ");

        $stmt->bindValue(':id', $productId, PDO::PARAM_INT);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':price', $data['price']);
        $stmt->bindValue(':availability_date', $data['availability_date']);
        $stmt->bindValue(':description', $data['description']);
        $stmt->bindValue(':image_path', $data['image_path']);
        $stmt->bindValue(':in_stock', $data['in_stock'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete(int $productId): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM products WHERE id = :id"
        );

        $stmt->bindValue(':id', $productId, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
