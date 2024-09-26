<?php
include "../../../config/db_connect.php";

$message = "";

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $sql = "CALL sp_BaiViet_delete('$id')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>alert("Xóa thành công")</script>';
    } else {
        echo '<script>alert("Xóa thất bại")</script>';
    }
} else {
    echo '<script>alert("No article ID provided.")</script>';
}

header("Location: ../article.php");
exit();
