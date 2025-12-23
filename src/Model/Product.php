<?php
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

    public function all(string $search, int $page, int $perPage = 10): array
    {
        $offset = ($page - 1) * $perPage;

        if (!empty($search)) {
            $stmt = $this->db->prepare(
                "SELECT * FROM products 
             WHERE name LIKE :search
             LIMIT :limit OFFSET :offset"
            );
            $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        } else {
            $stmt = $this->db->prepare(
                "SELECT * FROM products 
             LIMIT :limit OFFSET :offset"
            );
        }
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM products");

        return (int) $stmt->fetchColumn();
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO products (name, price, availability_date, description, image_path) 
             VALUES (:name, :price, :availability_date, :description, :image_path)"
        );

        return $stmt->execute([
            ':name'              => $data['name'],
            ':price'             => $data['price'],
            ':availability_date' => $data['availability_date'],
            ':description'       => $data['description'],
            ':image_path'        => $data['image_path'],
        ]);
    }

    public function update(int $productId, array $data): bool
    {
        $stmt = $this->db->prepare("
            UPDATE products 
            SET name = :name, 
                price = :price, 
                availability_date = :availability_date, 
                description = :description, 
                image_path = :image_path,
                in_stock = :in_stock
            WHERE id = :id
        ");

        return $stmt->execute([
            ':name'              => $data['name'],
            ':price'             => $data['price'],
            ':availability_date' => $data['availability_date'],
            ':description'       => $data['description'],
            ':image_path'        => $data['image_path'],
            ':in_stock'          => $data['in_stock'],
            ':id'                => $productId,
        ]);
    }

    public function find(int $productId): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id' => $productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        return $product ?: null;
    }

    public function delete(int $productId): bool
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");

        return $stmt->execute([':id' => $productId]);
    }
}