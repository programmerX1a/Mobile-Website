<?php
session_start();
$_SESSION["user_id"]=$_SESSION["username"]=$_SESSION["admin"]=$_SESSION["logged"]="";
session_destroy();
session_unset();
header("Location: index.php");


?>