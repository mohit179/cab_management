<?php
session_start();
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if(isset($_POST['submit']))
{
    if($_POST['otp']==$_SESSION['otp'])
    {
        header("location: change.php");
        
    }
    else
    {
        echo '<script>alert("Enter valid OTP");</script>';
        // header("location: ./otp.php");        
        
    }
}

include_once 'otp.html';

?>