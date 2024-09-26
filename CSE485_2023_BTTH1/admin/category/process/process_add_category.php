<?php
include "../../../config/db_connect.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $catName = $_POST["txtCatName"];

    if (!empty($catName)) {
        $sql = "CALL sp_TheLoai_insert('$catName')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $message = "Thêm thể loại thành công";
        } else {
            $message = "Thêm thể loại thất bại";
        }
    } else {
        $message = "Vui lòng nhập tên thể loại";
    }
}

header("Location: ../add_category.php?message=" . urlencode($message));
exit();
