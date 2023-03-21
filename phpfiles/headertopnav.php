
<div class="header">
            <img
                class="bannerimg"
                src="../image/banner2.jpg"
                alt="banner"
                width="1867"
                height="300"/>
        </div>

        <div class="topnav">
            <a class="zoom" href="/Assignment2/phpfiles/mainpage.php">Home</a>
            <a class="zoom" href="logout.php" style="float: right">Logout</a>
            <a class="zoom" href="cart.php" style="float: right">Cart</a>
            <?php 
    $query = "SELECT username FROM user WHERE `user_id` = $user_id AND adminverify= 1  ";
    $admincheck = mysqli_query($db, $query);
            if(mysqli_num_rows($admincheck) > 0){
?>
            <a class="zoom" href="products.php" style="float: right">Hello User - <?php echo $_SESSION['username'] ?></a>
            <a class="zoom" href="addproduct.php" style="float: right">Add Product</a>
            <?php
            }
            else{
                ?>
            <span class="zoom" style="float: right">Hello User - <?php echo $_SESSION['username'] ?></span>
<?php
        }
        ?>
        </div>
