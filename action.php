<?php
  error_reporting(0);
  session_start();

  include("libraries/connect.php");

  if (session_status() == PHP_SESSION_NONE) {session_start(); }

  $UID    = (isset($_POST['UID']) ? $_POST['UID'] : null);
  $PWD    = (isset($_POST['PWD']) ? $_POST['PWD'] : null);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['BUTSYS'])) { $BUTTON_CLICKED='SYSTEM'; }
  }

  if ($BUTTON_CLICKED=='SYSTEM') {
    $QRY = "SELECT * FROM log_in WHERE ((user_id = '" . $UID . "') OR (email='" . $UID . "') OR (mobile='" . $UID . "'))";
    $rs = mysql_query($QRY);

      if (mysql_num_rows($rs)==0) {
        $_SESSION['MY_MSG'] = "2";
        echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=index.php">';

      } else {

    while($row = mysql_fetch_array($rs)) {
      $USER_ID          = $row['user_id'];
      $USER_NAME        = $row['name'];
      $USER_EMAIL       = $row['email'];
      $USER_PASSWORD    = $row['password'];
      $USER_MOBILE      = $row['mobile'];

      if ($USER_PASSWORD==$PWD)  {
        $_SESSION['MY_UID'] 		= $USER_ID;
        $_SESSION['MY_NAME']    = $USER_NAME;
        $_SESSION['MY_EMAIL']   = $USER_EMAIL;
        $_SESSION['MY_PWD']     = $PWD;
        $_SESSION['MY_MOBILE']  = $USER_MOBILE;
        $_SESSION['MY_MSG']     = "0";

  ?>
    Loading... <META HTTP-EQUIV="Refresh" CONTENT="0; URL=main.html">
    <?php } else { $_SESSION['MY_MSG'] = "1"; ?>
    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=index.php">
<?php } } } }?>
