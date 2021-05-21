<!-- <?php

#define('host', 'user', 'pass', 'db');

// Parse without sections
//$ini_array = parse_ini_file("./conf/conf.ini");
//print_r($ini_array);

// Parse with sections
$ini_array = parse_ini_file("./conf/conf.ini", true);


$dbSettings = array();
array_walk_recursive($ini_array, function ($value, $key) use (&$dbSettings){
    $dbSettings[] = $value;
}, $dbSettings);
print '<pre>';
print_r($dbSettings);
print '</pre>';
echo $dbSettings[0];
?>
 -->


