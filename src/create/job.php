<?php
session_start();
include('../config/db.php');

if (is_null($_SESSION['userName'])) {
   header('location: ./auth/login.php?error=403 ');
   exit();
}
$isLoggedIn = !is_null($_SESSION['userName']);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav>
    <ul>
            <li>
                <a href="../index.php">Beauty</a>
            </li>
        </ul>
    <ul>
        <?php
        if( !$isLoggedIn){
            echo "
                <li>
                <a href='../auth/login.php'>login</a>
                
            </li>
            <li>
                <a href='../auth/signup.php'>signup</a>
                
            </li>
            ";
        };
        ?>
                
            <li>
                <a href="job.php">Jobs</a>
                
            </li>
            <li>
                <a href="../auth/logout.php">logout</a>
                
            </li>
        </ul>
        </nav>
    <form  method="post">
        <div>
            <label for="postName">Post Name</label>
            <input type="text" name="postName" placeholder="Post Name">
        </div>
        <button type="submit" name="submit">Add Post</button>
    </form>

    <?php
        if (isset($_POST['submit'])) {
            $postName=trim($_POST['postName']);
            if ( empty($postName)  ) {
                header('location: job.php?error?emptyFields');
            }
            $sql = "INSERT INTO post VALUES(null,'$postName')";
            $result= mysqli_query($conn,$sql);
            if ($result) {
                header('location: job.php');
                exit();
            }
            else{
                echo die(mysqli_error($conn));
            }

        }

?>
</body>
</html>