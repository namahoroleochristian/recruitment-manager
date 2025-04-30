<?php
session_start();
include('../config/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title> Login</title>
</head>
<body>
    <form method="post" id="create">
        <div>
            <label for="name">Name</label><br>
            <input type="text" name="name" placeholder="Names ">
        </div>
        <div>
            <label for="password">password</label><br>
            <input type="password" name="password" placeholder="passwords ">
        </div>
        <button type="submit" id="loginbutton" name="submit">login</button>
        <p>Don't have an account ? <a href="signup.php">signup</a></p>
    </form>
    <?php
            if(isset($_POST['submit'])){

                $name=trim($_POST['name']);
                
                $password=trim($_POST['password']);
                
                if (empty($name) || empty($password) ) {
                    header("location: login.php?error=EmptyFields");
                    exit(); 
                    
                }
                 
                $FindUsersql = "SELECT * FROM users WHERE UserName='$name'";
                $FoundUser = mysqli_query($conn,$FindUsersql);
                
                $User = mysqli_fetch_assoc($FoundUser); 
                
                if (!$User['UserName']) {
                    header("location: login.php?error=invalidCredentials");
                    exit(); 
                }
                $isPasswordMatching = password_verify($password,$User['Password']);

                if($isPasswordMatching){
                    $_SESSION['userName'] = $User['UserName'];
                    header("location: ../index.php?error=none");
                    exit();
                }
                else{
                    header("location: login.php?error=invalidCredential");
                    exit();
                }

                
            }
    ?>
</body>
</html>