<?php
session_start();
include "db_connect.php"; 

if (isset($_POST['className'])) {
    $className = $_POST['className'];
    
    $sql = "INSERT INTO class (name, created_at) VALUES (?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $className);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: manage_classes.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: add_class.php");
    exit();
}
?>
