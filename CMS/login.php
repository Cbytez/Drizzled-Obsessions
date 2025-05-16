<?php include "Includes/db.php"; ?> 
<?php include "Includes/admin_header.php"; ?>
<?php include "Includes/functions.php"; ?>
session_start();

<?php

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $user_password = mysqli_real_escape_string($connection, $_POST['user_password']);

        $query = "SELECT * FROM users WHERE username = '$username' AND user_password = '$user_password'";
        
    }
?>





<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="CSS/Login-style.css">
<title>Drizzled Obsessions Admin</title>
</head>
    <body>
        <div class="container">
            <div class="login-form">
                <form action="" role="form" method="POST">
                        <h1 class="login-title">Sign In</h1>
                        <h2 class="login-subtitle">Please enter your username and password to login.</h2>

                        <input type="text" name="username" placeholder="Username Required" class="login-input" required autofocus autocomplete="off">

                        <input type="password" name="user_password" placeholder="Password Required" class="login-input" required autocomplete="off">

                        <button type="submit" name="submit" class="login-button">Login</button>
               
                        <div class="login-links">
                            <a href="forgot-password.php" target="_blank" class="login-link">Forgot Password?</a>
                            <p class="register-link">Don't have an account? <a href="register.php">Create One.</a></p>
                        </div>
                </form>
            </div>
        </div>
    </body>
</html>