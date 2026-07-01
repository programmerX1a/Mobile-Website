<?php

include "db.php";
session_start();

$id=$_GET["id"];
$sql="SELECT * FROM products WHERE id=?";
$stmt=$pdo->prepare($sql);
$stmt->execute([$id]);
$product=$stmt->fetch(PDO::FETCH_ASSOC);
$sql="SELECT * FROM specs WHERE product_id=?";
$stmt=$pdo->prepare($sql);
$stmt->execute([$id]);
$specs=$stmt->fetch(PDO::FETCH_ASSOC);
$err="";
$success="";
if(isset($_SESSION["success"])&&!empty($_SESSION["success"])){
    $success=$_SESSION["success"];
    unset($_SESSION["success"]);
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!isset($_SESSION["user_id"])||empty($_SESSION["user_id"]) ){
    $err="Error:You must be logged in to add to cart";
    $success="";
    }
    if(isset($_POST["quantity"])&&!empty($_POST["quantity"])){
        $cart=[
            "quantity"=>(int)$_POST["quantity"],
            "id"=>$id

        ];
        $sql="SELECT * FROM cart WHERE user_id=? AND product_id=?";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$_SESSION["user_id"],$cart["id"]]);
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
             $sql="UPDATE cart SET count=? WHERE user_id=? AND product_id=?";
             $stmt=$pdo->prepare($sql);
             $stmt->execute([$cart["quantity"]+$row["count"],$_SESSION["user_id"],$cart["id"]]);

        }
        else{
        $sql="INSERT INTO cart (count,user_id,product_id) VALUES(?,?,?)";
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$cart["quantity"],$_SESSION["user_id"],$cart["id"]]);
        }
        $success="Successfully Added to Cart!";
        $_SESSION["success"]=$success;
        header('Location: product.php?id='.$id);
    
       
    }
    else{
        $_SESSION["success"]="";
        $err="Error: Enter Quantity";
    
    }




}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product["name"];?></title>
    <link rel="stylesheet" href="product.css">
    <link rel="stylesheet" href="index.css">

</head>
<body>
    <?php
include "header.php";
?>

    <div class="container">
<?php
 if(isset($success)&&!empty($success))
  echo'
        <div class="success">
            <h1> '.$success.' </h1>
        </div>';
?>
        <div class="main">
            <div class="image">
                <img src="images/<?php echo $product["image"];?>">
            </div>
            <div class="content">
                <h1><?php echo $product["name"] ." ". $product["type"] ; ?></h1>
                <h2>Price: <?php echo $product["price"];?>$</h2>
                <form action="product.php?id=<?php echo $id;?>" method="POST">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" min="1">
                    <button type="submit" onclick="displaySuccess()">Add to Cart</button>
                    <?php echo'<p style="color:red;">'.$err.'</p>' ?>
                </form>
            </div>
        </div>
        <h1 class="specs">Product Specs</h1>
        <table>
        
        <?php
        foreach($specs as $key=>$value){
         if(!empty($key)&& !str_contains($key,"id")&&!empty($value))
            echo"<tr><td>".$key."</td>"."<td>".$value."</td></tr>";
        }



        ?>
        
        </table>

    </div>
    

</body>
</html>