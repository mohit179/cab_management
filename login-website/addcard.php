<?php

session_start();
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
$username = $_SESSION['userid'];

if(isset($_POST['submit']))
{
    $cardno=$_POST['number'];
    $name=$_POST['name'];
    $cvv=$_POST['cvv'];
    $sql="INSERT into cards(card_no,card_name,cvv,user_email) values('$cardno','$name','$cvv','$username[0]');";
    $query=pg_query($conn,$sql);
    echo '<script>alert("Card added Successfully");</script>';
    echo '<script>window.location.href="addcard.php";</script>';
}
if (!empty($_SESSION['start'])) {
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
            <h3 class='w3-bar-item' style='width:100% ;text-align:center; color:white;'>Welcome " . $username[1] . "</h3>
            <a href='dashboard_book.php' class='w3-bar-item w3-button' style='width:100% ;text-align:center;  color:white; margin-top:10px;'>Book Your Ride</a>
            <a href='dashboard_past.php' class='w3-bar-item w3-button'style='width:100% ;text-align:center; color:white;'>View Past trips</a>
            <a href='addcard.php' class='w3-bar-item w3-button'style='width:100% ;text-align:center;color:white;'>Add Your Cards</a>
            <a href='viewcard.php' class='w3-bar-item w3-button'style='width:100% ;text-align:center;color:white;'>View All Cards</a>
            <a href='../logout.php' class='w3-bar-item w3-button' style='width:100% ;text-align:center;color:white;'>Logout</a>
        </div>
        <div id='container'>
            <div id='texty'>Add your card</div>
            <div id=box1 style='display:flex; justify-content:center;'>
            <div class='forminputs' style='display:flex; justify-content:center;'>
        <form action='addcard.php' method='post'>
            
            <div for='name'>Full Name(On the Card)</div>
            <input type='text' id='name' name='name' placeholder='Virat Kohli'style='border-radius: 5px;' required ><br><br>
            
            <div for='number'>Card number</div>
            <input type='text' id='number' name='number' style='border-radius: 5px;' placeholder='Card number' required><br><br>
            
            
            <div for='cvv'>Enter the 3 digit CVV</div>
            <input type='text' id='cvv' name='cvv' style='border-radius: 5px;' placeholder='CVV' required><br><br>
            
            <button class='btn btn-success' type='submit' name='submit'>Confirm</button>
        </form>
            
        </div>
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
