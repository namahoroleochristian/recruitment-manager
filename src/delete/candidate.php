<?php
session_start();
include('../config/db.php');

if (is_null($_SESSION['userName'])) {
   header('location: ./auth/login.php?error=403 ');
   exit();
}
if (isset($_GET['candidateId'])) {
    $id = $_GET['candidateId'];
    $sql = "DELETE FROM candidates WHERE CId=$id ";
    $result = mysqli_query($conn,$sql);
    if ($result) {
        header('location: ../index.php');
        exit();
    }
    else{
        echo die(mysqli_error($conn));
    }
}


?>