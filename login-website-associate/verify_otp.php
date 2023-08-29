<?php
session_start();
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
if (isset($_POST['submit'])) {
    if ($_POST['otp'] == $_SESSION['otp']) {
        $name = $_SESSION['name'];
        $emailid = strtolower($_SESSION['email']);
        $pass = $_SESSION['password'];
        $owner=$_SESSION['owner'];
        // echo ".$owner.";
        $mobile = $_SESSION['number'];
        $sql2 = "INSERT INTO associate (associate_email,associate_name, associate_account_no,associate_password,associate_owner) VALUES('$emailid','$name','$mobile','$pass','$owner')";
        $res = pg_query($conn, $sql2);
        session_destroy();
        echo '<script>alert("Successfully Registered");</script>';
        echo'<script>window.location.href="index.html";</script>';
    } else {
        echo '<script>alert("Enter valid OTP");</script>';
    }
}
include_once 'verify_otp.html';
?>