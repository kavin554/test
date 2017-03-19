<?php 
    session_start();
    if(!isset($_SESSION['UID'])){
    header('location:../index.php');
    }
?>

<?php include("main.php"); ?>
<?php include("menu.php"); ?>

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
<TITLE>Preference Setup </TITLE>
</HEAD>
<BODY>
    <div id="page-wrapper">
 <div class="row">
 
                    
  <div class="col-md-9">
  <div class="panel panel-default">
                        <div class="panel-body">



  

  <div>
  
  <ul class="nav nav-tabs" role="tablist">
  
    <li role="presentation" class="active"><a href="#detail" aria-controls="home" role="tab" data-toggle="tab">Preference Setup Form </a></li>
    <li role="presentation"><a href="#list" aria-controls="home" role="tab" data-toggle="tab">Preference Setup List</a></li>
   
    
  
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="detail">

    <form role="form" method="post" action="transactions.php">

    


        <div class="container" style="padding:5px;width:100%">

        <div class="table-responsive">
   
    <table width="98%">

        

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
                                    </SELECT>
                                </td>
                            </tr>

                            <tr height="40">
                                <td align="right">Email </td>
                                <td align="center">:</td>
                                <td><input type="text" class="form-control" id="EMAIL" name="EMAIL" value="" placeholder="Enter Email" value="" required ></td>
                            </tr>





     <tr height="50">
                                <td align="right" valign="top">Remarks</td>
                                <td align="center" valign="top">:</td>
                                <td><textarea class="form-control" rows="1" id="REMARKS" name="REMARKS" ></textarea></td>
                            </tr>
                            </table>

                        <table class="table">
                            <tr height="40">
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

    </div> 
        </div>
       


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
        <td>01</td>
        <td>Tim Cook</td>
        <td >appleball@gmail.com</td>
        <td >Japan</td>
        <td align="right"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/edit.png"></a></td>
                <td align="right" width="2%"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/delete.png"></a></td>
      </tr>

      <tr>
        <td>2</td>
        <td>Hitlar Khuresi</td>
        <td >hitkhuresi@yahoo.com</td>
        <td >Pakistan</td>
        <td align="right"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/edit.png"></a></td>
                <td align="right" width="2%"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/delete.png"></a></td>
      </tr>

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
                <th>Contact</th>
                <th>Email</th>
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
                    <input name="Contact"  class="form-control" placeholder="Contact" id="PP_NUMBER" >

                </td> 
                <td width="15%">
                    <input name="EMAIL"  class="form-control" placeholder="Email" id="EMAIL" >

                </td>
               
                <td width="5%"><button type="submit" class="btn btn-success">Save</button></td>
                                    <td align="center">&nbsp;</td>
              </tr>
            <tbody>
            <tr>
                <td>1</td>
                <td>Tim Cook</td>
                <td >Japan</td>
                <td >98787767</td>
                <td >appleball@gmail.com</td>
                <td align="right"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/edit.png"></a></td>
                <td align="right" width="2%"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/delete.png"></a></td>
            </tr>
             <tr>
                <td>2</td>
                <td>Hitlar Khuresi</td>
                <td >Pakistan</td>
                <td >98766556</td>
                <td >hitkhuresi@yahoo.com</td>
                <td align="right"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/edit.png"></a></td>
                <td align="right" width="2%"><a href="transactions.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/delete.png"></a></td>
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

  



  
    </div></div></div></div></thead></table></div>

      <div class="col-lg-3">
                <div class="panel panel-default">
                       
                        <!-- /.panel-heading -->

                                    

                <div ><img src="../../GHT/image/nepalflag.jpg" style="width:100%;height:100%;"></div>
            </div>

             <div class="panel panel-default">       
                        <!-- /.panel-heading -->
            <div id="wrapper">
                <div id="map"></div>
            </div>
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








  </div>




  </div>
</div>

</BODY>
</HTML>