<?php
include "../../../config/db_connect.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $catId = (int)$_POST["txtCatId"];
    $catName = $_POST["txtCatName"];

    if (!empty($catName)) {
        $sql = "CALL sp_TheLoai_update('$catId', '$catName')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $message = "Cập nhật thể loại thành công";
        } else {
            $message = "Cập nhật thể loại thất bại";
        }
    } else {
        $message = "Vui lòng nhập tên thể loại";
    }
}

header("Location: ../edit_category.php?id=" . $catId . "&message=" . urlencode($message));

exit();