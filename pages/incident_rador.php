<?php include("main.php"); ?>
<?php include("menu.php"); ?>

 

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
    height: 400px;
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
            <legend>Incident Rador Info</legend>

           <br>
                <!-- /.col-lg-12 -->
        </div>
            <!-- /.row -->
            <!-- /.row -->

        <div class="col-lg-12">

                     <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#detail" aria-controls="home" role="tab" data-toggle="tab">List View</a></li>
                <li role="presentation"><a href="#map_view" aria-controls="map_view" role="tab" data-toggle="tab">Map View</a></li>
               
              </ul>
             <!-- Tab panes -->
          <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="detail">
                <!-- /.list-group -->
                        <div class="panel-body">
                            <div class="list-group">
                                <div class="list-group">
                                 <table width="100%" class="table table-striped" border="0">

                                 <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Route</th>
                                    <th>Point</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Publish</th>
                                    <th>Deactivate Type</th>
                                    
                                  </tr>

                                 <tr>
                                    <th width="7%">
                                       <input name="DATE"  class="form-control" placeholder="No" id="dp_date"  >
                                    </th>
                                    <th width="13%">
                                        <input name="DATE"  class="form-control" placeholder="Date" id="dp_date"  >
                                    </th>
                                    <th width="9%">
                                        <input name="TIME"  class="form-control" placeholder="Time" id="dp_time" >

                                    </th width="9%"> 
                                    <th>
                                        <input name="TIME"  class="form-control" placeholder="Route" id="dp_time" >

                                    </th>
                                     <th width="9%">
                                        <input name="DATE"  class="form-control" placeholder="Point" id="dp_date"  >
                                    </th>
                                    <th width="20%">
                                        <input name="TIME"  class="form-control" placeholder="Description" id="dp_time" >

                                    </th>
                                     <th>
                                        <input name="DATE"  class="form-control" placeholder="Image" id="dp_date"  >
                                    </th>
                                    <th>
                                        <input name="TIME"  class="form-control" placeholder="Publish" id="dp_time" >

                                    </th>
                                     <th>
                                        <input name="DATE"  class="form-control" placeholder="Type" id="dp_date"  >
                                    </th>
                                   

                                    
                                  </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>2016-06-12</td>
                                    <td >6:40</td>
                                    <td >Pokhara</td>
                                    <td >Nepal</td>
                                </tr>
                                 <tr>
                                    <td>02</td>
                                    <td>2016-03-19</td>
                                    <td >5:30</td>
                                    <td >Beni</td>
                                    <td >Nepal</td>
                                </tr>
                                </tbody>
                                </table>

                                </div>   
                            </div>
                        </div>
                        <!-- /.panel-body -->
                 
                    <!-- /.panel -->
                   
                </div>
                <div role="tabpanel" class="tab-pane" id="map_view">
                    <div class="container" style="padding:5px;width:100%">

                        <div class="panel-body">
                            <div class="list-group">
                                <div class="list-group">
                                    
                                    <div id="wrapper">

                                        <div id="map"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
                        
                        <!-- /.panel-body -->
                       
                

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



</body>

</html>
