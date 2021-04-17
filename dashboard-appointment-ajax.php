<?php
session_start();
include "connection.php";

if($_POST['type'] == ""){
    $month= date("F");
    $year=date("Y");
    $null=null;
    $query = mysqli_query($db,"SELECT * from `appointments` where Month(date)=$month AND Year(date)=$year AND deleted_at is NULL;")or die("Query Unsuccessful.");
    // echo $month;
    // $query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");
    if(mysqli_num_rows ( $query )==0){
        $str="<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Bokningar denna månad</h4>
    </div> <p>Inga bokningar tillgängliga</p>";
    }else{
    $str = "<div class='card-header'>
    <h4 class='card-subtitle text-muted'>Bokningar denna månad</h4>
</div><div class='table-responsive'><table class='table table-bordered' ><thead>
<tr>
    <th>Employee Name</th>
    <th>Customer Name</th>
    <th>Date</th>
    <th>Day</th>
    <th>Time</th>
    <th>Actions</th>
</tr>
</thead><tbody>";
    while($row = mysqli_fetch_assoc($query)){
        $day=date("l", strtotime($row['date']));
        $appointment_id=$row['id'];
        $str .= "<tr><td>{$row['employee_id']}</td><td>{$row['customer_id']}</td><td>{$row['date']}</td><td>{$day}</td><td>{$time}</td><td><button class='btn btn-primary btn-sm'><i class='fa fa-question'></i><a style='color:white;text-decoration: none;' href='appointment-reschedule.php?id=$appointment_id' onclick='return myFunction1($appointment_id)'>Reschedule</a></button>&nbsp<button class='btn btn-danger '><i class='fas fa-times'></i> <a style='color:white;text-decoration: none;' href='appointment-delete.php?id=$appointment_id' onclick='return myFunction($appointment_id)'>Cancel</a></button></td></tr>";
    }}
}
if($_POST['type'] == "stateData"){

    $null=null;
    // $sql =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = {$_POST['id']} AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month";
    $employee_id1=$_POST['e_id'];
    if($employee_id1!=0){
        $sql="SELECT * from `appointments` where Month(date)={$_POST['id']} AND Year(date)={$_POST['year']} AND employee_id=$employee_id1 AND deleted_at is NULL ";


    }
    else{
        $sql="SELECT * from `appointments` where Month(date)={$_POST['id']} AND Year(date)={$_POST['year']} AND deleted_at is NULL";

    }
    $query = mysqli_query($db,$sql) or die("Query Unsuccessful.");
 
    if(mysqli_num_rows ( $query )==0){
        $str="<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Bokningar denna månad</h4>
    </div> <p>Inga bokningar tillgängliga</p>";
    }
    else{
        $str = "<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Bokningar denna månad</h4>
    </div><div class='table-responsive'><table class='table table-bordered' ><thead>
    <tr>
        <th>Employee Name</th>
        <th>Customer Name</th>
        <th>Date</th>
        <th>Day</th>
        <th>Time</th>
        <th>Actions</th>
    </tr>
    </thead><tbody>";
    while($row = mysqli_fetch_assoc($query)){
        // echo $row['employee_id'];
        $employee_id=$row['employee_id'];
        // echo $employee_id;
        // $role="employee";
        $sql1="SELECT name from `users` where id=$employee_id";
        $query1 = mysqli_query($db,$sql1) or die("Query Unsuccessful.");
        $row1 = mysqli_fetch_assoc($query1);
        $day=date("l", strtotime($row['date']));
        
        $customer_id=$row['customer_id'];
        // echo $employee_id;
        // $role="employee";
        $sql2="SELECT name from `users` where id=$customer_id";
        $query2 = mysqli_query($db,$sql2) or die("Query Unsuccessful.");
        $row2 = mysqli_fetch_assoc($query2);
        $appointment_id=$row['id'];

        
        
        $time=date('g:ia', strtotime($row['time']));
      $str .= "<tr><td>{$row1['name']}</td><td>{$row2['name']}</td><td>{$row['date']}</td><td>{$day}</td><td>{$time}</td><td><button class='btn btn-primary btn-sm'><i class='fa fa-question'></i><a style='color:white;text-decoration: none;' href='appointment-reschedule.php?id=$appointment_id' onclick='return myFunction1($appointment_id)'>Reschedule</a></button>&nbsp<button  class='btn btn-danger btn-sm'><i class='fas fa-times'></i> <a style='color:white;text-decoration: none;' href='appointment-delete.php?id=$appointment_id' onclick='return myFunction($appointment_id)'>Cancel</a></button></td></tr>";
    }
    $str .= "</tbody>
    </table></div>";
    }

    
}


if($_POST['type'] == "yearData"){
    $null=null;

    // $sql =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = {$_POST['id']} AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month";
    $employee_id1=$_POST['e_id'];
    if($employee_id1!=0){
        $sql="SELECT * from `appointments` where Month(date)={$_POST['id']} AND Year(date)={$_POST['year']} AND employee_id=$employee_id1 AND deleted_at is NULL ";


    }
    else{
        $sql="SELECT * from `appointments` where Month(date)={$_POST['id']} AND Year(date)={$_POST['year']} AND deleted_at is NULL";

    }
    $query = mysqli_query($db,$sql) or die("Query Unsuccessful.");
 
    if(mysqli_num_rows ( $query )==0){
        $str="<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Bokningar denna månad</h4>
    </div> <p>Inga bokningar tillgängliga</p>";
    }
    else{
        $str = "<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Bokningar denna månad</h4>
    </div><div class='table-responsive'><table class='table table-bordered' ><thead>
    <tr>
        <th>Employee Name</th>
        <th>Customer Name</th>
        <th>Date</th>
        <th>Day</th>
        <th>Time</th>
        <th>Actions</th>
    </tr>
    </thead><tbody>";
    while($row = mysqli_fetch_assoc($query)){

        // echo $row['employee_id'];
        $employee_id=$row['employee_id'];
        // echo $employee_id;
        // $role="employee";
        $sql1="SELECT name from `users` where id=$employee_id";
        $query1 = mysqli_query($db,$sql1) or die("Query Unsuccessful.");
        $row1 = mysqli_fetch_assoc($query1);
        $appointment_id=$row['id'];

        $day=date("l", strtotime($row['date']));
        $customer_id=$row['customer_id'];
        // echo $employee_id;
        // $role="employee";
        $sql2="SELECT name from `users` where id=$customer_id";
        $query2 = mysqli_query($db,$sql2) or die("Query Unsuccessful.");
        $row2 = mysqli_fetch_assoc($query2);
        $time=date('g:ia', strtotime($row['time']));
      $str .= "<tr><td>{$row1['name']}</td><td>{$row2['name']}</td><td>{$row['date']}</td><td>{$day}</td><td>{$time}</td><td><button class='btn btn-primary btn-sm'><i class='fa fa-question'></i><a style='color:white;text-decoration: none;' href='appointment-reschedule.php?id=$appointment_id' onclick='return myFunction1($appointment_id)'>Reschedule</a></button>&nbsp<button  class='btn btn-danger btn-sm'><i class='fas fa-times'></i><a style='color:white;text-decoration: none;' href='appointment-delete.php?id=$appointment_id' onclick='return myFunction($appointment_id)'>Cancel</a></button></td></tr>";
    }
    $str .= "</tbody>
    </table></div>";
    }

    
}

if($_POST['type'] == "employeeData"){

    $null=null;
    // $sql =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = {$_POST['id']} AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month";
    $employee_id1=$_POST['e_id'];
    if($employee_id1!=0){
        $sql="SELECT * from `appointments` where Month(date)={$_POST['id']} AND Year(date)={$_POST['year']} AND employee_id=$employee_id1 AND deleted_at is NULL ";


    }
    else{
        $sql="SELECT * from `appointments` where Month(date)={$_POST['id']} AND Year(date)={$_POST['year']} AND deleted_at is NULL";

    }    $query = mysqli_query($db,$sql) or die("Query Unsuccessful.");
 
    if(mysqli_num_rows ( $query )==0){
        $str="<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Bokningar denna månad</h4>
    </div> <p>Inga bokningar tillgängliga</p>";
    }
    else{
        $str = "<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Bokningar denna månad</h4>
    </div><div class='table-responsive'><table class='table table-bordered' ><thead>
    <tr>
        <th>Employee Name</th>
        <th>Customer Name</th>
        <th>Date</th>
        <th>Day</th>
        <th>Time</th>
        <th>Actions</th>
    </tr>
    </thead><tbody>";
    while($row = mysqli_fetch_assoc($query)){
        $appointment_id=$row['id'];

        // echo $row['employee_id'];
        $employee_id=$row['employee_id'];
        // echo $employee_id;
        // $role="employee";
        $sql1="SELECT name from `users` where id=$employee_id";
        $query1 = mysqli_query($db,$sql1) or die("Query Unsuccessful.");
        $row1 = mysqli_fetch_assoc($query1);


        $day=date("l", strtotime($row['date']));
        $customer_id=$row['customer_id'];
        // echo $employee_id;
        // $role="employee";
        $sql2="SELECT name from `users` where id=$customer_id";
        $query2 = mysqli_query($db,$sql2) or die("Query Unsuccessful.");
        $row2 = mysqli_fetch_assoc($query2);
        $time=date('g:ia', strtotime($row['time']));
      $str .= "<tr><td>{$row1['name']}</td><td>{$row2['name']}</td><td>{$row['date']}</td><td>{$day}</td><td>{$time}</td><td><button class='btn btn-primary btn-sm'><i class='fa fa-question'></i><a style='color:white;text-decoration: none;' href='appointment-reschedule.php?id=$appointment_id' onclick='return myFunction1($appointment_id)'>Reschedule</a></button>&nbsp<button class='btn btn-danger btn-sm'><i class='fas fa-times'></i> <a style='color:white;text-decoration: none;' href='appointment-delete.php?id=$appointment_id' onclick='return myFunction($appointment_id)'>Cancel</a></button></td></tr>";
    }
    $str .= "</tbody>
    </table></div>";
    }

    
}

echo $str;
?>

