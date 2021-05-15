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
  $sqlCreateTable = "CREATE TABLE `strava`.`activities` ( `athleteID` INT NOT NULL,
  `name` VARCHAR NOT NULL, 
  `distance` DECIMAL NOT NULL, 
  `moving_time` INT NOT NULL, 
  'elapsed_time' INT NOT NULL, 
  'type' VARCHAR NOT NULL, 
  'id' INT PRIMARY KEY, 
  'start_date' VARCHAR NOT NULL, 
  'start_data_local' VARCHAR NOT NULL, 
  'timezone' VARCHAR NOT NULL,
  'trainer' BOOLEAN NOT NULL, 
  'commute' BOOLEAN NOT NULL, 
  'manual' BOOLEAN NOT NULL, 
  'gear_id' VARCHAR NOT NULL),
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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