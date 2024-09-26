<?php
include "../../../config/db_connect.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $songName = $_POST["songName"];
    $categoryId = $_POST["categoryId"];
    $summary = $_POST["summary"];
    $content = $_POST["content"];
    $authorId = $_POST["authorId"];
    $image = $_POST["image"];

    if (!empty($title) && !empty($songName) && !empty($categoryId) && !empty($summary) && !empty($authorId)) {
        $sql = "CALL sp_BaiViet_insert('$title', '$songName', '$categoryId', '$summary', '$content', '$authorId', '$image')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $message = "Thêm bài viết thành công";
        } else {
            $message = "Thêm bài viết thất bại";
        }
    } else {
        $message = "Vui lòng nhập đầy đủ thông tin";
    }
}

header("Location: ../add_article.php?message=" . urlencode($message));
exit();
