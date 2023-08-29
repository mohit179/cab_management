<?php 
    session_start();
    $conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
    if(!empty($_SESSION['start']))
    {
        if(isset($_POST['submit']))
        {
            $id=$_POST['number'];
            $sql="delete from cab where reg_no='".$id."';";
            $res=pg_query($conn,$sql);
            if($res)
            {
                echo '<script>alert("Cab removed successfully");</script>';
                echo '<script>window.location.href="associatedashboard_cabs.php";</script>';
            }
            else
            {
                echo '<script>alert("Technical Error  ... Try again later");</script>';
                echo '<script>window.location.href="associatedashboard_cabs.php";</script>';
            }
        }
    }    





?>