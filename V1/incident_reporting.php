<?php
include 'connection.php';
showevent();

function showevent(){
global $connect;

  $query = "Select * FROM incident_reporting;";

  $result = mysqli_query($connect,$query);
  $number_of_rows = mysqli_num_rows($result);
  $response = array();

  if($number_of_rows > 0){
    while ($row = mysqli_fetch_array($result)) {
      
       array_push($response, array(

      "id" =>$row[0], 
      "name" => $row[1], 
      "latitude" => $row[2],
      "longitude" => $row[3],
      "altitude" => $row[4])); 
   }
  }
  header('Content-Type: application/json');
  echo json_encode(array("data" => $response));
  mysqli_close($connect);
}
?>
