<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Update Category</label>

        <?php
        if (isset($_GET['edit'])) {
            $cat_id_edit = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE cat_id = {$cat_id_edit}";
            $select_categories = mysqli_query($connection, $query);
            confirmQuery($select_categories);
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                ?>
                <input value="<?php if (isset($cat_title)) {
                    echo $cat_title;
                } ?>" class="form-control" type="text" name="cat_title">
                <?php
            }
        }
        ?>

        <?php
        //update category
        if (isset($_POST['update'])) {
            $update_cat_title = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id = {$cat_id_edit}";
            $edit_query = mysqli_query($connection, $query);
            confirmQuery($edit_query);
            header("Location: categories.php");//refresh the page
        }
        ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Update">
    </div>
</form>