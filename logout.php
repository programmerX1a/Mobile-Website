<?php
session_start();
session_destroy();
session_unset();
$_SESSION["user_id"]=$_SESSION["username"]=$_SESSION["admin"]=$_SESSION["logged"]="";
header("Location: index.php");


?>