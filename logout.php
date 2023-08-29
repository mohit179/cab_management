<?php
session_start();
$_SESSION['start']=false;
session_destroy();
echo("<script> window.location='index.html'</script>");