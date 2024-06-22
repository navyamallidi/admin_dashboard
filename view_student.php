<?php
session_start();
include "db_connect.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])){
    if(isset($_GET['id'])) {
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
                $image = $row['image'];
                $created_at = $row['created_at'];
                $created_date = $row['create_date'];
                
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
    <title>View Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .student-image {
            max-width: 200px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-5">
            <h1>Student Details</h1>
            <a href="manage_students.php" class="btn btn-secondary">Back to Students</a>
        </div>

        <div class="mt-3">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Student ID</th>
                        <td><?php echo htmlspecialchars($student_id); ?></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><?php echo htmlspecialchars($name); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo htmlspecialchars($email); ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo htmlspecialchars($address); ?></td>
                    </tr>
                    <tr>
                        <th>Class</th>
                        <td><?php echo htmlspecialchars($class_id); ?></td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td><img src="uploads/<?php echo htmlspecialchars($image); ?>" alt="Student Image" class="student-image"></td>
                    </tr>
                    <tr>
                        <th>Created Date</th>
                        <td><?php echo htmlspecialchars($created_date); ?></td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td><?php echo htmlspecialchars($created_at); ?></td>
                    </tr>
                    <!-- Add more fields as needed -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
} else {
    header("Location: index.php");
    exit();
}
?>
