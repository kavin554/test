<?php 
  include("menu.php"); 
  $SUBMIT   = (isset($_REQUEST['submit']) ? $_REQUEST['submit'] : null);
  $o= (isset($_REQUEST['o']) ? $_REQUEST['o'] : null);
  $MY_DATE  = date('Y-m-d H:i:s');

  if ($SUBMIT == 'SUBMIT'){
    $DESC      = (isset($_REQUEST['description']) ? $_REQUEST['description'] : null);

    $SYNTAX = "INSERT INTO weather_alert (date, description) VALUES ('" . $MY_DATE . "', '" . $DESC . "')";
    $rsINSERT= mysql_query($SYNTAX);

    ?>

    <META HTTP-EQUIV="Refresh" CONTENT="0; URL=transaction.php?o=alert">

  <?php } ?>


  <div class="breadcrumb">
  <table width="98%" border="0">
    <tr>
      <form role="form" method="post" action="alert.php">
      <td width="40%"><h3>Weather Alert</h3></td>
    </tr>
  </table>
  </div>

  <div class="container" style="padding:5px;width:100%">
  <table width="100%" class="table table-striped" border="0">
    <tr>
      <td><textarea name="description" id="C" class="form-control" rows="6"></textarea></td>
    </tr>
  </table>

  <table width="100%" class="table table-striped" border="0">
    <tr>
      <td width="70%">&nbsp;</td>
        <td width="25%" align="right">
          <input type="hidden" name="o" value="<?php echo $o; ?>">
          <input type="hidden" name="submit" value="SUBMIT">
          <button type="submit" class="btn btn-success" style="width: 200px;"><b>Save</b></button>
        </td>
    </form>
        <td width="25%" align="left"> 
          <form role="form" method="post" action="alert.php">
            <input type="hidden" name="o" value="<?php echo $o; ?>">
            <button type="submit" class="btn btn-default" style="width: 200px;">Cancel</button>
          </form>
        </td>
    </tr>
  </table>
  </div>
  </div>
  </div>