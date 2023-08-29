<?php

session_start();
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
$username = $_SESSION['userid'];
$account=$username[4];
if (!empty($_SESSION['start'])) {
    if(isset($_POST['submit']))
    {
        $balancee=$_POST['balancee'];
    if($balancee<10)
    {
        echo "<script>alert('Minimum Amount to withdraw is 10');</script>";
        echo "<script>window.location.href='associatedashboard_withdraw.php';</script>";
        
    }
    $sql1="Insert into withdraws_associate(associate_email,associate_withdraw_amount,associate_withdraw_time,withdraw_account) values('$username[0]','$balancee',now(),'$account'); ";
    $sql2="update associate set associate_balance=0 where associate_email='".$username[0]."';";
    $res1=pg_query($conn,$sql1);
    $res2=pg_query($conn,$sql2);
    
    echo "<script>alert('withdraw successful');</script>";
    echo "<script>window.location.href='associatedashboard_withdraw.hp';</script>";

    }
}
?>