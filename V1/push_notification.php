<?php
include 'connection.php';
showevent();

function showevent(){
global $connect;

  $query = "Select * FROM push_notification;";

  $result = mysqli_query($connect,$query);
  $number_of_rows = mysqli_num_rows($result);
  $response = array();

  if($number_of_rows > 0){
    while ($row = mysqli_fetch_array($result)) {
      
       array_push($response, array(

      "PN_ID" =>$row[0], 
      "PN_DATE" => $row[1],
      "PN_TITLE" => $row[2], 
      "PN_DESC" => $row[3],
      "REMARKS" => $row[4],
      "IMAGE_PATH" => $row[5],
      "IMEI_NUMBER" => $row[6],
      "MOBILE_NUMBER" => $row[7],
      "LATITUDE" => $row[8],
      "LONGATUDE" => $row[9],
      "ALTITUDE" => $row[10]));
      
          
   }
  }
  header('Content-Type: application/json');
  echo json_encode(array("server_response" => $response));
  mysqli_close($connect);
}
?>
