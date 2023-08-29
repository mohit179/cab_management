<?php 
session_start();
$conn=pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
if (isset($_POST['confirmride'])){
    $email=$_SESSION['userid'][0];
    $amount=$_POST['amount'];
    $distance=$_POST['distance'];
    $origin=$_POST['origin'];
    $mode=$_POST['mode'];
    $destination=$_POST['destination'];
    $sql1="select * from associate order by random() limit 1;";
    $res1=pg_query($conn,$sql1);
    $randass=pg_fetch_array($res1)[0];
    $sql2="select * from driver where associate_email='".$randass."' order by random() limit 1;";
    $sql3="select * from cab where associate_email='".$randass."' order by random() limit 1;";
    $res2=pg_query($conn,$sql2);
    $res3=pg_query($conn,$sql3);
    
    $res2=pg_query($conn,$sql2);
    $randdriver=pg_fetch_array($res2)[0];
    
    $res3=pg_query($conn,$sql3);
    $randreg=pg_fetch_array($res3)[0];
    
    $randasspro=(double)(pg_fetch_array($res1,0)[5]);
    $randasspro=$randasspro+(double)((0.1)*(double)($amount));
    
    $randassdriver=(double)(pg_fetch_array($res2,0)[5]);
    $randassdriver=$randassdriver+(double)((0.9)*(double)($amount));
    
    $sql5="update driver set available_profit='".$randassdriver."' where driver_email='".$randdriver."';";
    $sql6="update associate  set associate_balance='".$randasspro."' where associate_email='".$randass."';";
    
    $res10=pg_query($conn,$sql5);
    $res11=pg_query($conn,$sql6);
    

    $sql="INSERT INTO rides(origin,destination,distance,amount,driver_email,user_email,payment_mode,cab_number,associate_email,booking_time) VALUES('$origin','$destination','$distance','$amount','$randdriver','$email','$mode','$randreg','$randass',now());";
    $res = pg_query($conn, $sql);
    echo '<script>alert("Trip Successfully Added");</script>';
    echo '<script>window.location.href="dashboard_book.php";</script>';
}

?>