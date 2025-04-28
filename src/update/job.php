<?php
session_start();
include('../config/db.php');
    

if (is_null($_SESSION['userName'])) {
   header('location: ./auth/login.php?error=403 ');
   exit();
}
$isLoggedIn = !is_null($_SESSION['userName']);
echo $isLoggedIn;

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
                <a href="candidatesResults.php">Candidate Results</a>
                
            </li>
                
            <li>
                <a href="../create/job.php">Jobs</a>
                
            </li>
            <li>
                <a href="../auth/logout.php">logout</a>
                
            </li>
        </ul>
        </nav>

        <?php
        if (isset($_GET['postId'])) {
           $id = $_GET['postId'];
           $SelectSql = "SELECT * FROM post where PostId='$id'";
          
           $result = mysqli_query($conn,$SelectSql);    
            $row = mysqli_fetch_assoc($result);
        }
        ?>
    <form  method="post">
        <div>
            <label for="postName">Job Name</label>
            <input type="text" name="postName" value=<?php echo $row['PostName']?>>
        </div>
       
        <button type="submit" name="submit">Update Candidate</button>
    </form>
    <?php
        if (isset($_POST['submit'])) {
            $postname=trim($_POST['postName']);
            
            if ( empty($postname)   ) {
                header('location: candidate.php?error?emptyFields');
            }
            $sql = "UPDATE post SET PostName='$postname' WHERE PostId=$id";
            $result= mysqli_query($conn,$sql);
            if ($result) {
                header('location: ../create/job.php');
                exit();
            }
            else{
                echo die(mysqli_error($conn));
            }

        }

?>
</body>
</html>