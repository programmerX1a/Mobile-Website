<?php
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
    <script src="home.js"></script>
</head>
<body>
<div class="container">
    <div class="slideshow1">
         <a href="product.php?id=1" class="image"><img src="images/image1.png"  class="images"></a>
         <a href="" class="image"><img src="images/image2.png"  class="images"></a>
         <a href="" class="image"><img src="images/image3.png"  class="images"></a>
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
        <a href="" class="image"><img src="images/image4.png"></a>
         <a href="" class="image"><img src="images/image5.png" ></a>
         <a href="" class="image"><img src="images/image6.png" ></a>
         <a href="" class="image"><img src="images/image7.png" ></a>
    </div>

    

    
</div>


</body>
</html>