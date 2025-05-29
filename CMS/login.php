<?php include 'db.php'; ?> 
<?php include 'header.php'; ?>
<?php include 'Admin/functions.php'; ?>
<?php session_start(); ?>

<?php

    $error = "";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = mysqli_real_escape_string($dbs, $_POST['username']);
        $user_password = mysqli_real_escape_string($dbs, $_POST['user_password']);

        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($dbs, $sql);
        

        if(mysqli_num_rows($result) === 1){
            $user = mysqli_fetch_assoc($result);

            // var_dump($user);

            if(password_verify($user_password, $user['password'])){
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_role'] = $user['user_role'];

                if(isAdmin($_SESSION['username'])){
                    header('Location: Admin/index.php');
                    exit;
                }else{
                    header('Location: index.php');
                    exit;
                }
            }else{
                $error = "Invalid Password!";
            }            
            
        }else{
            $error = "User Not Found!";
        }
    }

    //Close the database connection.
    mysqli_close($dbs);
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

                        <input type="password" name="user_password" placeholder="Password Required" class="login-input" required autocomplete="off"><br>

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