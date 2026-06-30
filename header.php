<?php

session_start();
?>

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
                <select id="search_category" name="search_category">
                    <option value="all">All Categories</option>
                    <option value="Phone">Phones</option>
                    <option value="cameras">Cameras</option>
                    <option value="laptops">Laptops</option>
                    <option value="electronics">Electronics</option>
                    <option value="accessories">Accessories</option>
                    
                </select>
                <input placeholder="Search here" id="search" name="search">
                <button onclick="Search()">Search</button>
            </div>

            <ul class="icons">
                <li class="popup"><img src="images/user.png" width="40px" height="40px">
                <div class="card">
                    <ul>
                    <?php
                    if(isset($_SESSION["logged"])&&!empty($_SESSION["logged"])){

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
                <li><a href="index.php">Home</a></li>
                <li><a href="">Mobiles</a></li>
                <li><a href="">Laptops</a></li>
                <li><a href="">Accessories</a></li>
                <li><a href="">Cameras</a></li>
                <li><a href="">Electronics</a></li>
                <?php
                if(!empty($_SESSION["admin"])&&$_SESSION["admin"]==true)
                echo'<li><a href="admin.php">Admin Dashboard</a></li>';
                ?>
               
            </ul>
        </div>

        
    </div>
<script src="header.js">

</script>

