<?php
session_start();

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


    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Add New Class</h2>
            <a href="manage_classes.php" class="btn btn-primary">Back to Classes</a>
        </div>

        <form action="insert_class.php" method="POST">
            <div class="mb-3">
                <label for="className" class="form-label">Class Name</label>
                <input type="text" class="form-control" id="className" name="className" required>
            </div>
            <button type="submit" class="btn btn-warning">Add Class</button>
        </form>
    </div>

    </body> 
</html>

   <?php

}

else{
    header("Location: index.php");
    exit();
}

?>
