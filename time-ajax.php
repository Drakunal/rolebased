<?php
session_start();
include "connection.php";

if($_POST['type'] == ""){
    $role='customer';
    $query = mysqli_query($db,"SELECT id,name from `users` where role='$role' AND deleted_at is NULL;");

    // $query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");

    $str = "";
    while($row = mysqli_fetch_assoc($query)){
      $str .= "<option value='".$row['id']."'>".$row['name']."</option>";
    }
}
else if($_POST['type'] == "stateData"){


    $sql =   "SELECT time_alloted from `customer_details` where user_id = {$_POST['id']} AND deleted_at is NULL";

    $query = mysqli_query($db,$sql) or die("Query Unsuccessful.");
    $row=$query->fetch_assoc();
   
 
    if(mysqli_num_rows ( $query )==0){
        $str="<input type='number' required step='0.1' name='time_alloted' class='form-control' placeholder='Ange timmar' value='0'>";
    }
    else{
        $time=$row['time_alloted'];
        $str = "<input type='number' required step='0.1' name='time_alloted' class='form-control' placeholder='Ange timmar' value='".$time."'>";
    
    
    }

    
}

echo $str;
?>

