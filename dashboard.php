<?php
    
    session_start();
    if(!empty($_SESSION['start']))
    {
    $username=$_SESSION['userid'];
    echo"
    <html>
    <head></head>
    <body>Welcome =" .$username[1]."
    <a href=logout.php>logout</a>
    </body>
    </html>
    ";
    }
    else
    {
        echo "<script>alert('Log in first');</script>";
        echo("<script>window.location='index.html';</script>");
                
    }
?>