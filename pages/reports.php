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

     if ($o=='user_rador_embassy')                { $title = "User Rador for Embassy"; } 
     if ($o=='user_rador_police')               { $title = "User Rador for Police"; } 
     if ($o=='incident_report')               { $title = "Incident Report "; } 
     if ($o=='alert_map')               { $title = "Alert Map"; } 
     if ($o=='route_density')         { $title = "Route Density"; } 
    

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
    height: 300px;
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
            <legend><?php print $title; ?></legend>

           <br>
                <!-- /.col-lg-12 -->
        </div>
            <!-- /.row -->
            <!-- /.row -->
        <div class="row">

        <div class="col-lg-9">
                    <div class="panel panel-default">
                       
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                                    
                            <div id="wrapper">
                            <?php if (($o == 'user_rador_embassy') or ($o == 'user_rador_police') or ($o == 'incident_report') or ($o == 'alert_map') or ($o == 'route_density'))  {?>
                                <div id="map"></div>
                            <?php } ?>

                            <?php if ($o == 'registration_list')  {?>
                            <div class="list-group">
                            <legend>Emergency Contact</legend>

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
                                    
                                  </tr>
                                   <tr>
                                    <th width="7%">
                                       <input name="ID"  class="form-control" placeholder="Id" id="dp_date"  >
                                        </SELECT>
                                    </th>
                                    <th width="20%">
                                        <input name="NAME"  class="form-control" placeholder="Name" id="dp_time" >

                                    </th > 
                                     <th width="10%">
                                        <SELECT name="NATIONALITY" class="form-control">
                                            <OPTION VALUE="">Nepal</OPTION>
                                            <OPTION VALUE="P">China</OPTION>
                                            <OPTION VALUE="P">Srilanka</OPTION>
                                            <OPTION VALUE="P">Bhutan</OPTION>
                                        </SELECT>
                                    </th>
                                    <th width="10%">
                                        <input name="PP_NUMBER"  class="form-control" placeholder="PP No" id="PP_NUMBER" >

                                    </th> 
                                    <th width="10%">
                                        <input name="EMAIL"  class="form-control" placeholder="Email" id="EMAIL" >

                                    </th>
                                    <th width="10%">
                                        <SELECT name="NATIONALITY" class="form-control">
                                            <OPTION VALUE="">Active</OPTION>
                                            <OPTION VALUE="P">Inactive</OPTION>
                                           
                                        </SELECT>
                                    </th>
                                    
                                   
                                    

                                    
                                  </tr>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Tim Cook</td>
                                    <td >Japan</td>
                                    <td >001176545</td>
                                    <td >appleball@gmail.com</td>
                                    <td >Active</td>
                                </tr>
                                 <tr>
                                    <td>2</td>
                                    <td>Hitlar Khuresi</td>
                                    <td >Pakistan</td>
                                    <td >98766556</td>
                                    <td >hitkhuresi@yahoo.com</td>
                                    <td >Active</td>
                                </tr>
                                </tbody>
                                    </table>

                                
                        </div>
                        <!-- /.panel-body -->
                    </div>

                            <?php } ?>
                              </div>

                        </div>
                    </div>

                 
                            <!-- /.list-group -->
                    <div class="panel panel-default">
                        <div class="panel-body">                 

                                 <?php if ($o == 'user_rador_embassy')  {?>
                        

                                <div class="list-group">
                                    <table width="100%" class="table table-striped" border="0">
                                 <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Country</th>
                                    <th>Location</th>
                                    
                                  </tr>
                                   
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Tim Cook</td>
                                    <td >2016-04-12</td>
                                    <td >Japan</td>
                                    <td >Beni</td>
                                </tr>
                                 <tr>
                                    <td>2</td>
                                    <td>Hitlar Khuresi</td>
                                    <td >2016/08/21</td>
                                    <td >Pakistan</td>
                                    <td >Tatopani</td>
                                </tr>
                                </tbody>
                                    </table>

                                
                        </div>
                        <!-- /.panel-body -->
                   
                            <?php } ?>

 						<?php if ($o == 'user_rador_police')  {?>
                        

                                <div class="list-group">
                                    <table width="100%" class="table table-striped" border="0">
                                 <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Country</th>
                                    <th>Location</th>
                                    
                                  </tr>
                                   
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Tim Cook</td>
                                    <td >2016-04-12</td>
                                    <td >Japan</td>
                                    <td >Beni</td>
                                </tr>
                                 <tr>
                                    <td>2</td>
                                    <td>Hitlar Khuresi</td>
                                    <td >2016/08/21</td>
                                    <td >Pakistan</td>
                                    <td >Tatopani</td>
                                </tr>
                                </tbody>
                                    </table>

                                
                        </div>
                        <!-- /.panel-body -->
                   
                            <?php } ?>

                            <?php if ($o == 'incident_report')  {?>
                        

                                <div class="list-group">
                                    <table width="100%" class="table table-striped" border="0">
                                 <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Location</th>
                                    
                                  </tr>
                                   
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Tim Cook</td>
                                    <td >2016-04-12</td>
                                    <td >Warning</td>
                                    <td >Beni</td>
                                </tr>
                                 <tr>
                                    <td>2</td>
                                    <td>Hitlar Khuresi</td>
                                    <td >2016/08/21</td>
                                    <td >Alert</td>
                                    <td >Tatopani</td>
                                </tr>
                                </tbody>
                                    </table>

                                
                        </div>
                        <!-- /.panel-body -->
                   
                            <?php } ?>

                              <?php if ($o == 'alert_map')  {?>
                        

                                <div class="list-group">
                                    <table width="100%" class="table table-striped" border="0">
                                 <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                  </tr>
                                   
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>flood</td>
                                    <td >Warning</td>
                                </tr>
                                 <tr>
                                    <td>2</td>
                                    <td>Accident</td>
                                    <td >Alert</td>
                                </tr>
                                </tbody>
                                    </table>

                                
                        </div>
                        <!-- /.panel-body -->
                   
                            <?php } ?>

                             <?php if ($o == 'route_density')  {?>
                        

                                <div class="list-group">
                                    <table width="100%" class="table table-striped" border="0">
                                 <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>KM</th>
                                    <th>Days</th>
                                    
                                  </tr>
                                   
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Beni</td>
                                    <td >Tatopani</td>
                                    <td >100</td>
                                    <td >3</td>
                                </tr>
                                 <tr>
                                    <td>2</td>
                                    <td>Kathmandu</td>
                                    <td >Tatopani</td>
                                    <td >300</td>
                                    <td >3</td>
                                </tr>
                                </tbody>
                                    </table>

                                
                        </div>
                        <!-- /.panel-body -->
                   
                            <?php } ?>



                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                   
                        
                        <!-- /.panel-body -->
                       
                    </div>
                

            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Search Option </b> 
                    </div>                    
                        <div class="pull-right">
                            <div class="panel-body">
                                <label> Date within</label>
                                    <table width="100%">
                                    <tr>
                                        <td width="50%">
                                        <div class="input-append date" >
                                            <input name="FROM_DATE"  class="form-control" placeholder="From Date" id="dp_from_date" style="text-align:center" >
                                        </div>
                                        </td>
                                        <td width="02%">&nbsp;</td>
                                        <td width="50%"><input name="TO_DATE" class="form-control" placeholder="To Date" id="dp_to_date" style="text-align:center" ></td>
                                    </tr>
                                    </table>
                                    <br>                                

                                <label> Route</label>
                                    <table width="100%">
                                        <SELECT name="STATUS" class="form-control">
                                            <OPTION VALUE="">Kathmandu to Pokhara</OPTION>
                                            <OPTION VALUE="P">Beni to Tatopani</OPTION>
                                            <OPTION VALUE="A">Jomsom to Muktinath</OPTION>
                                        </SELECT>
                                    </table>
                                    <br>

                                <label> Place</label>
                                    <table width="100%">
                                        <SELECT name="STATUS" class="form-control">
                                            <OPTION VALUE="">Kathmandu</OPTION>
                                            <OPTION VALUE="P">Pokhara</OPTION>
                                            <OPTION VALUE="A">Jomsom</OPTION>
                                            <OPTION VALUE="A">Bara</OPTION>
                                            <OPTION VALUE="A">Muktinath</OPTION>
                                            <OPTION VALUE="A">Chitwan</OPTION>
                                            <OPTION VALUE="A">Putan</OPTION>
                                        </SELECT>
                                    </table>
                                    <br>
                            <?php if (($o == 'incident_report') or ($o == 'alert_map')) {?>

                                     <label> Type</label>
                                    <table width="100%">
                                        <SELECT name="STATUS" class="form-control">
                                            <OPTION VALUE="">Information</OPTION>
                                            <OPTION VALUE="P">Warning</OPTION>
                                            <OPTION VALUE="A">Alert</OPTION>
                                           
                                        </SELECT>
                                    </table>
                                    <br>
                            <?php } ?>
                            <?php if (($o != 'incident_report') and ($o != 'alert_map')) {?>

                                <label> Country</label>
                                    <table width="100%">
                                        <SELECT name="STATUS" class="form-control">
                                            <OPTION VALUE="">Nepal</OPTION>
                                            <OPTION VALUE="P">Pakistan</OPTION>
                                            <OPTION VALUE="A">Srilanka</OPTION>
                                        </SELECT>
                                    </table>
                                    <br>
                            <?php } ?>

                                  

                                <label> Name </label>
                                    <table width="100%">
                                    <tr>
                                        <td >
                                       <input name="NAME" class="form-control" placeholder="Name" id="NAME" style="text-align:" ></td>
                                    </tr>
                                    </table>
                                    <br>                                

                              

                                
                            </div>
                        </div>

                        <div class="panel-body" style="text-align:right">
                            <input type="hidden" name="o" value="<?php echo $o ?>">
                            <input type="hidden" name="search" value="SEARCH">
                                <button type="submit" class="btn btn-primary">Search </button>
                        </div>
  
                       
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        </div>
                        <!-- /.panel-body -->
                    </div>
                   
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

