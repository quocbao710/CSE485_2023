<?php
require_once __DIR__ . '../../config/database.php';
require_once __DIR__ . '../../models/AuthorModel.php';

class AuthorService
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

    public function getAllAuthors(): array
    {
        $sql = "CALL sp_TacGia_getAll()";
        $result = $this->executeQuery($sql);

        $authors = [];
        while ($row = $result->fetch_assoc()) {
            $authors[] = new AuthorModel($row['ma_tgia'], $row['ten_tgia'], $row['hinh_tgia']);
        }

        return $authors;
    }

    public function createAuthor(string $name): void
    {
        $targetDir = __DIR__ . '../../../assets/images/authors/';
        $targetFile = $targetDir . basename($_FILES['fileAuthorImage']['name']);

        if (!is_dir($targetDir) || !is_writable($targetDir)) {
            throw new Exception("Upload directory is not writable.");
        }

        if (!move_uploaded_file($_FILES['fileAuthorImage']['tmp_name'], $targetFile)) {
            throw new Exception("Failed to upload file.");
        }

        $relativePath = '/assets/images/authors/' . basename($_FILES['fileAuthorImage']['name']);

        $sql = "CALL sp_TacGia_insert(?, ?)";
        $this->executeQuery($sql, [$name, $relativePath]);
    }

    public function getAuthorById(int $id): ?AuthorModel
    {
        $sql = "CALL sp_TacGia_getById(?)";
        $result = $this->executeQuery($sql, [$id]);

        $author = $result->fetch_assoc();
        return $author ? new AuthorModel($author['ma_tgia'], $author['ten_tgia'], $author['hinh_tgia']) : null;
    }

    public function updateAuthor(int $id, string $name, ?array $file = null): void
    {
        $sql = "CALL sp_TacGia_update(?, ?, ?)";
        $params = [$id, $name, null];

        if ($file && isset($file['fileAuthorImage'])) {
            $targetDir = __DIR__ . '../../../assets/images/authors/';
            $targetFile = $targetDir . basename($file['fileAuthorImage']['name']);

            if (!is_dir($targetDir) || !is_writable($targetDir)) {
                throw new Exception("Upload directory is not writable.");
            }

            if (!move_uploaded_file($file['fileAuthorImage']['tmp_name'], $targetFile)) {
                throw new Exception("Failed to upload file.");
            }

            $relativePath = '/assets/images/authors/' . basename($file['fileAuthorImage']['name']);
            $params[2] = $relativePath;
        }

        $this->executeQuery($sql, $params);
    }


    public function deleteAuthor(int $id): void
    {
        $sql = "CALL sp_TacGia_delete(?)";
        $this->executeQuery($sql, [$id]);
    }
}
