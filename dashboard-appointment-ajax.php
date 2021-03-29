<?php
session_start();
include "connection.php";

if($_POST['type'] == ""){
    $month= date("F");
    $year=date("Y");
    $query = mysqli_query($db,"SELECT * from `appointments` where Month(date)=$month AND Year(date)=$year;");

    // $query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");

    $str = "<div class='card-header'>
    <h4 class='card-subtitle text-muted'>Appointments for the selected employee</h4>
</div><table class='table table-bordered' ><thead>
<tr>
    <th>Employee Name</th>
    <th>Customer Name</th>
    <th>Date</th>
    <th>Time</th>
</tr>
</thead><tbody>";
    while($row = mysqli_fetch_assoc($query)){
        $str .= "<tr><td>{$row['employee_id']}</td><td>{$row['customer_id']}</td><td>{$row['date']}</td><td>{$time}</td></tr>";
    }
}
if($_POST['type'] == "stateData"){


    // $sql =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = {$_POST['id']} AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month";

    $sql="SELECT * from `appointments` where Month(date)={$_POST['id']} AND Year(date)={$_POST['year']}";
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
        <th>Employee Name</th>
        <th>Customer Name</th>
        <th>Date</th>
        <th>Time</th>
    </tr>
    </thead><tbody>";
    while($row = mysqli_fetch_assoc($query)){
        // echo $row['employee_id'];
        $employee_id=$row['employee_id'];
        echo $employee_id;
        // $role="employee";
        $sql1="SELECT name from `users` where id=$employee_id";
        $query1 = mysqli_query($db,$sql1) or die("Query Unsuccessful.");
        $row1 = mysqli_fetch_assoc($query1);
        
        $time=date('g:ia', strtotime($row['time']));
      $str .= "<tr><td>{$row1['name']}</td><td>{$row['customer_id']}</td><td>{$row['date']}</td><td>{$time}</td></tr>";
    }
    $str .= "</tbody>
    </table>";
    }

    
}


if($_POST['type'] == "yearData"){


    // $sql =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = {$_POST['id']} AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month";

    $sql="SELECT * from `appointments` where Year(date)={$_POST['year']} AND MONTH(date)={$_POST['id']}";
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
        <th>Employee Name</th>
        <th>Customer Name</th>
        <th>Date</th>
        <th>Time</th>
    </tr>
    </thead><tbody>";
    while($row = mysqli_fetch_assoc($query)){
        $time=date('g:ia', strtotime($row['time']));
      $str .= "<tr><td>{$row['employee_id']}</td><td>{$row['customer_id']}</td><td>{$row['date']}</td><td>{$time}</td></tr>";
    }
    $str .= "</tbody>
    </table>";
    }

    
}

echo $str;
?>

