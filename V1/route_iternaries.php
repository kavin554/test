<?php
include 'connection.php';
showevent();

function showevent(){
global $connect;

  $query = "Select * FROM route_iteneraries;";

  $result = mysqli_query($connect,$query);
  $number_of_rows = mysqli_num_rows($result);
  $response = array();

  if($number_of_rows > 0){
    while ($row = mysqli_fetch_array($result)) {
      
       array_push($response, array(

      "RI_ID" =>$row[0], 
      "SR_CODE" => $row[1],
      "DAY" => $row[2], 
      "SR_START" => $row[3],
      "SR_END" => $row[4],
      "DURATION_HOURS" => $row[5],
      "RI_DESC" => $row[6],
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

      
      
