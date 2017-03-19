<?php
  define('hostname','localhost') ;
  define('user','root');
  define('password','');
  define('databaseName','great');

  $connect = mysqli_connect(hostname,user,password, databaseName);

  /* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    echo "connection error";
    exit();
}else{

   echo "connection ok";

}


var_dump($connect);
die;

echo "Connected";
?>
