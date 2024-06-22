<?php
session_start();
include "db_connect.php"; 
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_GET['id'])) {
    $class_id = intval($_GET['id']);

   
    $sql = "DELETE FROM class WHERE class_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $class_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    
    header("Location: manage_classes.php");
    exit();
} else {
    
    header("Location: index.php");
    exit();
}
?>
