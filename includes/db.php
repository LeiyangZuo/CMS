<?php
/**
 * Created by PhpStorm.
 * User: Leiyang
 * Date: 12/3/18
 * Time: 16:33
 */
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "root";
$db['db_name'] = "cms";

foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$connection) {
    die("database connect failed" . mysqli_error($connection));
}


//$connection = mysqli_connect('localhost','root','root','cms');
//if(!$connection) {
//    die("database connect failed" . mysqli_error($connection));
//} else {
//    echo "connected";
//}
