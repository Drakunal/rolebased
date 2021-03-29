<?php
session_start();
include "connection.php";

if($_POST['type'] == ""){
    $month= date("F");
    $query = mysqli_query($db,"SELECT * from `appointments` where Month(date)=$month;");

    // $query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");

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
        $str .= "<tr><td>{$row['customer_id']}</td><td>{$row['date']}</td><td>{$time}</td></tr>";
    }
}
if($_POST['type'] == "stateData"){


    // $sql =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = {$_POST['id']} AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month";

    $sql="SELECT * from `appointments` where Month(date)={$_POST['id']}";
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

