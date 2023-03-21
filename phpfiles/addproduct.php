<?php 
require_once 'dbsetup.php'; 
?>

<?php

error_reporting(0);

session_start();
if(!isset($_SESSION['username'])){
    header("Location: mainpage.php");
}

if(isset($_POST['add_product'])){
    $p_image = $_FILES['p_image']['name'];
    $p_name = $_POST['p_name'];
    $p_description = $_POST['p_description'];
    $p_price = $_POST['p_price'];
    $p_year = $_POST['p_year'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = '../image/GamePics/'.$p_image;
 
    $insert_query = mysqli_query($db, "INSERT INTO `gamelist` (gameimg, name, description, price, `year`) VALUES ('$p_image', '$p_name', '$p_description', '$p_price', '$p_year')") or die('query failed');
 
    if($insert_query){
       move_uploaded_file($_FILES['p_image']['tmp_name'], $p_image_folder);
       echo "<script>alert('Product Added Successfully'); window.location.href='addproduct.php';</script>";
    }else{
       $message[] = 'could not add the product';
    }
 };

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="/Assignment2/cssfiles/style.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="/Assignment2/cssfiles/banner+navi.css">
        <link rel="stylesheet" type="text/css" href="/Assignment2/cssfiles/login.css">

        <title>Add Products</title>
    </head>

    <body class="loginbody">
        <div class="header">
            <img
                class="bannerimg"
                src="../image/banner2.jpg"
                alt="banner"
                width="1867"
                height="300"/>
        </div>

        <div class="topnav">
            <a class="zoom" href="mainpage.php">Home</a>
        </div>

        <div class="login">
<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>add a new product</h3>
   <div class="input-group">
    <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <br>
   <input type="text" name="p_name" placeholder="Enter the product's name" class="box" required>
   <br> 
   <input type="text" name="p_description" placeholder="Enter the product's description" class="box" required>
   <br>
   <input type="number" name="p_price" min="0" placeholder="Enter the product's price" class="box" step=".01" required>
   <br>
   <select type="number" name="p_year">
	<option value="">--- Choose Game Release Year ---</option>
	<option value="2020">2020</option>
	<option value="2021">2021</option>
	<option value="2022">2022</option>
</select>
   <br>
   <input type="submit" value="Add Product" name="add_product" class="btn">
</div>
</form>

</div>
        <?php include 'footer.php' ?>
    </body>

</html>