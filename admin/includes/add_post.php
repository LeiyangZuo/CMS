<?php
if (isset($_POST['submit'])) {
    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_cat_id = $_POST['post_cat_id'];
    $post_date = date('d-m-y');
    $post_comment_count = 4;
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    $post_status = $_POST['post_status'];

    //upload files
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    move_uploaded_file($post_image_temp, "../images/{$post_image}");


    $query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags,post_comment_count, post_status)";
    $query .= "VALUES({$post_cat_id},'$post_title','$post_author',now(),'$post_image','$post_content','$post_tags',$post_comment_count,'$post_status')";
    $insert_post_query = mysqli_query($connection, $query);
    confirmQuery($insert_post_query);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select class="custom-select" name="post_cat_id" id="">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            confirmQuery($select_categories);
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row["cat_id"];
                $cat_title = $row['cat_title'];
                echo "<option value='{$cat_id}'>$cat_title</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea id="" cols="30" rows="10" class="form-control" name="post_content"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
    </div>
</form>