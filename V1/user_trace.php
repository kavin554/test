<?php
include 'connection.php';
showevent();

function showevent(){
global $connect;

  $query = "Select * FROM user_trace;";

  $result = mysqli_query($connect,$query);
  $number_of_rows = mysqli_num_rows($result);
  $response = array();

  if($number_of_rows > 0){
    while ($row = mysqli_fetch_array($result)) {
      
       array_push($response, array(

      "TRACE_ID" =>$row[0], 
      "USER_ID" => $row[1],
      "ROUTE" => $row[2], 
      "PLACE_NAME" => $row[3],
      "TIME_STAMPS" => $row[4],
      "DTAE" => $row[5],
      "LATITUDE" => $row[6],
      "LONGITUDE" => $row[7],
      "ALTITUDE" => $row[8]));
      
          
   }
  }
  header('Content-Type: application/json');
  echo json_encode(array("server_response" => $response));
  mysqli_close($connect);
}
?>
