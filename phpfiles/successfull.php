<?php

@include 'dbsetup.php';

session_start();
$user_id = $_SESSION['user_id'];

if(!isset($_SESSION['username'])){
   header("Location: login.php");
}

if(isset($_POST['checkout_btn'])){

    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $method = $_POST['method'];
    $flat = $_POST['flat'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $post_code = $_POST['post_code'];
 
    $cart_query = mysqli_query($db, "SELECT * FROM `cart` WHERE `user_id` = '$user_id'");
    $price_total = 0;
    $total_product = 0;
 
    if(mysqli_num_rows($cart_query) > 0){
       while($product_item = mysqli_fetch_assoc($cart_query)){
          $product_name = mysqli_real_escape_string($db,$product_item['name']);
          $product_price = number_format($product_item['price'] * $product_item['quantity'],2,'.','' );
          $total_product += $product_item['quantity'];
          $price_total += number_format($product_price,2,'.','');
 
       };
       $detail_query = mysqli_query($db, "INSERT INTO `checkout`(user_id, name, number, email, method, flat, street, city, state, country, post_code, total_products, total_price) VALUES('$user_id','$name','$number','$email','$method','$flat','$street','$city','$state','$country','$post_code','$total_product','$price_total')") or die('query failed');
       $delete_from_cart = mysqli_query($db, "DELETE FROM `cart` WHERE `user_id` = '$user_id'");
    };
 
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
        <title>Main Page</title>
    </head>
    <body?>
    <?php include 'headertopnav.php' ?>
        <div class="product container">
        <?php $cart_query = mysqli_query($db, "SELECT * FROM `checkout` WHERE `user_id` = '$user_id'"); ?>
        <?php if(mysqli_num_rows($cart_query) > 0){
            $row = $cart_query->fetch_assoc()
            ?>
        
       <div class="product message-container" style="width:500px; margin:auto">
          <h3>Thank You For Shopping With Us!</h3>
          <div class='order-detail'>
             <span>"<?php echo $row['total_products'] ?>" Item(s)</span>
             <span class='total'> Total : RM"<?php echo $row['total_price'] ?>"  </span>
          </div>
          <div class='customer-details'>
             <p> your name : <span>"<?php echo $row['name'] ?>"</span> </p>
             <p> your number : <span>"<?php echo $row['number'] ?>"</span> </p>
             <p> your email : <span>"<?php echo $row['email'] ?>"</span> </p>
             <p> your address : <span>"<?php echo $row['flat'] ?>, <?php echo $row['street'] ?>, <?php echo $row['city'] ?>, <?php echo $row['state'] ?>, <?php echo $row['country'] ?> - <?php echo $row['post_code'] ?>"</span> </p>
             <p> your payment mode : <span>"<?php echo $row['method'] ?>"</span> </p>
             <p>(*pay when product arrives*)</p>
          </div>
             <button><a href='mainpage.php' class='btn'>Continue Shopping</a></button>
          </div>
       </div>
       
        <?php 
        $delete_from_cart = mysqli_query($db, "DELETE FROM `checkout` WHERE `user_id` = '$user_id'");
   }
     ?>
     </div>
     <?php include 'footer.php' ?>
</body>
</html>