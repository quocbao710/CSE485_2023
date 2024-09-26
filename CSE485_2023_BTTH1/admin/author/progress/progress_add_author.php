<?php
include "../../../config/db_connect.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authorName = $_POST["txtAuthorName"];
    $authorImage = $_POST["fileAuthorImage"];

    if (!empty($authorName)) {
        $sql = "CALL sp_TacGia_insert('$authorName', '$authorImage')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $message = "Thêm tác giả thành công";
        } else {
            $message = "Thêm tác giả thất bại";
        }
    } else {
        $message = "Vui lòng nhập tên tác giả";
    }
}

header("Location: ../add_author.php?message=" . urlencode($message));
exit();