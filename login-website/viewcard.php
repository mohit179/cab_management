<?php

session_start();
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
$username = $_SESSION['userid'];

if (!empty($_SESSION['start'])) {
    $sql = "select * from cards where user_email='" . $username[0] . "';";
    $query=pg_query($conn,$sql);
    $text="";

    while ($row = pg_fetch_array($query)) 
    {
        $text=$text."<div class='card-box'>
                <div class='namefield'>".$row['card_name']." <img src='../visa-seeklogo.com.svg' height='25px' width='40px'>
                    <form method='POST' action='remove.php'>
                        <input value='".$row['s_no']."' name='s_no' type='hidden'></input>
                        <button style='color:black;' type ='submit'name='submit' >Remove</button>
                    </form>
                </div>
                <div style='display: flex; width: 100%; justify-content: space-between; padding-bottom: 20px;'>
                <div class='cardno'>".$row['card_no']." </div>
                <div class='expiry'>".$row['cvv']."</div>
                </div>
            </div>";          
    }
    
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
    <link rel='stylesheet' href='view.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
</head>
<body> 
    <div style=' display :flex;'>
        <div style='background: #1398c8;
        background: -webkit-linear-gradient(to right, #0ebcf6, #64b6ec, #43aecf, #59bfde);
        background: linear-gradient(to right, #0ebcf6, #64b6ec, #43aecf, #59bfde);'>
            <h3 class='w3-bar-item' style='width:100% ;text-align:center; color:white;'>Welcome " . $username[1] . "</h3>
            <a href='dashboard_book.php' class='w3-bar-item w3-button' style='width:100% ;text-align:center;  color:white; margin-top:10px;'>Book Your Ride</a>
            <a href='dashboard_past.php' class='w3-bar-item w3-button'style='width:100% ;text-align:center; color:white;'>View Past trips</a>
            <a href='addcard.php' class='w3-bar-item w3-button'style='width:100% ;text-align:center;color:white;'>Add Your Cards</a>
            <a href='viewcard.php' class='w3-bar-item w3-button'style='width:100% ;text-align:center;color:white;'>View All Cards</a>
            <a href='../logout.php' class='w3-bar-item w3-button' style='width:100% ;text-align:center;color:white;'>Logout</a>
        </div>
        <div id='container'>
            <div id='texty'>My Cards</div>
            <div id='box2' >
            
            ".$text."
            

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
