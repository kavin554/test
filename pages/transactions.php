<?php 
  session_start();
  if(!isset($_SESSION['UID'])){
    header('location:../index.php');
  }
?>

<?php include("main.php"); ?>
<?php include("menu.php"); ?>

  <?php

     $o=$_REQUEST["o"];
     if (strlen($o)==0) { $o=$_POST["o"]; }
     if (strlen($o)==0) { exit; }

     $title = null;

     if ($o=='user_registration') 		{ $title = "User Registration"; }
     if ($o=='daily_weather') 				{ $title = "Daily Weather"; }
     if ($o=='disperse_notification') 			{ $title = "Disperse Notification / Alert"; }


  ?>


  <?php


   $OPERATION = (isset($_POST['operation']) ? $_POST['operation'] : null);
   $SUBMIT = (isset($_POST['mode']) ? $_POST['mode'] : null);
   $MY_DATE = date('Y-m-d H:i:s');



   if ($OPERATION=='submit') {


	$CODE = (isset($_POST['CODE']) ? $_POST['CODE'] : null);
	$NAME = (isset($_POST['NAME']) ? $_POST['NAME'] : null);
	$REMARKS = (isset($_POST['REMARKS']) ? $_POST['REMARKS'] : null);

  if ($o=='user_registration') {

      if ($SUBMIT=='edit') {
      $ACTION = "UPDATE country SET
        COUNTRY_TEL_CODE ='" . $COUNTRY_TEL_CODE . "',
        USER_NAME ='" . $NAME . "',
        EMAIL_1 ='" . $EMAIL_1 . "',
        EMAIL_2 ='" . $EMAIL_2 . "',
        EMERGENCY_CONTACT_1 ='" . $EMERGENCY_CONTACT_1 . "',
        EMERGENCY_CONTACT_2 ='" . $EMERGENCY_CONTACT_2 . "',
        EMERGENCY_CONTACT_3 ='" . $EMERGENCY_CONTACT_3 . "',
        NATIONALITY ='" . $NATIONALITY . "',
        ADDRESS_1 ='" . $ADDRESS_1 . "',
        ADDRESS_2 ='" . $ADDRESS_2 . "',
        PASSPORT_NO ='" . $PASSPORT_NO . "',
        VISA_ISSUE_DATE ='" . $VISA_ISSUE_DATE . "',
        VISA_EXPIRY_DATE ='" . $VISA_EXPIRY_DATE . "',
        CREATED_BY ='" . $GLOBAL_UID . "',
        CREATED_DATE = '" . $MY_DATE . "'
        MODIFIED_BY ='" . $GLOBAL_UID . "',
        MODIFIED_DATE = '" . $MY_DATE . "'
        WHERE USER_ID = '" . $CODE . "'";

        $rsUPDATE = mysqli_query($ACTION);
      }


      if ($SUBMIT=='new') {
      $ACTION = "INSERT INTO country(
         USER_ID,
         USER_NAME,
         EMAIL_1,
         EMAIL_2,
         EMERGENCY_CONTACT_1,
         EMERGENCY_CONTACT_2,
         EMERGENCY_CONTACT_3,
         NATIONALITY,
         ADDRESS_1,
         ADDRESS_2,
         PASSPORT_NO,
         VISA_ISSUE_DATE,
         VISA_EXPIRY_DATE,
         CREATED_BY,
         CREATED_DATE,
         MODIFIED_BY,
         MODIFIED_DATE)
      VALUES('" . $CODE . "',
      '" . $NAME . "',
      '" . $EMAIL_1 . "',
      '" . $EMAIL_2 . "',
      '" . $EMERGENCY_CONTACT_1 . "',
      '" . $EMERGENCY_CONTACT_2 . "',
      '" . $EMERGENCY_CONTACT_3 . "',
      '" . $NATIONALITY . "',
      '" . $ADDRESS_1 . "',
      '" . $ADDRESS_2 . "',
      '" . $PASSPORT_NO . "',
      '" . $VISA_ISSUE_DATE . "',
      '" . $VISA_EXPIRY_DATE . "',
      '" . $GLOBAL_UID . "',
      '" . $MY_DATE  . "',
      '" . $GLOBAL_UID . "',
      '" . $MY_DATE  . "')";

          $rsINSERT= mysqli_query($ACTION);

      }

  }

}



  ?>
  <style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
  <style>
  #map {
    width: 100%;
    height: 330px;
  }
</style>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfnOQEYE3qSj4iKNMqiqJdg_slnltHWlE&callback=initMap"></script>

<script>
$(document).ready(function() {


      function change_data() {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        } else {
          // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("rdata").innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","route_data.php",true);
        xmlhttp.send();
      }



      function initialize() {
        var mapCanvas = document.getElementById('map');
        var mapOptions = {
          center: new google.maps.LatLng(27.707, 85.297),
          zoom: 8,
        }
        //intializing google maps
        var map = new google.maps.Map(mapCanvas, mapOptions)

        //listener for the click event
        google.maps.event.addListener(map, "click", function (event) {
            var lat = event.latLng.lat();
            var lng = event.latLng.lng();

            radius = new google.maps.Circle({map: map,
                radius: 10,
                center: event.latLng,
                fillColor: '#777',
                fillOpacity: 0.1,
                strokeColor: '#AA0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                draggable: false,
                editable: true
            });

            map.panTo(new google.maps.LatLng(lat,lng));

            document.getElementById("latitude").value = lat;
            document.getElementById("longitude").value = lng;

            var myPath = "map_submit.php?lt=" + lat + "&ln=" + lng;
        var xhReq = new XMLHttpRequest();
        xhReq.open("POST", myPath, false);
        xhReq.send(null);
        var serverResponse = xhReq.responseText;
        //alert(serverResponse);

        change_data();

        });
      }

google.maps.event.addDomListener(window, 'load', initialize);

});
</script>



<HTML>
<HEAD>
<TITLE><?php print $title; ?></TITLE>
</HEAD>
<BODY>
    <div id="page-wrapper">
 <div class="row">


  <div class="col-md-10">
  <div class="panel panel-default">
                        <div class="panel-body">





  <div>

  <ul class="nav nav-tabs" role="tablist">

    <li role="presentation" class="active"><a href="#detail" aria-controls="home" role="tab" data-toggle="tab"><?php print $title; ?> Form </a></li>
    <?php if ($o=='user_registration') { ?>
    <li role="presentation"><a href="#list" aria-controls="home" role="tab" data-toggle="tab"><?php print $title; ?> List</a></li>
    <li role="presentation"><a href="#contact" aria-controls="home" role="tab" data-toggle="tab"> Emergency Contact</a></li>
    <?php } ?>


  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="detail">

	<form role="form" method="post" action="transactions.php">

	<?php


	  error_reporting(0);
  	  $ID=$_REQUEST["id"];
	  if (strlen($ID)==0) { $ID = '1001'; }

	  $MODE = $_REQUEST["mode"];

	  if (strlen($MODE)==0) { $DISABLED = "DISABLED"; $READONLY ="READONLY"; }
	  if ($MODE=='view') { $DISABLED = "DISABLED"; $READONLY ="READONLY"; }
	  if ($MODE=='new') { $DISABLED = "ENABLED"; $READONLY =""; }
	  if ($MODE=='edit') { $DISABLED = "ENABLED"; $READONLY =""; }

	  error_reporting(1);




        ?>



        <div class="container" style="padding:5px;width:100%">

        <div class="table-responsive">

	<table width="98%">



  	 <?php if ($o == 'user_registration')  {


       $qry = "SELECT * FROM user_registration WHERE USER_ID = '" . $ID . "'";

 $rss = mysqli_query($qry);

       while($row = mysqli_fetch_array($rss)) {
          $CODE = $row['USER_ID'];
          $NAME = $row['USER_NAME'];
          $EMAIL_1 = $row['EMAIL_1'];
          $EMAIL_2 = $row['EMAIL_2'];
          $EMERGENCY_CONTACT_1 = $row['EMERGENCY_CONTACT_1'];
          $EMERGENCY_CONTACT_2 = $row['EMERGENCY_CONTACT_2'];
          $EMERGENCY_CONTACT_3 = $row['EMERGENCY_CONTACT_3'];
          $NATIONALITY = $row['NATIONALITY'];
          $ADDRESS_1 = $row['ADDRESS_1'];
          $ADDRESS_2 = $row['ADDRESS_2'];
          $PASSPORT_NO = $row['PASSPORT_NO'];
          $VISA_ISSUE_DATE = $row['VISA_ISSUE_DATE'];
          $VISA_EXPIRY_DATE = $row['VISA_EXPIRY_DATE'];
          $CREATED_BY = $row['GLOBAL_UID'];
          $CREATED_DATE = $row['MY_DATE'];
          $MODIFIED_BY = $row['GLOBAL_UID'];
          $MODIFIED_DATE = $row['MY_DATE'];
       }?>

        <tr height="40">
            <td width="28%" align="right">Id</td>
            <td width="02%" align="center">:</td>
            <td width="88%">
              <table width="100%">
                <tr>
                  <td width="30%">
                <input class="form-control" type="hidden">

              <?php if ($MODE=='new') { ?>
              <input type="text" class="form-control" id="CODE" size="10" name="CODE" value="<?php print $CODE; ?>" value="<?php print $CODE; ?>"
              REQUIRED style="width:100px">
              <?php } ?>

              <?php if ($MODE=='edit') { ?>
              <input type="text" class="form-control" id="CODE" size="10" name="CODE" value="<?php print $CODE; ?>" value="<?php print $CODE; ?>"
              READONLY style="width:100px">
              <?php } ?>

              <?php if ($MODE=='view') { ?>
              <input type="text" class="form-control" id="CODE" size="10" name="CODE" value="<?php print $CODE; ?>" value="<?php print $CODE; ?>"
              READONLY style="width:100px">
              <?php } ?>
                  <td align="right">&nbsp;</td>

          </td>
                    <td align="right">Type </td>
                    <td align="center">:</td>
                    <td width="40%">
                    <SELECT name="STATUS" class="form-control">
                        <OPTION VALUE="">Nepal</OPTION>
                        <OPTION VALUE="P">China</OPTION>
                        <OPTION VALUE="P">Srilanka</OPTION>
                        <OPTION VALUE="P">Bhutan</OPTION>
                    </SELECT></td>
                </tr>
              	</table>
            </td>
        </tr>

        <tr height="40">
            <td align="right"> Name </td>
            <td align="center">:</td>
            <td><input type="text" class="form-control" id="NAME" name="NAME" value="<?php print $NAME; ?>"
        </tr>

        <tr height="1">
         	<td align="right">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td><b>Address</b></td>
        </tr>

        <tr height="40">
            <td  align="right">Street</td>
            <td width="02%" align="center">:</td>
            <td width="88%">
            <table width="100%">
                <tr>
                <td width="30%">

                    <input name="STREET"  class="form-control" placeholder="Street " id="STREET" >

                </td>
                <td width="02%">&nbsp;</td>
            <td align="right">City </td>
            <td align="center">:</td>
                <td width="02%">&nbsp;</td>
                <td width="30%">

                    <input name="CITY"  class="form-control" placeholder="City " id="CITY" >

                </td>
                <td width="02%">&nbsp;</td>
            <td align="right">State </td>
            <td align="center">:</td>
                <td width="02%">&nbsp;</td>
                <td width="30%">

                    <input name="STATE"  class="form-control" placeholder="State " id="STATE" >

                </td>
                </tr>
            </table>
            </td>
        </tr>

        <tr height="1">
            <td align="right">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td><b>Contact</b></td>
        </tr>

        <tr height="40">
            <td  align="right">Mobile</td>
            <td width="02%" align="center">:</td>
            <td width="88%">
            <table width="100%">
                <tr>
                <td width="40%">

                    <input name="MOBILE"  class="form-control" placeholder="Mobile " id="MOBILE" >

                </td>
                <td width="02%">&nbsp;</td>
            <td align="right">Home </td>
            <td align="center">:</td>
                <td width="02%">&nbsp;</td>
                <td width="40%">

                    <input name="HOME"  class="form-control" placeholder="Home " id="HOME" >

                </td>

                </tr>
            </table>
            </td>
        </tr>

        <tr height="40">
            <td  align="right">Email</td>
            <td width="02%" align="center">:</td>
            <td width="88%">
            <table width="100%">
                <tr>
                <td width="40%">

                    <input name="EMAIL1"  class="form-control" placeholder="Email " id="EMAIL1" >

                </td>
                <td width="02%">&nbsp;</td>

                <td width="40%">

                    <input name="EMAIL2"  class="form-control" placeholder="Alt Email " id="EMAIL2" >

                </td>

                </tr>
            </table>
            </td>
        </tr>

        <tr height="1">
            <td align="right">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td><b>Passport</b></td>
        </tr>

        <tr height="40">
            <td  align="right">PP Number</td>
            <td width="02%" align="center">:</td>
            <td width="88%">
            <table width="100%">
                <tr>
                <td width="40%">

                    <input name="PP_NO"  class="form-control" placeholder="PP Number " id="PP_NO" >

                </td>
                <td width="02%">&nbsp;</td>
            <td align="right">Type </td>
            <td align="center">:</td>
                <td width="02%">&nbsp;</td>
                <td width="40%">

                    <SELECT name="STATUS" class="form-control">
                <OPTION VALUE="">General</OPTION>
                <OPTION VALUE="P">Diploment</OPTION>

            </SELECT>

                </td>

                </tr>
            </table>
            </td>
        </tr>

        <tr height="40">
            <td  align="right">Issue Date</td>
            <td width="02%" align="center">:</td>
            <td width="88%">
            <table width="100%">
                <tr>
                <td width="40%">

                    <input name="ISSUE_DATE"  class="form-control" placeholder="Issue Date" id="ISSUE_DATE" >

                </td>
                <td width="02%">&nbsp;</td>
            <td align="right">Expire Date </td>
            <td align="center">:</td>
                <td width="02%">&nbsp;</td>
                <td width="40%">

                    <input name="EXPIRE_DATE"  class="form-control" placeholder="Expire Date" id="EXPIRE_DATE" >

                </td>

                </tr>
            </table>
            </td>
        </tr>






	<tr height="40">
        <td align="right" valign="top">Remarks</td>
        <td align="center" valign="top">:</td>
        <td><textarea class="form-control" rows="1" id="REMARKS" placeholder="Enter Remarks" name="REMARKS" <?php print $READONLY; ?>>
        <?php print $REMARKS; ?></textarea></td>
        </tr>


	<tr height="40">
        <td align="right">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td>

	<table class="table">
	<tr>
        <td width="50%">


	<input type="hidden" name="o" value="<?php print $o; ?>">
	<input type="hidden" name="mode" value="<?php print $MODE; ?>">
	<input type="hidden" name="operation" value="submit">
 	<button type="submit" class="btn btn-success" <?php print $DISABLED; ?>><b>Submit</b> <?php print $title; ?></button>
 	</form>

        </td>


        <td width="25%" align="right">
	<!--
	<form role="form" method="post" action="delete.php">
	<input type="hidden" name="o" value="<?php print $o; ?>">
	<input type="hidden" name="id" value="<?php print $ID; ?>">
	<input type="hidden" name="name" value="<?php print $NAME; ?>">
	<input type="hidden" name="title" value="<?php print $title; ?>">
	<input type="hidden" name="src" value="definition.php">
 	<button type="submit" class="btn btn-danger" <?php print $DELETE_DISABLED; ?>>Delete</button>
 	</form>
        -->
	</td>


        <td width="25%" align="left">

	<form role="form" method="post" action="definition.php">
	<input type="hidden" name="o" value="<?php print $o; ?>">
 	<button type="submit" class="btn btn-default">Cancel</button>
 	</form>


        </td>

        </tr>
        </table>


	</td>
        </tr>
     <?php } ?>
           <?php if (($o=='disperse_notification') or ($o=='daily_weather'))  { ?>
            <div id="map"></div>

     <?php } ?>
        </table>

	</div>
        </div>
        <?php if ($o == 'disperse_notification')  {?>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="list-group">
                                <div class="list-group">
                                    <table width="100%" class="table table-striped" border="0">
                                 <thead>
                                  <tr>
                                    <th>User</th>
                                    <th>Route</th>
                                    <th>Location</th>
                                    <th>Detail</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>

                                  </tr>
                                <tbody>
                                <tr>
                                    <td>Ram Khadka</td>
                                    <td >Janakpur</td>
                                    <td >Kalaiya</td>
                                    <td >Hot Place</td>
                                    <td align="center">&nbsp;</td>
 									<td width="5%"><button type="submit" class="btn btn-success">Disperse</button></td>                                </tr>
                                 <tr>
                                    <td>Hari Shrestha</td>
                                    <td >Palpa</td>
                                    <td >Janakpur</td>
                                    <td >Hot Place</td>
                                    <td align="center">&nbsp;</td>
 									<td width="5%"><button type="submit" class="btn btn-success">Disperse</button></td>                                </tr>
                                </tr>
                                </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>

                <?php } ?>

                 <?php if ($o == 'daily_weather')  {?>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="list-group">
                                <div class="list-group">
                                    <table width="100%" class="table table-striped" border="0">
                                 <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Station</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Rain</th>
                                    <th>Humidity</th>
                                    <th>Sunshine</th>
                                    <th>Wind</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>

                                  </tr>
                                <tbody>
                                 <tr>
                                   <td width="5%">
                                       3
                                    </td>
                                    <td width="20%">
                                        <input name="STATION"  class="form-control" placeholder="Station" id="dp_time" >

                                    </td >
                                    <td width="15%">
                                        <input name="DATE"  class="form-control" placeholder="Date" id="EMAIL" >

                                    </td>
                                    <td width="10%">
                                        <input name="TIME"  class="form-control" placeholder="Time" id="EMAIL" >

                                    </td>
                                    <td width="10%">
                                        <input name="RAIN"  class="form-control" placeholder="RAin" id="EMAIL" >

                                    </td>
                                    <td width="10%">
                                        <input name="HUMIDITY"  class="form-control" placeholder="Humidity" id="EMAIL" >

                                    </td>
                                    <td width="10%">
                                        <input name="SUNSHINE"  class="form-control" placeholder="Sunshine" id="EMAIL" >

                                    </td>
                                    <td width="10%">
                                        <input name="WIND"  class="form-control" placeholder="Wind" id="EMAIL" >


                                    <td><button type="submit" class="btn btn-success">Submit</button></td>
                                                                <td align="center">&nbsp;</td>
                                  </tr>
                                                            <tr>
                                    <td>01 </td>
                                    <td >Janakpur</td>
                                    <td >2061/01/32</td>
                                    <td >3:21 </td>
                                    <td >23 </td>
                                    <td >45 </td>
                                    <td >43 </td>
                                    <td >32 </td>

									<td align="right"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/edit.png"></a></td>
                <td align="right" width="2%"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/delete.png"></a></td>
                                </tr>
                                <tr>
                                     <td>02 </td>
                                    <td >Palpa</td>
                                    <td >2061/04/32</td>
                                    <td >5:21 </td>
                                    <td >53 </td>
                                    <td >65 </td>
                                    <td >83 </td>
                                    <td >22 </td>
									<td align="right"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/edit.png"></a></td>
                <td align="right" width="2%"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/delete.png"></a></td>
                                </tr>
                                </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>

                <?php } ?>




  </div>


   <div role="tabpanel" class="tab-pane" id="contact">
  <div class="container" style="padding:5px;width:100%">
  <table width="100%" class="table table-striped" border="0">
    <thead>
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Country</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>

      <?php

      $qry = "SELECT * FROM user_registration order by USER_ID";
      $rs = mysqli_query($qry);

            while($row = mysqli_fetch_array($rs)) {
               $CODE = $row['USER_ID'];
               $NAME = $row['USER_NAME'];
               $EMAIL_1 = $row['EMAIL_1'];
               $ADDRESS_1 = $row['ADDRESS_1'];

               ?>

      <tr>
       <th width="10%">
           <input name="ID"  class="form-control" placeholder="No" id="dp_date"  >
            </SELECT>
        </th>
        <th width="30%">
            <input name="NAME"  class="form-control" placeholder="Name" id="dp_time" >

        </th >
        <th width="30%">
            <input name="EMAIL"  class="form-control" placeholder="Email" id="EMAIL" >

        </th>
         <th width="20%">
            <SELECT name="COUNTRY" class="form-control">
                <OPTION VALUE="">Nepal</OPTION>
                <OPTION VALUE="P">China</OPTION>
                <OPTION VALUE="P">Srilanka</OPTION>
                <OPTION VALUE="P">Bhutan</OPTION>
            </SELECT>
        </th>
        <td><button type="submit" class="btn btn-success">Submit</button></td>
                                    <td align="center">&nbsp;</td>
      </tr>

      <tr>
        <td><?php print $CODE; ?></td>
        <td><a href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=view"><?php print $NAME; ?></a></td>
        <td ><?php print $EMAIL_1; ?></td>
        <td ><?php print $ADDRESS_1; ?></td>
 		<td align="right"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/edit.png"></a></td>
                <td align="right" width="2%"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/delete.png"></a></td>
      </tr>
      <?php } ?>
      




    </tbody>
    </table>
  </div>
  </div>


   <div role="tabpanel" class="tab-pane" id="list">
  <div class="container" style="padding:5px;width:100%">
	 <div class="panel panel-default">
    <div class="panel-body">


     <div class="list-group">

            <div class="list-group">
                <table width="100%" class="table table-striped" border="0">
             <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Nationality</th>
                <th>PP Number</th>
                <th>Email</th>
                <th>Status</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
               <tr>
                <td width="5%">3</td>
                <td width="20%">
                    <input name="NAME"  class="form-control" placeholder="Name" id="dp_time" >

                </td >
                 <td width="10%">
                    <SELECT name="NATIONALITY" class="form-control">
                        <OPTION VALUE="">Nepal</OPTION>
                        <OPTION VALUE="P">China</OPTION>
                        <OPTION VALUE="P">Srilanka</OPTION>
                        <OPTION VALUE="P">Bhutan</OPTION>
                    </SELECT>
                </td>
                <td width="10%">
                    <input name="PP_NUMBER"  class="form-control" placeholder="PP No" id="PP_NUMBER" >

                </td>
                <td width="15%">
                    <input name="EMAIL"  class="form-control" placeholder="Email" id="EMAIL" >

                </td>
                <td width="10%">
                   <label class="switch">
  <input type="checkbox">
 <div class="slider round"></div></label>
                </td>
        		<td width="5%"><button type="submit" class="btn btn-success">Save</button></td>
                                    <td align="center">&nbsp;</td>
              </tr>
            <tbody>
            <tr>
                <td>1</td>
                <td>Tim Cook</td>
                <td >Japan</td>
                <td >001176545</td>
                <td >appleball@gmail.com</td>
                <td >Active</td>
                <td align="right"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/edit.png"></a></td>
                <td align="right" width="2%"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/delete.png"></a></td>
            </tr>
             <tr>
                <td>2</td>
                <td>Hitlar Khuresi</td>
                <td >Pakistan</td>
                <td >98766556</td>
                <td >hitkhuresi@yahoo.com</td>
                <td >Active</td>
                <td align="right"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/edit.png"></a></td>
                <td align="right" width="2%"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/delete.png"></a></td>
            </tr>
            </tbody>
                </table>


    </div>
    <!-- /.panel-body -->
</div>

        <div class="list-group">
        <legend>Emergency Contact</legend>

            <div class="list-group">
                <table width="100%" class="table table-striped" border="0">
             <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Country</th>

              </tr>

            <tbody>
            <tr>
                <td>01</td>
                <td>Tim Cook</td>
                <td >appleball@gmail.com</td>
                <td >Japan</td>
            </tr>
             <tr>
                <td>2</td>
                <td>Hitlar Khuresi</td>
                <td >hitkhuresi@yahoo.com</td>
                <td >Pakistan</td>
            </tr>
            </tbody>
                </table>


    </div>
    <!-- /.panel-body -->
</div>

  </div>
    <!-- /.panel-body -->




    <!-- /.panel-body -->

</div>





  </div>
  </div>

   <div role="tabpanel" class="tab-pane" id="custom">
  <div class="container" style="padding:5px;width:100%">
  <table width="100%" class="table table-striped" border="0">
    <thead>
      <tr>
        <th>Heading</th>
        <th>Information</th>
        <th>Remarks</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <td><input type="text" class="form-control" name="FIELD_ID"></td>
        <td><input type="text" class="form-control" name="FIELD_VAL"></td>
        <td><input type="text" class="form-control" name="REMARKS"></td>
        <td><button type="submit" class="btn btn-success">Submit</button></td>
      </tr>

      <tr>
        <td><b>Code Length</b></td>
        <td>Should be 4 digit at all</td>
        <td>&nbsp;</td>
        <th>&nbsp;</th>
      </tr>

    </tbody>
    </table>
  </div>
  </div>



  <div role="tabpanel" class="tab-pane" id="history">


  <div class="container" style="padding:5px;width:100%">
  <table width="100%" class="table table-striped" border="0">
    <thead>
      <tr>
        <th>Linked Description</th>
        <th>Count</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <td>Member Enrollment</td>
        <td>2 Records</td>
        <td>0.00</td>
      </tr>

      <tr>
        <td>Business Request</td>
        <td>1 Records</td>
        <td>50000.00</td>
      </tr>

    </tbody>
    </table>
    </div>

  </div>


    </div>
    </div></div></div></div>

      <div class="col-lg-2">
                <?php if ($o == 'preference')  {?>
                <div class="panel panel-default">

                        <!-- /.panel-heading -->



                <div ><img src="../../GHT/image/nepalflag.jpg" style="width:100%;height:100%;"></div>
            </div>
                <?php } ?>

                <?php if ($o == 'user_registration')  {?>
                <div class="panel panel-default">

                        <!-- /.panel-heading -->



                <div ><img src="../../GHT/image/qr.png" style="width:100%;height:100%;"></div>
                </div>

                <div class="panel panel-default">

                        <!-- /.panel-heading -->



                <div ><img src="../../GHT/image/pp.jpg" style="width:100%;height:100%;"></div>
                </div>


                <?php } ?>
                    <?php if (($o == 'preference') or ($o == 'route_setup') or ($o == 'location'))  {?>
                    <div class="panel panel-default">

                        <!-- /.panel-heading -->


                                    <div id="wrapper">

                                        <div id="map"></div>

                                    </div>

                    </div>

                    <?php } ?>
                    <?php if ($o == 'route_setup')  {?>
                    <div class="panel panel-default">
                        <div class="pull-right">
                            <table width="100%" class="table " border="0">

                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Information To be Included</th>
                                </tr>
                                <tr>
                                    <td>*</td>
                                    <td>Each Itenory Should have different Level</td>
                                </tr>
                                <tr>
                                    <td>*</td>
                                    <td>Places can be on the way or around the way</td>
                                </tr>

                        </div>



                        <!-- /.panel-body -->
                    </div>
                    <?php } ?>

                </div>
                <!-- /.col-lg-9 -->
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->








  </div>




  </div>
</div>

</BODY>
</HTML>
