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
    <ul class= "title"> 
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
        ?><li>
        <a href="../view/candidatesResults.php">Candidate Results</a>
        
    </li>
                
            <li>
                <a href="../config/job.php">Jobs</a>
                
            </li>
            <li>
                <a href="../auth/logout.php">logout</a>
                
            </li>
        </ul>
        </nav>

        <?php
        if (isset($_GET['candidateResultId'])) {
           $id = $_GET['candidateResultId'];
           $SelectSql = "SELECT * FROM candidatesresult where CRId='$id'";
          
           $result = mysqli_query($conn,$SelectSql);    
            $row = mysqli_fetch_assoc($result);
        }
        ?>
     <form  method="post">
        <div>
            <label for="cid">candidate Id</label>
            <input type="text" name="cid" value=<?php echo $row['CId'] ?>>
        </div>
       
        <div>
            <label for="doe">Date Of Exam</label>
            <input type="date" name="doe" value=<?php echo $row['examDate'] ?>>
        </div>
        
        
            <label for="marks">marks</label>
            <input type="text" name="marks" value=<?php echo $row['CRMarks'] ?>>
        </div>
        <div>
            <label for="decision">decision</label>
            <select name="decision">
                <option value="pass">pass</option>
                <option value="fail">fail</option>
                <select>
            
        </div>
        <button type="submit" name="submit">Add candidates result </button>
    </form>
    
         <?php
         if (isset($_POST['submit'])) {
             $cid=trim($_POST['cid']);
             $decision=trim($_POST['decision']);
             $doe=trim($_POST['doe']);
             $marks=trim($_POST['marks']);
             if ( empty($cid) || empty($decision) || empty($doe) || empty($marks)  ) {
                 header('location: candidatesResults.php?error?emptyFields');
                 exit();
             }
             $sql = "UPDATE candidatesResult SET CId='$cid',examDate='$doe',CRMarks='$marks',CRDecision='$decision' WHERE CRId=$id";
             $result= mysqli_query($conn,$sql);
             if ($result) {
                 header('location: ../view/candidatesResults.php');
                 exit();
             }
             else{
                 echo die(mysqli_error($conn));
             }
 
         }
 
 ?>


</body>
</html>