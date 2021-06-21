<?php
session_start();
include "connection.php";

if ($_POST['type'] == "") {
    $month = date("F");
    $year = date("Y");
    $null = null;
    $query = mysqli_query($db, "SELECT * from `appointments` where Month(date)=$month AND Year(date)=$year AND deleted_at is not NULL;") or die("Query Unsuccessful.");
    // echo $month;
    // $query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");
    if (mysqli_num_rows($query) == 0) {
        $str = "<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Möten i denna månad</h4>
    </div> <p>Inga möten tillgängliga</p>";
    } else {
        $str = "<div class='card-header'>
    <h4 class='card-subtitle text-muted'>Möten i denna månad</h4>
</div><div class='table-responsive'><table class='table table-bordered' ><thead>
<tr>
    <th>Anställd</th>
    <th>Kund</th>
    <th>Datum</th>
    <th>Day</th>
    <th>Tid</th>

</tr>
</thead><tbody>";
        while ($row = mysqli_fetch_assoc($query)) {
            $day = date("l", strtotime($row['date']));
            $appointment_id = $row['id'];
            $deleted_at=$row['deleted_at'];
            $date=$row['date'];
            if($deleted_at>=$date){

                $str .= "<tr>
                <td>{$row['employee_id']}</td>
                <td>{$row['customer_id']}</td>
                <td>{$row['date']}</td>
                <td>{$day}</td>
                <td>{$time}</td>
           
                </tr>";
               


            }
       }}
}
if ($_POST['type'] == "stateData") {

    $null = null;
    // $sql =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = {$_POST['id']} AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month";
    $employee_id1 = $_POST['e_id'];
    if ($employee_id1 != 0) {
        $sql = "SELECT * from `appointments` where Month(date)={$_POST['id']} AND Year(date)={$_POST['year']} AND employee_id=$employee_id1 AND deleted_at is not NULL ";

    } else {
        $sql = "SELECT * from `appointments` where Month(date)={$_POST['id']} AND Year(date)={$_POST['year']} AND deleted_at is not NULL";

    }
    $query = mysqli_query($db, $sql) or die("Query Unsuccessful.");

    if (mysqli_num_rows($query) == 0) {
        $str = "<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Möten i denna månad</h4>
    </div> <p>Inga möten tillgängliga</p>";
    } else {
        $str = "<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Möten i denna månad</h4>
    </div><div class='table-responsive'><table class='table table-bordered' ><thead>
    <tr>
        <th>Anställd</th>
        <th>Kund</th>
        <th>Datum</th>
        <th>Day</th>
        <th>Tid</th>
   
    </tr>
    </thead><tbody>";
        while ($row = mysqli_fetch_assoc($query)) {
            // echo $row['employee_id'];
            $employee_id = $row['employee_id'];
            // echo $employee_id;
            // $role="employee";
            $sql1 = "SELECT name from `users` where id=$employee_id";
            $query1 = mysqli_query($db, $sql1) or die("Query Unsuccessful.");
            $row1 = mysqli_fetch_assoc($query1);
            $day = date("l", strtotime($row['date']));

            $customer_id = $row['customer_id'];
            // echo $employee_id;
            // $role="employee";
            $sql2 = "SELECT name from `users` where id=$customer_id";
            $query2 = mysqli_query($db, $sql2) or die("Query Unsuccessful.");
            $row2 = mysqli_fetch_assoc($query2);
            $appointment_id = $row['id'];
            $deleted_at=$row['deleted_at'];
            $date=$row['date'];
            if($deleted_at>=$date){
                $time = date('G:i', strtotime($row['time']));
            $str .= "<tr>
            <td>{$row1['name']}</td>
            <td>{$row2['name']}</td>
            <td>{$row['date']}</td>
            <td>{$day}</td>
            <td>{$time}</td>

             </tr>";
        

                
            }
           
            }
        $str .= "</tbody>
    </table></div>";
    }

}

if ($_POST['type'] == "yearData") {
    $null = null;

    // $sql =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = {$_POST['id']} AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month";
    $employee_id1 = $_POST['e_id'];
    if ($employee_id1 != 0) {
        $sql = "SELECT * from `appointments` where Month(date)={$_POST['id']} AND Year(date)={$_POST['year']} AND employee_id=$employee_id1 AND deleted_at is not NULL ";

    } else {
        $sql = "SELECT * from `appointments` where Month(date)={$_POST['id']} AND Year(date)={$_POST['year']} AND deleted_at is not NULL";

    }
    $query = mysqli_query($db, $sql) or die("Query Unsuccessful.");

    if (mysqli_num_rows($query) == 0) {
        $str = "<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Möten i denna månad</h4>
    </div> <p>Inga möten tillgängliga</p>";
    } else {
        $str = "<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Möten i denna månad</h4>
    </div><div class='table-responsive'><table class='table table-bordered' ><thead>
    <tr>
        <th>Anställd</th>
        <th>Kund</th>
        <th>Datum</th>
        <th>Day</th>
        <th>Tid</th>

    </tr>
    </thead><tbody>";
        while ($row = mysqli_fetch_assoc($query)) {

            // echo $row['employee_id'];
            $employee_id = $row['employee_id'];
            // echo $employee_id;
            // $role="employee";
            $sql1 = "SELECT name from `users` where id=$employee_id";
            $query1 = mysqli_query($db, $sql1) or die("Query Unsuccessful.");
            $row1 = mysqli_fetch_assoc($query1);
            $appointment_id = $row['id'];
            $deleted_at=$row['deleted_at'];
            $date=$row['date'];
            if($deleted_at>=$date){
                $day = date("l", strtotime($row['date']));
                $customer_id = $row['customer_id'];
                // echo $employee_id;
                // $role="employee";
                $sql2 = "SELECT name from `users` where id=$customer_id";
                $query2 = mysqli_query($db, $sql2) or die("Query Unsuccessful.");
                $row2 = mysqli_fetch_assoc($query2);
                $time = date('G:i', strtotime($row['time']));
                $str .= "<tr><td>{$row1['name']}</td><td>{$row2['name']}</td><td>{$row['date']}</td><td>{$day}</td><td>{$time}</td></tr>";
           

                
            }


            }
        $str .= "</tbody>
    </table></div>";
    }

}

if ($_POST['type'] == "employeeData") {

    $null = null;
    // $sql =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = {$_POST['id']} AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month";
    $employee_id1 = $_POST['e_id'];
    if ($employee_id1 != 0) {
        $sql = "SELECT * from `appointments` where Month(date)={$_POST['id']} AND Year(date)={$_POST['year']} AND employee_id=$employee_id1 AND deleted_at is not NULL ";

    } else {
        $sql = "SELECT * from `appointments` where Month(date)={$_POST['id']} AND Year(date)={$_POST['year']} AND deleted_at is not NULL";

    }
    $query = mysqli_query($db, $sql) or die("Query Unsuccessful.");

    if (mysqli_num_rows($query) == 0) {
        $str = "<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Möten i denna månad</h4>
    </div> <p>Inga möten tillgängliga</p>";
    } else {
        $str = "<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Möten i denna månad</h4>
    </div><div class='table-responsive'><table class='table table-bordered' ><thead>
    <tr>
        <th>Anställd</th>
        <th>Kund</th>
        <th>Datum</th>
        <th>Day</th>
        <th>Tid</th>

    </tr>
    </thead><tbody>";
        while ($row = mysqli_fetch_assoc($query)) {
            $appointment_id = $row['id'];
            $deleted_at=$row['deleted_at'];
            $date=$row['date'];
            if($deleted_at>=$date){
                // echo $row['employee_id'];
            $employee_id = $row['employee_id'];
            // echo $employee_id;
            // $role="employee";
            $sql1 = "SELECT name from `users` where id=$employee_id";
            $query1 = mysqli_query($db, $sql1) or die("Query Unsuccessful.");
            $row1 = mysqli_fetch_assoc($query1);

            $day = date("l", strtotime($row['date']));
            $customer_id = $row['customer_id'];
            // echo $employee_id;
            // $role="employee";
            $sql2 = "SELECT name from `users` where id=$customer_id";
            $query2 = mysqli_query($db, $sql2) or die("Query Unsuccessful.");
            $row2 = mysqli_fetch_assoc($query2);
            $time = date('G:i', strtotime($row['time']));
            $str .= "<tr><td>{$row1['name']}</td><td>{$row2['name']}</td><td>{$row['date']}</td><td>{$day}</td><td>{$time}</td></tr>";
       

            }

             }
        $str .= "</tbody>
    </table></div>";
    }

}

echo $str;
