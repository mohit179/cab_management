<?php
session_start();
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
$mail = new PHPMailer();
$mail->isSMTP();
// $mail->SMTPDebug=2;
$mail->Host = 'smtp.office365.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->Username = 'YOUR_EMAIL_HERE';
$mail->Password = 'YOUR_PASSWORD_HERE';
$mail->setFrom('YOUR_EMAIL_HERE', 'Grahil Tech');
$mail->addReplyTo('YOUR_EMAIL_HERE', 'Grahil Tech');
$mail->subject = 'Reset Password';
$mail->isHTML(true);
$template =
    '<!DOCTYPE HTML>
<html dir="rtl">

<head>
<meta charset="utf-8">
</head>

<body style="font-family: tahoma, sans-serif !important;">
<div style="font: 13px tahoma,sans-serif !important;direction: ltr;background-color: #e8e8e8;">
    <div
        style="width: 70%;background-color: #fff;background-color: #fff; border-radius: 3px;margin: auto;position: relative;border-left: 1px solid #d9d9d9;border-right: 1px solid #d9d9d9;">
        <div
            style="top: 0;position: absolute;width: 100%; height: 4px;background: url( \'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAECAYAAAD8kH0gAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAGhJREFUeNpi/P///xkGKFh27TfDkiu/GQiBKC1WhhgdVoLqXkzsZHje30ZQnUR+OYNkYRVWORZkxy0DOo6JgGERpDhuYgcDAxN+EyVyS3E6DgSYkB3HQG3HEQo5Ao4DO3AwOw4EAAIMAMZJM9nl1EbWAAAAAElFTkSuQmCC\' ) repeat;">
        </div>
        <div style="padding: 22px 15px;">Hello <br> The otp to reset the passsword of your account is <br>
            <br>{TEXT}<br><br>
            Happy Shopping!!!<br>
            Regards<br>
            SaVaGe Sales
        </div>
        <div
            style="bottom: 0;position: absolute;width: 100%; height: 4px;background: url( \'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAECAYAAAD8kH0gAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAGhJREFUeNpi/P///xkGKFh27TfDkiu/GQiBKC1WhhgdVoLqXkzsZHje30ZQnUR+OYNkYRVWORZkxy0DOo6JgGERpDhuYgcDAxN+EyVyS3E6DgSYkB3HQG3HEQo5Ao4DO3AwOw4EAAIMAMZJM9nl1EbWAAAAAElFTkSuQmCC\' ) repeat;">
        </div>
    </div>
</div>
</body>

</html>';
include_once('forgot.html');
//$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = pg_query($sql);
    if (pg_num_rows($result) == 0) {
        echo '<script>alert("Register with us first");</script>';
    } 
    else {
        $_SESSION['email'] = $email;
        date_default_timezone_set('Etc/UTC');
        $otp = mt_rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $msg = str_replace('{TEXT}', $otp, $template);
        $mail->msgHTML($msg);
        $mail->AltBody = 'hello';
        $email = $email;
        $mail->addAddress($email);
        if ($mail->send()) {
        $issent = true;
        $_SESSION['otpsent'] = true;
        header("location:otp.php");
        }
    }
}
