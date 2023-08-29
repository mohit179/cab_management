<?php
session_start();
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
if (!empty($_SESSION['start'])) {
    if (isset($_POST['submit'])) {
        $emailid = $_SESSION['userid'][0];
        $color = $_POST['color'];
        $number = $_POST['cabnumber'];
        $type = $_POST['type'];
        $sql1="Select * from cab where reg_no='".$number."';";
        $res1 = pg_query($conn, $sql1);
        $n=pg_num_rows($res1);
        if($n!=0)
        {
            echo '<script>alert("cab already registered");</script>';
            echo '<script>window.location.href="associatedashboard.php"</script>';
        }
        
        
        $sql = "INSERT INTO cab(associate_email,cab_type,cab_color,reg_no) VALUES('$emailid','$type','$color','$number');";
        $res = pg_query($conn, $sql);
        if ($res)
            echo '<script>alert("Cab Added Successfully");</script>;';
        else
            echo "<script>alert('fail');</script>;";
        echo "<script>window.location.href='associatedashboard.php'</script>";
    } else {
     echo 'sa';
    }
} else
    {
        echo "<script>alert('Login First');</script>;";
        echo "<script>window.location.href='index.html'</script>";
    }
