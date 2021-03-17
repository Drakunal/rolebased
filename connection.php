<?php
$servername = "10.27.18.48";
$username = "swipemedia_serolebased@10.27.18.48";
$password = "peteradmin123";

// Create connection
$db = new mysqli($servername, $username, $password,"swipemedia_serolebased");

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
echo "Connected successfully";
?>