<?php
if (isset($_GET['id'])) {
    $post_id_edit = $_GET['id'];
}
$query = "SELECT * FROM posts WHERE post_id = {$post_id_edit}";
$select_posts_by_id = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_cat_id = $row['post_cat_id'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_comment_count = $row['post_comment_count'];
    $post_tags = $row['post_tags'];
    $post_status = $row['post_status'];
    $post_content = $row['post_content'];
}

if (isset($_POST['update'])) {
    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_cat_id = $_POST['post_cat_id'];
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    $post_status = $_POST['post_status'];

    //upload files
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    move_uploaded_file($post_image_temp, "../images/{$post_image}");

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $post_id_edit ";
        $select_image = mysqli_query($connection, $query);
        confirmQuery($select_image);
        while ($row = mysqli_fetch_assoc($select_image)) {
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}',";
    $query .= "post_cat_id = {$post_cat_id},";
    $query .= "post_date = now(),";
    $query .= "post_author = '{$post_author}',";
    $query .= "post_status = '{$post_status}',";
    $query .= "post_tags = '{$post_tags}',";
    $query .= "post_content = '{$post_content}',";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = {$post_id_edit}";

    $update_post_query = mysqli_query($connection, $query);
    confirmQuery($update_post_query);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
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
                if ($post_cat_id == $cat_id) {
                    echo "<option value='{$cat_id}' selected='selected'>$cat_title</option>";
                } else {
                    echo "<option value='{$cat_id}'>$cat_title</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img width="200" src="../images/<?php echo $post_image; ?>">
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea id="" cols="30" rows="10" class="form-control"
                  name="post_content"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="update" class="btn btn-primary" value="Update">
    </div>
</form>
