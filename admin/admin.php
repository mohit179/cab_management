<?php 
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");

if(isset($_POST['submit']))
{
    $email=strtolower($_POST['email']);
    $password=$_POST['password'];
    $sql1="select * from admin where admin_email='".$email."';";
    $res=pg_query($conn,$sql1);
    if(pg_num_rows($res)==0)
    {
        echo "<script>alert('You are not an admin.. Better go on user login');</script>";
        echo "<script>window.location.href='admin.html';</script>";
        
    }   
    else
    {
        $row=pg_fetch_array($res);
        if($row['admin_password']==$password)
        {
            session_start();
            $_SESSION['userid']=$row;
            $_SESSION['start']=true;
            $name=$row['admin_name'];
            echo "<script>alert('Logged in Successfully. Welcome ".$name."');</script>";
            echo "<script>window.location.href='admin_dash.php';</script>";
        }
        else
        {
            echo "<script>alert('Wrong Credentials. Enter a valid password!!');</script>";
            echo "<script>window.location.href='admin.html';</script>";
        }
    }
}
?>