<?php
require_once __DIR__ . '../../models/ArticleModel.php';
require_once __DIR__ . '../../config/database.php';

class ArticleService
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

    public function getAllArticles(): array
    {
        $sql = "CALL sp_BaiViet_getAll()";
        $result = $this->executeQuery($sql);

        $articles = [];
        while ($row = $result->fetch_assoc()) {
            $articles[] = new ArticleViewModel(
                $row['ma_bviet'],
                $row['tieude'],
                $row['ten_bhat'],
                $row['ten_tloai'],
                $row['tomtat'],
                $row['noidung'],
                $row['ten_tgia'],
                $row['ngayviet'],
                $row['hinhanh']
            );
        }

        return $articles;
    }

    public function createArticle(string $title, string $songName, int $categoryId, string $summary, string $content, int $authorId): void
    {
        $targetDir = __DIR__ . '../../../assets/images/articles/';
        $targetFile = $targetDir . basename($_FILES['fileArticleImage']['name']);

        if (!is_dir($targetDir) || !is_writable($targetDir)) {
            throw new Exception("Upload directory is not writable.");
        }

        if (!move_uploaded_file($_FILES['fileArticleImage']['tmp_name'], $targetFile)) {
            throw new Exception("Failed to upload file.");
        }

        $relativePath = '/assets/images/articles/' . basename($_FILES['fileArticleImage']['name']);

        $sql = "CALL sp_BaiViet_insert(?, ?, ?, ?, ?, ?, ?)";
        $this->executeQuery($sql, [$title, $songName, $categoryId, $summary, $content, $authorId, $relativePath]);
    }

    public function getArticleById(int $id): ?ArticleModel
    {
        $sql = "CALL sp_BaiViet_getById(?)";
        $result = $this->executeQuery($sql, [$id]);

        $row = $result->fetch_assoc();
        if (!$row) {
            return null;
        }

        return new ArticleModel($row['ma_bviet'], $row['tieude'], $row['ten_bhat'], $row['ma_tloai'], $row['tomtat'], $row['noidung'], $row['ma_tgia'], $row['ngayviet'], $row['hinhanh']);
    }

    public function updateArticle(int $id, string $title, string $songName, int $categoryId, string $summary, string $content, int $authorId, ?array $file = null): void
    {
        $sql = "CALL sp_BaiViet_update(?, ?, ?, ?, ?, ?, ?, ?)";
        $params = [$id, $title, $songName, $categoryId, $summary, $content, $authorId, null];

        if ($file && isset($file['fileArticleImage'])) {
            $targetDir = __DIR__ . '../../../assets/images/articles/';
            $targetFile = $targetDir . basename($file['fileArticleImage']['name']);

            if (!is_dir($targetDir) || !is_writable($targetDir)) {
                throw new Exception("Upload directory is not writable.");
            }

            if (!move_uploaded_file($file['fileArticleImage']['tmp_name'], $targetFile)) {
                throw new Exception("Failed to upload file.");
            }

            $relativePath = '/assets/images/articles/' . basename($file['fileArticleImage']['name']);
            $params[7] = $relativePath;
        }

        $this->executeQuery($sql, $params);
    }

    public function deleteArticle(int $id): void
    {
        $sql = "CALL sp_BaiViet_delete(?)";
        $this->executeQuery($sql, [$id]);
    }
}
