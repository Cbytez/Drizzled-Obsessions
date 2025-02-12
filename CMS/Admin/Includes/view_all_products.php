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
            <div class="btn-group">
                <input type="submit" name="submit" class="button-success" value="Submit">
                <button type="button" class="button-primary">Add Pastry</button>
                <!-- <a href="pastries.php?source=add_pastry" class="btn btn-primary">Add Pastry</a> -->
            </div>
        </div>
        <thead>
            <tr class="table-header">
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Pastry ID</th>
                <th>Pastry Name</th>
                <th>Pastry Catagory</th>
                <th>Pastry Description</th>
                <th>Pastry Price</th>
            </tr>
        </thead>
        <tbody>

            <?php
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                $mysqli = new mysqli($db['db_host'], $db['db_user'], $db['db_pass'], $db['db_name']);

                $stmt = $mysqli->prepare("SELECT p_id, p_name, p_catagory, p_description, p_price FROM pastries");
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($p_id, $p_name, $p_catagory, $p_description, $p_price);
                while($stmt->fetch()):
                    echo "<tr>";
                    ?>
                    <td><input class='checkboxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $p_id; ?>'></td>
                    <?php
                    echo "<td>{$p_id}</td>";    
                    echo "<td>{$p_name}</td>";
                    echo "<td>{$p_catagory}</td>";
                    echo "<td>{$p_description}</td>";
                    echo "<td>{$p_price}</td>";
                    echo "</tr>";
                endwhile;
            ?>
        </tbody>       
            
    </table>
</form>