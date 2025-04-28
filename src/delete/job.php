<?php
session_start();
include('../config/db.php');

if (is_null($_SESSION['userName'])) {
   header('location: ./auth/login.php?error=403 ');
   exit();
}
if (isset($_GET['postId'])) {
    $id = $_GET['postId'];
    $sql = "DELETE FROM post WHERE PostId=$id ";
    $result = mysqli_query($conn,$sql);
    if ($result) {
        header('location: ../create/job.php');
        exit();
    }
    else{
        echo die(mysqli_error($conn));
    }
}


?>