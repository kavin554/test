<?php
include 'connection.php';
showevent();

function showevent(){
global $connect;

  $query = "Select * FROM weather_forecast_log;";

  $result = mysqli_query($connect,$query);
  $number_of_rows = mysqli_num_rows($result);
  $response = array();

  if($number_of_rows > 0){
    while ($row = mysqli_fetch_array($result)) {
      
       array_push($response, array(

      "WF_ID" =>$row[0], 
      "WEATHER_ID" => $row[1],
      "WF_DATE" => $row[2], 
      "WF_DESC" => $row[3],
      "TEMP_MAX" => $row[4],
      "TEMP_MIN" => $row[5],
      "WF_HUMIDITY" => $row[6],
      "WF_VISUALITY" => $row[7],
      "WF_WIND" => $row[8],
      "WIND_DIRECTION" => $row[9],
      "WF_PRESSURE" => $row[10],
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
