<?php include("main.php"); ?>
<?php include("menu.php"); ?>

 <?php

     $o=$_REQUEST["o"];
     if (strlen($o)==0) { $o=$_POST["o"]; }
     if (strlen($o)==0) { exit; }

     if ($o=='area')                { $title = "Area"; } 
     if ($o=='route')               { $title = "Route "; } 
     if ($o=='route_point')         { $title = "Route Point"; } 
     if ($o=='preference')          { $title = "Preference Setup"; } 
     if ($o=='routemaker')        { $title = "Route Maker"; } 


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
            <legend><?php print $title; ?> Info</legend>

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
                            <div class="list-group">
                                <div class="list-group">
                                    
                                    <div id="wrapper">
                                 <?php if ($o == 'routemaker')  {?>

                                        <div id="map"></div>
                                    <?php } ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                            <!-- /.list-group -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="list-group">
                                <div class="list-group">
                                 <table width="100%" class="table table-striped" border="0">

                                 <thead>
                                 <?php if ($o == 'routemaker')  {?>
                                  <tr>
                                    <th>Route</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Place</th>
                                    <th>Country</th>
                                    
                                  </tr>

                                  <tr>
                                    <th width="30%">
                                        <SELECT name="STATUS" class="form-control">
                                            <OPTION VALUE="">Kathmandu to Pokhara</OPTION>
                                            <OPTION VALUE="P">Beni to Tatopani</OPTION>
                                            <OPTION VALUE="A">Jomsom to Muktinath</OPTION>
                                        </SELECT>
                                    </th>
                                    <th>
                                        <input name="DATE"  class="form-control" placeholder="Date" id="dp_date"  >
                                    </th>
                                    <th>
                                        <input name="TIME"  class="form-control" placeholder="Time" id="dp_time" >

                                    </th>
                                    <th width="20%">
                                        <SELECT name="STATUS" class="form-control">
                                            <OPTION VALUE="">Kathmandu</OPTION>
                                            <OPTION VALUE="P">Pokhara</OPTION>
                                            <OPTION VALUE="A">Jomsom</OPTION>
                                            <OPTION VALUE="A">Bara</OPTION>
                                            <OPTION VALUE="A">Muktinath</OPTION>
                                            <OPTION VALUE="A">Chitwan</OPTION>
                                            <OPTION VALUE="A">Putan</OPTION>
                                        </SELECT>
                                    </th>
                                    <th width="15%">
                                        <SELECT name="STATUS" class="form-control">
                                            <OPTION VALUE="">Nepal</OPTION>
                                            <OPTION VALUE="P">Pakistan</OPTION>
                                            <OPTION VALUE="A">Srilanka</OPTION>
                                        </SELECT>

                                    </th>
                                    
                                  </tr>
                                    <?php } ?>
                                </thead>
                                <tbody>
                                 <?php if ($o == 'routemaker')  {?>
                                <tr>
                                    <td>Kathmandu to Pokhara</td>
                                    <td>2016-06-12</td>
                                    <td >6:40</td>
                                    <td >Pokhara</td>
                                    <td >Nepal</td>
                                </tr>
                                 <tr>
                                    <td>Beni to Tatopani</td>
                                    <td>2016-03-19</td>
                                    <td >5:30</td>
                                    <td >Beni</td>
                                    <td >Nepal</td>
                                </tr>
                                    <?php } ?>
                                </tbody>
                                </table>

                                </div>   
                            </div>
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
                                <?php if ($o == 'routemaker')  {?>
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

                                <label> Country</label>
                                    <table width="100%">
                                        <SELECT name="STATUS" class="form-control">
                                            <OPTION VALUE="">Nepal</OPTION>
                                            <OPTION VALUE="P">Pakistan</OPTION>
                                            <OPTION VALUE="A">Srilanka</OPTION>
                                        </SELECT>
                                    </table>
                                    <?php } ?>
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
