<?php
session_start();
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
$sql2 = "INSERT INTO driver (d_email,d_name, d_number,d_password,d_dob) VALUES('grahilsinghal72@gmail.com','grahil','8085095909','123','123')";
$res = pg_query($conn, $sql2);