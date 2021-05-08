<?php
$host = "mysql-server";
$user = "root";
$pass = "secret";
$db = "strava";

 // Create connection
$conn = new mysqli($host, $user, $pass, $db);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO auth (ClientId, refreshToken, clientSecret)
VALUES ('52753', '780372a3a3bb4a6fe56b143df30923db40c085af', '63c0d4c5e6662fef0d2474921f1b9f9bf7b1a289')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close(); 


function readData (int $clientId){
    //get global vars
    global $host, $user, $pass, $db;
    // Create connection
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
        $authcode =  $row["clientSecret"]; // 42
        return $authcode;
      }
    } else {
      echo "0 results";
    }

    $conn->close();
    
    
}



$authcode = readData("52753");
echo $authcode;
?> 