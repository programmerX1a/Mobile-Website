<?php
include "db.php";
session_start();
if(empty($_GET["search"])||!isset($_GET["search"])){
    $_GET["search"]="";
}


$items_per_page=99;

if(isset($_GET["page"])&&!empty($_GET["page"])){
    $page=$_GET["page"];
}
else{
    $page=1;
}
if($_GET["category"]=="all"){
    $sql="SELECT COUNT(*) FROM products WHERE name LIKE ? ";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(["%".$_GET["search"]."%"]);
}
else{
    $sql="SELECT COUNT(*) FROM products WHERE type=? AND name LIKE ?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$_GET["category"],"%".$_GET["search"]."%"]);
}
$count=$stmt->fetch();
$count=$count[0];




$offset=($page-1)*$items_per_page;
$total_pages=(int)ceil($count/$items_per_page);
if($_GET["category"]=="all"){
    $sql="SELECT * FROM products WHERE name LIKE ? LIMIT $items_per_page OFFSET $offset  ";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(["%".$_GET["search"]."%"]);
}
else{
    $sql="SELECT * FROM products WHERE type=? AND name LIKE ? LIMIT $items_per_page OFFSET $offset ";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$_GET["category"],"%".$_GET["search"]."%"]);
}
$products=$stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $_GET["search"]?></title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="search.css">
</head>
<body>
    <?php include "header.php"?>
    <div class="container">
        <?php
        foreach($products as $i){
            echo'
            <div class="product">
            
               <a href="product.php?id='.$i["id"].'"><img src="images/' .$i["image"].' "></a>
               <a href="product.php?id='.$i["id"].'"><span>'.$i["name"].'  </span></a>
               <a href="product.php?id='.$i["id"].'"><p>'.$i["price"].'$</p></a>
            


            </div>
            
            
            ';
        }
      
        ?>

    </div>
    <div class="buttons">
        <span class="arrow"><a href="search.php?category=<?php echo $_GET["category"]?>&search=<?php echo $_GET["search"]?>&page=<?php if($page>1) echo $page-1; else echo (int)$total_pages; ?>"   ><</a></span>
        <?php
        for($i=1;$i<=$total_pages;$i++){
        echo'
        <span class="dot"><a href="search.php?category='.$_GET["category"].'&search='.$_GET["search"].'&page='.$i.'"  >'.$i.'</a></span>
        
        
        
        ';
        }
        ?>
        <span class="arrow"><a href="search.php?category=<?php echo $_GET["category"]?>&search=<?php echo $_GET["search"]?>&page=<?php if($page>=$total_pages) echo 1; else echo $page+1; ?>" >></a></span>
    </div>

</body>

</html>