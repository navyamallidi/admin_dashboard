<?php
session_start();
include "db_connect.php";


if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    $sql = "SELECT * FROM student WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $student_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
            $email = $row['email'];
            $address = $row['address'];
            $class_id = $row['class_id'];
           
        } else {
            echo "Student not found.";
            exit();
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
        exit();
    }
} else {
    echo "Student ID not provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Student</h2>
        <form action="update_student.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
            
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" required><?php echo htmlspecialchars($address); ?></textarea>
            </div>
            
            <div class="mb-3">
                <label for="class_id" class="form-label">Class</label>
                <input type="text" class="form-control" id="class_id" name="class_id" value="<?php echo htmlspecialchars($class_id); ?>" required>
            </div>
            
            
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="home.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
