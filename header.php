<?php
include "db.php";
$count=0;
if(isset($_SESSION["user_id"])&&!empty($_SESSION["user_id"])){
$sql="SELECT * FROM cart WHERE user_id=?";
$stmt=$pdo->prepare($sql);
$stmt->execute([$_SESSION["user_id"]]);
$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($row as $i){
    $count+=$i["count"];
}
$data=["count"=>$count,"success"=>true];

}
else{
    $data=["count"=>$count,"success"=>false];
}

?>
    <div class="nav">
        <header class="top">
            <ul>
                <li><a>Hotline 15474</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="checkout.php">Checkout</a></li>
            </ul>           
        </header>


        <div class="middle">
            <span><a href="index.php">X Shop</a></span>

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
                
                <li><a href="cart.php"><img src="images/shopping.png" width="40px" height="40px">
                    <?php
                    if($data["success"]==true)
                        echo'<span class="count"> '.$data["count"].'  </span>';

                    ?>
            </a></li>
               
                
                    
                
                


            </ul>

            
        </div>
        <div class="bottom">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="search.php?category=Phone">Mobiles</a></li>
                <li><a href="search.php?category=Laptop">Laptops</a></li>
                <li><a href="search.php?category=Acessory">Accessories</a></li>
                <li><a href="search.php?category=Camera">Cameras</a></li>
                <li><a href="search.php?category=Electronic">Electronics</a></li>
                <?php
                if(!empty($_SESSION["admin"])&&$_SESSION["admin"]==true)
                echo'<li><a href="admin.php">Admin Dashboard</a></li>';
                ?>
               
            </ul>
        </div>

        
    </div>
<script src="header.js">

</script>

