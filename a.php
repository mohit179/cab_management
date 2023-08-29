<?php
session_start();
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");

if (isset($_POST['onsubmit'])) {
    $color = $_POST['color'];
    echo
    $number = $_POST['cabnumber'];
    $type = $_POST['type'];
    $sql = "INSERT INTO cab VALUES('11','$type','$color','$number');";
    $res = pg_query($conn, $sql);
    if ($res)
        echo "<script><alert>'done'</alert></script>;";
    else
        echo "<script><alert>'fail'</alert></script>;";

    
}
