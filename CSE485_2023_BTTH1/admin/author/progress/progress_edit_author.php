<?php
include "../../../config/db_connect.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authorId = $_POST["txtAuthorId"];
    $authorName = $_POST["txtAuthorName"];
    $authorImage = $_POST["fileAuthorImage"];

    if (!empty($authorName)) {
        $sql = "CALL sp_TacGia_update('$authorId', '$authorName', '$authorImage')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $message = "Cập nhật tác giả thành công";
        } else {
            $message = "Cập nhật tác giả thất bại";
        }
    } else {
        $message = "Vui lòng nhập tên tác giả";
    }
}

header("Location: ../edit_author.php?id=" . $authorId . "&message=" . urlencode($message));
exit();