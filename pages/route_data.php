<table class="table">

    <?php 
      $ACTION   = null;
      $CLEAR    = (isset($_POST['clear']) ? $_POST['clear'] : null);
      $SUBMIT   = (isset($_POST['submit']) ? $_POST['submit'] : null);
      $MODE     = (isset($_REQUEST['mode']) ? $_REQUEST['mode'] : null);
      $dLat     = (isset($_REQUEST['lat']) ? $_REQUEST['lat'] : null);
      $dLng     = (isset($_REQUEST['lng']) ? $_REQUEST['lng'] : null);

      if ($CLEAR == 'CLEAR') {
        $ACTION = "DELETE FROM ROUTE_MAKER";
        $sti = oci_parse($connect, $ACTION);
        oci_execute($sti);
      }

      if ($MODE == 'DELETE') {
        $ACTION = "DELETE FROM ROUTE_MAKER WHERE LAT_VAL = '" . $dLat . "' AND LON_VAL = '" . $dLng . "'";
        $sti = oci_parse($connect, $ACTION);
        oci_execute($sti);
      }

      if ($SUBMIT == 'SUBMIT') {
        $RID = (isset($_REQUEST['ROUTE_CODE']) ? $_REQUEST['ROUTE_CODE'] : null);
        
        $ACTION = "INSERT INTO ROUTE_POINT_SETUP(ROUTE_CODE, LAT_VAL, LON_VAL, ALT_VAL, CREATED_BY, CREATED_DATE) 
                     (SELECT '" . $RID . "', LAT_VAL, LON_VAL, ALT_VAL, CREATED_BY, CREATED_DATE FROM ROUTE_MAKER)"; 
        $sti = oci_parse($connect, $ACTION);
        oci_execute($sti);

        $ACTION2 = "DELETE FROM ROUTE_MAKER";
        $sti2 = oci_parse($connect, $ACTION2);
        oci_execute($sti2);
      }

    ?>

    <form role="form" method="post" action="map.php">
      <tr>
        <td width="10px">
          <a href="map.php"><img src="images/refresh.png"></a>
        </td>
        <td>
          <select name="ROUTE_CODE" class="form-control" id="ROUTE_CODE">
            <?php 
              $qry = "SELECT * FROM ROUTE_SETUP";
              $stt = oci_parse($connect, $qry);
              oci_execute($stt);

              while (oci_fetch($stt)) {
                $RCODE = oci_result($stt, 'ROUTE_CODE');
                $RNAME = oci_result($stt, 'ROUTE_EDESC');
            ?>    
                <option value="<?php echo $RCODE; ?>">
                  <?php echo $RNAME; ?>
                </option>
            <?php
              }
            ?>
          </select>
        </td>

        <td>  
          <input type="hidden" id="submit" name="submit" value="SUBMIT">
          <button type="submit" class="btn btn-success"><b>Submit</b></button>
        </td>
    </form>
    <form role="form" method="post" action="map.php">
        <td align="right">
          <input type="hidden" id="clear" name="clear" value="CLEAR">
          <button type="submit" class="btn btn-danger" ><b>Clear All</b></button>
        </td>
    </form>

    </tr>

  <tr>
        <td> Latitude </td>
        <td> Longitude </td>
        <td> Altitude </td>
        <td></td>
    </tr>
<?php
	$ROUTE_DATA = "SELECT * FROM ROUTE_MAKER ORDER BY CREATED_DATE"; 
   	$st = oci_parse($connect, $ROUTE_DATA);
 	oci_execute($st);

   	while (oci_fetch($st)) {
    	$LAT = oci_result($st,'LAT_VAL'); 
      	$LNG = oci_result($st,'LON_VAL');
      	$ALT = oci_result($st,'ALT_VAL');
      	
      	echo "<tr>";
      	echo "<td>" . $LAT . "</td><td>" . $LNG . "</td><td>" . $ALT . "</td>";
      	echo "<td align=\"right\">";
    		echo "<a href=\"map.php?lat={$LAT}&lng={$LNG}&mode=DELETE\" >";
        		echo "<img src=\"images/delete.png\">";
    		echo "</a>";
			echo "</td>";
      	echo "</tr>"; 
   	} 
?>	
</table>