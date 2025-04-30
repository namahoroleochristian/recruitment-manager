<?php
$conn = mysqli_connect('localhost','root','','Emp_Recruitment',3309);
if ($conn) {
    // echo "connection established";
}
else{
    echo die(mysqli_error($conn));
};


?>
<?php
?>