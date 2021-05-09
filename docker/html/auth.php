<?php
$host = "mysql-server";
$user = "root";
$pass = "secret";
$db = "strava";
//function for refreshing the access_token
function refreshAuthToken (int $clientId){

  global $host, $user, $pass, $db;
  $conn = new mysqli($host,$user,$pass,$db);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT ClientId, refreshToken, clientSecret FROM auth WHERE clientId=$clientId";
  $result = $conn->query($sql);

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
  $conn->close(); 

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

  curl_close($curl);
  return $obj->access_token;
  #echo $response;
}

//funtion for storing the accesstoken
function storeAccessToken($clientId, $accessToken){
  global $host, $user, $pass, $db;
  $conn = new mysqli($host,$user,$pass,$db);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sqlUpdate = "UPDATE auth SET accessToken='$accessToken' WHERE clientId=$clientId";
  $sqlGetAccessToken = "SELECT accessToken FROM auth WHERE clientId=$clientId";
  $resultAccesToken = $conn->query($sqlGetAccessToken);
  
  if ($resultAccesToken->num_rows > 0) {
    
    while($row = $resultAccesToken->fetch_assoc()) {
    $accessTokenDB =  $row["accessToken"]; 
       }
  } else {
    echo "0 results";
  }
  $conn->close(); 
  //compare access token from db and from curl, if different update.
  if ($accessToken =! $accessTokenDB) {
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    if ($conn->query($sqlUpdate) === TRUE) {
      echo "Access Token updated";
    } else {
      echo "Error: " . $sqlUpdate . "<br>" . $conn->error;
    }
    $conn->close(); 
  } else {
    echo "Access Token already up 2 date:)";
  }



}


$accessToken = refreshAuthToken("52753");

storeAccessToken("52753", $accessToken);
echo "<br> new access code $accessToken";

?>


