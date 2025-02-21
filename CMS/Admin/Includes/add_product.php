

<?php
    
    if(isset($_POST['create_pastry'])){  
        echo "test";
        
        $p_name = $_POST['p_name'];
        $p_catagory = $_POST['p_catagory'];
        $p_description = $_POST['p_description'];
        
        $p_image = $_FILES['p_image']['name'];
        $p_image_temp = $_FILES['p_image']['tmp_name'];


        $p_status = $_POST['p_status'];
        $p_listing = $_POST['p_listing'];
        echo "test2";

        move_uploaded_file($p_image_temp, "../images/$p_image");
        echo "test3";
        
        
        $mysqli = new mysqli($db['db_host'], $db['db_user'], $db['db_pass'], $db['db_name']);
        echo "test4";
        $stmt = $mysqli->prepare("INSERT INTO pastries(p_name, p_catagory, p_description, p_image, p_status, p_listing) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param($stmt, "issss", $p_name, $p_catagory, $p_description, $p_image, $p_status, $p_listing);
        $stmt->execute();
        echo "test5";
        if(!$stmt){
            die("Query Failed!" . $mysqli->error);
        }
        echo "test6";
        echo "<script>window.location.href = 'products.php';</script>";
        echo "test7";
        
    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/584507be96.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/stylez.css">
</head>
<body>
    <div class="container_admin">

        <h1 class="admin_header">Add Product</h1>

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
                <li class="dropdown"><a href="catagories.php"><i class="fa-solid fa-tags"></i> Catagories<i class="fa-solid fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="catagories.php">View All Catagories</a>
                        <a href="catagories.php?add">Add New Catagory</a>
                    </div>
                </li>
                <li><a href="customers.php"><i class="fa-solid fa-users"></i> Customers</a></li>
                <li><a href="sales.php"><i class="fa-solid fa-chart-line"></i> Sales</a></li>
                <li><a href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                
            </ul>
        </div>

        <div class="product_form">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group1">
                    <label for="p_name">Pastry Name: </label>
                    <input type="text" name="p_name" id="p_name" class="form-control" autofocus>
                </div>
                <div class="form-group1">
                    <label for="p_catagory">Pastry Catagory: </label>
                    <input type="text" name="p_catagory" id="p_catagory" class="form-control">
                </div>
                <div class="form-group1">
                    <label for="p_description">Pastry Description: </label>
                    <input type="text" name="p_description" id="p_description" class="form-control">
                </div>
                <div class="form-group1">
                    <label for="p_price">Pastry Price: </label>
                    <input type="text" name="p_price" id="p_price" class="form-control">
                </div>
                <div class="form-group1">
                    <label for="p_image">Pastry Image: </label>
                    <input type="file" name="p_image" id="p_image" class="form-control">
                </div>
                <div class="form-group1">
                    <label for="p_status">Pastry Status: </label> 
                    <input type="text" name="p_status" id="p_status" class="form-control">
                </div>
                <div class="form-group1">
                    <label for="p_listing">Pastry Listing: </label>
                    <input type="text" name="p_listing" id="p_listing" class="form-control">
                </div>
                <div class="form-group1">
                    <input type="submit" name="create_pastry" class="button-success-add" value="Add Product">
                </div>
            </form> 
        </div>
        <div class="footer">
            <footer><h2> &copy; Drizzled Obsessions.com 2025</h2></footer>
        </div>
    </div>
</body>
</html>