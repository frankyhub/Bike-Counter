<!--
hoki-database.php
# Zugangsdaten DB4333920
$db_server = 'rdbms.strato.de';
$db_benutzer = 'U4333920';
$db_passwort = 'iSy088@2020';
$db_name = 'DB4333920';

  $dbname = "frankyhu_hoki_data";
  $username = "frankyhu_hoki";
  $password = "hoki#2021";
-->

<?php

  $servername = "rdbms.strato.de";
  // dbname
  $dbname = "dbs1699165";
  // username
  $username = "dbu389146";
  // password
  $password = "iSy088@2020";

  function insertReading($sensor, $location, $value1, $value2, $value3) {
    global $servername, $username, $password, $dbname;

    // DB-Verbindung
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check DB-Verbindungn
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO SensorData (sensor, location, value1, value2, value3)
    VALUES ('" . $sensor . "', '" . $location . "', '" . $value1 . "', '" . $value2 . "', '" . $value3 . "')";

    if ($conn->query($sql) === TRUE) {
      return "New record created successfully";
    }
    else {
      return "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
  }
  
  function getAllReadings($limit) {
    global $servername, $username, $password, $dbname;

    // DB-Verbindung herstellen
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check DB-Verbindung
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, sensor, location, value1, value2, value3, reading_time FROM SensorData order by reading_time desc limit " . $limit;
    if ($result = $conn->query($sql)) {
      return $result;
    }
    else {
      return false;
    }
    $conn->close();
  }
  function getLastReadings() {
    global $servername, $username, $password, $dbname;

    // DB-Verbindung herstellen
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check DB-Verbindung
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, sensor, location, value1, value2, value3, reading_time FROM SensorData order by reading_time desc limit 1" ;
    if ($result = $conn->query($sql)) {
      return $result->fetch_assoc();
    }
    else {
      return false;
    }
    $conn->close();
  }

  function minReading($limit, $value) {
     global $servername, $username, $password, $dbname;

    // DB-Verbindung herstellen
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check DB-Verbindung
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT MIN(" . $value . ") AS min_amount FROM (SELECT " . $value . " FROM SensorData order by reading_time desc limit " . $limit . ") AS min";
    if ($result = $conn->query($sql)) {
      return $result->fetch_assoc();
    }
    else {
      return false;
    }
    $conn->close();
  }

  function maxReading($limit, $value) {
     global $servername, $username, $password, $dbname;

    // DB-Verbindung herstellen
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check DB-Verbindung
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT MAX(" . $value . ") AS max_amount FROM (SELECT " . $value . " FROM SensorData order by reading_time desc limit " . $limit . ") AS max";
    if ($result = $conn->query($sql)) {
      return $result->fetch_assoc();
    }
    else {
      return false;
    }
    $conn->close();
  }

  function avgReading($limit, $value) {
     global $servername, $username, $password, $dbname;

    // DB-Verbindung herstellen
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check DB-Verbindung
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT AVG(" . $value . ") AS avg_amount FROM (SELECT " . $value . " FROM SensorData order by reading_time desc limit " . $limit . ") AS avg";
    if ($result = $conn->query($sql)) {
      return $result->fetch_assoc();
    }
    else {
      return false;
    }
    $conn->close();
  }
?>