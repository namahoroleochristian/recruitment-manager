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
                <a href="../config/job.php">Jobs</a>
                
            </li>
            <li>
                <a href="../auth/logout.php">logout</a>
                
            </li>
        </ul>
        </nav>

        <?php
        if (isset($_GET['candidateId'])) {
           $id = $_GET['candidateId'];
           $SelectSql = "SELECT * FROM candidates where CId='$id'";
          
           $result = mysqli_query($conn,$SelectSql);    
            $row = mysqli_fetch_assoc($result);
        }
        ?>
    <form  method="post">
        <div>
            <label for="fname">First Name</label>
            <input type="text" name="fname" value=<?php echo $row['CFirstName']?>>
        </div>
        <div>
            <label for="lname">Last Name</label>
            <input type="text" name="lname" value=<?php echo $row['CLastName']?>>
        </div>
        <div>
            <label for="gender">Gender</label>
            <select name="gender">
                <option value="male">male</option>
                <option value="female">female</option>
                <select>
            
        </div>
        <div>
            <label for="dob">Date Of Birth</label>
            <input type="date" name="dob" value=<?php echo $row['CDateOfBirth']?>>
        </div>
        <div>
            <label for="mobile">Phone number</label>
            <input type="text" name="mobile" value=<?php echo $row['PhoneNumber']?>>
        </div>
        <div>
            <label for="postId">PostId</label>
            <input type="text" name="postId" value=<?php echo $row['PostId']?>>
        </div>
        <button type="submit" name="submit">Update Candidate</button>
    </form>
    <?php
        if (isset($_POST['submit'])) {
            $fname=trim($_POST['fname']);
            $lname=trim($_POST['lname']);
            $gender=trim($_POST['gender']);
            $dob=trim($_POST['dob']);
            $mobile=trim($_POST['mobile']);
            $postId=trim($_POST['postId']);
            if ( empty($fname) || empty($lname) || empty($gender) || empty($dob) ||empty($mobile) || empty($postId)  ) {
                header('location: candidate.php?error?emptyFields');
            }
            $sql = "UPDATE candidates SET CFirstName='$fname',CLastName='$lname',Gender='$gender',CDateOfBirth='$dob',PhoneNumber='$mobile',PostId='$postId' WHERE CId=$id";
            $result= mysqli_query($conn,$sql);
            if ($result) {
                header('location: ../index.php');
                exit();
            }
            else{
                echo die(mysqli_error($conn));
            }

        }

?>
</body>
</html>