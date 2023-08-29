<?php 
    session_start();
    $conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
    if(!empty($_SESSION['start']))
    {
        if(isset($_POST['submit']))
        {
            $id=$_POST['id'];
            $sql="delete from users where user_email='".$id."';";
            $res=pg_query($conn,$sql);
            if($res)
            {
                echo '<script>alert("User removed successfully");</script>';
                echo '<script>window.location.href="users.php";</script>';
            }
            else
            {
                echo '<script>alert("Technical Error  ... Try again later");</script>';
                echo '<script>window.location.href="users.php";</script>';
            }
        }
    }    





?>