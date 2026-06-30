
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="index.css">
    <script src="home.js"></script>
</head>
<body>
<?php include "header.php"; ?>
<div class="container">
    <div class="slideshow1">
         <a href="product.php?id=1" class="image"><img src="images/image1.png"  class="images"></a>
         <a href="product.php?id=53" class="image"><img src="images/samsung_a17.png"  class="images"></a>
         <a href="product.php?id=52" class="image"><img src="images/oppo_reno15.png"  class="images"></a>
        <div class="arrowcontainer">
            <span class="prev" id="prev" onclick="previousSlide()">❮</span>
            <span class="next" id="next" onclick="nextSlide()">❯</span>
        </div>
        <div class="dotcontainer">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>
    <div class="staticshow1">
        <a href="product.php?id=51" class="image"><img src="images/oppo_a6.png"></a>
         <a href="product.php?id=58" class="image"><img src="images/lg_phoenix5.png" ></a>
         <a href="product.php?id=50" class="image"><img src="images/oppo_reno13_pro.png" ></a>
         <a href="product.php?id=59" class="image"><img src="images/nothing_3a.png" ></a>
    </div>

    

    
</div>


</body>
</html>