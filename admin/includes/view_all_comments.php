<!--show all posts-->
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Response to</th>
        <th>Date</th>
        <th>Approved</th>
        <th>Unapproved</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>

    <?php
    global $connection;
    $query = "SELECT * FROM comments";
    $show_all_comments = mysqli_query($connection, $query);
    confirmQuery($show_all_comments);
    while ($row = mysqli_fetch_assoc($show_all_comments)) {
        $com_id = $row['com_id'];
        $com_author = $row['com_author'];
        $com_content = $row['com_content'];
        $com_email = $row['com_email'];
        $com_status = $row['com_status'];
        $com_post_id = $row['com_post_id'];
        $com_date = $row['com_date'];

        echo "<tr>";
        echo "<td>{$com_id}</td>";
        echo "<td>{$com_author}</td>";
        echo "<td>{$com_content}</td>";
        echo "<td>{$com_email}</td>";
        echo "<td>{$com_status}</td>";

        $query = "SELECT * FROM posts WHERE post_id = {$com_post_id}";
        $comment_post_title_query = mysqli_query($connection, $query);
        confirmQuery($comment_post_title_query);
        while ($row = mysqli_fetch_assoc($comment_post_title_query)) {
            $post_id = $row['post_id'];
            $comment_post_title = $row['post_title'];
            echo "<td><a href='../post.php?post_id=$post_id'>{$comment_post_title}</td>";
        }

        echo "<td>{$com_date}</td>";
        echo "<td><a href='comments.php?approved={$com_id}'>Approved</td>";
        echo "<td><a href='comments.php?unapproved={$com_id}'>Unapproved</td>";
        echo "<td><a href=''>Edit</td>";
        echo "<td><a href='comments.php?delete={$com_id}'>Delete</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

<?php
if (isset($_GET['approved'])) {
    $update_com_id = $_GET['approved'];
    $query = "UPDATE comments SET com_status = 'Approved' WHERE com_id = {$update_com_id}";
    $approved_comment_query = mysqli_query($connection, $query);
    confirmQuery($approved_comment_query);
    header("Location: comments.php");//refresh the page
}

if (isset($_GET['unapproved'])) {
    $update_com_id = $_GET['unapproved'];
    $query = "UPDATE comments SET com_status = 'Unapproved' WHERE com_id = {$update_com_id}";
    $unapproved_comment_query = mysqli_query($connection, $query);
    confirmQuery($unapproved_comment_query);
    header("Location: comments.php");//refresh the page
}

if (isset($_GET['delete'])) {
    $delete_com_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE com_id = {$delete_com_id}";
    $delete_comment_query = mysqli_query($connection, $query);
    confirmQuery($delete_comment_query);
    header("Location: comments.php");//refresh the page
}
?>