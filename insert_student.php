<?php
session_start();
include "db_connect.php"; 

if (
    isset($_POST['name']) && isset($_POST['email']) && isset($_POST['address']) &&
    isset($_POST['class_id']) && isset($_FILES['image'])
) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class_id = $_POST['class_id'];
    

    $file = $_FILES['image'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExtensions = array('jpg', 'jpeg', 'png');

    if (in_array($fileExt, $allowedExtensions)) {
        if ($fileError === 0) {
            $fileNameNew = uniqid('', true) . "." . $fileExt;
            $fileDestination = 'uploads/' . $fileNameNew;
            
            move_uploaded_file($fileTmpName, $fileDestination);

            $created_at = date('Y-m-d H:i:s');
            $created_date = date('Y-m-d');

            $sql = "INSERT INTO student (name, email, address, created_at, class_id, image, create_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssiss", $name, $email, $address, $created_at, $class_id, $fileNameNew, $created_date);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                header("Location: home.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Invalid file type. Allowed types: jpg, jpeg, png.";
    }
} else {
    header("Location: create.php");
    exit();
}
?>
