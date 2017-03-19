<?php
include 'connection.php';
showevent();

function showevent(){
global $connect;

  $query = "Select * FROM user_registration;";

  $result = mysqli_query($connect,$query);
  $number_of_rows = mysqli_num_rows($result);
  $response = array();

  if($number_of_rows > 0){
    while ($row = mysqli_fetch_array($result)) {
      
       array_push($response, array(

      "USER_ID" =>$row[0], 
      "USER_NMAE" => $row[1],
      "EMAIL_1" => $row[2], 
      "EMAIL_2" => $row[3],
      "EMERGENCY_CONTACT_1" => $row[4],
      "EMERGENCY_CONTACT_2" => $row[5],
      "EMERGENCY_CONTACT_3" => $row[6],
      "NATIONALITY" => $row[7],
      "ADDRESS_1" => $row[8],
      "ADDRESS_2" => $row[9],
      "PASSWORD_NO" => $row[10],
      "VISA_ISSUE_DATE" => $row[11],
      "VISA_EXPIRY_DATE" => $row[12]));
      
          
   }
  }
  header('Content-Type: application/json');
  echo json_encode(array("server_response" => $response));
  mysqli_close($connect);
}
?>
