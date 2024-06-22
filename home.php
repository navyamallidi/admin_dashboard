<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])){
    include "db_connect.php";
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-5">
            <h1>Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h1>
            <div>
                <a href="create.php" class="btn btn-primary mr-2">Create Student</a>
                <a href="manage_classes.php" class="btn btn-warning mr-2">Manage Classes</a>
            </div>
        </div>

        <div class="mt-3">
            <h2>Manage Students</h2>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Class</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM student";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['class_id']) . "</td>";
                            echo "<td>";
                            echo "<a href='view_student.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-info btn-sm mx-2'>View</a>";
                            echo "<a href='edit_student.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-primary btn-sm mx-2'>Edit</a>";
                            echo "<a href='delete_student.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this student?');\">Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No students found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <a href="logout.php" class="btn btn-danger justify-content-between align-items-center mt-3">Logout</a>
    </div>
</body>
</html>

<?php
} else {
    header("Location: index.php");
    exit();
}
?>
