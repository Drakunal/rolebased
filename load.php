<?php
session_start();
include "connection.php";
if (!isset($_SESSION['login_user']) || $_SESSION['role'] != "admin") {
    header("location:index.php");
}
?>
<?php

//load.php

// $connect = new PDO('mysql:host=localhost;dbname=testing', 'root', '');

$data = array();

$query = "SELECT * FROM events ORDER BY id";
$result = mysqli_query($db,$query);

// $statement = $db->prepare($query);

// $statement->execute();

// $result = $statement->fetchAll();

while($row = $result->fetch_assoc())
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'start'   => $row["start_event"],
  'customer_id'   => $row["customer_id"],
  // 'end'   => $row["end_event"]
 );
}

echo json_encode($data);

?>
