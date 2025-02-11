<?php

    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $checkBoxValue){
            $bulk_options = escape($_POST['bulk_options']);

            switch($bulk_options){
                case 'published':
                    $stmt45 = mysqli_prepare($db, "UPDATE pastries SET status = ? WHERE id = $checkBoxValue");
                    mysqli_stmt_bind_param($stmt45, "s", $bulk_options);
                    mysqli_stmt_execute($stmt45);
                    mysqli_stmt_close($stmt45);
                    break;

                case 'draft':
                    $stmt46 = mysqli_prepare($db, "UPDATE pastries SET status = ? WHERE id = $checkBoxValue");
                    mysqli_stmt_bind_param($stmt46, "s", $bulk_options);
                    mysqli_stmt_execute($stmt46);
                    mysqli_stmt_close($stmt46);
                    break;

                case 'delete':
                    $stmt47 = mysqli_prepare($db, "DELETE FROM pastries WHERE id = ?");
                    mysqli_stmt_bind_param($stmt47, "i", $checkBoxValue);
                    mysqli_stmt_execute($stmt47);
                    mysqli_stmt_close($stmt47);
                    break;

                default:
                    #code...
                    break;
            }
        }
    }
?>

<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-2">
            <select class="form-control bulkOptions">
                <option value="">Select Options</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Submit">
            <a href="pastries.php?source=add_pastry" class="btn btn-primary">Add Pastry</a>
        </div>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Pastry Name</th>
                <th>Pastry Catagory</th>
                <th>Pastry Description</th>
                <th>Pastry Price</th>
                <th>Pastry Image</th>
                <th>Pastry Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php
                $stmt520 = mysqli_prepare($db, "SELECT p_id, p_name, p_catagory, p_description, p_price FROM pastries");
                mysqli_stmt_execute($stmt520);
                mysqli_stmt_store_result($stmt520);
                mysqli_stmt_bind_result($stmt520, $p_id, $p_name, $p_catagory, $p_description, $p_price);
                while(mysqli_stmt_fetch($stmt520)):
                    echo "<tr>";
                    ?>
                    <td><input class="checkboxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $p_id; ?>"></td>
                    <td><?php echo $p_name; ?></td>
                    <td><?php echo $p_catagory; ?></td>
                    <td><?php echo $p_description; ?></td>
                    <td><?php echo $p_price; ?></td>
                    <td><?php echo $p_image; ?></td>
                    <td><?php echo $p_status; ?></td>
                    <td>
                        <a href="pastries.php?source=edit_pastry&p_id=<?php echo $p_id; ?>" class="btn btn-info">Edit</a>
                        <a href="pastries.php?source=delete_pastry&p_id=<?php echo $p_id; ?>" class="btn btn-danger">Delete</a>
                    </td>
                    </tr>
            <?php
                endwhile;
            ?>
                    
            
            
    </table>
</form>