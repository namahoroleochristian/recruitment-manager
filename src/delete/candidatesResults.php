<?php
session_start();
include('../config/db.php');

if (is_null($_SESSION['userName'])) {
   header('location: ./auth/login.php?error=403 ');
   exit();
}
if (isset($_GET['candidateResultId'])) {
    $id = $_GET['candidateResultId'];
    $sql = "DELETE FROM candidatesresult WHERE CRId=$id";
    $result = mysqli_query($conn,$sql);
    if ($result) {
        header('location: ../view/candidatesResults.php');
        exit();
    }
    else{
        echo die(mysqli_error($conn));
    }
}


?>