<?php
include 'connection.php';
showevent();

function showevent(){
global $connect;

  $query = "Select * FROM country;";

  $result = mysqli_query($connect,$query);
  $number_of_rows = mysqli_num_rows($result);
  $response = array();

  if($number_of_rows > 0){
    while ($row = mysqli_fetch_array($result)) {
      
       array_push($response, array(

      "countryId" =>$row[0], 
      "coountryCode" => $row[1],
      "countryName" => $row[2], 
      "countryConteinent" => $row[3],
      "countryCurrency" => $row[4],
      "countryCurrencySymbol" => $row[5],
      "countryFlagImage" => $row[6],
      "remarks" => $row[7]));
      
          
   }
  }
  header('Content-Type: application/json');
  echo json_encode(array("server_response" => $response));
  mysqli_close($connect);
}
?>
