<?php
session_start();
include "db_connect.php";

if (
    isset($_POST['student_id']) && isset($_POST['name']) && isset($_POST['email']) &&
    isset($_POST['address']) && isset($_POST['class_id'])
) {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class_id = $_POST['class_id'];

    $sql = "UPDATE student SET name=?, email=?, address=?, class_id=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $address, $class_id, $student_id);
        mysqli_stmt_execute($stmt);


        if (mysqli_stmt_affected_rows($stmt) > 0) {
        
            header("Location: home.php");
            exit();
        } else {
            echo "Failed to update student.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Missing required parameters.";
}

mysqli_close($conn);
?>
