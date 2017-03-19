<?php
session_start();
if (!isset($_SESSION['UID'])) {
    header('location:../index.php');
}
?>

<?php include("main.php"); ?>
<?php include("menu.php"); ?>

<?php

$o = $_REQUEST["o"];
if (strlen($o) == 0) {
    $o = $_POST["o"];
}
if (strlen($o) == 0) {
    exit;
}

$title = null;

if ($o == 'country') {
    $title = "Country";
}
if ($o == 'embassy') {
    $title = "Embassy Contact";
}
if ($o == 'location_type') {
    $title = "Place Type";
}
if ($o == 'location') {
    $title = "Location";
}
if ($o == 'route') {
    $title = "Route ";
}
if ($o == 'weather_station') {
    $title = "Weather Station";
}
if ($o == 'incident_type') {
    $title = "Incident Type";
}
if ($o == 'notification_type') {
    $title = "Notification ";
}

?>


<?php


$OPERATION = (isset($_POST['operation']) ? $_POST['operation'] : null);
$SUBMIT = (isset($_POST['mode']) ? $_POST['mode'] : null);
$MY_DATE = date('Y-m-d H:i:s');


if ($OPERATION == 'submit') {


    $CODE = (isset($_POST['CODE']) ? $_POST['CODE'] : null);
    $NAME = (isset($_POST['NAME']) ? $_POST['NAME'] : null);
    $REMARKS = (isset($_POST['REMARKS']) ? $_POST['REMARKS'] : null);
    $FLAG_IMAGE = (isset($_POST['FLAG_IMAGE']) ? $_POST['FLAG_IMAGE'] : null);
    $REMARKS = (isset($_POST['REMARKS']) ? $_POST['REMARKS'] : null);
    $CREATED_BY = (isset($_POST['CREATED_BY']) ? $_POST['CREATED_BY'] : null);
    $CREATED_DATE = (isset($_POST['CREATED_DATE']) ? $_POST['CREATED_DATE'] : null);
    $MODIFIED_BY = (isset($_POST['MODIFIED_BY']) ? $_POST['MODIFIED_BY'] : null);
    $MODIFIED_DATE = (isset($_POST['MODIFIED_DATE']) ? $_POST['MODIFIED_DATE'] : null);


    if ($o == 'country') {

        $COUNTRY_TEL_CODE = (isset($_POST['COUNTRY_TEL_CODE']) ? $_POST['COUNTRY_TEL_CODE'] : null);
        $CONTINENT = (isset($_POST['CONTINENT']) ? $_POST['CONTINENT'] : null);
        $CURRENCY_NAME = (isset($_POST['CURRENCY_NAME']) ? $_POST['CURRENCY_NAME'] : null);
        $SYMBOLE = (isset($_POST['SYMBOLE']) ? $_POST['SYMBOLE'] : null);


        if ($SUBMIT == 'edit') {
            $ACTION = "UPDATE country SET
        COUNTRY_TEL_CODE ='" . $COUNTRY_TEL_CODE . "',
        COUNTRY_NAME ='" . $NAME . "',
        CONTINENT ='" . $CONTINENT . "',
        CURRENCY_NAME ='" . $CURRENCY_NAME . "',
        SYMBOLE ='" . $SYMBOLE . "',
        FLAG_IMAGE ='" . $FLAG_IMAGE . "',
        REMARKS ='" . $REMARKS . "',
        CREATED_BY ='" . $GLOBAL_UID . "',
        CREATED_DATE = '" . $MY_DATE . "'
        MODIFIED_BY ='" . $GLOBAL_UID . "',
        MODIFIED_DATE = '" . $MY_DATE . "'
        WHERE COUNTRY_ID = '" . $CODE . "'";

            $rsUPDATE = mysqli_query($ACTION);
        }


        if ($SUBMIT == 'new') {
            $ACTION = "INSERT INTO country(
         COUNTRY_ID,
         COUNTRY_TEL_CODE,
         COUNTRY_NAME,
         CONTINENT,
         CURRENCY_NAME,
         COUNTRY_CURRENCY_SYMBOL,
         SYMBOLE,
         FLAG_IMAGE,
         REMARKS,
         CREATED_BY,
         CREATED_DATE,
         MODIFIED_BY,
         MODIFIED_DATE)
      VALUES('" . $CODE . "',
      '" . $COUNTRY_TEL_CODE . "',
      '" . $NAME . "',
      '" . $CONTINENT . "',
      '" . $CURRENCY_NAME . "',
      '" . $COUNTRY_CURRENCY_SYMBOL . "',
      '" . $SYMBOLE . "',
      '" . $FLAG_IMAGE . "',
      '" . $REMARKS . "',
      '" . $GLOBAL_UID . "',
      '" . $MY_DATE . "',
      '" . $GLOBAL_UID . "',
      '" . $MY_DATE . "')";

            $rsINSERT = mysqli_query($ACTION);

        }

    }

    if ($o == 'embassy') {

        if ($SUBMIT == 'edit') {
            $ACTION = "UPDATE embassy SET
        E_NAME ='" . $NAME . "',
        CONTACT_PERSON ='" . $CONTACT_PERSON . "',
        POSITION ='" . $POSITION . "',
        MOBILE_NO ='" . $MOBILE_NO . "',
        COUNTRY_ID ='" . $COUNTRY_ID . "',
        REMARKS ='" . $REMARKS . "',


      WHERE E_ID = '" . $CODE . "'";

            $rsUPDATE = mysqli_query($ACTION);

        }


        if ($SUBMIT == 'new') {
            $ACTION = "INSERT INTO embassy(
         E_ID,
         E_NAME,
         CONTACT_PERSON,
         POSITION,
         MOBILE_NO,
         REMARKS,
         COUNTRY_ID)
      VALUES('" . $CODE . "',
      '" . $NAME . "',
      '" . $CONTACT_PERSON . "',
      '" . $POSITION . "',
      '" . $MOBILE_NO . "',
      '" . $REMARKS . "',
      '" . $COUNTRY_ID . "')";

            $rsINSERT = mysqli_query($ACTION);

        }

    }

    if ($o == 'location_type') {

        if ($SUBMIT == 'edit') {
            $ACTION = "UPDATE place_type SET
        PL_NAME ='" . $NAME . "',
        PL_IMAGE ='" . $PL_IMAGE . "',
        REMARKS ='" . $REMARKS . "',
        CREATED_BY ='" . $GLOBAL_UID . "',
        CREATED_DATE = '" . $MY_DATE . "'
        MODIFIED_BY ='" . $GLOBAL_UID . "',
        MODIFIED_DATE = '" . $MY_DATE . "'

      WHERE PL_ID = '" . $CODE . "'";

            $rsUPDATE = mysqli_query($ACTION);

        }


        if ($SUBMIT == 'new') {
            $ACTION = "INSERT INTO place_type(
         PL_ID,
         PL_NAME,
         PL_IMAGE,
         REMARKS,
         CREATED_BY,
         CREATED_DATE,
         MODIFIED_BY,
         MODIFIED_DATE)
      VALUES('" . $CODE . "',
      '" . $NAME . "',
      '" . $POSITION . "',
      '" . $PL_IMAGE . "',
      '" . $REMARKS . "',
      '" . $CREATED_BY . "',
      '" . $CREATED_DATE . "',
      '" . $MODIFIED_BY . "',
      '" . $MODIFIED_DATE . "')";

            $rsINSERT = mysqli_query($ACTION);

        }

    }

    if ($o == 'setup_location') {

        if ($SUBMIT == 'edit') {
            $ACTION = "UPDATE setup_location SET
       SL_NAME ='" . $NAME . "',
       PL_ID ='" . $PL_ID . "',
       SL_LATITUDE ='" . $SL_LATITUDE . "',
       SL_LONGITUDE ='" . $SL_LONGITUDE . "',
       SL_ALTITUDE ='" . $SL_ALTITUDE . "',
       SL_DESC ='" . $SL_DESC . "',
       REMARKS ='" . $REMARKS . "',
       CREATED_BY ='" . $GLOBAL_UID . "',
       CREATED_DATE = '" . $MY_DATE . "'
       MODIFIED_BY ='" . $GLOBAL_UID . "',
       MODIFIED_DATE = '" . $MY_DATE . "'

     WHERE SL_ID = '" . $CODE . "'";

            $rsUPDATE = mysqli_query($ACTION);

        }


        if ($SUBMIT == 'new') {
            $ACTION = "INSERT INTO place_type(
        SL_ID,
        SL_NAME,
        LT_ID,
        SL_LATITUDE,
        SL_LONGITUDE,
        SL_ALTITUDE,
        SL_DESC,
        REMARKS,
        CREATED_BY,
        CREATED_DATE,
        MODIFIED_BY,
        MODIFIED_DATE)
     VALUES('" . $CODE . "',
     '" . $NAME . "',
     '" . $LT_ID . "',
     '" . $SL_LATITUDE . "',
     '" . $SL_LONGITUDE . "',
     '" . $SL_ALTITUDE . "',
     '" . $SL_DESC . "',
     '" . $REMARKS . "',
     '" . $CREATED_BY . "',
     '" . $CREATED_DATE . "',
     '" . $MODIFIED_BY . "',
     '" . $MODIFIED_DATE . "')";

            $rsINSERT = mysqli_query($ACTION);

        }

    }


    if ($o == 'incident_type') {

        if ($SUBMIT == 'edit') {
            $ACTION = "UPDATE incident_type SET
        INCIDENT_NAME ='" . $NAME . "',
        TYPE ='" . $TYPE . "',
        IMAGE ='" . $IMAGE . "',
        REMARKS ='" . $REMARKS . "',
        CREATED_BY ='" . $GLOBAL_UID . "',
        CREATED_DATE = '" . $MY_DATE . "'
        MODIFIED_BY ='" . $GLOBAL_UID . "',
        MODIFIED_DATE = '" . $MY_DATE . "'
      WHERE INCIDENT_ID = '" . $CODE . "'";

            $rsUPDATE = mysqli_query($ACTION);

        }


        if ($SUBMIT == 'new') {
            $ACTION = "INSERT INTO incident_type(
         INCIDENT_ID,
         INCIDENT_NAME,
         TYPE,
         IMAGE
         REMARKS,
         CREATED_BY,
         CREATED_DATE,
         MODIFIED_BY,
         MODIFIED_DATE)
      VALUES('" . $CODE . "',
      '" . $NAME . "',
      '" . $TYPE . "',
      '" . $IMAGE . "',
      '" . $REMARKS . "',
      '" . $GLOBAL_UID . "',
      '" . $MY_DATE . "',
      '" . $GLOBAL_UID . "',
      '" . $MY_DATE . "')";

            $rsINSERT = mysqli_query($ACTION);

        }

    }


    if ($o == 'notification_type') {

        if ($SUBMIT == 'edit') {
            $ACTION = "UPDATE push_notification SET
        PN_TITLE ='" . $NAME . "',
        PN_DATE ='" . $PN_DATE . "',
        IR_ID ='" . $IR_ID . "',
        PN_DESC ='" . $PN_DESC . "',
        REMARKS ='" . $REMARKS . "',
        CREATED_BY ='" . $GLOBAL_UID . "',
        CREATED_DATE = '" . $MY_DATE . "'
        MODIFIED_BY ='" . $GLOBAL_UID . "',
        MODIFIED_DATE = '" . $MY_DATE . "'
      WHERE PN_ID = '" . $CODE . "'";

            $rsUPDATE = mysqli_query($ACTION);

        }


        if ($SUBMIT == 'new') {
            $ACTION = "INSERT INTO push_notification(
         PN_ID,
         PN_TITLE,
         PN_DATE,
         IR_ID,
         PN_DESC,
         REMARKS,
         CREATED_BY,
         CREATED_DATE,
         MODIFIED_BY,
         MODIFIED_DATE)
      VALUES('" . $CODE . "',
      '" . $NAME . "',
      '" . $PN_DATE . "',
      '" . $IR_ID . "',
      '" . $PN_DESC . "',
      '" . $REMARKS . "',
      '" . $GLOBAL_UID . "',
      '" . $MY_DATE . "',
      '" . $GLOBAL_UID . "',
      '" . $MY_DATE . "')";

            $rsINSERT = mysqli_query($ACTION);

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

    .switch input {
        display: none;
    }

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
    $(document).ready(function () {


        function change_data() {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("rdata").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "route_data.php", true);
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

                radius = new google.maps.Circle({
                    map: map,
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

                map.panTo(new google.maps.LatLng(lat, lng));

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


        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">


                    <div>

                        <ul class="nav nav-tabs" role="tablist">

                            <li role="presentation" class="active"><a href="#detail" aria-controls="home" role="tab"
                                                                      data-toggle="tab"> <?php if ($o == 'notification_type') { ?> Alert <?php } ?> <?php print $title; ?>
                                    Form </a></li>
                            <li role="presentation"><a href="#list" aria-controls="home" role="tab"
                                                       data-toggle="tab">  <?php print $title; ?> List </a></li>
                            <?php if ($o == 'route') { ?>
                                <li role="presentation"><a href="#maker" aria-controls="home" role="tab"
                                                           data-toggle="tab"><?php print $title; ?> Maker</a></li>
                                <li role="presentation"><a href="#itetaries" aria-controls="home" role="tab"
                                                           data-toggle="tab"> <?php print $title; ?> Itetaries</a></li>
                                <li role="presentation"><a href="#stops" aria-controls="home" role="tab"
                                                           data-toggle="tab"> Stops Setup</a></li>
                            <?php } ?>

                            <?php if (($o == 'route') or ($o == 'weather_station') or ($o == 'location')) { ?>


                                <li role="presentation"><a href="#map" aria-controls="home" role="tab"
                                                           data-toggle="tab"> Map</a></li>
                            <?php } ?>

                            <?php if ($o == 'notification_type') { ?>
                                <li role="presentation"><a href="#pushnotification" aria-controls="home" role="tab"
                                                           data-toggle="tab">Push <?php print $title; ?> Form</a></li>
                            <?php } ?>


                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="detail">

                                <form role="form" method="post" action="general_setup.php">

                                    <?php


                                    error_reporting(0);
                                    $ID = $_REQUEST["id"];
                                    if (strlen($ID) == 0) {
                                        $ID = '1001';
                                    }

                                    $MODE = $_REQUEST["mode"];

                                    if (strlen($MODE) == 0) {
                                        $DISABLED = "DISABLED";
                                        $READONLY = "READONLY";
                                    }
                                    if ($MODE == 'view') {
                                        $DISABLED = "DISABLED";
                                        $READONLY = "READONLY";
                                    }
                                    if ($MODE == 'new') {
                                        $DISABLED = "ENABLED";
                                        $READONLY = "";
                                    }
                                    if ($MODE == 'edit') {
                                        $DISABLED = "ENABLED";
                                        $READONLY = "";
                                    }

                                    error_reporting(1);


                                    if ($MODE == 'new') {

                                        $CODE = "";
                                        $NAME = "";
                                        $REMARKS = "";

                                        $DELETE_DISABLED = " DISABLED";


                                    } else {

                                        if ($o == 'country') {

                                            $qry = "SELECT * FROM country WHERE COUNTRY_ID = '" . $ID . "'";

                                            $rss = mysqli_query($qry);

                                            while ($row = mysqli_fetch_array($rss)) {
                                                $CODE = $row['COUNTRY_ID'];
                                                $NAME = $row['COUNTRY_NAME'];
                                                $COUNTRY_TEL_CODE = $row['COUNTRY_TEL_CODE'];
                                                $CONTINENT = $row['CONTINENT'];
                                                $CURRENCY_NAME = $row['CURRENCY_NAME'];
                                                $SYMBOLE = $row['SYMBOLE'];
                                                $FLAG_IMAGE = $row['FLAG_IMAGE'];
                                                $REMARKS = $row['REMARKS'];
                                                $CREATED_BY = $row['GLOBAL_UID'];
                                                $CREATED_DATE = $row['MY_DATE'];
                                                $MODIFIED_BY = $row['GLOBAL_UID'];
                                                $MODIFIED_DATE = $row['MY_DATE'];
                                            }
                                        }

                                        if ($o == 'embassy') {

                                            $qry = "SELECT * FROM embassy_contact WHERE EC_ID = '" . $ID . "'";

                                            $rss = mysqli_query($qry);

                                            while ($row = mysqli_fetch_array($rss)) {
                                                $CODE = $row['EC_ID'];
                                                $COUNTRY_ID = $row['COUNTRY_ID'];
                                                $NAME = $row['E_NAME'];
                                                $CONTACT_PERSON = $row['CONTACT_PERSON'];
                                                $POSITION = $row['POSITION'];
                                                $MOBILE_NO = $row['MOBILE_NO'];
                                                $REMARKS = $row['REMARKS'];
                                            }
                                        }

                                        if ($o == 'location_type') {

                                            $qry = "SELECT * FROM place_type WHERE PL_ID = '" . $ID . "'";

                                            $rss = mysqli_query($qry);

                                            while ($row = mysqli_fetch_array($rss)) {
                                                $CODE = $row['PL_ID'];
                                                $NAME = $row['PL_NAME'];
                                                $PL_IMAGE = $row['PL_IMAGE'];
                                                $REMARKS = $row['REMARKS'];
                                                $CREATED_BY = $row['GLOBAL_UID'];
                                                $CREATED_DATE = $row['MY_DATE'];
                                                $MODIFIED_BY = $row['GLOBAL_UID'];
                                                $MODIFIED_DATE = $row['MY_DATE'];

                                            }
                                        }

                                        if ($o == 'location') {

                                            $qry = "SELECT * FROM place_type WHERE SL_ID = '" . $ID . "'";

                                            $rss = mysqli_query($qry);

                                            while ($row = mysqli_fetch_array($rss)) {
                                                $CODE = $row['SL_ID'];
                                                $PL_ID = $row['PL_ID'];
                                                $NAME = $row['SL_NAME'];
                                                $SL_LATITUDE = $row['SL_LATITUDE'];
                                                $SL_LONGITUDE = $row['SL_LONGITUDE'];
                                                $SL_ALTITUDE = $row['SL_ALTITUDE'];
                                                $SL_DESC = $row['SL_DESC'];
                                                $REMARKS = $row['REMARKS'];
                                                $CREATED_BY = $row['GLOBAL_UID'];
                                                $CREATED_DATE = $row['MY_DATE'];
                                                $MODIFIED_BY = $row['GLOBAL_UID'];
                                                $MODIFIED_DATE = $row['MY_DATE'];

                                            }
                                        }


                                        if ($o == 'incident_type') {

                                            $qry = "SELECT * FROM incident_type WHERE INCIDENT_ID = '" . $ID . "'";

                                            $rss = mysqli_query($qry);

                                            while ($row = mysqli_fetch_array($rss)) {
                                                $CODE = $row['INCIDENT_ID'];
                                                $NAME = $row['INCIDENT_NAME'];
                                                $TYPE = $row['TYPE'];
                                                $IMAGE = $row['IMAGE'];
                                                $REMARKS = $row['REMARKS'];
                                                $CREATED_BY = $row['GLOBAL_UID'];
                                                $CREATED_DATE = $row['MY_DATE'];
                                                $MODIFIED_BY = $row['GLOBAL_UID'];
                                                $MODIFIED_DATE = $row['MY_DATE'];
                                            }
                                        }


                                    }


                                    ?>


                                    <div class="container" style="padding:5px;width:100%">

                                        <div class="table-responsive">

                                            <table width="98%">

                                                <tr height="40">
                                                    <td width="28%"
                                                        align="right"><?php if ($o == 'notification_type') { ?> Alert <?php } ?><?php print $title; ?>
                                                        Code
                                                    </td>
                                                    <td width="02%" align="center">:</td>
                                                    <td>
                                                        <table width="100%">
                                                            <tr>
                                                                <td width="30%">
                                                                    <input class="form-control" type="hidden">

                                                                    <?php if ($MODE == 'new') { ?>
                                                                        <input type="text" class="form-control"
                                                                               id="CODE" size="10" name="CODE"
                                                                               value="<?php print $CODE; ?>"
                                                                               value="<?php print $CODE; ?>"
                                                                               REQUIRED style="width:100px">
                                                                    <?php } ?>

                                                                    <?php if ($MODE == 'edit') { ?>
                                                                        <input type="text" class="form-control"
                                                                               id="CODE" size="10" name="CODE"
                                                                               value="<?php print $CODE; ?>"
                                                                               value="<?php print $CODE; ?>"
                                                                               READONLY style="width:100px">
                                                                    <?php } ?>

                                                                    <?php if ($MODE == 'view') { ?>
                                                                        <input type="text" class="form-control"
                                                                               id="CODE" size="10" name="CODE"
                                                                               value="<?php print $CODE; ?>"
                                                                               value="<?php print $CODE; ?>"
                                                                               READONLY style="width:100px">
                                                                    <?php } ?>
                                                                <td align="right">&nbsp;</td>

                                                                </td>
                                                                <?php if ($o == 'country') { ?>

                                                                    <td align="right">Country Tel Code</td>
                                                                    <td width="02%" align="center">:</td>
                                                                    <td width="30%">
                                                                        <input type="text" class="form-control"
                                                                               id="COUNTRY_TEL_CODE"
                                                                               name="COUNTRY_TEL_CODE"
                                                                               value="<?php print $COUNTRY_TEL_CODE; ?>"
                                                                               placeholder="Country Tel Code "
                                                                               required <?php print $READONLY; ?>>
                                                                    </td>


                                                                <?php } ?>

                                                                <?php if ($o == 'location') { ?>

                                                                    <td align="right">Type</td>
                                                                    <td align="center">:</td>
                                                                    <td width="30%"><SELECT name="STATUS"
                                                                                            class="form-control">
                                                                            <OPTION VALUE="">Active</OPTION>
                                                                            <OPTION VALUE="P">Inactive</OPTION>
                                                                        </SELECT></td>
                                                                <?php } ?>

                                                                <?php if ($o == 'route') { ?>

                                                                    <td align="right">Region</td>
                                                                    <td align="center">:</td>
                                                                    <td width="55%"><SELECT name="STATUS"
                                                                                            class="form-control">
                                                                            <OPTION VALUE="">Far Western Development
                                                                                Region
                                                                            </OPTION>
                                                                            <OPTION VALUE="">Mid Western Development
                                                                                Region
                                                                            </OPTION>
                                                                            <OPTION VALUE="">Western Development
                                                                                Region
                                                                            </OPTION>
                                                                            <OPTION VALUE="">Central Development
                                                                                Region
                                                                            </OPTION>
                                                                            <OPTION VALUE="">Eastern Development
                                                                                Region
                                                                            </OPTION>
                                                                            OPTION>
                                                                        </SELECT></td>
                                                                <?php } ?>

                                                            </tr>
                                                            </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <?php if ($o != 'embassy') { ?>

                                                    <tr height="40">
                                                        <td align="right"> <?php if ($o == 'notification_type') { ?> Alert <?php } ?> <?php print $title; ?>
                                                            Name
                                                        </td>
                                                        <td align="center">:</td>
                                                        <td><input type="text" class="form-control" id="NAME"
                                                                   name="NAME" value="<?php print $NAME; ?>"
                                                                   placeholder="Enter Name "
                                                                   required <?php print $READONLY; ?>></td>
                                                    </tr>

                                                <?php } ?>

                                                <?php if ($o == 'location') { ?>


                                                    <tr height="40">
                                                        <td align="right">Lat</td>
                                                        <td width="02%" align="center">:</td>
                                                        <td width="88%">
                                                            <table width="100%">
                                                                <tr>
                                                                    <td width="30%">
                                                                        <input type="text" class="form-control" id="LAT"
                                                                               name="LAT" value="<?php print $LAT; ?>"
                                                                               placeholder="latitude"
                                                                               required <?php print $READONLY; ?>>
                                                                    </td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td align="right">Long</td>
                                                                    <td align="center">:</td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td width="30%">

                                                                        <input type="text" class="form-control" id="LON"
                                                                               name="LON" value="<?php print $LON; ?>"
                                                                               placeholder="Longitude"
                                                                               required <?php print $READONLY; ?>>

                                                                    </td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td align="right">Alt</td>
                                                                    <td align="center">:</td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td width="30%">

                                                                        <input type="text" class="form-control" id="ALT"
                                                                               name="ALT" value="<?php print $ALT; ?>"
                                                                               placeholder="Altitude"
                                                                               required <?php print $READONLY; ?>>

                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>

                                                    <tr height="40">
                                                        <td align="right"> Details</td>
                                                        <td align="center">:</td>
                                                        <td><input type="text" class="form-control" id="DETAILS"
                                                                   name="DETAILS" value="<?php print $DETAILS; ?>"
                                                                   placeholder="Enter Details"
                                                                   required <?php print $READONLY; ?>>
                                                        </td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if ($o == 'location_type') { ?>


                                                    <tr height="40">
                                                        <td align="right">Icon</td>
                                                        <td align="center">:</td>
                                                        <td>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td width="15%">

                                                                        <img src="../../GHT/image/logo.png"
                                                                             style="width:200px;height:120px;">

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="40%">
                                                                <tr>
                                                                    <td><input type="file" name="IMAGE_PATH"
                                                                               id="IMAGE_PATH"></td>
                                                                </tr>
                                                                </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>


                                                <?php } ?>

                                                <?php if ($o == 'country') { ?>


                                                    <tr height="40">
                                                        <td align="right">Continent</td>
                                                        <td align="center">:</td>

                                                        <td><input type="text" class="form-control"
                                                                   id="CONTINENT" name="CONTINENT"
                                                                   value="<?php print $CONTINENT; ?>"
                                                                   placeholder="Enter Continent "
                                                                   required <?php print $READONLY; ?>></td>

                                                    </tr>

                                                    <tr height="40">
                                                        <td align="right">Currency Name</td>
                                                        <td width="02%" align="center">:</td>
                                                        <td width="88%">
                                                            <table width="100%">
                                                                <tr>
                                                                    <td width="70%">
                                                                        <div class="input-append date">
                                                                            <input type="text" class="form-control"
                                                                                   id="CURRENCY_NAME"
                                                                                   name="CURRENCY_NAME"
                                                                                   value="<?php print $CURRENCY_NAME; ?>"
                                                                                   placeholder="Currency Name"
                                                                                   required <?php print $READONLY; ?>>
                                                                        </div>
                                                                    </td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td align="right">Symbol</td>
                                                                    <td width="02%" align="center">:</td>
                                                                    <td width="20%"><input type="text"
                                                                                           class="form-control"
                                                                                           id="SYMBOLE"
                                                                                           name="SYMBOLE"
                                                                                           value="<?php print $SYMBOLE; ?>"
                                                                                           placeholder="Symbol"
                                                                                           required <?php print $READONLY; ?>>
                                                                    </td>
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

                                                                        <img src="../../GHT/image/logo.png"
                                                                             style="width:204px;height:120px;">

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="40%">
                                                                <tr>
                                                                    <td><input type="file" name="IMAGE_PATH"
                                                                               id="IMAGE_PATH"></td>
                                                                </tr>
                                                                </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>

                                                <?php } ?>

                                                <?php if ($o == 'embassy')  { ?>


                                                <table width="98%">


                                                    <tr height="40">
                                                        <td width="28%" align="right">Location</td>
                                                        <td width="02%" align="center">:</td>
                                                        <td><input type="text" class="form-control" id="NAME"
                                                                   name="NAME" value="<?php print $NAME; ?>"
                                                                   placeholder="Location"
                                                                   required <?php print $READONLY; ?>>

                                                    </tr>

                                                    <tr height="40">
                                                        <td width="28%" align="right">Contact Person</td>
                                                        <td width="02%" align="center">:</td>
                                                        <td><input type="text" class="form-control" id="CONTACT_PERSON"
                                                                   name="CONTACT_PERSON"
                                                                   value="<?php print $CONTACT_PERSON; ?>"
                                                                   placeholder="Contact Person "
                                                                   required <?php print $READONLY; ?>></td>
                                                    </tr>

                                                    <tr height="40">
                                                        <td width="28%" align="right"> Position</td>
                                                        <td width="02%" align="center">:</td>
                                                        <td width="88%">
                                                            <table width="100%">
                                                                <tr>
                                                                    <td width="40%">
                                                                        <div class="input-append date">
                                                                            <input type="text" class="form-control"
                                                                                   id="POSITION" name="POSITION"
                                                                                   value="<?php print $POSITION; ?>"
                                                                                   placeholder="Position "
                                                                                   required <?php print $READONLY; ?>>
                                                                        </div>
                                                                    </td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td align="right">Mobile No</td>
                                                                    <td align="center">:</td>
                                                                    <td width="40%"><input type="text"
                                                                                           class="form-control"
                                                                                           id="MOBILE_NO"
                                                                                           name="MOBILE_NO"
                                                                                           value="<?php print $MOBILE_NO; ?>"
                                                                                           placeholder="Mobile No "
                                                                                           required <?php print $READONLY; ?>>
                                                                    </td>
                                                                </tr>
                                                            </table>


                                                            <?php } ?>

                                                            <?php if ($o == 'route') { ?>


                                                    <tr height="40">
                                                        <td width="28%" align="right">Code</td>
                                                        <td width="02%" align="center">:</td>
                                                        <td width="88%">
                                                            <table width="100%">
                                                                <tr>
                                                                    <td width="30%">
                                                                        <div class="input-append date">
                                                                            <input name="CODE" class="form-control"
                                                                                   placeholder="Code" id="CODE">
                                                                        </div>
                                                                    </td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td align="right">Region</td>
                                                                    <td align="center">:</td>
                                                                    <td width="55%"><SELECT name="STATUS"
                                                                                            class="form-control">
                                                                            <OPTION VALUE="">Far Western Development
                                                                                Region
                                                                            </OPTION>
                                                                            <OPTION VALUE="">Mid Western Development
                                                                                Region
                                                                            </OPTION>
                                                                            <OPTION VALUE="">Western Development
                                                                                Region
                                                                            </OPTION>
                                                                            <OPTION VALUE="">Central Development
                                                                                Region
                                                                            </OPTION>
                                                                            <OPTION VALUE="">Eastern Development
                                                                                Region
                                                                            </OPTION>
                                                                            OPTION>
                                                                        </SELECT></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>


                                                    <tr height="40">
                                                        <td align="right">Level</td>
                                                        <td width="02%" align="center">:</td>
                                                        <td width="88%">
                                                            <table width="100%">
                                                                <tr>
                                                                    <td width="40%">
                                                                        <div class="input-append date">
                                                                            <SELECT name="STATUS" class="form-control">
                                                                                <OPTION VALUE="">Level 1</OPTION>
                                                                                <OPTION VALUE="P">Level 2</OPTION>
                                                                                <OPTION VALUE="A">Level 3</OPTION>
                                                                            </SELECT>
                                                                        </div>
                                                                    </td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td align="right">No of Days</td>
                                                                    <td width="02%" align="center">:</td>
                                                                    <td width="20%"><input name="NO_DAYS"
                                                                                           class="form-control"
                                                                                           placeholder="No of Days "
                                                                                           id="NO_DAYS"></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>

                                                    <tr height="40">
                                                        <td align="right">Total Distance</td>
                                                        <td width="02%" align="center">:</td>
                                                        <td width="88%">
                                                            <table width="100%">
                                                                <tr>
                                                                    <td width="25%"><input name="TOTAL_DISTANCE"
                                                                                           class="form-control"
                                                                                           placeholder="Total Distance"
                                                                                           id="TOTAL_DISTANCE"></td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td align="right">Highest Point</td>
                                                                    <td width="02%" align="center">:</td>
                                                                    <td width="02%" align="center">&nbsp;</td>
                                                                    <td width="30%"><input name="HIGHEST_POINT"
                                                                                           class="form-control"
                                                                                           placeholder="Highest Point "
                                                                                           id="HIGHEST_POINT"></td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td width="20%"><SELECT name="STATUS"
                                                                                            class="form-control">
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
                                                        <td align="right">Lat</td>
                                                        <td width="02%" align="center">:</td>
                                                        <td width="88%">
                                                            <table width="100%">
                                                                <tr>
                                                                    <td width="30%">

                                                                        <input name="LAT" class="form-control"
                                                                               placeholder="latitude " id="LAT">

                                                                    </td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td align="right">Long</td>
                                                                    <td align="center">:</td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td width="30%">

                                                                        <input name="LON" class="form-control"
                                                                               placeholder="Longitude " id="LON">

                                                                    </td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td align="right">Alt</td>
                                                                    <td align="center">:</td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td width="30%">

                                                                        <input name="ALT" class="form-control"
                                                                               placeholder="Altitude " id="ALT">

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
                                                        <td align="right">Lat</td>
                                                        <td width="02%" align="center">:</td>
                                                        <td width="88%">
                                                            <table width="100%">
                                                                <tr>
                                                                    <td width="30%">

                                                                        <input name="LAT" class="form-control"
                                                                               placeholder="latitude " id="LAT">

                                                                    </td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td align="right">Long</td>
                                                                    <td align="center">:</td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td width="30%">

                                                                        <input name="LON" class="form-control"
                                                                               placeholder="Longitude " id="LON">

                                                                    </td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td align="right">Alt</td>
                                                                    <td align="center">:</td>
                                                                    <td width="02%">&nbsp;</td>
                                                                    <td width="30%">

                                                                        <input name="ALT" class="form-control"
                                                                               placeholder="Altitude " id="ALT">

                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>

                                                    <tr height="40">
                                                        <td width="28%" align="right">Speciality</td>
                                                        <td width="02%" align="center">:</td>
                                                        <td><input type="text" class="form-control" id="SPECIALITY"
                                                                   name="SPECIALITY" value="" placeholder="Speciality"
                                                                   value="" required></td>
                                                    </tr>

                                                    <tr height="40">
                                                        <td width="28%" align="right">Resources</td>
                                                        <td width="02%" align="center">:</td>
                                                        <td><input type="text" class="form-control" id="RESOURCES"
                                                                   name="RESOURCES" value="" placeholder="Resources"
                                                                   value="" required></td>
                                                    </tr>


                                                    <?php } ?>

                                                    <?php if ($o == 'weather_station') { ?>


                                                        <tr height="40">
                                                            <td align="right">Lat</td>
                                                            <td width="02%" align="center">:</td>
                                                            <td width="88%">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td width="30%">

                                                                            <input name="LAT" class="form-control"
                                                                                   placeholder="latitude " id="LAT">

                                                                        </td>
                                                                        <td width="02%">&nbsp;</td>
                                                                        <td align="right">Long</td>
                                                                        <td align="center">:</td>
                                                                        <td width="02%">&nbsp;</td>
                                                                        <td width="30%">

                                                                            <input name="LON" class="form-control"
                                                                                   placeholder="Longitude " id="LON">

                                                                        </td>
                                                                        <td width="02%">&nbsp;</td>
                                                                        <td align="right">Alt</td>
                                                                        <td align="center">:</td>
                                                                        <td width="02%">&nbsp;</td>
                                                                        <td width="30%">

                                                                            <input name="ALT" class="form-control"
                                                                                   placeholder="Altitude " id="ALT">

                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                    <?php } ?>
                                                    <?php if ($o == 'incident_type') { ?>


                                                        <tr height="40">
                                                            <td align="right">Incident Type</td>
                                                            <td width="02%" align="center">:</td>
                                                            <td width="88%">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td width="40%">
                                                                            <div class="input-append date">
                                                                                <SELECT name="STATUS"
                                                                                        class="form-control">
                                                                                    <OPTION VALUE="">Information
                                                                                    </OPTION>
                                                                                    <OPTION VALUE="P">Warning</OPTION>
                                                                                    <OPTION VALUE="A">Alert</OPTION>
                                                                                </SELECT>
                                                                            </div>
                                                                        </td>
                                                                        <td width="02%">&nbsp;</td>
                                                                        <td align="right">&nbsp; </td>
                                                                        <td width="02%" align="center">&nbsp;</td>
                                                                        <td width="20%">&nbsp;</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <tr height="40">
                                                            <td align="right"> Image</td>
                                                            <td align="center">:</td>
                                                            <td>
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td width="15%">

                                                                            <img src="../../GHT/image/logo.png"
                                                                                 style="width:204px;height:120px;">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="40%">
                                                                    <tr>
                                                                        <td><input type="file" name="IMAGE_PATH"
                                                                                   id="IMAGE_PATH"></td>
                                                                    </tr>
                                                                    </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                    <?php } ?>

                                                    <?php if ($o == 'notification_type') { ?>


                                                        <tr height="40">
                                                            <td width="28%" align="right">Alert Description</td>
                                                            <td width="02%" align="center">:</td>
                                                            <td><input type="text" class="form-control" id="NAME"
                                                                       name="NAME" value=""
                                                                       placeholder="Alert Description " value=""
                                                                       required></td>
                                                        </tr>


                                                    <?php } ?>


                                                    <tr height="40">
                                                        <td align="right" valign="top">Remarks</td>
                                                        <td align="center" valign="top">:</td>
                                                        <td><textarea class="form-control" rows="1" id="REMARKS"
                                                                      placeholder="Enter Remarks"
                                                                      name="REMARKS" <?php print $READONLY; ?>>
                                                        <?php print $REMARKS; ?></textarea></td>
                                                    </tr>


                                                    <tr height="40">
                                                        <td align="right">&nbsp;</td>
                                                        <td align="center">&nbsp;</td>
                                                        <td>

                                                            <table class="table">
                                                                <tr>
                                                                    <td width="50%">


                                                                        <input type="hidden" name="o"
                                                                               value="<?php print $o; ?>">
                                                                        <input type="hidden" name="mode"
                                                                               value="<?php print $MODE; ?>">
                                                                        <input type="hidden" name="operation"
                                                                               value="submit">
                                                                        <button type="submit"
                                                                                class="btn btn-success" <?php print $DISABLED; ?>>
                                                                            <b>Submit</b> <?php print $title; ?>
                                                                        </button>
                                </form>

                                </td>


                                <td width="25%" align="right">

                                    <form role="form" method="post" action="delete.php">
                                        <input type="hidden" name="o" value="<?php print $o; ?>">
                                        <input type="hidden" name="id" value="<?php print $ID; ?>">
                                        <input type="hidden" name="name" value="<?php print $NAME; ?>">
                                        <input type="hidden" name="title" value="<?php print $title; ?>">
                                        <input type="hidden" name="src" value="definition.php">
                                        <button type="submit" class="btn btn-danger" <?php print $DELETE_DISABLED; ?>>
                                            Delete
                                        </button>
                                    </form>

                                </td>


                                <td width="25%" align="left">

                                    <form role="form" method="post" action="general_setup.php">
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


                    <div role="tabpanel" class="tab-pane" id="maker">
                        <div class="container" style="padding:5px;width:100%">
                            <div class="panel panel-default">
                            </div>

                            <div class="list-group">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <div class="list-group">
                                            <table width="100%" class="table table-striped" border="0">
                                                <thead>

                                                <tr>
                                                    <th>Route</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Place</th>
                                                    <th>Country</th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>
                                                </tr>

                                                <tr>
                                                    <td width="30%">
                                                        <SELECT name="STATUS" class="form-control">
                                                            <OPTION VALUE="">Kathmandu to Pokhara</OPTION>
                                                            <OPTION VALUE="P">Beni to Tatopani</OPTION>
                                                            <OPTION VALUE="A">Jomsom to Muktinath</OPTION>
                                                        </SELECT>
                                                    </td>
                                                    <td>
                                                        <input name="DATE" class="form-control" placeholder="Date"
                                                               id="dp_date">
                                                    </td>
                                                    <td>
                                                        <input name="TIME" class="form-control" placeholder="Time"
                                                               id="dp_time">

                                                    </td>
                                                    <td width="20%">
                                                        <SELECT name="STATUS" class="form-control">
                                                            <OPTION VALUE="">Kathmandu</OPTION>
                                                            <OPTION VALUE="P">Pokhara</OPTION>
                                                            <OPTION VALUE="A">Jomsom</OPTION>
                                                            <OPTION VALUE="A">Bara</OPTION>
                                                            <OPTION VALUE="A">Muktinath</OPTION>
                                                            <OPTION VALUE="A">Chitwan</OPTION>
                                                            <OPTION VALUE="A">Putan</OPTION>
                                                        </SELECT>
                                                    </td>
                                                    <td width="15%">
                                                        <SELECT name="STATUS" class="form-control">
                                                            <OPTION VALUE="">Nepal</OPTION>
                                                            <OPTION VALUE="P">Pakistan</OPTION>
                                                            <OPTION VALUE="A">Srilanka</OPTION>
                                                        </SELECT>

                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </td>
                                                </tr>

                                                </thead>
                                                <tbody>

                                                <tr>
                                                    <td>Kathmandu to Pokhara</td>
                                                    <td>2016-06-12</td>
                                                    <td>6:40</td>
                                                    <td>Pokhara</td>
                                                    <td>Nepal</td>
                                                    <td align="right"><a
                                                                href="definition.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                    src="images/edit.png"></a></td>
                                                    <td align="right"><a
                                                                href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                    src="images/delete.png"></a></td>
                                                </tr>
                                                <tr>
                                                    <td>Beni to Tatopani</td>
                                                    <td>2016-03-19</td>
                                                    <td>5:30</td>
                                                    <td>Beni</td>
                                                    <td>Nepal</td>
                                                    <td align="right"><a
                                                                href="definition.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                    src="images/edit.png"></a></td>
                                                    <td align="right"><a
                                                                href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                    src="images/delete.png"></a></td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                    <div role="tabpanel" class="tab-pane" id="list">
                        <div class="container" style="padding:5px;width:100%">
                            <div class="panel panel-default">
                            </div>

                            <div class="list-group">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <div class="list-group">
                                            <table width="100%" class="table table-striped" border="0">
                                                <thead>

                                                <?php if ($o == 'country') { ?>
                                                    <tr>
                                                        <th>Country Code</th>
                                                        <th>Tel Code</th>
                                                        <th>Name</th>
                                                        <th>Continent</th>
                                                        <th>Currency</th>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>
                                                    </tr>

                                                <?php } ?>

                                                <?php if ($o == 'embassy') { ?>
                                                    <tr>
                                                        <th>Route</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Place</th>
                                                        <th>Country</th>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>
                                                    </tr>

                                                <?php } ?>

                                                <?php if ($o == 'location_type') { ?>
                                                    <tr>
                                                        <th>Code</th>
                                                        <th>Name</th>
                                                        <th>Icon</th>
                                                        <th>Status</th>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>
                                                    </tr>

                                                <?php } ?>

                                                <?php if ($o == 'location') { ?>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Type</th>
                                                        <th>Name</th>
                                                        <th>Lat</th>
                                                        <th>Long</th>
                                                        <th>Alt</th>
                                                        <th>Status</th>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>

                                                    </tr>

                                                <?php } ?>

                                                <?php if ($o == 'route') { ?>
                                                    <tr>
                                                        <th>Day</th>
                                                        <th>Name</th>
                                                        <th>Lat</th>
                                                        <th>Long</th>
                                                        <th>Alt</th>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>
                                                    </tr>

                                                <?php } ?>

                                                <?php if ($o == 'weather_station') { ?>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Type</th>
                                                        <th>Name</th>
                                                        <th>Lat</th>
                                                        <th>Long</th>
                                                        <th>Alt</th>
                                                        <th>Status</th>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>

                                                    </tr>

                                                <?php } ?>

                                                <?php if ($o == 'incident_type') { ?>
                                                    <tr>
                                                        <th>Route</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Place</th>
                                                        <th>Country</th>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>
                                                    </tr>

                                                <?php } ?>

                                                <?php if ($o == 'notification_type') { ?>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Name</th>
                                                        <th>Date</th>
                                                        <th>DESCRIPTION</th>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>
                                                    </tr>

                                                <?php } ?>



                                                <?php if ($o == 'country') { ?>

                                                <tr>
                                                    <td width="30%">
                                                        <SELECT name="STATUS" class="form-control">
                                                            <OPTION VALUE="">Kathmandu to Pokhara</OPTION>
                                                            <OPTION VALUE="P">Beni to Tatopani</OPTION>
                                                            <OPTION VALUE="A">Jomsom to Muktinath</OPTION>
                                                        </SELECT>
                                                    </td>
                                                    <td>
                                                        <input name="DATE" class="form-control" placeholder="Date"
                                                               id="dp_date">
                                                    </td>
                                                    <td>
                                                        <input name="TIME" class="form-control" placeholder="Time"
                                                               id="dp_time">

                                                    </td>
                                                    <td width="20%">
                                                        <SELECT name="STATUS" class="form-control">
                                                            <OPTION VALUE="">Kathmandu</OPTION>
                                                            <OPTION VALUE="P">Pokhara</OPTION>
                                                            <OPTION VALUE="A">Jomsom</OPTION>
                                                            <OPTION VALUE="A">Bara</OPTION>
                                                            <OPTION VALUE="A">Muktinath</OPTION>
                                                            <OPTION VALUE="A">Chitwan</OPTION>
                                                            <OPTION VALUE="A">Putan</OPTION>
                                                        </SELECT>
                                                    </td>
                                                    <td width="15%">
                                                        <SELECT name="STATUS" class="form-control">
                                                            <OPTION VALUE="">Nepal</OPTION>
                                                            <OPTION VALUE="P">Pakistan</OPTION>
                                                            <OPTION VALUE="A">Srilanka</OPTION>
                                                        </SELECT>

                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </td>
                                                </tr>
                                                </thead>
                                                <?php } ?>

                                                <?php if ($o == 'embassy') { ?>

                                                    <tr>
                                                        <td width="30%">
                                                            <SELECT name="STATUS" class="form-control">
                                                                <OPTION VALUE="">Kathmandu to Pokhara</OPTION>
                                                                <OPTION VALUE="P">Beni to Tatopani</OPTION>
                                                                <OPTION VALUE="A">Jomsom to Muktinath</OPTION>
                                                            </SELECT>
                                                        </td>
                                                        <td>
                                                            <input name="DATE" class="form-control" placeholder="Date"
                                                                   id="dp_date">
                                                        </td>
                                                        <td>
                                                            <input name="TIME" class="form-control" placeholder="Time"
                                                                   id="dp_time">

                                                        </td>
                                                        <td width="20%">
                                                            <SELECT name="STATUS" class="form-control">
                                                                <OPTION VALUE="">Kathmandu</OPTION>
                                                                <OPTION VALUE="P">Pokhara</OPTION>
                                                                <OPTION VALUE="A">Jomsom</OPTION>
                                                                <OPTION VALUE="A">Bara</OPTION>
                                                                <OPTION VALUE="A">Muktinath</OPTION>
                                                                <OPTION VALUE="A">Chitwan</OPTION>
                                                                <OPTION VALUE="A">Putan</OPTION>
                                                            </SELECT>
                                                        </td>
                                                        <td width="15%">
                                                            <SELECT name="STATUS" class="form-control">
                                                                <OPTION VALUE="">Nepal</OPTION>
                                                                <OPTION VALUE="P">Pakistan</OPTION>
                                                                <OPTION VALUE="A">Srilanka</OPTION>
                                                            </SELECT>

                                                        </td>
                                                        <td>
                                                            <button type="submit" class="btn btn-success">Submit
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    </thead>
                                                <?php } ?>

                                                <?php if ($o == 'location_type') { ?>

                                                    <tr>
                                                        <td width="13%">
                                                            <input name="CODE" class="form-control" placeholder="Code"
                                                                   id="CODE">
                                                        </td>
                                                        <td>
                                                            <input name="NAME" class="form-control" placeholder="Name"
                                                                   id="NAME">
                                                        </td>
                                                        <td width="20%">
                                                            <input type="file" name="IMAGE_PATH" id="IMAGE_PATH">

                                                        </td>
                                                        <td width="20%">
                                                            <label class="switch">
                                                                <input type="checkbox">
                                                                <div class="slider round"></div>
                                                            </label>
                                                        </td>
                                                        <td width="5%">
                                                            <button type="submit" class="btn btn-success">Save</button>
                                                        </td>


                                                    </tr>
                                                    </thead>
                                                <?php } ?>

                                                <?php if ($o == 'location') { ?>

                                                <tr>
                                                    <td width="10%">3
                                                    </th>
                                                    <td width="20%">
                                                        <input name="TYPE" class="form-control" placeholder="Type"
                                                               id="dp_date">
                                                    </td>
                                                    <td width="25%">
                                                        <input name="NAME" class="form-control" placeholder="Name"
                                                               id="dp_time">

                                                    </td>
                                                    <td width="10%">
                                                        <input name="LAT" class="form-control" placeholder="Lat"
                                                               id="dp_time">

                                                    </td>
                                                    <td width="10%">
                                                        <input name="LONG" class="form-control" placeholder="Long"
                                                               id="dp_date">
                                                    </td>
                                                    <td width="10%">
                                                        <input name="ALT" class="form-control" placeholder="Alt"
                                                               id="dp_time">

                                                    </td>
                                                    <td width="20%">
                                                        <label class="switch">
                                                            <input type="checkbox">
                                                            <div class="slider round"></div>
                                                        </label>
                                                    </td>
                                                    <td width="5%">
                                                        <button type="submit" class="btn btn-success">Save</button>
                                                    </td>


                                                </tr>
                                                <tbody>


                                                <?php } ?>

                                                <?php if ($o == 'route') { ?>

                                                <tr>
                                                    <td width="30%">
                                                        <SELECT name="STATUS" class="form-control">
                                                            <OPTION VALUE="">Kathmandu to Pokhara</OPTION>
                                                            <OPTION VALUE="P">Beni to Tatopani</OPTION>
                                                            <OPTION VALUE="A">Jomsom to Muktinath</OPTION>
                                                        </SELECT>
                                                    </td>
                                                    <td>
                                                        <input name="DATE" class="form-control" placeholder="Date"
                                                               id="dp_date">
                                                    </td>
                                                    <td>
                                                        <input name="TIME" class="form-control" placeholder="Time"
                                                               id="dp_time">

                                                    </td>
                                                    <td width="20%">
                                                        <SELECT name="STATUS" class="form-control">
                                                            <OPTION VALUE="">Kathmandu</OPTION>
                                                            <OPTION VALUE="P">Pokhara</OPTION>
                                                            <OPTION VALUE="A">Jomsom</OPTION>
                                                            <OPTION VALUE="A">Bara</OPTION>
                                                            <OPTION VALUE="A">Muktinath</OPTION>
                                                            <OPTION VALUE="A">Chitwan</OPTION>
                                                            <OPTION VALUE="A">Putan</OPTION>
                                                        </SELECT>
                                                    </td>
                                                    <td width="15%">
                                                        <SELECT name="STATUS" class="form-control">
                                                            <OPTION VALUE="">Nepal</OPTION>
                                                            <OPTION VALUE="P">Pakistan</OPTION>
                                                            <OPTION VALUE="A">Srilanka</OPTION>
                                                        </SELECT>

                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </td>
                                                </tr>
                                                </thead>
                                            <?php } ?>

                                                <?php if ($o == 'weather_station') { ?>

                                                <thead>

                                                <tr>
                                                    <td width="10%">3
                                                    </th>
                                                    <td width="20%">
                                                        <input name="TYPE" class="form-control" placeholder="Type"
                                                               id="dp_date">
                                                    </td>
                                                    <td width="25%">
                                                        <input name="NAME" class="form-control" placeholder="Name"
                                                               id="dp_time">

                                                    </td>
                                                    <td width="10%">
                                                        <input name="LAT" class="form-control" placeholder="Lat"
                                                               id="dp_time">

                                                    </td>
                                                    <td width="10%">
                                                        <input name="LONG" class="form-control" placeholder="Long"
                                                               id="dp_date">
                                                    </td>
                                                    <td width="10%">
                                                        <input name="ALT" class="form-control" placeholder="Alt"
                                                               id="dp_time">

                                                    </td>
                                                    <td width="20%">
                                                        <label class="switch">
                                                            <input type="checkbox">
                                                            <div class="slider round"></div>
                                                        </label>
                                                    </td>
                                                    <td width="5%">
                                                        <button type="submit" class="btn btn-success">Save</button>
                                                    </td>


                                                </tr>

                                                <?php } ?>
                                                <?php if ($o == 'incident_type') { ?>

                                                    <tr>
                                                        <td width="30%">
                                                            <SELECT name="STATUS" class="form-control">
                                                                <OPTION VALUE="">Kathmandu to Pokhara</OPTION>
                                                                <OPTION VALUE="P">Beni to Tatopani</OPTION>
                                                                <OPTION VALUE="A">Jomsom to Muktinath</OPTION>
                                                            </SELECT>
                                                        </td>
                                                        <td>
                                                            <input name="DATE" class="form-control" placeholder="Date"
                                                                   id="dp_date">
                                                        </td>
                                                        <td>
                                                            <input name="TIME" class="form-control" placeholder="Time"
                                                                   id="dp_time">

                                                        </td>
                                                        <td width="20%">
                                                            <SELECT name="STATUS" class="form-control">
                                                                <OPTION VALUE="">Kathmandu</OPTION>
                                                                <OPTION VALUE="P">Pokhara</OPTION>
                                                                <OPTION VALUE="A">Jomsom</OPTION>
                                                                <OPTION VALUE="A">Bara</OPTION>
                                                                <OPTION VALUE="A">Muktinath</OPTION>
                                                                <OPTION VALUE="A">Chitwan</OPTION>
                                                                <OPTION VALUE="A">Putan</OPTION>
                                                            </SELECT>
                                                        </td>
                                                        <td width="15%">
                                                            <SELECT name="STATUS" class="form-control">
                                                                <OPTION VALUE="">Nepal</OPTION>
                                                                <OPTION VALUE="P">Pakistan</OPTION>
                                                                <OPTION VALUE="A">Srilanka</OPTION>
                                                            </SELECT>

                                                        </td>
                                                        <td>
                                                            <button type="submit" class="btn btn-success">Submit
                                                            </button>
                                                        </td>
                                                    </tr>

                                                <?php } ?>




                                                <?php if ($o == 'country') { ?>
                                                <?php } ?>
                                                <?php if ($o == 'embassy') { ?>
                                                <?php } ?>
                                                <?php if ($o == 'location_type') { ?>


                                                <?php } ?>
                                                <?php if ($o == 'location') { ?>
                                                <?php } ?>
                                                <?php if ($o == 'route') { ?>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>Kathmandu</td>
                                                        <td>311.12</td>
                                                        <td>987.32</td>
                                                        <td>500</td>
                                                        <td align="right"><a
                                                                    href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                        src="images/edit.png"></a></td>
                                                        <td align="right"><a
                                                                    href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                        src="images/delete.png"></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Tatopani</td>
                                                        <td>232.43</td>
                                                        <td>3422.234</td>
                                                        <td>300</td>
                                                        <td align="right"><a
                                                                    href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                        src="images/edit.png"></a></td>
                                                        <td align="right"><a
                                                                    href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                        src="images/delete.png"></a></td>
                                                    </tr>
                                                <?php } ?>
                                                <?php if ($o == 'weather_station') { ?>
                                                <?php } ?>
                                                <?php if ($o == 'incident_type') { ?>
                                                <?php } ?>
                                                <?php if ($o == 'notification_type') { ?>


                                                <?php } ?>


                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                    <div role="tabpanel" class="tab-pane" id="map">
                        <div class="container" style="padding:5px;width:100%">
                            <div class="panel panel-default">
                            </div>

                            <div class="list-group">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <div id="map"></div>

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="pushnotification">
                        <div class="container" style="padding:5px;width:100%">
                            <div class="container" style="padding:5px;width:100%">

                                <div class="table-responsive">

                                    <table width="98%">

                                        <tr height="40">
                                            <td width="28%" align="right"> Push Notification Id</td>
                                            <td width="02%" align="center">:</td>
                                            <td width="88%">
                                                <table width="100%">
                                                    <tr>
                                                        <td width="30%">
                                                            <div class="input-append date">
                                                                <input name="CODE" class="form-control"
                                                                       placeholder="Notification Code" id="CODE">
                                                            </div>
                                                        </td>
                                                        <td width="02%">&nbsp;</td>
                                                        <td align="right">&nbsp; </td>
                                                        <td align="center">&nbsp;</td>
                                                        <td width="30%">&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr height="40">
                                            <td width="28%" align="right"> Push Notification Name</td>
                                            <td width="02%" align="center">:</td>
                                            <td><input type="text" class="form-control" id="NAME" name="NAME" value=""
                                                       placeholder="Notification Name " value="" required></td>
                                        </tr>

                                        <tr height="40">
                                            <td width="28%" align="right"> Push Notification Description</td>
                                            <td width="02%" align="center">:</td>
                                            <td><input type="text" class="form-control" id="NAME" name="NAME" value=""
                                                       placeholder="Notification Description " value="" required></td>
                                        </tr>
                                        <tr height="40">
                                            <td align="right" valign="top">Remarks</td>
                                            <td align="center" valign="top">:</td>
                                            <td><textarea class="form-control" rows="1" id="REMARKS"
                                                          placeholder="Enter Remarks"
                                                          name="REMARKS" <?php print $READONLY; ?>><?php print $REMARKS; ?></textarea>
                                            </td>
                                        </tr>


                                        <tr height="40">
                                            <td align="right">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td>

                                                <table class="table">
                                                    <tr>
                                                        <td width="50%">


                                                            <input type="hidden" name="o" value="<?php print $o; ?>">
                                                            <input type="hidden" name="mode"
                                                                   value="<?php print $MODE; ?>">
                                                            <input type="hidden" name="operation" value="submit">
                                                            <button type="submit"
                                                                    class="btn btn-success" <?php print $DISABLED; ?>>
                                                                <b>Submit</b> <?php print $title; ?>
                                                            </button>
                                                            </form>

                                                        </td>


                                                        <td width="25%" align="right">

                                                            <form role="form" method="post" action="delete.php">
                                                                <input type="hidden" name="o"
                                                                       value="<?php print $o; ?>">
                                                                <input type="hidden" name="id"
                                                                       value="<?php print $ID; ?>">
                                                                <input type="hidden" name="name"
                                                                       value="<?php print $NAME; ?>">
                                                                <input type="hidden" name="title"
                                                                       value="<?php print $title; ?>">
                                                                <input type="hidden" name="src" value="definition.php">
                                                                <button type="submit"
                                                                        class="btn btn-danger" <?php print $DELETE_DISABLED; ?>>
                                                                    Delete
                                                                </button>
                                                            </form>

                                                        </td>


                                                        <td width="25%" align="left">

                                                            <form role="form" method="post" action="general_setup.php">
                                                                <input type="hidden" name="o"
                                                                       value="<?php print $o; ?>">
                                                                <button type="submit" class="btn btn-default">Cancel
                                                                </button>
                                                            </form>


                                                        </td>

                                                    </tr>
                                                </table>


                                            </td>
                                        </tr>
                                    </table>


                                </div>


                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="list-group">
                                            <div class="list-group">
                                                <table width="100%" class="table table-striped" border="0">
                                                    <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Name</th>
                                                        <th>Date</th>
                                                        <th>Lat</th>
                                                        <th>Long</th>
                                                        <th>Alt</th>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                    <tbody>
                                                    <?php

                                                    $qry = "SELECT * FROM push_notification order by PN_ID";
                                                    $rs = mysqli_query($qry);

                                                    while ($row = mysqli_fetch_array($rs)) {
                                                        $CODE = $row['PN_ID'];
                                                        $NAME = $row['PN_TITLE'];
                                                        $PN_DATE = $row['PN_DATE'];
                                                        $LATITUDE = $row['LATITUDE'];
                                                        $LONGITUDE = $row['LONGITUDE'];
                                                        $ALTITUDE = $row['ALTITUDE'];

                                                        ?>
                                                        <tr>
                                                            <td><?php print $CODE; ?></td>
                                                            <td>
                                                                <a href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=view"><?php print $NAME; ?></a>
                                                            </td>

                                                            <td><?php print $PN_DATE; ?></td>
                                                            <td><?php print $LATITUDE; ?></td>
                                                            <td><?php print $LONGITUDE; ?></td>
                                                            <td><?php print $ALTITUDE; ?></td>
                                                            <td align="right"><a
                                                                        href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                            src="images/edit.png"></a></td>
                                                            <td align="right"><a
                                                                        href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                            src="images/delete.png"></a></td>
                                                        </tr>
                                                    <?php } ?>

                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.panel-body -->
                                </div>


                            </div>
                        </div>
                    </div>


                    <div role="tabpanel" class="tab-pane" id="itetaries">
                        <div class="container" style="padding:5px;width:100%">
                            <div class="panel panel-default">

                                <!-- /.list-group -->
                                <div class="panel-body">
                                    <div class="list-group">
                                        <div class="list-group">
                                            <table width="100%" class="table table-striped" border="0">

                                                <thead>
                                                <tr>
                                                    <th>Day</th>
                                                    <th>Start</th>
                                                    <th>End</th>
                                                    <th>Duration</th>
                                                    <th>Remarks</th>
                                                    <th>Highest Alt</th>
                                                    <th>&nbsp;</th>
                                                    <th>&nbsp;</th>

                                                </tr>

                                                <tr>
                                                    <td width="5%">
                                                        3
                                                    </td>
                                                    <td width="15%">
                                                        <input name="START_DATE" class="form-control"
                                                               placeholder="Start"
                                                               id="dp_date">
                                                    </td>
                                                    <td width="15%">
                                                        <input name="END_DATE" class="form-control" placeholder="End"
                                                               id="dp_time">

                                                    </td>
                                                    <td width="15%">
                                                        <input name="DURATION" class="form-control"
                                                               placeholder="Duration"
                                                               id="DURATION">

                                                    </td>
                                                    <td width="20%">
                                                        <input name="REMARKS" class="form-control" placeholder="Remarks"
                                                               id="REMARKS">
                                                    </td>
                                                    <td width="15%">
                                                        <input name="HIGHEST_ALT" class="form-control"
                                                               placeholder="Highest Alt" id="HIGHEST_ALT">

                                                    </td width="10%">
                                                    <td>
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </td>


                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>01</td>
                                                    <td>2016-06-12</td>
                                                    <td>2016-03-19</td>
                                                    <td>6:40</td>
                                                    <td>Pokhara</td>
                                                    <td>343</td>
                                                    <td align="right"><a
                                                                href="definition.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                    src="images/edit.png"></a></td>
                                                    <td align="right"><a
                                                                href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                    src="images/delete.png"></a></td>
                                                </tr>
                                                <tr>
                                                    <td>02</td>
                                                    <td>2016-03-19</td>
                                                    <td>2016-06-12</td>
                                                    <td>5:30</td>
                                                    <td>Beni</td>
                                                    <td>433</td>
                                                    <td align="right"><a
                                                                href="definition.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                    src="images/edit.png"></a></td>
                                                    <td align="right"><a
                                                                href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                    src="images/delete.png"></a></td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.panel-body -->

                                <!-- /.panel -->

                            </div>


                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="photo">
                        <div class="container" style="padding:5px;width:100%">
                            <div class="panel panel-default">

                                <!-- /.list-group -->
                                <div class="panel-body">
                                    <div class="list-group">
                                        <div class="list-group">
                                            <table width="100%" class="table table-striped" border="0">

                                                <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Description</th>
                                                    <th>Default</th>
                                                    <th>Remarks</th>
                                                    <th>&nbsp;</th>

                                                </tr>

                                                <tr>
                                                    <td width="7%">
                                                        <input type="file" name="IMAGE_PATH" id="IMAGE_PATH">
                                                    </td>
                                                    <td width="30%">
                                                        <input name="DESCRIPTION" class="form-control"
                                                               placeholder="Description" id="dp_date">
                                                    </td>
                                                    <td width="10%">
                                                        <input name="DEFAULT" class="form-control" placeholder="Default"
                                                               id="dp_time">

                                                    </td>

                                                    <td width="10%">
                                                        <input name="REMARKS" class="form-control" placeholder="Remarks"
                                                               id="REMARKS">
                                                    </td>

                                                    <td>
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </td>


                                                </tr>
                                                </thead>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.panel-body -->

                                <!-- /.panel -->

                            </div>


                        </div>
                    </div>
                    <!-- /.panel-body -->


                    <div role="tabpanel" class="tab-pane" id="stops">
                        <div class="container" style="padding:5px;width:100%">
                            <div class="panel panel-default">
                                <div class="panel-body">


                                    <div class="panel-body">
                                        <div class="list-group">
                                            <div class="list-group">
                                                <table width="100%" class="table table-striped" border="0">

                                                    <thead>
                                                    <tr>
                                                        <th>Day</th>
                                                        <th>Start</th>
                                                        <th>End</th>
                                                        <th>Duration</th>
                                                        <th>Remarks</th>
                                                        <th>Highest Alt</th>
                                                        <th>&nbsp;</th>
                                                        <th>&nbsp;</th>

                                                    </tr>

                                                    <tr>
                                                        <td width="5%">
                                                            3
                                                        </td>
                                                        <td width="15%">
                                                            <input name="START_DATE" class="form-control"
                                                                   placeholder="Start" id="dp_date">
                                                        </td>
                                                        <td width="15%">
                                                            <input name="END_DATE" class="form-control"
                                                                   placeholder="End"
                                                                   id="dp_time">

                                                        </td>
                                                        <td width="15%">
                                                            <input name="DURATION" class="form-control"
                                                                   placeholder="Duration" id="DURATION">

                                                        </td>
                                                        <td width="20%">
                                                            <input name="REMARKS" class="form-control"
                                                                   placeholder="Remarks"
                                                                   id="REMARKS">
                                                        </td>
                                                        <td width="15%">
                                                            <input name="HIGHEST_ALT" class="form-control"
                                                                   placeholder="Highest Alt" id="HIGHEST_ALT">

                                                        </td width="10%">
                                                        <td>
                                                            <button type="submit" class="btn btn-success">Submit
                                                            </button>
                                                        </td>


                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>2016-06-12</td>
                                                        <td>2016-03-19</td>
                                                        <td>6:40</td>
                                                        <td>Pokhara</td>
                                                        <td>343</td>
                                                        <td align="right"><a
                                                                    href="definition.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                        src="images/edit.png"></a></td>
                                                        <td align="right"><a
                                                                    href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                        src="images/delete.png"></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>02</td>
                                                        <td>2016-03-19</td>
                                                        <td>2016-06-12</td>
                                                        <td>5:30</td>
                                                        <td>Beni</td>
                                                        <td>433</td>
                                                        <td align="right"><a
                                                                    href="definition.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                        src="images/edit.png"></a></td>
                                                        <td align="right"><a
                                                                    href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                                        src="images/delete.png"></a></td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.panel-body -->

                                    <!-- /.panel -->

                                </div>


                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-body">
                    <table width="100%" border="0">
                        <tr>
                            <td width="100%" align="center"><a href="general_setup.php?o=<?php print $o; ?>&mode=new">
                                    <button type="submit" class="btn btn-success" width="100%">Add
                                        New <?php print $title; ?></button>
                                </a>
                            </td>
                        </tr>
                    </table>

                    <table width="100%" class="table table-striped" border="0">
                        <thead>
                        <tr style="width:100%">
                            <th width="95%"><?php print $title; ?> List</th>
                            <th width="05%">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php if ($o == 'country') {

                            $qry = "SELECT * FROM country order by COUNTRY_ID";
                            $rs = mysqli_query($qry);

                            while ($row = mysqli_fetch_array($rs)) {
                                $CODE = $row['COUNTRY_ID'];
                                $NAME = $row['COUNTRY_NAME'];


                                ?>
                                <tr>
                                    <td>
                                        <a href="definition.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=view"><?php print $NAME; ?></a>
                                    </td>
                                    <td align="right"><a href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img src="images/edit.png"></a></td>
                                </tr>
                            <?php }
                        } ?>

                        <?php if ($o == 'embassy') {

                            $qry = "SELECT * FROM embassy_contact order by EC_ID";
                            $rs = mysqli_query($qry);

                            while ($row = mysqli_fetch_array($rs)) {
                                $CODE = $row['EC_ID'];
                                $NAME = $row['LOCATION'];
                                ?>
                                <tr>
                                    <td>
                                        <a href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=view"><?php print $NAME; ?></a>
                                    </td>
                                    <td align="right"><a
                                                href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                    src="images/edit.png"></a></td>
                                </tr>
                            <?php }
                        } ?>

                        <?php if ($o == 'incident_type') {

                        $qry = "SELECT * FROM incident_type order by INCIDENT_ID";
                        $rs = mysqli_query($qry);

                        while ($row = mysqli_fetch_array($rs)) {
                            $CODE = $row['INCIDENT_ID'];
                            $NAME = $row['INCIDENT_NAME'];

                            ?>
                            <tr>
                                <td>
                                    <a href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=view"><?php print $NAME; ?></a>
                                </td>
                                <td align="right"><a
                                            href="general_setup.php?o=<?php print $o; ?>&id=<?php print $CODE; ?>&mode=edit"><img
                                                src="images/edit.png"></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

        <?php } ?>


        <!-- /#wrapper -->


</body>

</html>
