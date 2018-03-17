<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
            if (isset($_GET['post_id'])) {
                $select_post_id = $_GET['post_id'];
            }
            $query = "SELECT * FROM posts WHERE post_id = $select_post_id";
            $select_post_by_id = mysqli_query($connection, $query);
            if (!$select_post_by_id) {
                die ("Query failed! " . mysqli_error($connection));
            }
            while ($row = mysqli_fetch_assoc($select_post_by_id)) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span
                            class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php } ?>

            <!-- Pager -->
            <!--            <ul class="pager">-->
            <!--                <li class="previous">-->
            <!--                    <a href="#">&larr; Older</a>-->
            <!--                </li>-->
            <!--                <li class="next">-->
            <!--                    <a href="#">Newer &rarr;</a>-->
            <!--                </li>-->
            <!--            </ul>-->

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Blog Comments -->


    <?php
    if (isset($_POST['create_comment'])) {
        $select_post_id = $_GET['post_id'];
        $com_author = $_POST['com_author'];
        $com_email = $_POST['com_email'];
        $com_content = $_POST['com_content'];

        $query = "INSERT INTO comments (com_post_id, com_date, com_author, com_email, com_content, com_status) ";
        $query .= "VALUES ({$select_post_id}, now(), '{$com_author}', '{$com_email}', '{$com_content}', 'Unapproved')";
        $create_comment_query = mysqli_query($connection, $query);
        if (!$create_comment_query) {
            die ("Query failed!" . mysqli_error($connection));
        }

        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = {$select_post_id}";
        $update_comment_count = mysqli_query($connection, $query);
        if (!$update_comment_count) {
            die ("Query failed!" . mysqli_error($connection));
        }
    }
    ?>


    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        <form action="#" method="post" role="form">
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" class="form-control" name="com_author">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="com_email">
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea name="com_content" class="form-control" rows="3"></textarea>
            </div>
            <button name="create_comment" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <hr>

    <!-- Posted Comments -->
    <?php
    $query = "SELECT * FROM comments WHERE com_post_id = {$select_post_id} ";
    $query .= "AND com_status = 'approved' ";
    $query .= "ORDER BY com_id DESC";
    $select_comments_by_post_id = mysqli_query($connection, $query);
    if (!$select_comments_by_post_id) {
        die ("Query failed!" . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($select_comments_by_post_id)) {
        $com_date = $row['com_date'];
        $com_content = $row['com_content'];
        $com_author = $row['com_author'];
        ?>

        <!-- Comment -->
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $com_author; ?>
                    <small><?php echo $com_date; ?></small>
                </h4>
                <?php echo $com_content; ?>
            </div>
        </div>

    <?php } ?>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
