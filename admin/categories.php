<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Leiyang</small>
                    </h1>

                    <!--Add Category Form-->
                    <div class="col-xs-6">
                        <!--add category-->
                        <?php addCategory(); ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add">
                            </div>
                        </form>

                        <?php
                        //update category
                        if (isset($_GET['edit'])) {
                            $cat_id_edit = $_GET['edit'];
                            include "includes/update_categories.php";
                        }
                        ?>

                    </div>

                    <!-- Show All Categories -->
                    <div class="col-xs-6">

                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Title</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>

                            <!--find all categories-->
                            <?php findAllCategories(); ?>

                            <!--delete category-->
                            <?php deleteCategory(); ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <?php include "includes/admin_footer.php"; ?>
