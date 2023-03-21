<?php
require_once 'dbsetup.php'; 
?>

<?php 
error_reporting(0);
session_start();

if(isset($_SESSION['username'])){
    header("Location: mainpage.php");
}





if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($db, $sql);

    if($result->num_rows > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_id'] = $row['user_id'];
        header("Location: mainpage.php");
    }
    else {
        echo "<script>alert('The Username or Password Entered is Wrong')</script>";
        $username = "";
        $_POST['password'] = "";
    }
}
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

        <title>Login Form</title>
    </head>

    <body class="loginbody">
        <div class="header">
            <img
                class="bannerimg"
                src="/Assignment2/image/banner2.jpg"
                alt="banner"
                width="1867"
                height="300"/>
        </div>

        <div class="topnav">
            <a class="zoom" href="mainpage.php">Home</a>
        </div>

        <div class="login">
            <form method="POST" class="login-email">
                <p class="login-text">Login</p>
                <div class="input-group">
                    <input
                        type="text"
                        placeholder="Username"
                        name="username"
                        value="<?php echo $username ?>"
                        required="required">
                </div>
                <div class="input-group">
                    <input
                        type="password"
                        oncontextmenu="return false"
                        oncopy="return false"
                        oncut="return false"
                        onpaste="return false"
                        placeholder="Password"
                        name="password"
                        value="<?php echo $_POST['password']; ?>"
                        required="required">
                </div>
                <div class="input-group">
                    <button name="submit" class="btn">Login</button>
                </div>
                <p class="log-reg">Don't have an account?
                    <a class="signinup" href="signup.php">Signup Here!</a>
                </p>
            </form>
        </div>
        <?php include 'footer.php' ?>
    </body>

</html>