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
$employee_id=$_GET['ids'];
// $employee_id="'".$employee_id."'";
$data = array();
if($employee_id!=0){
  $query = "SELECT * FROM events where employee_id='$employee_id' or employee_id is NULL ORDER BY id";

}
else{
  $query = "SELECT * FROM events ORDER BY id";
}


$result = mysqli_query($db,$query) or die("BAL");
// echo "HI";
// $statement = $db->prepare($query);

// $statement->execute();

// $result = $statement->fetchAll();

while($row = $result->fetch_assoc())
{
    // print_r($row);
    if($row["end_event"]==NULL){
      $data[] = array(
        'id'   => $row["id"],
        'title'   => $row["title"],
        'start'   => $row["start_event"],
        'customer_id'   => $row["customer_id"],
        'color' => $row["color"],
      //   'refetch'=>true,
      //   'rerender'=>true,
        
        // 'end'   => $row["end_event"]
       );

    }
    else{
      $data[] = array(
        'id'   => $row["id"],
        'title'   => $row["title"],
        'start'   => $row["start_event"],
        'end'   => $row["end_event"],
        'customer_id'   => $row["customer_id"],
        'color' => $row["color"],
      //   'refetch'=>true,
      //   'rerender'=>true,
        
        // 'end'   => $row["end_event"]
       );
    }

}
echo json_encode($data);

?>
