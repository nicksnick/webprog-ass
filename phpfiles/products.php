<?php 
require_once 'dbsetup.php'; 
error_reporting(0);
session_start();

$user_id = $_SESSION['user_id'];


if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

 
 if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($db, "DELETE FROM `gamelist` WHERE gameid = '$remove_id'");
    header('location:products.php');
 };

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/Assignment2/cssfiles/style.css"/>
        <link rel="stylesheet" href="/Assignment2/cssfiles/gamesliststyle.css"/>
        <link rel="stylesheet" href="/Assignment2/cssfiles/banner+navi.css"/>
        <link rel="stylesheet" href="/Assignment2/cssfiles/cart.css"/>
        <title>Shopping Cart</title>
    </head>
    <body>
    <?php include 'headertopnav.php' ?>
        <div class="row">
            <div class="shopping-cart">
                <table cellspacing="0">
                    <div class="product-headerr">
                        <thead>
                            <th class="product-header">Product Image</th>
                            <th class="product-header">Product Name</th>
                            <th class="product-header">Product Price</th>
                            <th class="product-header">Year</th>
                            <th class="product-header">Action</th>
                        </thead>
                    </div>

                    <tbody>

                        <?php 
   
   $showproducts = mysqli_query($db, "SELECT * FROM `gamelist`");
   if(mysqli_num_rows($showproducts) > 0){
      while($fetchproducts = mysqli_fetch_assoc($showproducts)){
   ?>

                        <tr class="table-top">
                            <div class="cartdiv">
                                <td class="cartitems"><img
                                    src="/Assignment2/image/GamePics/<?php echo $fetchproducts['gameimg']; ?>"
                                    class="cart-img"
                                    alt=""></td>
                            </div>
                            <td class="cartitems"><?php echo $fetchproducts['name']; ?></td>
                            <td class="cartitems">RM<?php echo number_format($fetchproducts['price'],2,'.','' ); ?>
                            </td>
                            <td class="cartitems"><?php echo $fetchproducts['year']; ?>
                            </td>
                            <td class="cartitems">
                                <a
                                    href="products.php?remove=<?php echo $fetchproducts['gameid']; ?>"
                                    onclick="return confirm('remove item from product list?')"
                                    class="delete-btn">
                                    <i class="fas fa-trash"></i>
                                    remove</a>
                            </td>
                        </tr>
                    <?php
     $grand_total += $sub_total; 
      };
   }