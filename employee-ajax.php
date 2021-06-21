<?php
session_start();
include "connection.php";

if($_POST['type'] == ""){
    $role='employee';
    $query = mysqli_query($db,"SELECT id,name from `users` where role='$role' AND deleted_at is NULL;");

    // $query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");

    $str = "";
    while($row = mysqli_fetch_assoc($query)){
      $str .= "<option value='".$row['id']."'>".$row['name']."</option>";
    }
}
else if($_POST['type'] == "stateData"){


    $sql =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = {$_POST['id']} AND deleted_at is NULL AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month";

    $query = mysqli_query($db,$sql) or die("Query Unsuccessful.");
 
    if(mysqli_num_rows ( $query )==0){
        $str="<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Möten för vald medarbetare</h4>
    </div> <p>Inga möten tillgängliga</p>";
    }
    else{
        $str = "<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Möten för vald medarbetare</h4>
    </div><table class='table table-bordered' ><thead>
    <tr>
        <th>Kund</th>
        <th>Datum</th>
        <th>Tid</th>
    </tr>
    </thead><tbody>";
    while($row = mysqli_fetch_assoc($query)){

        $customer_id=$row['customer_id'];
        // echo $employee_id;
        // $role="employee";
        $sql2="SELECT name from `users` where id=$customer_id";
        $query2 = mysqli_query($db,$sql2) or die("Query Unsuccessful.");
        $row2 = mysqli_fetch_assoc($query2);
        $time=date('G:i', strtotime($row['time']));
      $str .= "<tr><td>{$row2['name']}</td><td>{$row['date']}</td><td>{$time}</td></tr>";
    }
    $str .= "</tbody>
    </table>";
    }

    
}

echo $str;
?>

