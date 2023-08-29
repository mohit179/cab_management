<?php 
session_start();
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
$username = $_SESSION['userid'];
if (!empty($_SESSION['start'])) {
    if(isset($_POST['submit']))
    {
        $email=$_POST['email'];
        $dob=$_POST['DOB'];
        $name=$_POST['name'];
        $number=$_POST['number'];
        $sql1="Select * from driver where driver_email='".$email."';";
        $res1=pg_query($conn,$sql1);
        if(pg_num_rows($res1)!=0)
        {
            echo '<script>alert("Driver already added");</script>';  
            echo "<script>window.location.href='associatedashboard_adddriver.php';</script>";      
        } 
        $sql="INSERT INTO driver(driver_email,driver_name,driver_dob,associate_email,driver_account) VALUES('$email','$name','$dob','$username[0]','$number');";
        $res=pg_query($conn,$sql);
        if($res)
        {
            echo "<script>alert('Driver Added Successfully');</script>";
            echo "<script>window.location.href='associatedashboard_adddriver.php';</script>";
        }
        else
        {
            echo "<script>alert('Technical Error Try Again Later');</script>";
        }
    }
}


?>