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
    <link rel="stylesheet" href="../style/style.css">

    <title>Document</title>
</head>
<body>
<nav>
    <ul class="title">
            <li>
                <a href="../index.php">Beauty</a>
            </li>
        </ul>
    <ul class="NavItems">
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
                <a href="../view/candidatesResults.php">Candidate Results</a>
                
            </li>
            <li>
                <a href="../auth/logout.php">logout</a>
                
            </li>
        </ul>
        </nav>
    <form  method="post" class="postForm">
        <div class="group">
            <label for="postName">Post Name</label>
            <input class="postName" type="text" name="postName" placeholder="Post Name">
        </div>
        <button type="submit" name="submit" class="add">Add Post</button>
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
<section>
    
    <table id="tablepost" border=1 cellspacing=0>
    <thead>
        <tr>
            <th>Post Id</th>
        <th>Post Name</th>
        <th colspan=2>action</th>
    </tr>

</thead>
<tbody>
<?php
    $sql = "SELECT * FROM post";
    $result = mysqli_query($conn,$sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
       echo "
       <tr>
    <td>".$row['PostId']."</td>
    <td>".$row['PostName']."</td>
    <td><button class='update'><a class='updatelink' href='../update/job.php?postId=".$row['PostId']."'>update</a></button></td>
    <td><button class='delete'><a class='deletelink' href='../delete/job.php?postId=".$row['PostId']."'>delete</a></button></td>
</tr>
       ";
    }
    ?>
</tbody>

    </table>
   
</section>
</body>
</html>