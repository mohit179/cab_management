<?php
$conn=pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
$email="grahilsinghal72@gmail.com";
$str="UPDATE register SET password='hehehasle' WHERE username='$email'";
$result = pg_query($str);
if($result)
{
    echo "done";
}