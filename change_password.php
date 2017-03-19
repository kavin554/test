<?php include("menu.php"); ?>


<?php 

   $ERROR = null;
   $INFO = null;
   $OPERATION = (isset($_REQUEST['OPERATION']) ? $_REQUEST['OPERATION'] : null);
   $OLD_PASSWORD = (isset($_REQUEST['OLD_PASSWORD']) ? $_REQUEST['OLD_PASSWORD'] : null);


   $NEW_PASSWORD = (isset($_REQUEST['NEW_PASSWORD']) ? $_REQUEST['NEW_PASSWORD'] : null);
   $REPEAT_PASSWORD = (isset($_REQUEST['REPEAT_PASSWORD']) ? $_REQUEST['REPEAT_PASSWORD'] : null);
   $GLOBAL_PWD = $_SESSION['MY_PWD'];
   $FAIL = 0;

   if ($OPERATION=='SUBMIT') { 

	if ($GLOBAL_PWD<>$OLD_PASSWORD)  { $ERROR = "Invalid Old Password ! Please type valid old password."; $FAIL = 1; } 
	if ($NEW_PASSWORD<>$REPEAT_PASSWORD)  { $ERROR = "New Password and Repeat Password does not match !"; $FAIL = 1; } 
	if ($NEW_PASSWORD==$OLD_PASSWORD)  { $ERROR = "New Password is similar to Old Password. Please enter New Password !"; $FAIL = 1; } 

	if ($FAIL==0) { 

		
	        $_SESSION['MY_PWD'] = $NEW_PASSWORD;   	

		$UPDATE = "UPDATE user_info SET password ='" . $NEW_PASSWORD . "' WHERE ((id ='" . $GLOBAL_UID . "') 
		OR (mobile ='" . $GLOBAL_MOBILE . "') OR (email ='" . $GLOBAL_EMAIL . "'))"; 

 	        $rsUPDATE = mysql_query($UPDATE);
		$INFO = "Password has been changed successfully"; 

	}

   }

?>


<br><br><br><br>
<div id="wrapper">

   <div class="col-lg-3">&nbsp;</div> 

   <div class="col-lg-6"> 


   <div class="panel panel-primary">
   <div class="panel-heading"><h3 class="panel-title">Change Password</h3></div>

   <div style="margin:10px">

   <form role="form" method="post" action="change_password.php">
   <table width="100%">
   <tr><td width="80%">


	   <table width="100%">

	   <tr height="40">
	   <td align="right">Current User ID</td>
	   <td>:</td>
	   <td><B><?php print $GLOBAL_UID; ?></B></td>	
	   </tr>

	   <tr>
	   <td align="right">Old Password</td>
	   <td>:</td>
	   <td><input type="password" class="form-control" name="OLD_PASSWORD" value="<?php print $OLD_PASSWORD; ?>" required></td>	
	   </tr>

	   <tr height="45">
	   <td align="right">New Password</td>
	   <td>:</td>
	   <td><input type="password" class="form-control" name="NEW_PASSWORD" value="<?php print $NEW_PASSWORD; ?>" required></td>	
	   </tr>

	   <tr height="30">
	   <td align="right">Repeat Password</td>
	   <td>:</td>
	   <td><input type="password" class="form-control" name="REPEAT_PASSWORD" value="<?php print $REPEAT_PASSWORD; ?>" required></td>	
	   </tr>
	   </table>	
    </td>
    <td width="01%" align="center">&nbsp;</td>
    <td width="19%" align="center"><img src="images/lock.png" border="0"></td>
    </tr>
	
    <tr height="50">
        <td align="right">
	<input type="hidden" name="OPERATION" value="SUBMIT">
	<button type="submit" class="btn btn-success">Change Password</button></form></td>
        <td align="right">&nbsp;</td>
        <td align="left">
        <form role="form" method="post" action="main.php">
	<button type="submit" class="btn btn-default">Cancel</button></form></td>
    </tr>



    </table>

    <?php if (strlen($ERROR)<>'0') { ?><div style="color:red;height:30px"><?php print $ERROR; ?></div><?php } ?>	
    <?php if (strlen($INFO)<>'0') { ?><div style="color:green;height:30px"><?php print $INFO; ?>
    <META HTTP-EQUIV="Refresh" CONTENT="2; URL=index.php">
    </div><?php } ?>	
	

   </div>	

   </div>	


   </div>
   <div class="col-lg-3">&nbsp;</div> 


</div>

