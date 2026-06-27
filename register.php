<?php
include "db.php";
session_start();
$err1=$err2=$err3="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $_SESSION["err"]="";
    if(!isset($_POST["username"]) || empty($_POST["username"])){
        $err1="Enter a valid Username";
    }
    else{
        $username=htmlspecialchars($_POST["username"]);
    }
    if(!isset($_POST["password"]) || empty($_POST["password"])){
        $err2="Enter a Password";
    }
    else{
        $password=htmlspecialchars($_POST["password"]);
    }
    if(!isset($_POST["cpassword"]) || empty($_POST["cpassword"])){
        $err3="Enter Confirmed Password";
    }
    else{
        $cpassword=htmlspecialchars($_POST["cpassword"]);
    }
    if(!empty($password)&&!empty($cpassword)){
        if($password!=$cpassword){
            $err3="Passwords dont match";
        }
        else{
            $password=password_hash($password, PASSWORD_DEFAULT);
        }
    }
    

    if(!$err1&&!$err2&&!$err3){
    $sql="SELECT * FROM users WHERE name=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$username]);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($row){
        $err1="User already exists";
        
    }
    else{
        $sql="INSERT INTO users (name,password) VALUES(?,?)";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$username,$password]);
        $_SESSION["username"]=$username;
        $sql="SELECT id FROM users WHERE name=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$username]);
        $id=$stmt->fetch(PDO::FETCH_ASSOC)["id"];
        $_SESSION["user_id"]=$id;
        $_SESSION["logged"]=true;
        header("Location: index.php");
    }
    
    


  
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <form action="register.php" method="post">
        <span><img src="images/arrow.png" width="20px" height="10px"><a href="header.php">Home</a></span>
        <h1>Registration</h1>
        
        <div class="field">        
          <label for="username">Username</label>
          <input name="username" id="username" placeholder="Enter Username">
          <?php 
        if(isset($err1))
          echo'<p style="width:50%;">' .$err1.'</p>'; 
         ?>
        </div>
        <div class="field"> 
          <label for="password">Password</label>
          <input name="password" id="password" placeholder="Enter Password">
          <?php 
        if(isset($err2))
          echo'<p style="width:50%;">' .$err2.'</p>'; 
         ?>
        </div>

        <div class="field"> 
          <label for="cpassword">Confirm Password</label>
          <input id="cpassword" name="cpassword" placeholder="Enter The Same Password">
          <?php 
        if(isset($err3))
          echo'<p style="width:50%;">' .$err3.'</p>'; 
         ?>
        </div>
        <button type="submit" name="register">Register</button>

        

    </form>
    
</body>
</html>

