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
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    $adminkey = $_POST['adminkey'];

    if($adminkey == '123'){
        $adminverify = 1;
    }
    else{
        $adminverify = 0;
    }

    if ($password == $cpassword){
        $sql = "SELECT * FROM user WHERE email='$email' OR username='$username'";
        $result = mysqli_query($db, $sql);

        if($result->num_rows > 0){
            echo "<script>alert('The E-mail or Username is Already In Use. Please Try Again.')</script>";
            $username = "";
            $email = "";
            $_POST['password'] = "";
            $_POST['cpassword'] = "";
            $_POST['adminkey'] = "";
        }
        else{
        $sql = "INSERT INTO `user`(`username`, `email`, `password`, `adminverify`) VALUES ('$username','$email','$password', '$adminverify')";
        $result = mysqli_query($db, $sql);

        if(isset($_POST['adminkey']) && $adminkey=='123' &&$result){
            echo "<script>alert('Successfully Registered Admin.'); window.location.href='login.php';</script>";
        }
        elseif($result){
            echo "<script>alert('Successfully Registered User.'); window.location.href='login.php';</script>";
        }
        else{
            echo "<script>alert('An Error Occurred.')</script>";
        }
    }
    }
    else {
        echo "<script>alert('Password Does Not Match.')</script>";
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

        <title>Registration Form</title>
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
                <p class="login-text">Signup</p>
                <div class="input-group">
                    <input
                        type="text"
                        placeholder="Username"
                        name="username"
                        value="<?php echo $username; ?>"
                        required="required">
                </div>
                <div class="input-group">
                    <input
                        type="email"
                        placeholder="E-mail"
                        name="email"
                        value="<?php echo $email; ?>"
                        required="required">
                </div>
                <div class="input-group">
                    <input
                        oncontextmenu="return false"
                        oncopy="return false"
                        oncut="return false"
                        onpaste="return false"
                        type="password" 
                        placeholder="Password"
                        name="password"
                        value="<?php echo $_POST['password']; ?>"
                        required="required">
                </div>
                <div class="input-group">
                    <input
                        oncontextmenu="return false"
                        oncopy="return false"
                        oncut="return false"
                        onpaste="return false"
                        type="password"
                        placeholder="Confirm Password"
                        name="cpassword"
                        value="<?php echo $_POST['cpassword']; ?>"
                        required="required">
                </div>
                <div class="input-group">
                    <input
                        type="text"
                        placeholder="Enter Admin Key (If available)"
                        name="adminkey"
                        value="<?php echo $_POST['adminkey']; ?>">
                </div>
                <div class="input-group">
                    <button name="submit" class="btn">Signup</button>
                </div>
                <p class="log-reg">Already have an account?
                    <a class="signinup" href="login.php">Login Here!</a>
                </p>
            </form>
        </div>
        <?php include 'footer.php' ?>
    </body>

</html>