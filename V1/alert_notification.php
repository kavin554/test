<?php
include 'connection.php';
showevent();

function showevent(){
global $connect;

  $query = "Select * FROM alert_notification;";

  $result = mysqli_query($connect,$query);
  $number_of_rows = mysqli_num_rows($result);
  $response = array();

  if($number_of_rows > 0){
    while ($row = mysqli_fetch_array($result)) {
      
       array_push($response, array(

      "AN_ID" =>$row[0], 
      "AN_DATE" => $row[1],
      "AN_TITLE" => $row[2], 
      "AN_DESC" => $row[3],
      "IMAGE_PATH" => $row[4],
      "REMARKS" => $row[5]));
      
          
   }
  }
  header('Content-Type: application/json');
  echo json_encode(array("server_response" => $response));
  mysqli_close($connect);
}
?>
