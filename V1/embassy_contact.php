<?php
include 'connection.php';
showevent();

function showevent(){
global $connect;

  $query = "Select * FROM 'embassy_contact' 'c'
  LEFT JOIN 'embassy' 'e' ON ('c'.'e_id' = 'e'. 'e_id') ORDER BY 'e'. 'e_id';";

  $result = mysqli_query($connect,$query);
  $number_of_rows = mysqli_num_rows($result);
  $response = array();

  if($number_of_rows > 0){
    while ($row = mysqli_fetch_array($result)) {
      
       array_push($response, array(

      "embassyContactId" =>$row[0], 
      "location" => $row[1],
      "contactPerson" => $row[2], 
      "position" => $row[3],
      "mobileNumber" => $row[4],
      "remarks" => $row[5]));
      
          
   }
  }
  header('Content-Type: application/json');
  echo json_encode(array("server_response" => $response));
  mysqli_close($connect);
}
?>
