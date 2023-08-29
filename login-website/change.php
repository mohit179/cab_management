<?php
session_start();

$conn=pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
if (isset($_POST['submit'])){
$pass=$_POST['password'];
$repass=$_POST['repassword']; 
if($pass!=$repass){
    echo '<script>alert("password does not match")</script>';
}
else
{
    $email=$_SESSION['email'];
    $pass1=password_hash($pass,PASSWORD_BCRYPT);
    $str="UPDATE users SET password='$pass1' WHERE email='$email'";
    $result = pg_query($str);
    if($result)
    {
        echo '<script>alert("Password changed successfully")</script>';
        session_destroy();
        header('location:index.php');
        
    }
}
}
include_once('change.html');

?>