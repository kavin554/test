<?php include("main.php"); ?>
<?php include("menu.php"); ?>

 <?php

     $o=$_REQUEST["o"];
     if (strlen($o)==0) { $o=$_POST["o"]; }
     if (strlen($o)==0) { exit; }

     if ($o=='location')            { $title = "Location"; } 
     if ($o=='route')               { $title = "Route "; } 
     if ($o=='route_point')         { $title = "Route Point"; } 
     if ($o=='preference')          { $title = "Preference Setup"; } 
     if ($o=='route_setup')         { $title = "Route Setup"; } 
     if ($o=='country_setup')       { $title = "Country Setup"; } 
     if ($o=='user_registration')   { $title = "User Registration"; } 


  ?>


  <?php


   $OPERATION = (isset($_POST['operation']) ? $_POST['operation'] : null);
   $SUBMIT = (isset($_POST['mode']) ? $_POST['mode'] : null);

   if ($OPERATION=='submit') { 


    $CODE = (isset($_POST['CODE']) ? $_POST['CODE'] : null);
    $EDESC = (isset($_POST['EDESC']) ? $_POST['EDESC'] : null);
    $NDESC = (isset($_POST['NDESC']) ? $_POST['NDESC'] : null);
    $REMARKS = (isset($_POST['REMARKS']) ? $_POST['REMARKS'] : null);
    $STATUS_FLAG ='Y';

    
   } 

    

  ?>



<HTML>
<HEAD>

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

</head>

<body>

   
    <div id="page-wrapper">
        <div class="row">
            <legend><?php print $title; ?> Info</legend>
           <br>
                <!-- /.col-lg-12 -->
        </div>
            <!-- /.row -->
            <!-- /.row -->
        <div class="row">
         <div>
  
  <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#detail" aria-controls="home" role="tab" data-toggle="tab"><?php print $title; ?> Detail</a></li>
            <li role="presentation"><a href="#custom" aria-controls="custom" role="tab" data-toggle="tab"><?php print $title; ?></a></li>
           
          </ul>
          </div>

        <div class="col-lg-9">
       
           
                    
                            <!-- /.list-group -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="list-group">
                                <div class="list-group">
                                 <table width="100%" class="table table-striped" border="0">
                                 <?php if ($o == 'location')  {?>
                                    <tr height="40">
                                        <td width="28%" align="right">Id</td>
                                        <td width="02%" align="center">:</td>
                                        <td width="88%">
                                        <table width="100%">
                                            <tr>
                                            <td width="30%">
                                            <div class="input-append date" >
                                                <input name="CODE"  class="form-control" placeholder="Code" id="CODE" >
                                            </div>
                                            </td>
                                            <td width="02%">&nbsp;</td>
                                            <td align="right">Type </td>
                                            <td align="center">:</td>
                                            <td width="30%"><SELECT name="STATUS" class="form-control">
                                            <OPTION VALUE="">Active</OPTION>
                                            <OPTION VALUE="P">Inactive</OPTION>
                                        </SELECT></td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>

                                    <tr height="40">
                                        <td align="right"> Name </td>
                                        <td align="center">:</td>
                                        <td><input type="text" class="form-control" id="NAME" name="NAME" value="" placeholder="Enter Name" value="" required ></td>
                                    </tr>

                                    <tr height="40">
                                        <td  align="right">Lat</td>
                                        <td width="02%" align="center">:</td>
                                        <td width="88%">
                                        <table width="100%">
                                            <tr>
                                            <td width="30%">
                                            
                                                <input name="LAT"  class="form-control" placeholder="latitude " id="LAT" >
                                            
                                            </td>
                                            <td width="02%">&nbsp;</td>
                                        <td align="right">Long </td>
                                        <td align="center">:</td>
                                            <td width="02%">&nbsp;</td>
                                            <td width="30%">
                                            
                                                <input name="LON"  class="form-control" placeholder="Longitude " id="LON" >
                                            
                                            </td>
                                            <td width="02%">&nbsp;</td>
                                        <td align="right">Alt </td>
                                        <td align="center">:</td>
                                            <td width="02%">&nbsp;</td>
                                            <td width="30%">
                                            
                                                <input name="ALT"  class="form-control" placeholder="Altitude " id="ALT" >
                                            
                                            </td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>

                                    <tr height="40">
                                        <td align="right"> Details </td>
                                        <td align="center">:</td>
                                        <td><input type="text" class="form-control" id="DETAILS" name="DETAILS" value="" placeholder="Enter Details" value="" required ></td>
                                    </tr>

                                <?php } ?>
                                 <?php if ($o == 'preference')  {?>
                                    <tr height="40">
                                        <td width="28%" align="right">Country</td>
                                        <td width="02%" align="center">:</td>
                                        <td width="88%">
                                        <table width="100%">
                                            <tr>
                                            <td width="30%">
                                            <div class="input-append date" >
                                                <input name="COUNTYR_CODE"  class="form-control" placeholder="Country Code" id="COUNTYR_CODE" >
                                            </div>
                                            </td>
                                            <td width="02%">&nbsp;</td>
                                            <td width="70%"><input name="COUNTYR_NAME" class="form-control" placeholder="Country Name" id="COUNTYR_NAME"  ></td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>

                                    <tr height="40">
                                        <td align="right">Location </td>
                                        <td align="center">:</td>
                                        <td><input type="text" class="form-control" id="LOCATION" name="LOCATION" value="" placeholder="Enter Location" value="" required ></td>
                                    </tr>

                                    <tr height="40">
                                        <td  align="right">Lat</td>
                                        <td width="02%" align="center">:</td>
                                        <td width="88%">
                                        <table width="100%">
                                            <tr>
                                            <td width="30%">
                                            
                                                <input name="LAT"  class="form-control" placeholder="latitude " id="LAT" >
                                            
                                            </td>
                                            <td width="02%">&nbsp;</td>
                                        <td align="right">Long </td>
                                        <td align="center">:</td>
                                            <td width="02%">&nbsp;</td>
                                            <td width="30%">
                                            
                                                <input name="LON"  class="form-control" placeholder="Longitude " id="LON" >
                                            
                                            </td>
                                            <td width="02%">&nbsp;</td>
                                        <td align="right">Alt </td>
                                        <td align="center">:</td>
                                            <td width="02%">&nbsp;</td>
                                            <td width="30%">
                                            
                                                <input name="ALT"  class="form-control" placeholder="Altitude " id="ALT" >
                                            
                                            </td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>
                                <?php } ?>

                                 <?php if ($o == 'preference')  {?>

                                     <tr height="40">
                                        <td align="right">Contact Person</td>
                                        <td width="02%" align="center">:</td>
                                        <td width="88%">
                                        <table width="100%">
                                            <tr>
                                            <td width="30%">
                                            <div class="input-append date" >
                                                <input name="FIRST_NAME"  class="form-control" placeholder="First Name" id="FIRST_NAME" >
                                            </div>
                                            </td>
                                            <td width="02%">&nbsp;</td>
                                            <td width="30%"><input name="MIDDLE_NAME" class="form-control" placeholder="Middle Name" id="MIDDLE_NAME"  ></td>
                                            <td width="02%">&nbsp;</td>
                                            <td width="40%"><input name="LAST_NAME" class="form-control" placeholder="Last Name" id="LAST_NAME"  ></td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>
                                        
                                   <tr height="40">
                                        <td align="right">Position </td>
                                        <td align="center">:</td>
                                        <td><input type="text" class="form-control" id="POSITION" name="POSITION" value="" placeholder="Enter Position" value="" required ></td>
                                    </tr>

                                    <tr height="40">
                                        <td align="right">Emergency Contact</td>
                                        <td width="02%" align="center">:</td>
                                        <td width="88%">
                                        <table width="100%">
                                            <tr>
                                            <td width="50%">
                                            <div class="input-append date" >
                                                <input name="CONTACT1"  class="form-control" placeholder="Contact No" id="CONTACT1" >
                                            </div>
                                            </td>
                                            <td width="02%">&nbsp;</td>
                                            <td width="50%"><input name="CONTACT2" class="form-control" placeholder="Contact No " id="CONTACT2"  ></td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>

                                     <tr height="40">
                                        <td align="right">Place Name </td>
                                        <td align="center">:</td>
                                        <td><input type="text" class="form-control" id="PLACE_NAME" name="PLACE_NAME" value="" placeholder="Enter Place Name" value="" required ></td>
                                    </tr>

                                    <tr height="40">
                                        <td align="right">Type </td>
                                        <td align="center">:</td>
                                        <td><SELECT name="STATUS" class="form-control">
                                            <OPTION VALUE="">Embassy</OPTION>
                                            <OPTION VALUE="P">Consultancy</OPTION>
                                            <OPTION VALUE="A">Representative</OPTION>
                                        </SELECT></td>
                                    </tr>

                                    <tr height="40">
                                        <td align="right">Email </td>
                                        <td align="center">:</td>
                                        <td><input type="text" class="form-control" id="EMAIL" name="EMAIL" value="" placeholder="Enter Email" value="" required ></td>
                                    </tr>

                                  

                                <?php } ?>

                                <?php if ($o == 'country_setup')  {?>
                                    <tr height="40">
                                        <td width="28%" align="right">Code</td>
                                        <td align="center">:</td>
                                        <td width="88%">
                                        <table width="100%">
                                            <tr>
                                            <td width="30%">
                                            <div class="input-append date" >
                                                <input class="form-control" type="hidden">
                                                <input type="hidden" id="CODE" size="10" name="CODE" value="<?php print $CODE; ?>" value="<?php print $CODE; ?>">
                                            </div>
                                            </td>
                                            <td width="02%">&nbsp;</td>
                                            <td align="right">Country Tel Code </td>
                                            <td width="02%" align="center">:</td>
                                            <td width="30%"><input name="TEL_CODE" class="form-control" placeholder="Country Tel Code " id="TEL_CODE"  ></td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>

                                    <tr height="40">
                                        <td align="right"><b></b> Name in English </td>
                                        <td align="center">:</td>
                                        <td><input type="text" class="form-control" id="EDESC" name="EDESC" value="" placeholder="Enter English Description" value="" required ></td>
                                        </tr>
                                        
                                    <tr height="40">
                                        <td align="right">Name in Nepali</td>
                                        <td align="center">:</td>
                                        <td><input type="text" class="form-control" id="NDESC" name="NDESC" value="" placeholder="नेपाली युनिकोडमा टाइप गर्नुहोस" value="" required ></td>
                                    </tr>

                                     <tr height="40">
                                        <td align="right">Continent</td>
                                        <td align="center">:</td>
                                        <td><input type="text" class="form-control" id="CONTINENT" name="CONTINENT" value="" placeholder="Continent" value="" required ></td>
                                    </tr>

                                    <tr height="40">
                                        <td align="right">Currency Name </td>
                                        <td width="02%" align="center">:</td>
                                        <td width="88%">
                                        <table width="100%">
                                            <tr>
                                            <td width="70%">
                                            <div class="input-append date" >
                                                <input name="CURRENCY_NAME"  class="form-control" placeholder="Currency Name" id="CURRENCY_NAME" >
                                            </div>
                                            </td>
                                            <td width="02%">&nbsp;</td>
                                            <td align="right">Symbol </td>
                                            <td width="02%" align="center">:</td>
                                            <td width="20%"><input name="SYMBOL" class="form-control" placeholder="Symbol " id="SYMBOL"  ></td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>

                                    <tr height="40">
                                      <td align="right">Flag Image</td>
                                      <td align="center">:</td>
                                      <td>
                                        <table width="100%">
                                          <tr>
                                            <td width="15%">
                                           
                                              <img src="../../GHT/image/logo.png" style="width:304px;height:220px;">
                                           
                                            </td>
                                          </tr>
                                          <tr>
                                            <td height="40%">
                                             <tr>
                                              <td><input type="file" name="IMAGE_PATH" id="IMAGE_PATH"> </td>
                                             </tr>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                  </tr>

                                <?php } ?>


                                 <?php if ($o == 'route_setup') {?>

                                     <tr height="40">
                                        <td width="28%" align="right">Code</td>
                                        <td width="02%" align="center">:</td>
                                        <td width="88%">
                                        <table width="100%">
                                            <tr>
                                            <td width="30%">
                                            <div class="input-append date" >
                                                <input name="CODE"  class="form-control" placeholder="Code" id="CODE" >
                                            </div>
                                            </td>
                                            <td width="02%">&nbsp;</td>
                                            <td align="right">Region </td>
                                            <td align="center">:</td>
                                            <td width="55%"><SELECT name="STATUS" class="form-control">
                                            <OPTION VALUE="">Far Western Development Region</OPTION>
                                            <OPTION VALUE="">Mid Western Development Region</OPTION>
                                            <OPTION VALUE="">Western Development Region</OPTION>
                                            <OPTION VALUE="">Central Development Region</OPTION>
                                            <OPTION VALUE="">Eastern Development Region</OPTION>OPTION>
                                        </SELECT></td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>

                                    <tr height="40">
                                       <td width="28%" align="right">Name</td>
                                        <td width="02%" align="center">:</td>
                                        <td><input type="text" class="form-control" id="NAME" name="NAME" value="" placeholder="Name" value="" required ></td>
                                    </tr>

                                    <tr height="40">
                                        <td align="right">Level </td>
                                        <td width="02%" align="center">:</td>
                                        <td width="88%">
                                        <table width="100%">
                                            <tr>
                                            <td width="40%">
                                            <div class="input-append date" >
                                               <SELECT name="STATUS" class="form-control">
                                            <OPTION VALUE="">Level 1</OPTION>
                                            <OPTION VALUE="P">Level 2</OPTION>
                                            <OPTION VALUE="A">Level 3</OPTION>
                                        </SELECT>
                                            </div>
                                            </td>
                                            <td width="02%">&nbsp;</td>
                                            <td align="right">No of Days </td>
                                            <td width="02%" align="center">:</td>
                                            <td width="20%"><input name="NO_DAYS" class="form-control" placeholder="No of Days " id="NO_DAYS"  ></td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>

                                    <tr height="40">
                                        <td align="right">Total Distance </td>
                                        <td width="02%" align="center">:</td>
                                        <td width="88%">
                                        <table width="100%">
                                            <tr>
                                            <td width="25%"><input name="TOTAL_DISTANCE" class="form-control" placeholder="Total Distance" id="TOTAL_DISTANCE"  ></td>
                                            <td width="02%">&nbsp;</td>
                                            <td align="right">Highest Point</td>
                                            <td width="02%" align="center">:</td>
                                            <td width="02%" align="center">&nbsp;</td>
                                            <td width="30%"><input name="HIGHEST_POINT" class="form-control" placeholder="Highest Point " id="HIGHEST_POINT"  ></td>
                                            <td width="02%">&nbsp;</td>
                                             <td width="20%"><SELECT name="STATUS" class="form-control">
                                            <OPTION VALUE="">Feet</OPTION>
                                            <OPTION VALUE="P">Meter</OPTION>
                                           
                                        </SELECT></td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>

                                    <tr height="2">
                                        <td align="right">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td><b>Starting Point</b></td>
                                    </tr>

                                    <tr height="40">
                                        <td  align="right">Lat</td>
                                        <td width="02%" align="center">:</td>
                                        <td width="88%">
                                        <table width="100%">
                                            <tr>
                                            <td width="30%">
                                            
                                                <input name="LAT"  class="form-control" placeholder="latitude " id="LAT" >
                                            
                                            </td>
                                            <td width="02%">&nbsp;</td>
                                        <td align="right">Long </td>
                                        <td align="center">:</td>
                                            <td width="02%">&nbsp;</td>
                                            <td width="30%">
                                            
                                                <input name="LON"  class="form-control" placeholder="Longitude " id="LON" >
                                            
                                            </td>
                                            <td width="02%">&nbsp;</td>
                                        <td align="right">Alt </td>
                                        <td align="center">:</td>
                                            <td width="02%">&nbsp;</td>
                                            <td width="30%">
                                            
                                                <input name="ALT"  class="form-control" placeholder="Altitude " id="ALT" >
                                            
                                            </td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>

                                    <tr height="2">
                                        <td align="right">&nbsp;</td>
                                        <td align="center">&nbsp;</td>
                                        <td><b>Ending Point</b></td>
                                    </tr>

                                    <tr height="40">
                                        <td  align="right">Lat</td>
                                        <td width="02%" align="center">:</td>
                                        <td width="88%">
                                        <table width="100%">
                                            <tr>
                                            <td width="30%">
                                            
                                                <input name="LAT"  class="form-control" placeholder="latitude " id="LAT" >
                                            
                                            </td>
                                            <td width="02%">&nbsp;</td>
                                        <td align="right">Long </td>
                                        <td align="center">:</td>
                                            <td width="02%">&nbsp;</td>
                                            <td width="30%">
                                            
                                                <input name="LON"  class="form-control" placeholder="Longitude " id="LON" >
                                            
                                            </td>
                                            <td width="02%">&nbsp;</td>
                                        <td align="right">Alt </td>
                                        <td align="center">:</td>
                                            <td width="02%">&nbsp;</td>
                                            <td width="30%">
                                            
                                                <input name="ALT"  class="form-control" placeholder="Altitude " id="ALT" >
                                            
                                            </td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>

                                    <tr height="40">
                                       <td width="28%" align="right">Speciality</td>
                                        <td width="02%" align="center">:</td>
                                        <td><input type="text" class="form-control" id="SPECIALITY" name="SPECIALITY" value="" placeholder="Speciality" value="" required ></td>
                                    </tr>

                                    <tr height="40">
                                       <td width="28%" align="right">Recources</td>
                                        <td width="02%" align="center">:</td>
                                        <td><input type="text" class="form-control" id="RECOURCES" name="RECOURCES" value="" placeholder="Recources" value="" required ></td>
                                    </tr>

                                    
                                 <?php } ?>

                                   <?php if ($o == 'user_registration')  {?>
                                    <tr height="40">
                                        <td width="28%" align="right">Id</td>
                                        <td width="02%" align="center">:</td>
                                        <td width="88%">
                                        <table width="100%">
                                            <tr>
                                            <td width="30%">
                                            <div class="input-append date" >
                                                <input name="CODE"  class="form-control" placeholder="Code" id="CODE" >
                                            </div>
                                            </td>
                                            <td width="02%">&nbsp;</td>
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
                                        <td><input type="text" class="form-control" id="NAME" name="NAME" value="" placeholder="Enter Name" value="" required ></td>
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



                                 <?php } ?>




                                    <tr height="50">
                                        <td align="right" valign="top">Remarks</td>
                                        <td align="center" valign="top">:</td>
                                        <td><textarea class="form-control" rows="1" id="REMARKS" name="REMARKS" ></textarea></td>
                                        </tr>
                                    <table class="table">
                                    <tr>
                                        <td width="50%">


                                    <input type="hidden" name="o" value="<?php print $o; ?>">
                                    <input type="hidden" name="mode" value="<?php print $MODE; ?>">
                                    <input type="hidden" name="operation" value="submit">
                                    <button type="submit" class="btn btn-primary" ><b>Save</b> </button>
                                    </form>

                                        </td>


                                        <td width="25%" align="right"> 

                                    <form role="form" method="post" action="definition.php">
                                    <input type="hidden" name="o" value="<?php print $o; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>

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

                                        </table>

                                </div>   
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                                   
                        <!-- /.panel-body -->
                <?php if ($o == 'route_setup')  {?>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="list-group">
                                <div class="list-group">
                                    <table width="100%" class="table table-striped" border="0">
                                 <thead>
                                  <tr>
                                    <th>Day</th>
                                    <th>Name</th>
                                    <th>Lat</th>
                                    <th>Long</th>
                                    <th>Alt</th>
                                    
                                  </tr>
                                <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>Kathmandu</td>
                                    <td >311.12</td>
                                    <td >987.32</td>
                                    <td >500</td>
                                </tr>
                                 <tr>
                                    <td>2</td>
                                    <td>Tatopani</td>
                                    <td >232.43</td>
                                    <td >3422.234</td>
                                    <td >300</td>
                                </tr>
                                </tbody>
                                    </table>

                                
                                </div>   
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>

                <?php } ?>

                <?php if ($o == 'location')  {?>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="list-group">
                                <div class="list-group">
                                    <table width="100%" class="table table-striped" border="0">
                                 <thead>
                                  <tr>
                                    <th>Id</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Lat</th>
                                    <th>Long</th>
                                    <th>Alt</th>
                                    <th>Status</th>
                                    
                                  </tr>
                                   <tr>
                                    <th width="10%">
                                       <input name="ID"  class="form-control" placeholder="Id" id="dp_date"  >
                                        </SELECT>
                                    </th>
                                    <th width="20%">
                                        <input name="TYPE"  class="form-control" placeholder="Type" id="dp_date"  >
                                    </th>
                                    <th width="20%">
                                        <input name="NAME"  class="form-control" placeholder="Name" id="dp_time" >

                                    </th > 
                                    <th width="10%">
                                        <input name="LAT"  class="form-control" placeholder="Lat" id="dp_time" >

                                    </th>
                                     <th width="10%">
                                        <input name="LONG"  class="form-control" placeholder="Long" id="dp_date"  >
                                    </th>
                                    <th width="10%">
                                        <input name="ALT"  class="form-control" placeholder="Alt" id="dp_time" >

                                    </th>
                                     <th width="20%">
                                        <SELECT name="STATUS" class="form-control">
                                            <OPTION VALUE="">Active</OPTION>
                                            <OPTION VALUE="P">Inactive</OPTION>
                                        </SELECT>
                                    </th>
                                    

                                    
                                  </tr>
                                <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>Active</td>
                                    <td>Kathmandu</td>
                                    <td >311.12</td>
                                    <td >987.32</td>
                                    <td >500</td>
                                    <td>Active</td>
                                </tr>
                                 <tr>
                                    <td>2</td>
                                    <td>Active</td>
                                    <td>Tatopani</td>
                                    <td >232.43</td>
                                    <td >3422.234</td>
                                    <td >300</td>
                                    <td>Active</td>
                                </tr>
                                </tbody>
                                    </table>

                                
                                </div>   
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>

                <?php } ?>

                <?php if ($o == 'user_registration')  {?>

                    <div class="panel panel-default">
                        <div class="panel-body">
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
                                   <tr>
                                    <th width="7%">
                                       <input name="ID"  class="form-control" placeholder="No" id="dp_date"  >
                                        </SELECT>
                                    </th>
                                    <th width="20%">
                                        <input name="NAME"  class="form-control" placeholder="Name" id="dp_time" >

                                    </th > 
                                    <th width="10%">
                                        <input name="EMAIL"  class="form-control" placeholder="Email" id="EMAIL" >

                                    </th>
                                     <th width="10%">
                                        <SELECT name="COUNTRY" class="form-control">
                                            <OPTION VALUE="">Nepal</OPTION>
                                            <OPTION VALUE="P">China</OPTION>
                                            <OPTION VALUE="P">Srilanka</OPTION>
                                            <OPTION VALUE="P">Bhutan</OPTION>
                                        </SELECT>
                                    </th>
                                   
                                    

                                    
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
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>

                <?php } ?>

                        
                       
                </div>
                

            <div class="col-lg-3">
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



</body>

</html>
