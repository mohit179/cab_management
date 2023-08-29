<?php 
session_start();
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
if(!empty($_SESSION['start']))
{
    $sql1="select count(*) from cab";
    $res=pg_query($conn,$sql1);
    $arr1=pg_fetch_array($res);
    
    $sql2="select count(*) from driver";
    $res1=pg_query($conn,$sql2);
    $arr2=pg_fetch_array($res1);

    $sql3="select count(*) from users";
    $res2=pg_query($conn,$sql3);
    $arr3=pg_fetch_array($res2);

    $sql4="select count(*) from associate";
    $res3=pg_query($conn,$sql4);
    $arr4=pg_fetch_array($res3);

    $username=$_SESSION['userid'];
    echo "
        <html>

<head>
    <title></title>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script defer
        src='https://maps.googleapis.com/maps/api/js?libraries=places&language=en&key=YOUR_API_KEY_HERE'
        type='text/javascript'></script>
    <link href='//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' id='bootstrap-css' rel='stylesheet' />
    <link rel='stylesheet' href='dashboard.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
</head>
<body> 
    <div style=' display :flex;'>
        <div style='background: #1398c8;
        background: -webkit-linear-gradient(to right, #0ebcf6, #64b6ec, #43aecf, #59bfde);
        background: linear-gradient(to right, #0ebcf6, #64b6ec, #43aecf, #59bfde);'>
            <h3 class='w3-bar-item' style='width:100% ;text-align:center; color:white;'>Welcome Admin " . $username[1] . "</h3>
            <a href='admin_dash.php' class='w3-bar-item w3-button' style='width:100% ;text-align:center;  color:white; margin-top:10px;'>Home</a>
            <a href='associate.php' class='w3-bar-item w3-button' style='width:100% ;text-align:center;  color:white;'>View all Associates</a>
            <a href='users.php' class='w3-bar-item w3-button' style='width:100% ;text-align:center;  color:white;'>View all Users</a>
            <a href='cabs.php' class='w3-bar-item w3-button'style='width:100% ;text-align:center; color:white;'>View all associated Cabs</a>
            <a href='drivers.php' class='w3-bar-item w3-button'style='width:100% ;text-align:center;color:white;'>View All associated Drivers</a>
            <a href='logs.php' class='w3-bar-item w3-button'style='width:100% ;text-align:center;color:white;'>View all the logs</a>
            <a href='../logout.php' class='w3-bar-item w3-button' style='width:100% ;text-align:center;color:white;'>Logout</a>
        </div>
        <div id='container'>
    
            <div id='texty'>Home</div>
            <div id=box1 style='display:block !important;'>            
                <div>Total Associated cabs=".$arr1['count']."</div>
                <div>Total Associated drivers=".$arr2['count']."</div>
                <div>Total Associated users=".$arr3['count']."</div>
                <div>Total Associated associates=".$arr4['count']."</div>
            </div>
        </div>
    </div>
    
</body>

</html>
        
        
        ";
}



?>