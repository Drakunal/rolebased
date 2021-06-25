

<?php
session_start();
include "connection.php";

if ($_POST['type'] == "") {
    $month = date("F");
    $year = date("Y");
    $null = null;
    $query = mysqli_query($db, "SELECT SUM(time_alloted)
    FROM `appointments`
    WHERE Month(date)=$month AND
     Year(date)=$year  AND
       deleted_at is NULL; ") or die("Query Unsuccessfuls.");
    // echo $month;
    // $query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");
    if (mysqli_num_rows($query) == 0) {
        $str = "<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Appointments in this Month</h4>
    </div> <p>No appointments available</p>";
    } else {
        $str = "0 hours";
        while ($row = mysqli_fetch_assoc($query)) {
            // $day=date("l", strtotime($row['date']));
            // $appointment_id=$row['id'];
            $str = "{$row['SUM(time_alloted)']} hours";
        }
    }
}
if ($_POST['type'] == "stateData") {

    $null = null;
    // $sql =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = {$_POST['id']} AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month";
    $employee_id1 = $_POST['e_id'];
    if ($employee_id1 != 0) {
        $sql = "SELECT *
        FROM `appointments`
        WHERE Month(date)={$_POST['id']} AND
         Year(date)={$_POST['year']} AND
          employee_id=$employee_id1 AND
           deleted_at is NULL; ";
    } else {
        $sql = "SELECT *
        FROM `appointments`
        WHERE Month(date)={$_POST['id']} AND
         Year(date)={$_POST['year']} AND
          deleted_at is NULL;";
    }
    $query = mysqli_query($db, $sql) or die("Query Unsuccessful1.");
    $rut = 0;
    $non_rut = 0;
    $extra = 0;

    if (mysqli_num_rows($query) == 0) {
        $str = "<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Appointments in this Month</h4>
    </div> <p>No appointments available</p>";
    } else {
        $str = " ";

        while ($row = mysqli_fetch_assoc($query)) {
            //extra charge calculation
            $additional_charge = $row['additional_charge'];
            $invoice_charge = $row['invoice_charge'];
            $temp_extra = ($additional_charge + $invoice_charge);
            $extra = $extra + $temp_extra;

            $customer_id = $row['customer_id'];
            $sql2 = "SELECT time_alloted,base_price,is_personal from `customer_details` where user_id=$customer_id";
            $query2 = mysqli_query($db, $sql2) or die("Query Unsuccessful.");
            $row2 = mysqli_fetch_assoc($query2);
            $base_price = $row2['base_price'];
            $time_alloted = $row2['time_alloted'];

            if ($row2['is_personal'] == 1) //if it is personal use
            {
                $rut = $rut + ($base_price * $time_alloted);
            } else if ($row2['is_personal'] == 0) //if it is company use
            {
                $non_rut = $non_rut + ($base_price * $time_alloted);
            }
        }
    }
    $str = "<table class='table table-sm'>
        <th>Personal</th>
        <th>Gov</th>
        <th>Company</th>
        <th>Extra</th>
        <th>Total</th>
        <tr>
        <td>" . $rut . " Kr
        </td>
        <td>" . $rut . " Kr
        </td>
        <td>" . $non_rut . " Kr
        </td>
        <td>" . $extra . " Kr
        </td>
        <td>" . ($non_rut + $rut + $rut + $extra) . " Kr
        </td>
        </tr>
    </table>";
}


if ($_POST['type'] == "yearData") {
    $str = "<table class='table table-sm'>
    <th>Customer id</th>
        <th>Personal</th>
        <th>Gov</th>
        <th>Company</th>
        <th>Extra</th>
        <th>Total</th>";
    $c_role = "customer";
    $customer_list_query = mysqli_query($db, "SELECT id,user_id,name from `users` where role='$c_role' AND  deleted_at is NULL") or die("Unsuccessful list");

    while ($customer_list_row = $customer_list_query->fetch_assoc()) {
        echo "a";
        $rut = 0;
        $non_rut = 0;
        $extra = 0;
        $c_id = $customer_list_row['id'];
        $sql1 = "SELECT *
          FROM `appointments`
          WHERE Month(date)={$_POST['id']} AND
          Year(date)={$_POST['year']} AND customer_id='$c_id' AND
          deleted_at is NULL;";
        $query1 = mysqli_query($db, $sql1);


        $sql2 = "SELECT time_alloted,base_price,is_personal from `customer_details` where user_id=$c_id";
        $query2 = mysqli_query($db, $sql2) or die("Query Unsuccessful.");
        $row2 = mysqli_fetch_assoc($query2);
        $base_price = $row2['base_price'];
        $time_alloted = $row2['time_alloted'];

        // $row1 = $query1->fetch_assoc();
        // echo "bal";


        while ($row1 = mysqli_fetch_assoc($query1)) {
            //extra charge calculation
            $additional_charge = $row1['additional_charge'];
            $invoice_charge = $row1['invoice_charge'];
            $temp_extra = ($additional_charge + $invoice_charge);
            $extra = $extra + $temp_extra;

            // $customer_id = $row['customer_id'];
            // $sql2 = "SELECT time_alloted,base_price,is_personal from `customer_details` where user_id=$customer_id";
            // $query2 = mysqli_query($db, $sql2) or die("Query Unsuccessful.");
            // $row2 = mysqli_fetch_assoc($query2);
            // $base_price = $row2['base_price'];
            // $time_alloted = $row2['time_alloted'];

            if ($row2['is_personal'] == 1) //if it is personal use
            {
                $rut = $rut + ($base_price * $time_alloted);
            } else if ($row2['is_personal'] == 0) //if it is company use
            {
                $non_rut = $non_rut + ($base_price * $time_alloted);
            }
        }
        $str=$str."
        <tr>
        <td>" . $c_id . "
        </td>
        <td>" . $rut . " Kr
        </td>
        <td>" . $rut . " Kr
        </td>
        <td>" . $non_rut . " Kr
        </td>
        <td>" . $extra . " Kr
        </td>
        <td>" . ($non_rut + $rut + $rut + $extra) . " Kr
        </td>
        </tr>
    ";
    }

    // $sql =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = {$_POST['id']} AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month";
    $employee_id1 = $_POST['e_id'];
    // $customer_query=
    // if ($employee_id1 != 0) {
    //     $sql = "SELECT *
    //     FROM `appointments`
    //     WHERE Month(date)={$_POST['id']} AND
    //      Year(date)={$_POST['year']} AND
    //       employee_id=$employee_id1 AND
    //        deleted_at is NULL; ";
    // } else {
    //     $sql = "SELECT *
    //     FROM `appointments`
    //     WHERE Month(date)={$_POST['id']} AND
    //      Year(date)={$_POST['year']} AND
    //       deleted_at is NULL;";
    // }
    // $query = mysqli_query($db, $sql) or die("Query Unsuccessfult.");
    // $rut = 0;
    // $non_rut = 0;
    // $extra = 0;

    // if (mysqli_num_rows($query) == 0) {
    //     $str = "<div class='card-header'>
    //     <h4 class='card-subtitle text-muted'>Appointments in this Month</h4>
    // </div> <p>No appointments available</p>";
    // } else {
    //     $str = " ";

    //     while ($row = mysqli_fetch_assoc($query)) {
    //         //extra charge calculation
    //         $additional_charge = $row['additional_charge'];
    //         $invoice_charge = $row['invoice_charge'];
    //         $temp_extra = ($additional_charge + $invoice_charge);
    //         $extra = $extra + $temp_extra;

    //         $customer_id = $row['customer_id'];
    //         $sql2 = "SELECT time_alloted,base_price,is_personal from `customer_details` where user_id=$customer_id";
    //         $query2 = mysqli_query($db, $sql2) or die("Query Unsuccessful.");
    //         $row2 = mysqli_fetch_assoc($query2);
    //         $base_price = $row2['base_price'];
    //         $time_alloted = $row2['time_alloted'];

    //         if ($row2['is_personal'] == 1) //if it is personal use
    //         {
    //             $rut = $rut + ($base_price * $time_alloted);
    //         } else if ($row2['is_personal'] == 0) //if it is company use
    //         {
    //             $non_rut = $non_rut + ($base_price * $time_alloted);
    //         }
    //     }
    // }
    $str=$str."</table>";
}

if ($_POST['type'] == "employeeData") {

    $null = null;
    // $sql =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = {$_POST['id']} AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month";
    $employee_id1 = $_POST['e_id'];
    if ($employee_id1 != 0) {
        $sql = "SELECT *
        FROM `appointments`
        WHERE Month(date)={$_POST['id']} AND
         Year(date)={$_POST['year']} AND
          employee_id=$employee_id1 AND
           deleted_at is NULL; ";
    } else {
        $sql = "SELECT *
        FROM `appointments`
        WHERE Month(date)={$_POST['id']} AND
         Year(date)={$_POST['year']} AND
           deleted_at is NULL; ";
    }
    $query = mysqli_query($db, $sql) or die("Query Unsuccessfula.");
    $rut = 0;
    $non_rut = 0;
    $extra = 0;

    if (mysqli_num_rows($query) == 0) {
        $str = "<div class='card-header'>
        <h4 class='card-subtitle text-muted'>Appointments in this Month</h4>
    </div> <p>No appointments available</p>";
    } else {
        $str = " ";

        while ($row = mysqli_fetch_assoc($query)) {
            //extra charge calculation
            $additional_charge = $row['additional_charge'];
            $invoice_charge = $row['invoice_charge'];
            $temp_extra = ($additional_charge + $invoice_charge);
            $extra = $extra + $temp_extra;

            $customer_id = $row['customer_id'];
            $sql2 = "SELECT time_alloted,base_price,is_personal from `customer_details` where user_id=$customer_id";
            $query2 = mysqli_query($db, $sql2) or die("Query Unsuccessful.");
            $row2 = mysqli_fetch_assoc($query2);
            $base_price = $row2['base_price'];
            $time_alloted = $row2['time_alloted'];

            if ($row2['is_personal'] == 1) //if it is personal use
            {
                $rut = $rut + ($base_price * $time_alloted);
            } else if ($row2['is_personal'] == 0) //if it is company use
            {
                $non_rut = $non_rut + ($base_price * $time_alloted);
            }
        }
    }
    $str = "<table class='table table-sm'>
        <th>Personal</th>
        <th>Gov</th>
        <th>Company</th>
        <th>Extra</th>
        <th>Total</th>
        <tr>
        <td>" . $rut . " Kr
        </td>
        <td>" . $rut . " Kr
        </td>
        <td>" . $non_rut . " Kr
        </td>
        <td>" . $extra . " Kr
        </td>
        <td>" . ($non_rut + $rut + $rut + $extra) . " Kr
        </td>
        </tr>
    </table>";
}

echo $str;
?>

