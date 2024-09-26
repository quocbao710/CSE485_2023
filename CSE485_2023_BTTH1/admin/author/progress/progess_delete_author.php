<?php
include "../../../config/db_connect.php";

$message = "";

if(isset($_GET["id"])){
    $id = $_GET["id"];

    $sql = "CALL sp_TacGia_delete('$id')";
    $result = mysqli_query($conn, $sql);

    if($result){
        $message = "Xóa thành công";
    } else {
        $message = "Xóa thất bại";
    }
} else {
    echo "No author ID provided.";
}

header("Location: ../author.php");
exit();