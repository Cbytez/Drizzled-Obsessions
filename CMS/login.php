<?php include 'db.php'; ?>
<?php session_start(); ?>
<?php include 'functions.php'; ?>



?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="CSS/style.css">
<title>Drizzled Obsessions Admin</title>
</head>
    <body>
        <div class="container">
            <div class="login-form">
                <form action="#">
                        <h1 class="login-title">Sign In</h1>
                        <h2 class="login-subtitle">Please enter your username and password to login.</h2>

                        <input type="text" name="username" placeholder="Username Required" class="login-input" required autofocus autocomplete="off">
                        <input type="password" name="password" placeholder="Password Required" class="login-input" required autocomplete="off">
                        <button type="submit" name="submit" class="login-button">Login</button>
                    </form>
                    <div class="login-links">
                        <a href="forgot-password.php" target="_blank" class="login-link">Forgot Password?</a>
                        <p class="register-link">Don't have an account? <a href="register.php">Create One.</a></p>
                    </div>
                </div>
        </div>
    </body>
</html>