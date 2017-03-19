<?php
include 'connection.php';
showevent();

function showevent(){
global $connect;

  $query = "Select * FROM embassy;";


  $result = mysqli_query($connect,$query);
  $number_of_rows = mysqli_num_rows($result);
  $response = array();

  if($number_of_rows > 0){
    while ($row = mysqli_fetch_array($result)) {
      
       array_push($response, array(

      "embassyId" =>$row[0], 
      "embassyName" => $row[1], 
      "embassyLocation" => $row[2]));         
   }
  }
  header('Content-Type: application/json');
  echo json_encode(array("server_response" => $response));
  mysqli_close($connect);
}
?>
