<?php
session_start();
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
include_once('index.html');
if (isset($_POST['submit'])) {
    $name = strtolower($_POST['username']);
    $password = $_POST['password'];
    if ($name != '' && $password != '') {
        $sql = "select * from users where user_email = '$name' ";
        $res = pg_query($conn, $sql);
        $n = pg_num_rows($res);
        if ($n == 0) {
            echo "<script>alert('you are not registered with us. please register yourself.');</script>";
        } 
        else {
            if($password==pg_fetch_array($res)['user_password'])
            {
                $_SESSION['start'] = true;
                $_SESSION['userid'] = pg_fetch_array($res,0);
                echo "<script>alert('Logged in');</script>";
                echo("<script> window.location='dashboard_book.php'</script>");
            }            
            else
            {
                echo "<script>alert('Wrong Password');</script>";                
            }
     }
    }}


?>

