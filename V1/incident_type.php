<?php
include 'connection.php';

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

// retrieve the table and key from the path
$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
$key = array_shift($request)+0;
 
// escape the columns and values from the input object
$columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));
$values = array_map(function ($value) use ($link) {
  if ($value===null) return null;
  return mysqli_real_escape_string($link,(string)$value);
},array_values($input));
 
// build the SET part of the SQL command
$set = '';
for ($i=0;$i<count($columns);$i++) {
  $set.=($i>0?',':'').'`'.$columns[$i].'`=';
  $set.=($values[$i]===null?'NULL':'"'.$values[$i].'"');
}
 
// create SQL based on HTTP method
switch ($method) {
  case 'GET':
    $sql = "select * from `$incident_type`".($key?" WHERE INCIDENT_ID=$key":''); break;
  case 'PUT':
    $sql = "update `$incident_type` set $set where INCIDENT_ID=$key"; break;
  case 'POST':
    $sql = "insert into `$incident_type` set $set"; break;
  case 'DELETE':
    $sql = "delete `$incident_type` where INCIDENT_ID=$key"; break;
}


// function showevent(){


  

// global $connect;

//   $query = "Select * FROM incident_type;";

//   $result = mysqli_query($connect,$query);
//   $number_of_rows = mysqli_num_rows($result);
//   $response = array();

//   if($number_of_rows > 0){
//     while ($row = mysqli_fetch_array($result)) {
      
//        array_push($response, array(

//       "id" =>$row[0], 
//       "name" => $row[1],
//       "type" => $row[2]));
      
          
//    }
//   }




// excecute SQL statement
$result = mysqli_query($link,$sql);
 
// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error());
}
 
// print results, insert id or affected row count
if ($method == 'GET') {
  if (!$key) echo '[';
  for ($i=0;$i<mysqli_num_rows($result);$i++) {
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
  }
  if (!$key) echo ']';
} elseif ($method == 'POST') {
  echo mysqli_insert_id($link);
} else {
  echo mysqli_affected_rows($link);
}
 
// close mysql connection
mysqli_close($link);