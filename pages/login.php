<?php include("header.php"); ?>

<?php
  error_reporting(0);
  if (session_status() == PHP_SESSION_NONE) {session_start(); }
    $MSG = $_SESSION['MY_MSG'];
  error_reporting(1);

  include("libraries/connect.php");
  $id = (isset($_REQUEST['id']) ? $_REQUEST['id'] : null);

  if (strlen($id)==0) { $Title = "Event"; } else { $Title = $id; }

?>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>

                    <div class="panel-body">
                      <form class="form-inline" method="post" action="action.php">
                  	  <table class="table">
                  	  <tr>
                        <td align="right">Admin ID : </td>
                        <td><input type="text" style="width:100%" class="form-control" id="UID" name="UID" placeholder="Email / Mobile No / User ID" required></td>
                    	</tr>
                  	  <tr>
                        <td align="right">Password :</td>
                        <td><input type="password" style="width:100%" width="100%" class="form-control" id="PWD" name="PWD" placeholder="Password" required></td>
                    	</tr>
                  	  <tr>
                        <?php if ($MSG=='1') { ?><div style="color:red;height:30px">Invalid or wrong password !</div><?php } ?>
                        <?php if ($MSG=='2') { ?><div style="color:red;height:30px">Invalid or wrong username !</div><?php } ?>
                        <td>
                          <button type="submit" name='BUTSYS' class="btn btn-warning" style="width: 100px">Login</button>
                  	    </td>
                    	</tr>
                  	  </table>
                   	</form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  

</body>

</html>
