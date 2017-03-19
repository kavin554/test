<?php
include 'connection.php';
showevent();

function showevent(){
global $connect;

  $query = "Select * FROM user_permission;";

  $result = mysqli_query($connect,$query);
  $number_of_rows = mysqli_num_rows($result);
  $response = array();

  if($number_of_rows > 0){
    while ($row = mysqli_fetch_array($result)) {
      
       array_push($response, array(

      "UP_ID" =>$row[0], 
      "USER_ID" => $row[1],
      "UP_DEVICE" => $row[2], 
      "SR_ID" => $row[3],
      "UP_ISSUE_DATE" => $row[4],
      "UP_EXPIRY_DATE" => $row[5]));  
          
   }
  }
  header('Content-Type: application/json');
  echo json_encode(array("server_response" => $response));
  mysqli_close($connect);
}
?>
