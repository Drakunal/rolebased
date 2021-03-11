
	<!-- // $db=mysqli_connect("localhost","root","","rolebased"); // server name, username, password, database name
	// session_start(); -->


<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$db = new mysqli($servername, $username, $password,"rolebased");

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
// echo "Connected successfully";
?>