<?php
include 'connection.php';
showevent();

function showevent(){
global $connect;

  $query = "Select * FROM setup_route;";

  $result = mysqli_query($connect,$query);
  $number_of_rows = mysqli_num_rows($result);
  $response = array();

  if($number_of_rows > 0){
    while ($row = mysqli_fetch_array($result)) {
      
       array_push($response, array(

      "SR_ID" =>$row[0], 
      "SR_NAME" => $row[1],
      "SR_LEVL" => $row[2], 
      "NO_DAYS" => $row[3],
      "SPECIALITY" => $row[4],
      "SEASONS" => $row[5],
      "REMARKS" => $row[6],
      "CREATED_BY" => $row[7],
      "CREATED_DATE" => $row[8],
      "MODIFIED_BY" => $row[9],
      "MODIFIED_DATE" => $row[10]));
      
          
   }
  }
  header('Content-Type: application/json');
  echo json_encode(array("server_response" => $response));
  mysqli_close($connect);
}
?>
