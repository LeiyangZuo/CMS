<?php
/**
 * Created by PhpStorm.
 * User: Leiyang
 * Date: 13/3/18
 * Time: 23:57
 */

//add category
function addCategory()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if ($cat_title != "" && !empty($cat_title)) {
            $query = "INSERT INTO categories (cat_title) VALUE ('$cat_title')";
            $create_category_query = mysqli_query($connection, $query);
            if (!$create_category_query) {
                die ("Add Failed" . mysqli_error($connection));
            }
        } else {
            echo "This field should not be empty";
        }
    }
}

//find all categories
function findAllCategories()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</td>";
        echo "</tr>";
    }
}

//delete category
function deleteCategory()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $cat_id_delete = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$cat_id_delete}";
        $delete_query = mysqli_query($connection, $query);
        if (!$delete_query) {
            die("Delete failed" . mysqli_error($connection));
        }
        header("Location: categories.php");//refresh the page
    }
}

//check query if it is successful
function confirmQuery($result)
{
    global $connection;
    if (!$result) {
        die ("Query failed" . mysqli_error($connection));
    }
}

