<?php
$host = 'std-mysql';
$db = 'std_2070_bd';
$username = 'std_2070_bd';
$password = '12345678';
$conn = new mysqli($host, $username, $password, $db);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

?>