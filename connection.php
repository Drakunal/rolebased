<?php
$servername = "swipemedia.se.mysql";
$username = "swipemedia_semonika2";
$password = "qwerty1234";

// Create connection
$db = new mysqli($servername, $username, $password,"swipemedia_semonika2");

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
 //echo "Connected successfully";
?>