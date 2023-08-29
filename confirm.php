<?php 
    session_start();
    $conn=pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
    if(empty($_SESSION['start']))
    {
        echo"<script>alert('Login First')</script>";
        echo"<script>window.location.href=window.location.href='login-website'</script>";

    }
    else
    {
        echo"<script>window.location.href=window.location.href='login-website/dashboard_book.php'</script>";

    }    

?>
