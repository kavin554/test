<?php
include 'connection.php';
showevent();

function showevent(){
global $connect;

  $query = "Select * FROM weather_data;";

  $result = mysqli_query($connect,$query);
  $number_of_rows = mysqli_num_rows($result);
  $response = array();

  if($number_of_rows > 0){
    while ($row = mysqli_fetch_array($result)) {
      
       array_push($response, array(

      "WEATHER_ID" =>$row[0], 
      "PL_ID" => $row[1],
      "DATE" => $row[2], 
      "TIME" => $row[3],
      "RAIN" => $row[4],
      "HUMIDITY" => $row[5],
      "SUNSHINE" => $row[6],
      "WIND" => $row[7]));
      
          
   }
  }
  header('Content-Type: application/json');
  echo json_encode(array("server_response" => $response));
  mysqli_close($connect);
}
?>

     