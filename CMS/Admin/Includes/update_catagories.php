<form action="" method="post">
    <div class="form-group1">
        <label for="cat_title">Edit Catagory</label>

        <?php
            if(isset($_GET['edit'])){
                $cat_id = escape($_GET['edit']);
                $mysqli = new mysqli($db['db_host'], $db['db_user'], $db['db_pass'], $db['db_name']);
                $stmt = $mysqli->prepare("SELECT cat_title FROM catagories WHERE cat_id = ?");
                $stmt->bind_param("i", $cat_id);
                $stmt->execute();
                $stmt->bind_result($cat_title);
                $stmt->fetch();
                $stmt->close();
                $mysqli->close();
            
        ?>
        <input value="<?php if(isset($cat_title)){ echo $cat_title; } ?>" type="text" class="form-control" name="cat_title" placeholder="Category Title">
        <?php } ?>

        <?php 
            if(isset($_POST['update_catagory'])){
                $the_cat_title = escape($_POST['cat_title']);
                $mysqli = new mysqli($db['db_host'], $db['db_user'], $db['db_pass'], $db['db_name']);
                $stmt = $mysqli->prepare("UPDATE catagories SET cat_title = ? WHERE cat_id = ?");
                $stmt->bind_param("si", $the_cat_title, $cat_id);
                $stmt->execute();
                $stmt->close();
                $mysqli->close();

                if(!$stmt2513){
                    die("Query Failed!" . $mysqli->error);
                }

            }
        ?>        
    </div>
    <div class="form-group">
        <input type="submit" class="button-success-add" name="update_catagory" value="Update Catagory">
    </div>
</form>
