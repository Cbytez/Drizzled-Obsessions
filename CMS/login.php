<?php include "Includes/db.php"; ?> 
<?php include "Includes/admin_header.php"; ?>
<?php include "functions.php"; ?>
<?php session_start(); ?>

<?php

    $error = "";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = escape($dbs, $_POST['username']);
        $user_password = escape($dbs, $_POST['user_password']);

        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($dbs, $sql);
        

        if(mysqli_num_rows($result) === 1){
            $user = mysqli_fetch_assoc($result);

            // var_dump($user);

            if(password_verify($user_password, $user['password'])){
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_role'] = $user['user_role'];
                redirect('index.php');

                // if(isAdmin($_SESSION['username'])){
                //     redirect('Admin/index.php');
                   
                // }else{
                //     redirect('index.php');
                    
                // }
            }else{
                $error = "Invalid Password!";
            }            
            
        }else{
            $error = "User Not Found!";
        }
    }
?>





<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="CSS/Login-style.css">
<title>Drizzled Obsessions Login</title>
</head>
    <body>
        <div class="container">
            <div class="login-form">
                <form action="" role="form" method="POST">
                    <?php if(!empty($error)): ?>
                        <div class="error"><?php echo $error; ?></div>
                    <?php endif; ?>
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