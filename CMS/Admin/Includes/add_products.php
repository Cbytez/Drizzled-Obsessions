<?php include "../functions.php"; ?>

<?php

if(isset($_POST['add_product'])){
    global $db;
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $p_name = escape($_POST['p_name']);
    $p_catagory = escape($_POST['p_catagory']);
    $p_description = escape($_POST['p_description']);
    $p_price = $_POST['p_price'];
    $p_image = $_POST['p_image'];
    $p_status = escape($_POST['p_status']);
    $p_listing = escape($_POST['p_listing']);
    
    
    $stmt = $db->prepare("INSERT INTO products (p_name, p_catagory, p_description, p_price, p_image, p_status, p_listing) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisss", $p_name, $p_catagory, $p_description, $p_price, $p_image, $p_status, $p_listing);
    $stmt->execute();
    $stmt->close();
    $db->close();

    

    if(!$stmt){
        die("Query Failed" . mysqli_error($connection));
    }else{
        echo "Product Added Successfully";
    }

    redirect("../products.php");
    
   
}
?>

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

            <form action="" method="post" enctype="multipart/form-data" class="product_form">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="p_name" id="p_name" required autofocus>
                </div>

                <div class="form-group">
                    <label for="product_catagory">Product Catagory</label>
                    <input type="text" name="p_catagory" id="p_catagory" required>
                </div>

                <div class="form-group">
                    <label for="product_description">Product Description</label>
                    <input type="text" name="p_description" id="p_description" required>
                </div>

                <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="float" name="p_price" id="p_price" required>
                </div>

                <div class="form-group">
                    <label for="product_image">Product Image</label>
                    <input type="file" name="p_image" id="p_image" required>
                </div>

                <div class="form-group">
                    <label for="product_status">Product Status</label>
                    <input type="text" name="p_status" id="p_status" required>
                </div>

                <div class="form-group">
                    <label for="product_listing">Product Listing</label>
                    <input type="text" name="p_listing" id="p_listing" required>
                </div>

                <button type="submit" name="add_product" class="button-success">Add Product</button>
                <a href="../products.php" class="button-btp">Back to Products</a>
            </form>
            <div class="footer">
                <footer><h3>Copyright &copy; 2025 Drizzled Obsessions</h3></footer>
            </div>
        </div>        
    </div>    
</body>
</html>