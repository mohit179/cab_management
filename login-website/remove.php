<?php

session_start();
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
$username = $_SESSION['userid'];
if(isset($_POST['submit']))
{
    $s_no=$_POST['s_no'];
    $sql="delete from cards where s_no='$s_no'";
    $res=pg_query($conn,$sql);
    echo '<script>alert("Card deleted successfully!!");</script>';
    echo '<script>window.location.href="viewcard.php";</script>';
}