<?php
include "header.php";
include "db.php";
$id=$_GET["id"];
$sql="SELECT * FROM products WHERE id=?";
$stmt=$pdo->prepare($sql);
$stmt->execute([$id]);
$product=$stmt->fetch(PDO::FETCH_ASSOC);
$sql="SELECT * FROM specs WHERE product_id=?";
$stmt=$pdo->prepare($sql);
$stmt->execute([$id]);
$specs=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product["name"];?></title>
    <link rel="stylesheet" href="product.css">

</head>
<body>
    <div class="container">
        <div class="image">
            <img src="images/<?php echo $product["image"];?>">
        </div>
        <div class="content">
            <h1><?php echo $product["name"] ." ". $product["type"] ." ". $specs["RAM"]." ".$specs["Color"]; ?></h1>
            <h2>Price: <?php echo $product["price"];?>$</h2>
            <form action="product.php?id=<?php echo $id;?>" method="POST">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity">
                <button type="submit">Add to Cart</button>
            </form>
        </div>

    </div>
    <table>
        <h1 style="text-align:center;">Product Specs</h1>
        <?php
        foreach($specs as $key=>$value){
         if(!empty($key)&& !str_contains($key,"id")&&!empty($value))
            echo"<tr><td>".$key."</td>"."<td>".$value."</td></tr>";
        }



        ?>
        
    </table>
    
</body>
</html>