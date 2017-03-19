<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "great";
    
    mysqli_connect($host, $user, $password) or die(mysqli_error());
    mysqli_select_db($db);
?>