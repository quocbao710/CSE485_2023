<?php
require_once __DIR__ . '../../config/database.php';
require_once __DIR__ . '../../models/UserModel.php';

class AuthService
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

    public function login(string $username, string $password): ?UserModel
    {
        $sql = "CALL sp_User_login(?, ?)";
        $result = $this->executeQuery($sql, [$username, $password]);

        $user = null;
        if ($row = $result->fetch_assoc()) {
            $user = new UserModel($row['id'], $row['username'], $row['password']);
        }

        return $user;
    }

    public function register(string $username, string $password): void
    {
        $sql = "CALL sp_User_register(?, ?)";
        $this->executeQuery($sql, [$username, $password]);
    }
}
