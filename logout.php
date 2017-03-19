<?php
  error_reporting(0);
  session_start(); 
  if (session_status() == PHP_SESSION_NONE) {session_start(); }
  $_SESSION['MY_UID'] 	= null;
  $_SESSION['MY_NAME'] 	= null;
  $_SESSION['MY_EMAIL'] = null;	
  $_SESSION['MY_PWD'] 	= null;
?>


<META HTTP-EQUIV="Refresh" CONTENT="0; URL=index.php">
