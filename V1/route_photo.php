<?php
include 'connection.php';
showevent();

function showevent(){
global $connect;

  $query = "Select * FROM route_photo;";

  $result = mysqli_query($connect,$query);
  $number_of_rows = mysqli_num_rows($result);
  $response = array();

  if($number_of_rows > 0){
    while ($row = mysqli_fetch_array($result)) {
      
       array_push($response, array(

      "RP_ID" =>$row[0], 
      "SR_CODE" => $row[1],
      "DAY" => $row[2], 
      "RP_DEFAULT" => $row[3],
      "RP_IMAGE_DESC" => $row[4],
      "CREATED_BY" => $row[5],
      "CREATED_DATE" => $row[6],
      "MODIFIED_BY" => $row[7],
      "MODIFIED_DATE" => $row[8]));
      
          
   }
  }
  header('Content-Type: application/json');
  echo json_encode(array("server_response" => $response));
  mysqli_close($connect);
}
?>
