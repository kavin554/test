<?php

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'great');

$connect = @mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$connect) {

    die('Could Not Connect To Server');
}

$db_selected = mysqli_select_db($connect,DB_NAME);
if (!$db_selected) {
    die('Could not select database: ' . mysqli_error());
}
?>