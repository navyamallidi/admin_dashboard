<?php
session_start();
include "db_connect.php";


if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

  
    $sql = "DELETE FROM student WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $student_id);
        mysqli_stmt_execute($stmt);

        
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Student deleted successfully.";
        } else {
            echo "Failed to delete student.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Student ID not provided.";
}


header("Location: home.php");
exit();
?>
