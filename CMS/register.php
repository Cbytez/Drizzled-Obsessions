<?php
    
    include 'db.php';
    session_start();
    $error = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Registration variables.
        $username = mysqli_real_escape_string($dbs, $_POST['username']);
        $email = mysqli_real_escape_string($dbs, $_POST['email']);
        $password = mysqli_real_escape_string($dbs, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($dbs, $_POST['confirm_password']);

        //Error handling.
        if($password !== $confirm_password){
            $error = "Passwords do not match";
        }else{

            //Check if username already exist in the database.
                $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
                $result = mysqli_query($dbs, $sql);

            if(mysqli_num_rows($result) === 1){
                $error = "Username already exists, Please choose another.";
            }else{
                
                //Check if email already exist in the database
                $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
                $result = mysqli_query($dbs, $sql);

                if(mysqli_num_rows($result) === 1){
                    $error = "Email already exists, Please choose another.";

                }else{
                    //Hash the password and insert the data into the database.
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $user = 'user';
                    $sql = "INSERT INTO users (username, password, email, user_role) VALUES ('$username', '$passwordHash', '$email', '$user')";

                    if(mysqli_query($dbs, $sql)){
                        $_SESSION['logged_in'] = true;
                        $_SESSION['username'] = $username;
                        header('Location: index.php');
                        exit();
                    }else{
                        echo "Error: NOT Registered! ". mysqli_error($dbs);
                    }
                }
            }
            
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
    <link rel="stylesheet" type="text/css" href="CSS/register-style.css">
    <title>Drizzled Obsessions Registration</title>
</head>
<body>
    <div class="container">
        <div class="register-form">
            <form action="" method="POST">
                <h1>Register</h1>
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Username" required autofocus>
                <br>
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email" required>
                <br>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required>
                <br>
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <br>
                <button type="submit" name="submit" class="register-button">Register</button>
                <br>
                <p class="register-link">Already have an account? <a href="login.php">Login</a></p>
            </form>
            
        </div>
    </div>