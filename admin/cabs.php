<?php 
session_start();
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
if(!empty($_SESSION['start']))
{
    $text="<tr>   <td>Cab_reg_no</td>   <td>cab_type</td>  <td>cab_color</td>    <td>associated_with</td> <td>Associate_email</td> <td></td></tr>";
    $sql="select * from cab;";
    $res=pg_query($conn,$sql);
    while($row=pg_fetch_array($res))
    {
        $sql2="select associate_name from associate where associate_email='".$row['associate_email']."';";
        $res2=pg_query($conn,$sql2);
        $assname=pg_fetch_array($res2)['associate_name'];
        $text=$text."<tr><td>".$row['reg_no']."</td>   <td>".$row['cab_type']."</td>  <td>".$row['cab_color']."</td><td>".$assname."</td><td>".$row['associate_email']."</td>   <td> 
        <form action='remove_cab.php' method='POST'>
            <input name='id' value=".$row['reg_no']." hidden>
            <button name='submit'>Remove</button>
        
        </form>     
        </td></tr>";
    }
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
    <style>
        table,th,td{
            border:1px solid black;
            padding:2px 2px 2px 2px;
            text-align:center;
        }
    </style>
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
    
            <div id='texty'>All Cabs</div>
            <div id=box1 >            
                <table>
                ".$text."
                </table>

            </div>
        </div>
    </div>
    
</body>

</html>
        
        
        ";
}
