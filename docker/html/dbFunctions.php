<?php

//include config file
require_once ('dbConfig.php');


function storeAccessToken($clientId, $accessToken){
  $dbConn = dbConnection();

  $sqlUpdate = "UPDATE auth SET accessToken='$accessToken' WHERE clientId=$clientId";
  $sqlGetAccessToken = "SELECT accessToken FROM auth WHERE clientId=$clientId";
  $resultAccesToken = $dbConn->query($sqlGetAccessToken);
  
  if ($resultAccesToken->num_rows > 0) {
    
    while($row = $resultAccesToken->fetch_assoc()) {
    $accessTokenDB =  $row["accessToken"]; 
       }
  } else {
        echo "0 results";
      }
     // $dbConn->close(); 
      echo "Token from the db = $accessTokenDB<br>";
      //compare access token from db and from curl, if different update.
      if ($accessToken != $accessTokenDB) {
        if ($dbConn->connect_error) {
          die("Connection failed: " . $dbConn->connect_error);
        }
        if ($dbConn->query($sqlUpdate) === TRUE) {
          echo "Access Token updated";
        } else {
          echo "Error: " . $sqlUpdate . "<br>" . $dbConn->error;
        }
       // $dbConn->close(); 
      } else {
        echo "Access Token already up 2 date:)";
      }
      
  mysqli_close($dbConn);

}

//function for refreshing the access_token
function refreshAuthToken ($clientId){
  $dbConn = dbConnection();

  $sql = "SELECT ClientId, refreshToken, clientSecret FROM auth WHERE clientId=$clientId";
  $result = $dbConn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
     # echo "clientid: " . $row["ClientId"]. " - refreshToken: " . $row["refreshToken"]. "  - ClientSecret: " . $row["clientSecret"]. "<br>";
      $clientSecret =  $row["clientSecret"]; 
      $refreshToken = $row["refreshToken"];
    
    }
  } else {
    echo "0 results";
  }
  

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://www.strava.com/oauth/token?client_id=$clientId&client_secret=$clientSecret&refresh_token=$refreshToken&grant_type=refresh_token",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_HTTPHEADER => array(
      'Cookie: _strava4_session=qmofqug171lg7rjhftkjreua8nk7ccvf'
    ),
  ));

  $obj = json_decode($response = curl_exec($curl));
  mysqli_close($dbConn);
  curl_close($curl);
  return $obj->access_token;
  #echo $response;
}

function getAccessToken (int $clientId){
  $dbConn = dbConnection();
  $sql = "SELECT accessToken FROM auth WHERE clientId=$clientId";
  $result = $dbConn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
     
      $accessToken =  $row["accessToken"]; 
      return $accessToken;
    }

  } else {
    echo "(getaccesstoken) could not get receive accesToken for clientid $clientId";
  }

  mysqli_close($dbConn);

}


function initRideLoad($clientId){
  $accessToken = getAccessToken($clientId);
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  $curl = curl_init();
  unset($page);
  $page = 1;
  while($response1 !="Array ( ) "){
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://www.strava.com/api/v3/athlete/activities?page=$page&per_page=30&access_token=$accessToken",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
  ));
  
  $response = curl_exec($curl);
  
  curl_close($curl);
  $response1 = json_decode($response);
  //nice print of json /array in php(line below)
  #echo '<pre>'; print_r($response1); echo '</pre>';
  //loops throuch the curl data page
   print_r ($response1);
  foreach ($response1 as $value){
      //maps variable
      $id = $value->id;
      $name = $value->name;
      $athleteID = $value->athlete->id;
      $distance = $value->distance;
      $moving_time = $value->moving_time;
      $elapsed_time = $value->elapsed_time;
      $type = $value->type;
      $start_date = substr($value->start_date,0,-1);
      $start_data_local = substr($value->start_date_local,0,-1);
      $timezone = $value->timezone;
      if($value->trainer) {
         $trainer = 1;
      }
      else {
          $trainer = 0;
      }
     
     if($value->commute){
          $commute = 1;
      }
      else{
          $commute = 0;
      }
     
      if($value->manual){
          $manual = 1;
      }
      else{
          $manual = 0;
      }
      $gear_id = $value->gear_id;
      
  
      echo "id = $id name= $name athlete =$athleteID distance =$distance moving_time = $moving_time elapsed_time $elapsed_time type $type startdate = $start_date start_local =$start_data_local  timezome = $timezone trainer = $trainer commute= $commute manual = $manual Gear= $gear_id athlete id $athleteID<br>";
      //database variable
      $dbConn = dbConnection();

      $stmt = $dbConn->prepare("INSERT INTO activities (id, athleteID, name, distance, moving_time, elapsed_time, type, start_date, start_date_local, timezone, trainer, commute, manual, gear_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      echo $dbConn->error;
      $stmt->bind_param("iisdiissssiiis", $id, $athleteID, $name, $distance, $moving_time, $elapsed_time, $type, $start_date, $start_data_local, $timezone, $trainer, $commute, $manual, $gear_id );
      
      $stmt->execute(); 
      echo "New records stored in database <br>";
      $stmt->close();
      $dbConn->close();
      
  }
   
  $page++;
  }

}






?>