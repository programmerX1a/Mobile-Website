<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Website</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="nav">
        <header class="top">
            <ul>
                <li><a href="">Hotline 15474</a></li>
                <li><a href="">Cart</a></li>
                <li><a href="">Checkout</a></li>
            </ul>           
        </header>


        <div class="middle">
            <span>X Shop</span>

            <div class="search_bar">
                <select>
                    <option>All Categories</option>
                </select>
                <input placeholder="Search here">
                <button>Search</button>
            </div>

            <ul class="icons">
                <li class="popup"><img src="images/user.png" width="40px" height="40px">
                <div class="card">
                    <ul>
                    <?php
                    if(isset($_SESSION["logged"])){

                        if($_SESSION["logged"]==true)
                        echo'<li>Welcome, '.$_SESSION["username"].'</li>';
                        echo'<br><li><a href="logout.php">Logout</a></li>';
                    }
                    else{
                        echo'<li><a href="login.php">Login</a></li>';
                        echo'<br> <li><a href="register.php">Register</a></li>';

                    }                       
                   ?>
                   </ul>

                </div>
            
                </li>
                
                <li><a href=""><img src="images/favourites.png" width="40px" height="40px"></a></li>
                <li><a href=""><img src="images/shopping.png" width="40px" height="40px"></a></li>
                


            </ul>

            
        </div>
        <div class="bottom">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Mobiles</a></li>
                <li><a href="">Laptops</a></li>
                <li><a href="">Accessories</a></li>
                <li><a href="">Cameras</a></li>
                <li><a href="">Electronics</a></li>
               
            </ul>
        </div>

        
    </div>

    
</body>
</html>