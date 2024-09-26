<?php
require_once __DIR__ . '../../config/database.php';
require_once __DIR__ . '../../models/CategoryModel.php';

class CategoryService
{
    private DBConnection $dbConn;

    public function __construct()
    {
        $this->dbConn = new DBConnection();
    }

    private function executeQuery($sql, $params = [])
    {
        $conn = $this->dbConn->connect();
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Failed to prepare query: " . $conn->error);
        }

        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            throw new Exception("Query execution failed: " . $stmt->error);
        }

        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();

        return $result;
    }

    public function getAllCategories(): array
    {
        $sql = "CALL sp_TheLoai_getAll()";
        $result = $this->executeQuery($sql);

        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = new CategoryModel($row['ma_tloai'], $row['ten_tloai']);
        }

        return $categories;
    }

    public function createCategory(string $name): void
    {
        $sql = "CALL sp_TheLoai_insert(?)";
        $this->executeQuery($sql, [$name]);
    }

    public function getCategoryById(int $id): ?CategoryModel
    {
        $sql = "CALL sp_TheLoai_getById(?)";
        $result = $this->executeQuery($sql, [$id]);

        if ($row = $result->fetch_assoc()) {
            return new CategoryModel($row['ma_tloai'], $row['ten_tloai']);
        }

        return null;
    }

    public function updateCategory(int $id, string $name): void
    {
        $sql = "CALL sp_TheLoai_update(?, ?)";
        $this->executeQuery($sql, [$id, $name]);
    }

    public function deleteCategory(int $id): void
    {
        $sql = "CALL sp_TheLoai_delete(?)";
        $this->executeQuery($sql, [$id]);
    }
}
