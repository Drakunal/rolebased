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
 
    if(mysqli_num_rows ( $query )==0){
        $str="<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Appointments for the selected employee</h4>
    </div> <p>No appointments available</p>";
    }
    else{
        $str = "<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Appointments for the selected employee</h4>
    </div><table class='table table-bordered' ><thead>
    <tr>
        <th>Customer Name</th>
        <th>Date</th>
        <th>Time</th>
    </tr>
    </thead><tbody>";
    while($row = mysqli_fetch_assoc($query)){
        $time=date('g:ia', strtotime($row['time']));
      $str .= "<tr><td>{$row['customer_id']}</td><td>{$row['date']}</td><td>{$time}</td></tr>";
    }
    $str .= "</tbody>
    </table>";
    }

    
}

echo $str;
?>

