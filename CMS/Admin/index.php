<?php include "Includes/admin_header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/584507be96.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <div class="container_admin">
        <h1 class="admin_header">Drizzled Obsessions Admin</h1>

        <div class="admin_content_head">
            <h2 class="admin_content_header">Welcome <?php echo $_SESSION['username']; ?> to the admin panel</h2>            
        </div>

        <div class="admin_navigation">
            <ul>
                <li><a href="index.php" class="active"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                <li><a href="products.php"><i class="fa-solid fa-box"></i> Products</a></li>
                <li><a href="orders.php"><i class="fa-solid fa-cart-shopping"></i> Orders</a></li>
                <li><a href="customers.php"><i class="fa-solid fa-users"></i> Customers</a></li>
                <li><a href="sales.php"><i class="fa-solid fa-chart-line"></i> Sales</a></li>
            </ul>
        </div>  
    </div>


</body>
</html>

<button class="logout_button" onclick="logout()">Logout</button>

<?php include "Includes/admin_footer.php"; ?>

<script type="text/javascript">
function logout(){
    window.location.href = "../logout.php";
}
</script>