<?php
session_start();
include('../config/db.php');
    

if (is_null($_SESSION['userName'])) {
   header('location: ./auth/login.php?error=403 ');
   exit();
}
$isLoggedIn = !is_null($_SESSION['userName']);
// echo $isLoggedIn;

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
            <Button class="add"> <a class="add" href="../create/candidatesResults.php">Add results</a></Button>
            <table cellspacing=0 id="table">
                <thead>
                    <tr>
                        <th>Candidate Name</th>
                        <th>Post Name</th>
                        
                        <th>Date of exam </th>
                        <th>marks</th>
                        <th>decision</th>
                        <th colspan=2>action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT candidates.CFirstName, candidates.CLastName,post.PostName,candidatesresult.CRId,candidatesresult.examDate,candidatesresult.CRMarks, candidatesresult.CRDecision FROM candidates JOIN candidatesresult ON candidates.CId = candidatesresult.CId JOIN post ON post.postId = candidates.PostId;";
                        $result = mysqli_query($conn,$sql);
                        
                        while($row = mysqli_fetch_assoc($result)){
                            echo "
                                <tr>
                        <td>".$row['CFirstName']." ".$row['CLastName']."</td>
                        <td>".$row['PostName']."</td>
                        <td>".$row['examDate']."</td>
                        <td>".$row['CRMarks']."</td>
                        <td>".$row['CRDecision']."</td>
                         <td><button class='update'><a class='updatelink' href='../update/candidatesResults.php?candidateResultId=".$row['CRId']."'>update</a></button></td>
                        <td><button class='delete'><a class='deletelink' href='../delete/candidatesResults.php?candidateResultId=".$row['CRId']."'>delete</a></button></td>
                    </tr>
                            ";

                        }
                    ?>
                    
                </tbody>
            </table>
        </section>
    
        
       
</body>
</html>