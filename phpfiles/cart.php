<?php 
require_once 'dbsetup.php'; 
error_reporting(0);
session_start();

$user_id = $_SESSION['user_id'];


if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

if(isset($_POST['update_update_btn'])){
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($db, "UPDATE `cart` SET quantity = '$update_value' WHERE cartid = '$update_id'");
    if($update_quantity_query){
       header('location:cart.php');
    };
 };
 
 if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($db, "DELETE FROM `cart` WHERE cartid = '$remove_id'");
    header('location:cart.php');
 };
 
 if(isset($_GET['delete_all'])){
    mysqli_query($db, "DELETE FROM `cart` WHERE `user_id` = '$user_id'");
    header('location:cart.php');
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
                            <th class="product-header">Product Quantity</th>
                            <th class="product-header">Total Price</th>
                            <th class="product-header">Action</th>
                        </thead>
                    </div>

                    <tbody>

                        <?php 
   
   $select_cart = mysqli_query($db, "SELECT * FROM `cart` WHERE `user_id`='$user_id'");
   $grand_total = 0;
   if(mysqli_num_rows($select_cart) > 0){
      while($fetch_cart = mysqli_fetch_assoc($select_cart)){
   ?>

                        <tr class="table-top">
                            <div class="cartdiv">
                                <td class="cartitems"><img
                                    src="/Assignment2/image/GamePics/<?php echo $fetch_cart['image']; ?>"
                                    class="cart-img"
                                    alt=""></td>
                            </div>
                            <td class="cartitems"><?php echo $fetch_cart['name']; ?></td>
                            <td class="cartitems">RM<?php echo number_format($fetch_cart['price'],2,'.','' ); ?>
                            </td>
                            <td class="cartitems">
                                <form action="" method="post">
                                    <input
                                        type="hidden"
                                        name="update_quantity_id"
                                        value="<?php echo $fetch_cart['cartid']; ?>">
                                    <input
                                        type="number"
                                        name="update_quantity"
                                        min="1"
                                        value="<?php echo $fetch_cart['quantity']; ?>">
                                    <input type="submit" value="update" name="update_update_btn">
                                </form>
                            </td>
                            <td class="cartitems">RM<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity'],2,'.','' ); ?>
                            </td>
                            <td class="cartitems">
                                <a
                                    href="cart.php?remove=<?php echo $fetch_cart['cartid']; ?>"
                                    onclick="return confirm('remove item from cart?')"
                                    class="delete-btn">
                                    <i class="fas fa-trash"></i>
                                    remove</a>
                            </td>
                        </tr>
                    <?php
     $grand_total += $sub_total; 
      };
   }
   else{ ?>
                        <tr class="table-top">
                            <div class="cartdiv">
                                <td class="cartitems"><img src="/Assignment2/image/GamePics/noitems.png" class="cart-img" alt=""></td>
                            </div>
                            <td class="cartitems">NO ITEMS</td>
                            <td class="cartitems">RM<?php echo number_format($fetch_cart['price'],2,'.',''); ?></td>
                            <td class="cartitems">
                                NO
                            </td>
                            <td class="cartitems">$<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity'],2,'.',''); ?>
                            </td>
                            <td class="cartitems">
                                NO ITEMS
                            </td>
                        </tr>
                        <?php
     $grand_total += $sub_total;  
   }
   ?>
                        <tr class="table-bottom">
                            <td class="cartitems bottom">
                                <a href="mainpage.php" class="option-btn" style="margin-top: 0;">Continue Shopping</a>
                            </td>
                            <td class="cartitems bottom" colspan="3" style="color:rgb(0, 0, 0);">Grand Total</td>
                            <td class="cartitems bottom" style="color:rgb(0, 0, 0);">
                                RM<?php echo number_format($grand_total,2,'.',''); ?>/-</td>
                            <td class="cartitems bottom">
                            <?php
                            $select_cart = mysqli_query($db, "SELECT * FROM `cart` WHERE `user_id`='$user_id'");
                            $grand_total = 0;
                            if(mysqli_num_rows($select_cart) > 0){
                        ?>
                                <a
                                    href="cart.php?delete_all"
                                    onclick="return confirm('are you sure you want to delete all?');"
                                    class="option-btn">
                                    <i class="fas fa-trash"></i>
                                    Delete All
                                </a>
                                <?php } 
                                else{
                                    ?>
                                    <a
                                    href="cart.php"
                                    onclick="alert('No Items To Delete From Cart');"
                                    class="option-btn">
                                    <i class="fas fa-trash"></i>
                                    Delete All
                                </a>
                                <?php
                                }?>
                            </td>
                        </tr>
                    </tbody>

                </table>
                <table class="checkout">
                    <tr>
                        <td class="cartitems bottom">

                            <a
                                href="checkout.php"
                                class="option-btn <?= ($grand_total > 1)?'':'disabled'; ?>">Checkout</a>
                        </tr>
                    </table>
                    <div class="checkout-btn"></div>

                </section>
            </div>

        </div>
        <?php include 'footer.php' ?>
    </body>

</html>