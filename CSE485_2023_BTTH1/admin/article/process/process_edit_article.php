<?php
include "../../../config/db_connect.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $songName = $_POST["songName"];
    $categoryId = $_POST["categoryId"];
    $summary = $_POST["summary"];
    $content = $_POST["content"];
    $authorId = $_POST["authorId"];
    $image = $_POST["image"];

    // if (!empty($id) && !empty($title) && !empty($songName) && !empty($categoryId) && !empty($summary) && !empty($authorId)) {
        $sql = "CALL sp_BaiViet_update('$id', '$title', '$songName', '$categoryId', '$summary', '$content', '$authorId', '$image')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $message = "Cập nhật bài viết thành công";
        } else {
            $message = "Cập nhật bài viết thất bại";
        }
    // } else {
    //     $message = "Vui lòng nhập đầy đủ thông tin";
    // }
}

header("Location: ../edit_article.php?id=" . $id . "&message=" . urlencode($message));
exit();
