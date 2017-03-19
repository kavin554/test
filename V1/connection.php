<?php
  define('hostname','localhost') ;
  define('user','root');
  define('password','');
  define('databaseName','great');

  $connect = mysqli_connect(hostname,user,password, databaseName);

echo "connected";
?>
