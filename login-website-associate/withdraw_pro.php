<?php

session_start();
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
$username = $_SESSION['userid'];

if (!empty($_SESSION['start'])) {
    if(isset($_POST['submit']))
    {
        $id=$_POST['id'];
        $balance=$_POST['balance'];
        $acc=$_POST['account'];
        if($balance<10)
        {
            echo "<script>alert('Minimum Amount to withdraw is 10');</script>";
            echo "<script>window.location.href='associatedashboard_drives.php';</script>";
        }
    $sql1="Insert into withdraws_driver(withdraw_amount,withdraw_account,driver_email,withdraw_time) values('$balance','$acc','$id',now()); ";
    $sql2="update driver set available_profit='0' where driver_email='".$id."';";
    $res1=pg_query($conn,$sql1);
    $res2=pg_query($conn,$sql2);
    
    echo "<script>alert('withdraw successful');</script>";
    echo "<script>window.location.href='associatedashboard_drives.php';</script>";


    }
    if(isset($_POST['submit1']))
    {
        $id=$_POST['id'];
        $sql="Delete from driver where driver_email='".$id."';";
        $res=pg_query($conn,$sql);
        echo "<script>alert('driver removed successfully');</script>";
        echo "<script>window.location.href='associatedashboard_drives.php';</script>";

    }

}


?>