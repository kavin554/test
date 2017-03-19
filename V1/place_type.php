<?php
include 'connection.php';
showevent();

function showevent(){
global $connect;

  $query = "Select * FROM place_type ;";

  $result = mysqli_query($connect,$query);
  $number_of_rows = mysqli_num_rows($result);
  $response = array();

  if($number_of_rows > 0){
    while ($row = mysqli_fetch_array($result)) {
      
       array_push($response, array(

      "PL_ID" =>$row[0], 
      "PL_NAME" => $row[1],
      "PL_IMAGE" => $row[2], 
      "REMARKS" => $row[3],
      "CREATED_BY" => $row[4],
      "CREATED_DATE" => $row[5],
      "MODIFIED_BY" => $row[6],
      "MODIFIED_DATE" => $row[7],
      "STATUS_FLAG" => $row[8]));
      
          
   }
  }
  header('Content-Type: application/json');
  echo json_encode(array("server_response" => $response));
  mysqli_close($connect);
}
?>
