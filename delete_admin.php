<?php
session_start();
include "database.php";

// Check if id is passed
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM admin WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "
        <script>
            alert('Admin deleted successfully');
            window.location.href='view_admin.php';
        </script>";
        exit();
    }
}
