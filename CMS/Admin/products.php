<?php include "Includes/admin_header.php"; ?>
<?php include "functions.php"; ?>

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
        <h1 class="admin_header">Drizzled Obsessions Products</h1>        

        <div class="admin_navigation">
            <ul>
                <li><a href="index.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                <li class="dropdown"><a class="active" href="products.php"><i class="fa-solid fa-box"></i> Products<i class="fa-solid fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="Includes/add_product.php" target="_blank">Add Product</a>
                        <a href="edit_product">Edit Product</a>
                        <a href="delete_product">Delete Product</a>
                    </div>
                </li>

                <li><a href="orders.php"><i class="fa-solid fa-cart-shopping"></i> Orders</a></li>
                <li><a href="catagories.php"><i class="fa-solid fa-tags"></i> Catagories</a></li>
                <li><a href="customers.php"><i class="fa-solid fa-users"></i> Customers</a></li>
                <li><a href="sales.php"><i class="fa-solid fa-chart-line"></i> Sales</a></li>
                <li><a href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                
            </ul>
        </div>

        
        
        <!-- Content -->

        <?php
            if(isset($_GET['source'])){
                $source = escape($_GET['source']);
            } else {
                $source = '';
            }

            switch($source){
                case 'add_product':
                    include "Includes/add_products.php";
                    break;

                    case '100':
                        echo "great";
                        break;

                case 'edit_product':
                    include "Includes/edit_product.php";
                    break;

                case 'delete_product':
                    include "Includes/delete_product.php";
                    break;
                    
                default:
                    include "Includes/view_all_products.php";
                    break;
            }
        ?>

        <div class="footer">
            <footer><h2> &copy; Drizzled Obsessions.com 2025</h2></footer>
        </div>
    </div>
</body>
</html>




