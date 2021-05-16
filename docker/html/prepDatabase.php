<?php
$host = "mysql-server";
$user = "root";
$pass = "secret";
$db = "strava";
$conn = new mysqli($host, $user, $pass, $db);
 // Check connection
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sqlCreateDatabase = "CREATE DATABASE activities";
  $sqlCreateTable = "CREATE TABLE `activities` (
    `athleteID` int(10) UNSIGNED NOT NULL,
    `name` varchar(200) NOT NULL,
    `distance` double(7,1) UNSIGNED NOT NULL,
    `moving_time` int(8) UNSIGNED NOT NULL,
    `elapsed_time` int(8) UNSIGNED NOT NULL,
    `type` varchar(10) NOT NULL,
    `id` int(10) NOT NULL,
    `start_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `start_data_local` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `timezone` varchar(50) NOT NULL,
    `trainer` tinyint(1) NOT NULL,
    `commute` tinyint(1) NOT NULL,
    `manual` tinyint(1) NOT NULL,
    `gear_id` varchar(8) NOT NULL
  )";

  

  // if ($conn->query($sqlCreateDatabase) === TRUE) {
  //   echo "Database created successfully";
  // } else {
  //   echo "Error creating database: " . $conn->error;
  // }
  if ($conn->query($sqlCreateTable) === TRUE) {
    echo "Database created successfully";
  } else {
    echo "Error creating database: " . $conn->error;
  }

  $conn->close();