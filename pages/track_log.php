<?php include("main.php"); ?>
<?php include("menu.php"); ?>

<HTML>
<HEAD>

<style>
  #map {
    width: 100%;
    height: 380px;
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


</HEAD>
<BODY>
 <div id="page-wrapper">
    <div class="row">
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
                        <div id="map"></div>
                        
                    </div>

 

                    </div>
                </div>
                </div>
            </div>
                           


                       
        </div>
                

            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Field </b> 
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
