<?php

session_start();
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
$username = $_SESSION['userid'];

if (!empty($_SESSION['start'])) {
    $sql="Select * from associate where associate_email='".$username[0]."';";
    $res=pg_query($conn,$sql);
    $row=pg_fetch_array($res);
    $avai=$row['associate_balance'];
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
            <h3 class='w3-bar-item' style='width:100% ;text-align:center; color:white;'>Welcome driver " . $username[1] . "</h3>
            <a href='associatedashboard.php' class='w3-bar-item w3-button' style='width:100% ;text-align:center;  color:white; margin-top:10px;'>Add Your Cab</a>
            <a href='associatedashboard_adddriver.php' class='w3-bar-item w3-button' style='width:100% ;text-align:center;  color:white;'>Add your Drivers</a>
            <a href='associatedashboard_cabs.php' class='w3-bar-item w3-button'style='width:100% ;text-align:center; color:white;'>View Your Cabs</a>
            <a href='associatedashboard_drives.php' class='w3-bar-item w3-button'style='width:100% ;text-align:center;color:white;'>View All Drivers</a>
            <a href='associatedashboard_withdraw.php' class='w3-bar-item w3-button'style='width:100% ;text-align:center;color:white;'>Withdraw Profit</a>
            <a href='../logout.php' class='w3-bar-item w3-button' style='width:100% ;text-align:center;color:white;'>Logout</a>
        </div>
        <div id='container'>
        <div style ='position:absolute; right:10px;top:20px;'>Availabe Profit= ".$avai." INR</div>
            <div id='texty'>Add Your Cab  </div>
            <div id=box1>
            
            <form action='adddriver.php' method='POST' class='cabs'>
                <label for='driver_email'>Driver Email</label>
                <input type='email' id='driver_email' name='email' required/><br>
                <label for='driver_name'>Driver name</label>
                <input type='text' id='driver_name' name='name' required /><br>
                <label for='driver_account'>Driver Bank Acc. Number</label>
                <input type='text' id='driver_account' name='number' required /><br>
                <label for='driver_dob'>Driver DOB</label>
                <input type='date' id='driver_dob' name='DOB' /><br>




            <button type='submit' name='submit'>Submit</button>
        </form>
            
            </div>
        </div>
    </div>
    
</body>

</html>
        
        
        ";
    
} else {
    echo "<script>alert('Log in first');</script>";
    echo ("<script>window.location='index.html';</script>");
}
