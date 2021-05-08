<?php
$host = "mysql-server";
$user = "root";
$pass = "secret";
$db = "strava";
//function for refreshing the access_token
function AuthToken (int $clientId){

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
  $sql = "UPDATE auth SET accessToken='$accessToken' WHERE clientId=$clientId";
 # $sql = "INSERT INTO auth (ClientId, refreshToken, clientSecret)
  #VALUES ('52753', '780372a3a3bb4a6fe56b143df30923db40c085af', '63c0d4c5e6662fef0d2474921f1b9f9bf7b1a289')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

 $conn->close(); 
}


$accessToken = AuthToken("52753");

storeAccessToken("52753", $accessToken);
echo $accessToken;

?>


