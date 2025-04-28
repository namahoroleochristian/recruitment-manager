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
                <a href="../create/job.php">Jobs</a>
                
            </li>
            <li>
                <a href="candidatesResults.php">Candidate Results</a>
                
            </li>
            <li>
                <a href="../auth/logout.php">logout</a>
                
            </li>
        </ul>
        </nav>
        <section>
            <Button> <a href="../create/candidatesResults.php">Add results</a></Button>
            <table border=1 cellspacing=0>
                <thead>
                    <tr>
                        <th>Candidate id</th>
                        <th>Candidate Result Id</th>
                        
                        <th>date of birth</th>
                        <th>marks</th>
                        <th>decision</th>
                        <th colspan=2>action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM candidatesresult";
                        $result = mysqli_query($conn,$sql);
                        
                        while($row = mysqli_fetch_assoc($result)){
                            echo "
                                <tr>
                        <td>".$row['CId']."</td>
                        
                 
                        <td>".$row['CRId']."</td>
                        <td>".$row['examDate']."</td>
                        <td>".$row['CRMarks']."</td>
                        <td>".$row['CRDecision']."</td>
                        <td><button><a href='../update/candidatesResults.php?candidateResultId=".$row['CRId']."'>update</a></button></td>
                        <td><button><a href='../delete/candidatesResults.php?candidateResultId=".$row['CRId']."'>delete</a></button></td>
                    </tr>
                            ";

                        }
                    ?>
                    
                </tbody>
            </table>
        </section>
    
        
       
</body>
</html>