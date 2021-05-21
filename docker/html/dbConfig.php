<?php
function dbConnection(){
//load ini file from conf folder, right change needed
$ini_array = parse_ini_file("./conf/conf.ini", true);

$dbSettings = array();
array_walk_recursive($ini_array, function ($value, $key) use (&$dbSettings){
    $dbSettings[] = $value;
},  $dbSettings);
//print '<pre>';
//print_r($dbSettings);
//print '</pre>';

    
    $conn = mysqli_connect ($dbSettings[0], $dbSettings[1], $dbSettings[2], $dbSettings[3]);
    if($conn === false){
        die("ERROR: Could not connect. " . _connect_error());
       
    }
return $conn;
}

?>