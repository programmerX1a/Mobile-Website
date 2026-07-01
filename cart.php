<?php 
session_start();

include "db.php";
include "header.php";
if(!isset($_SESSION["user_id"])){
    header("Location: index.php");
}
$total_sum=0;
$sql="SELECT * FROM cart WHERE user_id=?";
$stmt=$pdo->prepare($sql);
$stmt->execute([$_SESSION["user_id"]]);
$ids=$stmt->fetchAll(PDO::FETCH_ASSOC);
$products=[];

foreach($ids as $i){
    if(isset($i["product_id"])&&!empty($i["product_id"])){
        array_push($products,["id"=>$i["product_id"],"count"=>$i["count"]]);
    }
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $aproduct=$_GET["product_id"];
    $count=(int)$_GET["count"];
    if(isset($_POST["checkout"])&&!empty($_POST["checkout"])){
           header("Location: checkout.php");
           exit();
        }


    if(isset($_POST["decrease"])&&!empty($_POST["decrease"])&& $_POST["decrease"]=="decrease"){
        if(isset($count)&&!empty($count)){
            if($count<=1){
                $sql="DELETE FROM cart WHERE product_id=? AND user_id=?";
                $stmt=$pdo->prepare($sql);
                $stmt->execute([$aproduct,$_SESSION["user_id"]]);
            }
        
        else{
            $sql="UPDATE cart SET count=? WHERE product_id=? AND user_id=?";
            $stmt=$pdo->prepare($sql);
            $stmt->execute([$count-1,$aproduct,$_SESSION["user_id"]]);

        }
        }
    }
    else if(isset($_POST["increase"])&&!empty($_POST["increase"])&& $_POST["increase"]=="increase"){
           if(isset($count)&&!empty($count)){
            $sql="UPDATE cart SET count=? WHERE product_id=? AND user_id=?";
            $stmt=$pdo->prepare($sql);
            $stmt->execute([$count+1,$aproduct,$_SESSION["user_id"]]);

        }

    }
    else if(isset($_POST["remove"])&&!empty($_POST["remove"])&& $_POST["remove"]=="remove"){
            $sql="DELETE FROM cart WHERE product_id=? AND user_id=?";
            $stmt=$pdo->prepare($sql);
            $stmt->execute([$aproduct,$_SESSION["user_id"]]);


    }
    
    
    header("Location: cart.php");


}








?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <div class="container">
        <h1>Shopping Cart</h1>
        <?php
        $total_count=0;
        foreach($products as $i){
        $sql="SELECT * FROM products WHERE id=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$i["id"]]);
        $product=$stmt->fetch(PDO::FETCH_ASSOC);
        $total_sum+=($product["price"]*$i["count"]);
        $total_count+=$i["count"];
        echo'

        <div class="product">
        <img src="images/'.$product["image"].'">
            <div class="main">
                <h1>'.$product["name"].'</h1>
                <h2>Price: '.$product["price"].'$</h2>
                <form action="cart.php?product_id='.$i["id"].'&count='.$i["count"].'" method="POST">
                 <button type="submit" name="decrease" id="decrease" value="decrease"><</button>
                 <span>'.$i["count"].'</span>
                 <button type="submit" value="increase" name="increase" id="increase">></button>
                 <button type="submit" value="remove" name="remove" id="remove"><img style="width:100%; height:100%;"src="images/trash.png"></button>

                </form>
                <p>Total: '.$i["count"]*$product["price"].'$</p>
            </div>
        </div>




        ';
        }



         ?>
         <div class="end">
            <p>Grand Total(<?php echo $total_count;?> Items): <?php echo $total_sum;?>$</p>
            <div class="buttondiv">
               <form action="cart.php" method="POST"> 
                <button type="submit" name="checkout" value="checkout"> Proceed to Checkout </button>
               </form> 
            </div>
         </div>
    </div>
    



</body>
</html>