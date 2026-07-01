<?php
include "db.php";
session_start();
if(!isset($_SESSION["user_id"])||empty($_SESSION["user_id"])){
    header("Location: index.php");
}
$err1=$err2=$err3=$err4="";
$sql="SELECT * FROM cart WHERE user_id=?";
$stmt=$pdo->prepare($sql);
$stmt->execute([$_SESSION["user_id"]]);
$total=0;
$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($row as $i){
    $sql="SELECT * FROM products WHERE id=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$i["product_id"]]);
    $row2=$stmt->fetch(PDO::FETCH_ASSOC);
    $total+=$i["count"]*$row2["price"];
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["card"])||!isset($_POST["card"])){
        $err1="Enter Credit Card Number";
    }
    if(empty($_POST["name"])||!isset($_POST["name"])){
        $err2="Enter Card Name Holder";
    }
    if(empty($_POST["cvv"])||!isset($_POST["cvv"])){
        $err3="Enter CVV";
    }
    if(empty($_POST["my"])||!isset($_POST["my"])){
        $err4="Enter Credit Card Expiry Date";
    }
    
    $date=explode("/",$_POST["my"]);
    $current_year=((int)(explode("-",date("Y-m-d"))[0])) %100;
    $current_month=((int)(explode("-",date("Y-m-d"))[1]));
    if(!$date)$err4="Enter Valid Credit Card Expiry Date";
    else{
        if((int)$date[0]<1 || (int)$date[0]>12 ){
            $err4="Enter Valid Credit Card Expiry Date";
        }
        if(!isset($date[1])||!$date[1]||empty($date[1])) $err="Enter Valid Credit Card Expiry Date"; 
        else{
        if((int)$date[1]<$current_year  || $date[1]=="00"){
            $err4="Card Expired";
        }
        else{
            if((int)$date[0]<$current_month)
                $err4="Card Expired";
        }
        }
    }

    if(!$err1&&!$err2&&!$err3&&!$err4){
        header("Location: success.php");
        exit();
    }




}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1/dist/cleave.min.js"></script>

</head>
<body>
<div class="container">
<form action="checkout.php" method="POST">
<span ><a href="index.php">< Home</a></span>
<img src="images/credit.png">
<input name="name" placeholder="Card Holder Name" >
<?php if(isset($err2))  echo'<p>'.$err2.'</p>'; ?>
<div class="fakeinput">
<input placeholder="Card Number" id="credit" name="card">
<img  id="image">
</div>
    <?php if(isset($err1))  echo'<p>'.$err1.'</p>'; ?>
 
<div class="inputs" >
    <input name="my" placeholder="MM/YYYY" id="MMYYYY" class="MY">
   
    <input name="cvv" placeholder="CVV" class="cvv" id="cvv">
    
</div>
<div class="ps">
 <?php if(isset($err4))  echo'<p>'.$err4.'</p>'; ?>
 <?php if(isset($err3))  echo'<p>'.$err3.'</p>'; ?>

</div>


<div class="buttons">
    <button class="pay"type="submit">Pay <?php echo $total."$";?></button>
    <button class="cancel"><a href="index.php"> Cancel</a></button>
</div>
</form>
</div>
    <script src="checkout.js"></script>
</body>
</html>