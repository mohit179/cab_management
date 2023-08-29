<?php
session_start();
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
if (isset($_POST['submit'])) {
    if ($_POST['otp'] == $_SESSION['otp']) {
        $name = $_SESSION['name'];
        $emailid = strtolower($_SESSION['email']);
        $pass = $_SESSION['password'];
        $mobile = $_SESSION['number'];
        $gender="k";
        $sql = "INSERT INTO users (user_email,user_name, user_mobile,user_password,user_gender) VALUES('$emailid','$name','$mobile','$pass','$gender')";
        $res = pg_query($conn, $sql);
        session_destroy();
        echo '<script>alert("Successfully Registered");</script>';
        echo '<script>window.location.href="index.html";</script>';
    } else {
        echo '<script>alert("Enter valid OTP");</script>';
    }
}
include_once 'verify_otp.html';
?>