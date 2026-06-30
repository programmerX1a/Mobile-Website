<?php
    try {
        $dbhost = 'localhost';
        $dbname='Mobile_Website';
        $dbuser = 'root';
        $dbpass = '';
        $pdo = new PDO(
"mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
    }
   catch (PDOException $e) {
        echo "Error : " . $e->getMessage() . "<br/>";
        die();
    }