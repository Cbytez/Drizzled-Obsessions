<?php include 'db.php'; ?>
<?php include 'header.php'; ?>


<?php
session_start();

if(!isset($_SESSION['username']) && $_SESSION['user_role'] != 'admin'){
    header("Location: index.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = mysqli_real_escape_string($dbs, $_POST['username']);
    $role = mysqli_real_escape_string($dbs, $_POST['role']);

    $sql = "UPDATE users SET user_role='$role' WHERE username='$username'";
    $result = mysqli_query($dbs, $sql);

    if($result){
        echo "User role changed successfully";
    }else{
        echo "User role change failed";
    }
}

?>
<!-- user role change form -->
<html>
    <head>
        <title>User Role Change</title>
        <link rel="stylesheet" href="CSS/index.css">
    </head>
    <body>
        <div class="container">
        <h1>User Role Change</h1>
        <form action="user-role.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
                <button type="submit">Change Role</button>
            </form>
        </div>
    </body>
</html>