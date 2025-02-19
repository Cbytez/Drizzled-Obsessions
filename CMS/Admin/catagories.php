<?php include "Includes/admin_header.php"; ?>



<div class="container">
    <div class="row">
        <?php include "Includes/admin_navigation.php"; ?>
        <div class="col-md-12">
            <h1 class="admin_header">Catagories</h1>
        </div>
        <h1 class="page-header">
            <h2>Welcome Admin</h2>
            <div class="col-lg-12">
                <div class="col-xs-6">
                    <?php insert_catagories(); ?>

                    <form action="" method="post">
                        <div class="form-group1">
                            <label for="cat_title">ADD CATEGORY</label>
                            <input type="text" class="form-control" name="cat_title" placeholder="Category Title">
                        </div>
                        <div class="form-group1">
                            <input class="button-success-add" type="submit" name="submit" value="Add">
                        </div>
                    </form>

                    <!-- Update and include query -->
                    <?php 
                        if(isset($_GET['edit'])){
                            $cat_id = $_GET['edit'];
                            include "Includes/update_catagories.php";
                        }
                    ?>
                </div>
                <!-- Add Catagory Form -->
                <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Catagory Title</th>
                                <th>Edit Catagory</th>
                                <th>Delete Catagory</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php findAllCatagories(); ?>

                            <!-- Delete Catagory -->
                            <?php deleteQuery(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </h1>
    </div>
</div>

<?php include "Includes/admin_footer.php"; ?>
</body>
</html>