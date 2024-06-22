<?php
session_start();
include "db_connect.php";

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])){
    ?>


<!DOCTYPE html>
<html>
    <head>
        <title>Manage Classes</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

    <div class="d-flex justify-content-between align-items-center mb-3 mt-5 mx-3">
                <h2>Your Classes</h2>
                <a href="add_classes.php" class="btn btn-primary">Add Class</a>
    </div>



    <div class="d-flex justify-content-between align-items-center mt-5 mx-5 text-primary">
            <table class="table table-bordered border border-warning rounded">
                <thead>
                    <tr>
                        <th>Class Name</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM class";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                            echo "<td><a href='delete_class.php?id=" . htmlspecialchars($row['class_id']) . "' class='btn btn-danger'>Delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No classes found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
                </div>
</html>

   <?php

}

else{
    header("Location: index.php");
    exit();
}

?>
