<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <div class="container">
        <h1>Add Product</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="p_name">Pastry Name</label>
                <input type="text" name="p_name" id="p_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="p_catagory">Pastry Catagory</label>
                <input type="text" name="p_catagory" id="p_catagory" class="form-control">
            </div>
            <div class="form-group">
                <label for="p_description">Pastry Description</label>
                <input type="text" name="p_description" id="p_description" class="form-control">
            </div>
            <div class="form-group">
                <label for="p_price">Pastry Price</label>
                <input type="text" name="p_price" id="p_price" class="form-control">
            </div>
            <div class="form-group">
                <label for="p_image">Pastry Image</label>
                <input type="file" name="p_image" id="p_image" class="form-control">
            </div>
            <div class="form-group">
                <label for="p_status">Pastry Status</label> 
                <input type="text" name="p_status" id="p_status" class="form-control">
            </div>
            <div class="form-group">
                <label for="p_listing">Pastry Listing</label>
                <input type="text" name="p_listing" id="p_listing" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="button-success" value="Submit">
            </div>
        </form> 
    </div>
</body>
</html>