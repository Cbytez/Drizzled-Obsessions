<?php include "functions.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/584507be96.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/stylez.css">
    <title>Add Products</title>
</head>
<body>
    <div class="container_admin">
        <h1 class="admin_header">Drizzled Obsessions Products</h1>        

        <div class="admin_navigation">
            <ul>
                <li><a href="index.php"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                <li class="dropdown"><a class="active" href="products.php"><i class="fa-solid fa-box"></i> Products<i class="fa-solid fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="Includes/add_products.php" target="_blank">Add Product</a>
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

        <div class="admin_content">
            <h2>Add Product</h2>

            <form action="Includes/add_products.php" method="post" enctype="multipart/form-data" class="product_form">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" id="product_name" required>
                </div>

                <div class="form-group">
                    <label for="product_catagory">Product Catagory</label>
                    <input type="text" name="product_catagory" id="product_catagory" required>
                </div>

                <div class="form-group">
                    <label for="product_description">Product Description</label>
                    <input type="text" name="product_description" id="product_description" required>
                </div>

                <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="number" name="product_price" id="product_price" required>
                </div>

                <div class="form-group">
                    <label for="product_image">Product Image</label>
                    <input type="file" name="product_image" id="product_image" required>
                </div>

                <div class="form-group">
                    <label for="product_status">Product Status</label>
                    <input type="text" name="product_status" id="product_status" required>
                </div>

                <div class="form-group">
                    <label for="product_listing">Product Listing</label>
                    <input type="text" name="product_listing" id="product_listing" required>
                </div>

                <button type="submit" name="add_product">Add Product</button>
                <a href="products.php">Back to Products</a>
            </form>          
                
        </div>
    </div>
</body>
</html>