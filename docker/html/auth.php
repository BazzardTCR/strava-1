<?php
require_once ('dbFunctions.php');

//52753 -> clientID
$accessToken = refreshAuthToken($_POST["clienID"]);

storeAccessToken($_POST["clienID"], $accessToken);
echo "<br> new access code $accessToken";

?>


