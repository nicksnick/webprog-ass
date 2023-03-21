<!-- start database-->
<?php 
require_once 'dbsetup.php'; 
?>
<!-- call box arts -->
<?php
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

if(isset($_POST['add_to_cart'])){

    $product_name = mysqli_real_escape_string($db,$_POST['product_name']); 
    $product_image = $_POST['product_image'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    
    $query = "SELECT * FROM `cart` WHERE `name`='$product_name' AND `user_id`='$user_id'";
    $select_cart = mysqli_query($db, $query);
    if(mysqli_num_rows($select_cart) > 0){
        echo "<script>alert('Product already in cart!')</script>";
    }else{
        $db->query("INSERT INTO `cart` (user_id, name, price, image, quantity) VALUES ('$user_id','$product_name','$product_price','$product_image','$product_quantity')") or die('query failed');
        echo "<script>alert('Product Successfully Added!')</script>";
    }

}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/Assignment2/cssfiles/style.css"/>
        <link rel="stylesheet" href="/Assignment2/cssfiles/gamesliststyle.css"/>
        <link rel="stylesheet" href="/Assignment2/cssfiles/banner+navi.css"/>
        <title>Main Page</title>
    </head>
    <body>
<?php include 'headertopnav.php'; ?>
        <div class="row">
            <div class="leftcolumn">
                <div class="product product-1">
                    <h2 class="product-category">Best Sellers of 2020</h2>
                    <button class="prev">&#10094</button>
                    <button class="next">&#10095</button>
                    <div class="product-container">
                        <!--Get image data from database -->
                        <?php $result = $db->query("SELECT `gameimg`,`name`,`description`,`price` FROM `gamelist` WHERE `year` = 2020" ); ?>

                        <?php if($result->num_rows > 0){ ?>
                            <?php while($row = $result->fetch_assoc()){ ?>
                        <div class="product-list">

                                <form action="" method="post">
                            <div class="product-image">
                                <img
                                    src="/Assignment2/image/GamePics/<?php echo $row['gameimg']; ?>"
                                    alt=""
                                    class="product-pic">
                                    <input type="hidden" name="product_image" value="<?php echo $row['gameimg']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                                    <input type="hidden" name="product_quantity" value="1" ?>">
                                <button type="submit "class="card-btn" name="add_to_cart">Add to cart</button>
                            </div>
                            </form>
                            <div class="product-info">
                                <h2 class="product-brand"><?php echo $row['name'];?></h2>
                                <h2 class="price">RM<?php echo $row['price'];?></h2>
                            </div>                        </div> 
                            <?php } ?>
                        <?php }?>

                    </div>

                </div>
                <div class="product product-2">
                    <h2 class="product-category">Best Sellers of 2021</h2>
                    <button class="prev">&#10094</button>
                    <button class="next">&#10095</button>
                    <div class="product-container">
                        <!--Get image data from database -->
                        <?php $result = $db->query("SELECT `gameimg`,`name`,`description`,`price` FROM `gamelist` WHERE `year` = 2021" ); ?>

                        <?php if($result->num_rows > 0){ ?>
                            <?php while($row = $result->fetch_assoc()){ ?>
                        <div class="product-list">

                                <form action="" method="post">
                            <div class="product-image">
                                <img
                                    src="/Assignment2/image/GamePics/<?php echo $row['gameimg']; ?>"
                                    alt=""
                                    class="product-pic">
                                    <input type="hidden" name="product_image" value="<?php echo $row['gameimg']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                                    <input type="hidden" name="product_quantity" value="1" ?>">
                                <button type="submit "class="card-btn" name="add_to_cart">Add to cart</button>
                            </div>
                            </form>
                            <div class="product-info">
                                <h2 class="product-brand"><?php echo $row['name'];?></h2>
                                <h2 class="price">RM<?php echo $row['price'];?></h2>
                            </div>                        </div> 
                            <?php } ?>
                        <?php }?>

                    </div>

                </div>
                <div class="product product-3">
                <h2 class="product-category">Best Sellers of 2022</h2>
                    <button class="prev">&#10094</button>
                    <button class="next">&#10095</button>
                    <div class="product-container">
                        <!--Get image data from database -->
                        <?php $result = $db->query("SELECT `gameimg`,`name`,`description`,`price` FROM `gamelist` WHERE `year` = 2022" ); ?>

                        <?php if($result->num_rows > 0){ ?>
                            <?php while($row = $result->fetch_assoc()){ ?>
                        <div class="product-list">

                                <form action="" method="post">
                            <div class="product-image">
                                <img
                                    src="/Assignment2/image/GamePics/<?php echo $row['gameimg']; ?>"
                                    alt=""
                                    class="product-pic">
                                    <input type="hidden" name="product_image" value="<?php echo $row['gameimg']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                                    <input type="hidden" name="product_quantity" value="1" ?>">
                                <button type="submit "class="card-btn" name="add_to_cart">Add to cart</button>
                            </div>
                            </form>
                            <div class="product-info">
                                <h2 class="product-brand"><?php echo $row['name'];?></h2>
                                <h2 class="price">RM<?php echo $row['price'];?></h2>
                            </div>                        </div> 
                            <?php } ?>
                        <?php }?>

                    </div>

                </div>
            </div>
            <div class="rightcolumn">
                <div class="card3">
                    <h2 class="p">About WGames</h2>
                    <div class="fakeimg">
                        <img class="trending" src="/Assignment2/image/gameshop.jpg">
                    </div>
                    <p>Wgaming is a trusted and authorised game company that sells original games
                        and gaming equipments at the most affordable price that you can find in the
                        market!
                    </p>
                    <p>Hit us up to get the best value and have the best experience in gaming~</p>
                </div>
            </div>
            <div class="rightcolumn">
                <div class="card3">
                    <h3 class="p">Trending games</h3>
                    <div class="fakeimg zoom2">
                        <div class="container">
                            <img class="trending" src="/Assignment2/image/trending/trending3.jpg">
                            <div class="middle">
                                <div class="midtext">GENSHIN IMPACT</div>
                            </div>
                        </div>
                    </div>
                    <div class="fakeimg zoom2">
                        <div class="container">
                            <img class="trending" src="/Assignment2/image/trending/trending1.jpg">
                            <div class="middle">
                                <div class="midtext">CYBERPUNK</div>
                            </div>
                        </div>
                    </div>
                    <div class="fakeimg zoom2">
                        <div class="container">
                            <img class="trending" src="/Assignment2/image/trending/trending2.jpg">
                            <div class="middle">
                                <div class="midtext">DOOM ETERNAL</div>
                            </div>
                        </div>
                    </div>
                    <div class="fakeimg zoom2">
                        <div class="container">
                            <img class="trending" src="/Assignment2/image/trending/trending4.jpg">
                            <div class="middle">
                                <div class="midtext">SUPER SMASH BROS. ULTIMATE</div>
                            </div>
                        </div>
                    </div>
                    <div class="fakeimg zoom2">
                        <div class="container">
                            <img class="trending" src="/Assignment2/image/trending/trending5.jpeg">
                            <div class="middle">
                                <div class="midtext">MINECRAFT</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rightcolumn">
                <div class="card3">
                    <h3 class="p">Contact us</h3>
                    <div class="contact">
                        <p>Email:
                            <br>
                            Chungwengzee25@gmail.com
                            <br>
                            Nycholasphang123@gmail.com
                            <br><br>
                            WhastApp:
                            <br>
                            017-2762913 (Zee Weng Chung)<br>
                            012-6895530 (Nycholas Phang)</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php include 'footer.php' ?>
    <script src="/Assignment2/slideshow.js"></script>
    <script src="/Assignment2/productslideshow.js"></script>
</body>
</html>