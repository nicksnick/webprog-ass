<?php

@include 'dbsetup.php';

session_start();
$user_id = $_SESSION['user_id'];

if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>checkout</title>

        <!-- font awesome cdn link -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- custom css file link -->
        <link rel="stylesheet" href="/Assignment2/cssfiles/style.css"/>
        <link rel="stylesheet" href="/Assignment2/cssfiles/gamesliststyle.css"/>
        <link rel="stylesheet" href="/Assignment2/cssfiles/banner+navi.css"/>
        <link rel="stylesheet" href="/Assignment2/cssfiles/cart.css"/>

    </head>
    <body>
    <?php include 'headertopnav.php' ?>
        <div class="container">
<div style="width:500px; margin:auto">
        <?php
         $select_cart = mysqli_query($db, "SELECT * FROM `cart` WHERE `user_id` = '$user_id'");
         $total = 0;
         $grand_total = 0;
         if(!mysqli_num_rows($select_cart) > 0){
            echo "<script>alert('Your Cart is Empty'); window.location.href='cart.php';</script>";
      }else{
                ?>
            <div class="product checkout-form">

                <h1 class="heading">Complete Your Order</h1>

                <form action="successfull.php" method="post">
                    <?php
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity'],2,'.','' );
            $grand_total = $total += $total_price;
         ?><div class="display-order">
            <div class="product-brand"><?= $fetch_cart['name']; ?> <div style="padding: 15px">Quantity = <?= $fetch_cart['quantity']; ?></div></div>

                     <?php }?>
                        <h3 class="Grand Total" style="margin-left:10px">
                            Grand Total : $<?= $grand_total; ?>/-
                        </h3>


                    <div class="container" style="margin-left:10px; padding:10px">
                        <div class="inputBox">
                            <span>Name:
                            </span>
                            <input
                                type="text"
                                placeholder="Enter your name"
                                name="name"
                                required="required">
                        </div>
                        <div class="inputBox">
                            <span>Phone number:
                            </span>
                            <input
                                type="text"
                                placeholder="Enter your phone number"
                                name="number"
                                required="required">
                        </div>
                        <div class="inputBox">
                            <span>Email:
                            </span>
                            <input
                                type="email"
                                placeholder="Enter your e-mail"
                                name="email"
                                required="required">
                        </div>
                        <div class="inputBox">
                            <span>Payment method:
                            </span>
                            <select name="method">
                                <option value="Cash on Delivery" selected="selected">Cash on Devlivery</option>
                                <option value="Credit Cart">Credit Card</option>
                                <option value="Paypal">Paypal</option>
                            </select>
                        </div>
                        <div class="inputBox">
                            <span>Address line 1:
                            </span>
                            <input type="text" placeholder="e.g. House No." name="flat" required="required">
                        </div>
                        <div class="inputBox">
                            <span>Address line 2:
                            </span>
                            <input
                                type="text"
                                placeholder="e.g. Street Name"
                                name="street"
                                required="required">
                        </div>
                        <div class="inputBox">
                            <span>City:
                            </span>
                            <input type="text" placeholder="e.g. Puchong" name="city" required="required">
                        </div>
                        <div class="inputBox">
                            <span>State:
                            </span>
                            <input type="text" placeholder="e.g. Selangor" name="state" required="required">
                        </div>
                        <div class="inputBox">
                            <span>Country:
                            </span>
                            <input
                                type="text"
                                placeholder="e.g. Malaysia"
                                name="country"
                                required="required">
                        </div>
                        <div class="inputBox">
                            <span>Post code:
                            </span>
                            <input
                                type="text"
                                placeholder="e.g. 47000"
                                name="post_code"
                                required="required">
                        </div>
                        <input type="submit" value="Order now" name="checkout_btn" class="btn">
                    </div>

                </form>
                  
            </div>
            <?php

      }
      ?>
      </div>
    </div>
    </div>
      <?php include 'footer.php' ?>
      
    </body>  
      </html>