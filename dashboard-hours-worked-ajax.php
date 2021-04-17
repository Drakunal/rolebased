
<?php
session_start();
include "connection.php";

if($_POST['type'] == ""){
    $month= date("F");
    $year=date("Y");
    $null=null;
    $query = mysqli_query($db,"SELECT SUM(time_alloted)
    FROM `appointments`
    WHERE Month(date)=$month AND
     Year(date)=$year  AND
       deleted_at is NULL; ")or die("Query Unsuccessfuls.");
    // echo $month;
    // $query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");
    if(mysqli_num_rows ( $query )==0){
        $str="<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Appointments in this Month</h4>
    </div> <p>No appointments available</p>";
    }else{
    $str = "0 timmar";
    while($row = mysqli_fetch_assoc($query)){
        // $day=date("l", strtotime($row['date']));
        // $appointment_id=$row['id'];
        $str = "{$row['SUM(time_alloted)']} timmar";
    }}
}
if($_POST['type'] == "stateData"){

    $null=null;
    // $sql =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = {$_POST['id']} AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month";
    $employee_id1=$_POST['e_id'];
    if($employee_id1!=0){
        $sql="SELECT SUM(time_alloted)
        FROM `appointments`
        WHERE Month(date)={$_POST['id']} AND
         Year(date)={$_POST['year']} AND
          employee_id=$employee_id1 AND
           deleted_at is NULL; ";


    }
    else{
        $sql="SELECT SUM(time_alloted)
        FROM `appointments`
        WHERE Month(date)={$_POST['id']} AND
         Year(date)={$_POST['year']} AND
          deleted_at is NULL;";

    }
    $query = mysqli_query($db,$sql) or die("Query Unsuccessful1.");
 
    if(mysqli_num_rows ( $query )==0){
        $str="<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Appointments in this Month</h4>
    </div> <p>No appointments available</p>";
    }
    else{
        $str = "0 timmar ";
    while($row = mysqli_fetch_assoc($query)){
        // echo $row['employee_id'];
        // $employee_id=$row['employee_id'];
        // echo $employee_id;
        // $role="employee";
        // $sql1="SELECT name from `users` where id=$employee_id";
        // $query1 = mysqli_query($db,$sql1) or die("Query Unsuccessful.");
        // $row1 = mysqli_fetch_assoc($query1);
        // $day=date("l", strtotime($row['date']));
        
        // $customer_id=$row['customer_id'];
        // echo $employee_id;
        // $role="employee";
        // $sql2="SELECT name from `users` where id=$customer_id";
        // $query2 = mysqli_query($db,$sql2) or die("Query Unsuccessful.");
        // $row2 = mysqli_fetch_assoc($query2);
        // $appointment_id=$row['id'];

        // print_r($row) ;
        
        // $time=date('g:ia', strtotime($row['time']));
      $str = "{$row['SUM(time_alloted)']} timmar";
    }
    if($str==" timmar")
    {
        $str="0 timmar";
    }
    $str .= "";
    }

    
}


if($_POST['type'] == "yearData"){
    $null=null;

    // $sql =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = {$_POST['id']} AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month";
    $employee_id1=$_POST['e_id'];
    if($employee_id1!=0){
        $sql="SELECT SUM(time_alloted)
        FROM `appointments`
        WHERE Month(date)={$_POST['id']} AND
         Year(date)={$_POST['year']} AND
          employee_id=$employee_id1 AND
           deleted_at is NULL; ";


    }
    else{
        $sql="SELECT SUM(time_alloted)
        FROM `appointments`
        WHERE Month(date)={$_POST['id']} AND
         Year(date)={$_POST['year']} AND
          deleted_at is NULL;";

    }
    $query = mysqli_query($db,$sql) or die("Query Unsuccessfult.");
 
    if(mysqli_num_rows ( $query )==0){
        $str="<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Appointments in this Month</h4>
    </div> <p>No appointments available</p>";
    }
    else{
        $str = " 0 timmar";
    while($row = mysqli_fetch_assoc($query)){

        // echo $row['employee_id'];
        // $employee_id=$row['employee_id'];
        // echo $employee_id;
        // $role="employee";
        // $sql1="SELECT name from `users` where id=$employee_id";
        // $query1 = mysqli_query($db,$sql1) or die("Query Unsuccessful.");
        // $row1 = mysqli_fetch_assoc($query1);
        // $appointment_id=$row['id'];

        // $day=date("l", strtotime($row['date']));
        // $customer_id=$row['customer_id'];
        // echo $employee_id;
        // $role="employee";
        // $sql2="SELECT name from `users` where id=$customer_id";
        // $query2 = mysqli_query($db,$sql2) or die("Query Unsuccessful.");
        // $row2 = mysqli_fetch_assoc($query2);
        // $time=date('g:ia', strtotime($row['time']));
      $str = "{$row['SUM(time_alloted)']} timmar";
    }
    if($str==" timmar")
    {
        $str="0 timmar";
    }
    $str .= " ";
    }

    
}

if($_POST['type'] == "employeeData"){

    $null=null;
    // $sql =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = {$_POST['id']} AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month";
    $employee_id1=$_POST['e_id'];
    if($employee_id1!=0){
        $sql="SELECT SUM(time_alloted)
        FROM `appointments`
        WHERE Month(date)={$_POST['id']} AND
         Year(date)={$_POST['year']} AND
          employee_id=$employee_id1 AND
           deleted_at is NULL; ";


    }
    else{
        $sql="SELECT SUM(time_alloted)
        FROM `appointments`
        WHERE Month(date)={$_POST['id']} AND
         Year(date)={$_POST['year']} AND
           deleted_at is NULL; ";

    } 
       $query = mysqli_query($db,$sql) or die("Query Unsuccessfula.");
 
    if(mysqli_num_rows ( $query )==0){
        $str="<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Appointments in this Month</h4>
    </div> <p>No appointments available</p>";
    }
    else{
        $str = "0 timmar ";
    while($row = mysqli_fetch_assoc($query)){
        // $appointment_id=$row['id'];

        // echo $row['employee_id'];
        // $employee_id=$row['employee_id'];
        // echo $employee_id;
        // $role="employee";
        // $sql1="SELECT name from `users` where id=$employee_id";
        // $query1 = mysqli_query($db,$sql1) or die("Query Unsuccessful.");
        // $row1 = mysqli_fetch_assoc($query1);


        // $day=date("l", strtotime($row['date']));
        // $customer_id=$row['customer_id'];
        // echo $employee_id;
        // $role="employee";
        // $sql2="SELECT name from `users` where id=$customer_id";
        // $query2 = mysqli_query($db,$sql2) or die("Query Unsuccessful.");
        // $row2 = mysqli_fetch_assoc($query2);
        // $time=date('g:ia', strtotime($row['time']));
      $str = "{$row['SUM(time_alloted)']} timmar";
    }
    if($str==" timmar")
    {
        $str="0 timmar";
    }
    $str .= " ";
    }

    
}

echo $str;
?>

