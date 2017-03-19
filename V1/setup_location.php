<?php
include 'connection.php';
showevent();

function showevent(){
global $connect;

  $query = "Select * FROM setup_location;";

  $result = mysqli_query($connect,$query);
  $number_of_rows = mysqli_num_rows($result);
  $response = array();

  if($number_of_rows > 0){
    while ($row = mysqli_fetch_array($result)) {
      
       array_push($response, array(

      "SL_ID" =>$row[0], 
      "PL_ID" => $row[1],
      "SL_NAME" => $row[2], 
      "SL_LATITUDE" => $row[3],
      "SL_LONGATUDE" => $row[4],
      "SL_ALTITUDE" => $row[5],
      "SL_DESC" => $row[6],
      "REMARKS" => $row[7],
      "CREATED_BY" => $row[8],
      "CREATED_DATE" => $row[9],
      "MODIFIED_BY" => $row[10],
      "MODIFIED_DATE" => $row[11]));
      
          
   }
  }
  header('Content-Type: application/json');
  echo json_encode(array("server_response" => $response));
  mysqli_close($connect);
}
?>
