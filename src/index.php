<?php
session_start();
include("./config/db.php");
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
    <link rel="stylesheet" href="./style/style.css">
    <title>Beauty</title>
</head>
<body>
    <nav >
        <ul class="title">
            <li>
                Beauty
            </li>
    </ul>
       
    <ul class="NavItems">
        <?php
        if( !$isLoggedIn){
            echo "
                <li>
                <a href='./auth/login.php'>login</a>
                
            </li>
            <li>
                <a href='./auth/signup.php'>signup</a>
                
            </li>
            ";
        };
        ?>
                
                <li>
                <a href="./create/job.php">Jobs</a>
                
            </li>
            <li>
                <a href="./view/candidatesResults.php">Candidate Results</a>
                
            </li>
            <li>
                <a href="./auth/logout.php">logout</a>
                
            </li>
        </ul>
        </nav>
        <section>
            <Button class="add" > <a   href="./create/candidate.php">Add candidate</a></Button>
            <table border=1 cellspacing=2 id="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Candidate's Firstname</th>
                        <th>Candidate's Lastname</th>
                        <th>Gender</th>
                        <th>date of birth</th>
                        <th>phone number</th>
                        <th>Post Id</th>
                        <th colspan=2>action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM candidates";
                        $result = mysqli_query($conn,$sql);
                        
                        while($row = mysqli_fetch_assoc($result)){
                            echo "
                                <tr>
                        <td>".$row['CId']."</td>
                 
                        <td>".$row['CFirstName']."</td>
                        <td>".$row['CLastName']."</td>
                        <td>".$row['Gender']."</td>
                        <td>".$row['CDateOfBirth']."</td>
                        <td>".$row['PhoneNumber']."</td>
                        <td>".$row['PostId']."</td>
                        <td><button><a class='updatelink' href='./update/candidate.php?candidateId=".$row['CId']."'>update</a></button></td>
                        <td><button><a class='updatelink' href='./delete/candidate.php?candidateId=".$row['CId']."'>delete</a></button></td>
                    </tr>
                            ";

                        }
                    ?>
                    
                </tbody>
            </table>
        </section>
    
        
       
</body>
</html>