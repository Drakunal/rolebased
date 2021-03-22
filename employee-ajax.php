<?php
session_start();
include "connection.php";

if($_POST['type'] == ""){
    $role='employee';
    $query = mysqli_query($db,"SELECT id,name from `users` where role='$role';");

    // $query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");

    $str = "";
    while($row = mysqli_fetch_assoc($query)){
      $str .= "<option value='".$row['id']."'>".$row['name']."</option>";
    }
}
else if($_POST['type'] == "stateData"){

    $sql = "SELECT * FROM appointments WHERE employee_id = {$_POST['id']}";

    $query = mysqli_query($db,$sql) or die("Query Unsuccessful.");

    $str = "";
    while($row = mysqli_fetch_assoc($query)){
      $str .= "<tr><td>{$row['id']}</td><td>{$row['customer_id']}</td></tr>";
    }
}
echo $str;
?>

