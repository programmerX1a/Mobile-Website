<?php

include "db.php";
$sql="SHOW COLUMNS FROM products";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
$fields=[];
$products=[];
foreach($row as $i){
  if($i["Field"]!="id"){
    array_push($fields,$i["Field"]);
    array_push($products,$i["Field"]);
  }
}
$sql="SHOW COLUMNS FROM specs";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
$specs=[];
foreach($row as $i){
 if($i["Field"]!='id'&& $i["Field"]!='product_id'){
    array_push($fields,$i["Field"]);
    array_push($specs,$i["Field"]);
 }
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $products_values=[];
    
    for($i=0;$i<count($products);$i++){
      if(isset($_POST[$products[$i]])&&!empty($_POST[$products[$i]]))
        array_push($products_values,$_POST[$products[$i]]);
      else
        array_push($products_values,NULL);
    }
    $specs_values=[];
    for($i=0;$i<count($specs);$i++){
      if(isset($_POST[$specs[$i]])&&!empty($_POST[$specs[$i]]))
        array_push($specs_values,$_POST[$specs[$i]]);
      else
        array_push($specs_values,NULL);
    }
    $products_placeholders = rtrim(
    str_repeat("?,", count($products)),
    ","
    );
    $specs_placeholders = rtrim(
    str_repeat("?,", count($specs)),
    ","
    );
    $products=implode(", ",$products);
    $specs=implode(", ",$specs);
    $sql="INSERT INTO products ($products) VALUES($products_placeholders)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute($products_values);
    $sql="INSERT INTO specs ($specs) VALUES($specs_placeholders)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute($specs_values);
    $product_id=$pdo->lastInsertId();
    $sql="UPDATE specs SET product_id=? WHERE id=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$product_id,$product_id]);

    header("Location: admin.php");
    




}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php include"header.php"; ?>
    <div class="container">
        <form action="admin.php" method="post">
            <table>
                
                <?php
                $i=0;
                while($i<count($fields)){
                echo"<tr>";
                   for($j=0;$j<4;$j++){
                  if($i<count($fields))
                    echo' <td>'.$fields[$i].'</td> <td><input name="'.$fields[$i].'" id="'.$fields[$i].'""></td>';
                    $i++;

                   }
                   echo"</tr>";
                }


                ?>
                
            </table>
            <div class="buttondiv">
            <button type="submit">Add Product</button>
            </div>

    </form> 

    </div>
    
</body>
</html>