<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.strava.com/api/v3/athlete/activities?page=1&per_page=10&access_token=e6e1b03062a57de75333947810e397e3821b99de',
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
    $servername = "mysql-server";
    $username = "root";
    $password = "secret";
    $dbname = "strava";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("INSERT INTO activities (id, athleteID, name, distance, moving_time, elapsed_time, type, start_date, start_date_local, timezone, trainer, commute, manual, gear_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    echo $conn->error;
    $stmt->bind_param("iisdiissssiiis", $id, $athleteID, $name, $distance, $moving_time, $elapsed_time, $type, $start_date, $start_data_local, $timezone, $trainer, $commute, $manual, $gear_id );
    
    $stmt->execute(); 
    echo "New records stored in database <br>";
    $stmt->close();
    $conn->close();
    
}

?>

