<?php
session_start();

include('../config/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
<form method="post">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Names ">
        </div>
        <div>
            <label for="password">password</label>
            <input type="password" name="password" placeholder="passwords ">
        </div>
        <button type="submit" name="submit" >Signup</button>
        <p>already have an account ? <a href="login.php">Login</a></p>
    </form>
    <?php
            if(isset($_POST['submit'])){

                $name=trim($_POST['name']);
                
                $password=trim($_POST['password']);
                
                if (empty($name) || empty($password) ) {
                    header("location: signup.php?error=EmptyFields");
                    exit(); 
                }
                $hashedPassword= password_hash($password,PASSWORD_BCRYPT);
                 
                $sql = "INSERT INTO users VALUES(null,'$name','$hashedPassword')";
                $result = mysqli_query($conn,$sql);
                if($result){
                    header("location: login.php?error=none");
                    exit();
                }
                else{
                    echo die(mysqli_error($conn));
                }
            }
    ?>
</body>
</html>