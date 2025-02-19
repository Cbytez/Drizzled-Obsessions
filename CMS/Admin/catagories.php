<?php include "Includes/admin_header.php"; ?>


<div class="container">
    <div class="row">
        <?php include "Includes/admin_navigation.php"; ?>
        <div class="col-md-12">
            <h1>Catagories</h1>
        </div>
        <h1 class="page-header">
            Catagories
            <small>Welcome Admin</small>
            <div class="col-lg-12">
                <div class="col-xs-6">
                    <?php insert_catagories(); ?>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="cat_title">ADD NEW CATEGORY</label>
                            <input type="text" class="form-control" name="cat_title" placeholder="Category Title">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Catagory">
                        </div>
                </div>
            </div>
        </h1>
    </div>
</div>