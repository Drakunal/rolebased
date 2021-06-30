

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
    $str = "<script src='js/jquery.js'></script>

    <script src='js/dataTables.bootstrap4.min.js'></script><table id='b' class='table table-responsive table-sm' style='width:100%'>
    <thead>
        <th>Kundnummer</th>
        <th>Kund</th>
        <th>Antal bokningar</th>
        <th> Timpris</th>
        <th>Antal timmar</th>
        <th>Kostnad för kunden</th>
        <th>Skatteverket</th>
        <th>Företag</th>
        <th>Extra</th>
        <th>Total</th>
        <th>Totalt för kunden</th>
        </thead>
        <tbody  id='price'>";
    $c_role = "customer";
    $customer_list_query = mysqli_query($db, "SELECT id,user_id,name from `users` where role='$c_role' AND  deleted_at is NULL") or die("Unsuccessful list");

    while ($customer_list_row = $customer_list_query->fetch_assoc()) {

        $appointment_count = 0;
        $hours = 0;
        
        $rut = 0;
        $non_rut = 0;
        $extra = 0;
        $c_id = $customer_list_row['id'];
        $c_name = $customer_list_row['name'];
        $sql1 = "SELECT *
          FROM `appointments`
          WHERE Month(date)={$_POST['id']} AND
          Year(date)={$_POST['year']} AND customer_id='$c_id' AND
          deleted_at is NULL;";
        $query1 = mysqli_query($db, $sql1);


        $sql2 = "SELECT base_price,is_personal from `customer_details` where user_id=$c_id";
        $query2 = mysqli_query($db, $sql2) or die("Query Unsuccessful.");
        $row2 = mysqli_fetch_assoc($query2);
        $base_price = $row2['base_price'];



        while ($row1 = mysqli_fetch_assoc($query1)) {
            $base_price = $row1['base_price'];
            $time_alloted = $row1['time_alloted'];
            $appointment_count++;
            $hours = $hours + $time_alloted;
            //extra charge calculation
            $additional_charge = $row1['additional_charge'];
            $invoice_charge = $row1['invoice_charge'];
            $temp_extra = ($additional_charge + $invoice_charge);
            $extra = $extra + $temp_extra;
            if ($row2['is_personal'] == 1) //if it is personal use
            {
                $rut = $rut + ($base_price * $time_alloted);
            } else if ($row2['is_personal'] == 0) //if it is company use
            {
                $non_rut = $non_rut + ($base_price * $time_alloted);
            }
        }
        if ($rut == 0 && $non_rut != 0) {
            $str = $str . "
            <tr>
            <td>" . $c_id . "
            </td>
            <td>" . $c_name . "
            </td>
            <td>" . $appointment_count . "
            </td>
            <td>" . $base_price . " Kr
            </td>
            <td>" . $hours . " timmar
            </td>
            <td> - 
            </td>
            <td> - 
            </td>
            <td>" . $non_rut . " Kr
            </td>
            <td>" . $extra . " Kr
            </td>
            <td>" . ($non_rut + $rut + $rut + $extra) . " Kr
            </td>
            <td>" . ($non_rut + $rut + $extra) . " Kr
            </td>
            </tr>";
        } else if ($rut != 0 && $non_rut == 0) {
            $str = $str . "
            <tr>
            <td>" . $c_id . "
            </td>
            <td>" . $c_name . "
            </td>
            <td>" . $appointment_count . "
            </td>
            <td>" . $base_price . " Kr
            </td>
            <td>" . $hours . " timmar
            </td>
            <td>" . $rut . " Kr
            </td>
            <td>" . $rut . " Kr
            </td>
            <td> -
            </td>
            <td>" . $extra . " Kr
            </td>
            <td>" . ($non_rut + $rut + $rut + $extra) . " Kr
            </td>
            <td>" . ($non_rut + $rut + $extra) . " Kr
            </td>
            </tr>";
        } else if ($rut == 0 && $non_rut == 0) {
            $str = $str . "
            <tr>
            <td>" . $c_id . "
            </td>
            <td>" . $c_name . "
            </td>
            <td> -
            </td>
            <td>" . $base_price . " Kr
            </td>
            <td> -
            </td>
            <td> -
            </td>
            <td> -
            </td>
            <td> -
            </td>
            <td> - 
            </td>
            <td> - 
            </td>
            <td> - 
            </td>
            </tr>";
        }
    }
    $employee_id1 = $_POST['e_id'];
    $str = $str . "</tbody>

    </table>
 
    
    ";
}


if ($_POST['type'] == "yearData") {
    $str = "<script src='js/jquery.js'></script>

    <script src='js/dataTables.bootstrap4.min.js'></script><table id='b' class='table table-responsive table-sm' style='width:100%'>
    <thead>
        <th>Kundnummer</th>
        <th>Kund</th>
        <th>Antal bokningar</th>
        <th> Timpris</th>
        <th>Antal timmar</th>
        <th>Kostnad för kunden</th>
        <th>Skatteverket</th>
        <th>Företag</th>
        <th>Extra</th>
        <th>Total</th>
        <th>Totalt för kunden</th>
        </thead>
        <tbody  id='price'>";
    $c_role = "customer";
    $customer_list_query = mysqli_query($db, "SELECT id,user_id,name from `users` where role='$c_role' AND  deleted_at is NULL") or die("Unsuccessful list");

    while ($customer_list_row = $customer_list_query->fetch_assoc()) {
        $appointment_count = 0;
        $hours = 0;
        
        $rut = 0;
        $non_rut = 0;
        $extra = 0;
        $c_id = $customer_list_row['id'];
        $c_name = $customer_list_row['name'];
        $sql1 = "SELECT *
          FROM `appointments`
          WHERE Month(date)={$_POST['id']} AND
          Year(date)={$_POST['year']} AND customer_id='$c_id' AND
          deleted_at is NULL;";
        $query1 = mysqli_query($db, $sql1);


        $sql2 = "SELECT base_price,is_personal from `customer_details` where user_id=$c_id";
        $query2 = mysqli_query($db, $sql2) or die("Query Unsuccessful.");
        $row2 = mysqli_fetch_assoc($query2);
        $base_price = $row2['base_price'];


        while ($row1 = mysqli_fetch_assoc($query1)) {
            //extra charge calculation
            $base_price = $row1['base_price'];
            $time_alloted = $row1['time_alloted'];
            $hours = $hours + $time_alloted;
            $appointment_count++;
            $additional_charge = $row1['additional_charge'];
            $invoice_charge = $row1['invoice_charge'];
            $temp_extra = ($additional_charge + $invoice_charge);
            $extra = $extra + $temp_extra;
            if ($row2['is_personal'] == 1) //if it is personal use
            {
                $rut = $rut + ($base_price * $time_alloted);
            } else if ($row2['is_personal'] == 0) //if it is company use
            {
                $non_rut = $non_rut + ($base_price * $time_alloted);
            }
        }
        if ($rut == 0 && $non_rut != 0) {
            $str = $str . "
            <tr>
            <td>" . $c_id . "
            </td>
            <td>" . $c_name . "
            </td>
            <td>" . $appointment_count . "
            </td>
            <td>" . $base_price . " Kr
            </td>
            <td>" . $hours . " timmar
            </td>
            <td> - 
            </td>
            <td> - 
            </td>
            <td>" . $non_rut . " Kr
            </td>
            <td>" . $extra . " Kr
            </td>
            <td>" . ($non_rut + $rut + $rut + $extra) . " Kr
            </td>
            <td>" . ($non_rut + $rut + $extra) . " Kr
            </td>
            </tr>";
        } else if ($rut != 0 && $non_rut == 0) {
            $str = $str . "
            <tr>
            <td>" . $c_id . "
            </td>
            <td>" . $c_name . "
            </td>
            <td>" . $appointment_count . "
            </td>
            <td>" . $base_price . " Kr
            </td>
            <td>" . $hours . " timmar
            </td>
            <td>" . $rut . " Kr
            </td>
            <td>" . $rut . " Kr
            </td>
            <td> -
            </td>
            <td>" . $extra . " Kr
            </td>
            <td>" . ($non_rut + $rut + $rut + $extra) . " Kr
            </td>
            <td>" . ($non_rut + $rut + $extra) . " Kr
            </td>
            </tr>";
        } else if ($rut == 0 && $non_rut == 0) {
            $str = $str . "
            <tr>
            <td>" . $c_id . "
            </td>
            <td>" . $c_name . "
            </td>
            <td> -
            </td>
            <td>" . $base_price . " Kr
            </td>
            <td> -
            </td>
            <td> -
            </td>
            <td> -
            </td>
            <td> -
            </td>
            <td> - 
            </td>
            <td> - 
            </td>
            <td> - 
            </td>
            </tr>";
        }
    }
    $employee_id1 = $_POST['e_id'];
    $str = $str . "</tbody>

    </table>
 
    
    ";
}

if ($_POST['type'] == "employeeData") {
    $str = "<script src='js/jquery.js'></script>

    <script src='js/dataTables.bootstrap4.min.js'></script><table id='b' class='table table-responsive table-sm' style='width:100%'>
    <thead>
        <th>Kundnummer</th>
        <th>Kund</th>
        <th>Antal bokningar</th>
        <th>Timpris</th>
        <th>Antal timmar</th>
        <th>Kostnad för kunden</th>
        <th>Skatteverket</th>
        <th>Företag</th>
        <th>Extra</th>
        <th>Total</th>
        <th>Totalt för kunden</th>
        </thead>
        <tbody  id='price'>";
    $c_role = "customer";
    $customer_list_query = mysqli_query($db, "SELECT id,user_id,name from `users` where role='$c_role' AND  deleted_at is NULL") or die("Unsuccessful list");

    while ($customer_list_row = $customer_list_query->fetch_assoc()) {
        $appointment_count = 0;
        $hours = 0;
       
        $rut = 0;
        $non_rut = 0;
        $extra = 0;
        $c_id = $customer_list_row['id'];
        $c_name = $customer_list_row['name'];
        $sql1 = "SELECT *
          FROM `appointments`
          WHERE Month(date)={$_POST['id']} AND
          Year(date)={$_POST['year']} AND customer_id='$c_id' AND
          deleted_at is NULL;";
        $query1 = mysqli_query($db, $sql1);


        $sql2 = "SELECT base_price,is_personal from `customer_details` where user_id=$c_id";
        $query2 = mysqli_query($db, $sql2) or die("Query Unsuccessful.");
        $row2 = mysqli_fetch_assoc($query2);
        $base_price = $row2['base_price'];


        while ($row1 = mysqli_fetch_assoc($query1)) {
            $base_price = $row1['base_price'];
            $time_alloted = $row1['time_alloted'];
            $appointment_count++;
            $hours = $hours + $time_alloted;
            //extra charge calculation
            $additional_charge = $row1['additional_charge'];
            $invoice_charge = $row1['invoice_charge'];
            $temp_extra = ($additional_charge + $invoice_charge);
            $extra = $extra + $temp_extra;
            if ($row2['is_personal'] == 1) //if it is personal use
            {
                $rut = $rut + ($base_price * $time_alloted);
            } else if ($row2['is_personal'] == 0) //if it is company use
            {
                $non_rut = $non_rut + ($base_price * $time_alloted);
            }
        }
        if ($rut == 0 && $non_rut != 0) {
            $str = $str . "
            <tr>
            <td>" . $c_id . "
            </td>
            <td>" . $c_name . "
            </td>
            <td>" . $appointment_count . "
            </td>
            <td>" . $base_price . " Kr
            </td>
            <td>" . $hours . " timmar
            </td>
            <td> - 
            </td>
            <td> - 
            </td>
            <td>" . $non_rut . " Kr
            </td>
            <td>" . $extra . " Kr
            </td>
            <td>" . ($non_rut + $rut + $rut + $extra) . " Kr
            </td>
            <td>" . ($non_rut + $rut + $extra) . " Kr
            </td>
            </tr>";
        } else if ($rut != 0 && $non_rut == 0) {
            $str = $str . "
            <tr>
            <td>" . $c_id . "
            </td>
            <td>" . $c_name . "
            </td>
            <td>" . $appointment_count . "
            </td>
            <td>" . $base_price . " Kr
            </td>
            <td>" . $hours . " timmar
            </td>
            <td>" . $rut . " Kr
            </td>
            <td>" . $rut . " Kr
            </td>
            <td> -
            </td>
            <td>" . $extra . " Kr
            </td>
            <td>" . ($non_rut + $rut + $rut + $extra) . " Kr
            </td>
            <td>" . ($non_rut + $rut + $extra) . " Kr
            </td>
            </tr>";
        } else if ($rut == 0 && $non_rut == 0) {
            $str = $str . "
            <tr>
            <td>" . $c_id . "
            </td>
            <td>" . $c_name . "
            </td>
            <td> -
            </td>
            <td>" . $base_price . " Kr
            </td>
            <td> -
            </td>
            <td> -
            </td>
            <td> -
            </td>
            <td> -
            </td>
            <td> - 
            </td>
            <td> - 
            </td>
            <td> - 
            </td>
            </tr>";
        }
    }
    $employee_id1 = $_POST['e_id'];
    $str = $str . "</tbody>

    </table>
    
 
    
    ";
}

$str = $str . "
<script>
    $(document).ready(function() {
        var table = $('#b').DataTable({
            lengthChange: false, 
            language: {
                'search': 'Sök',
                'lengthMenu': 'Display _MENU_ records per page',
                'zeroRecords': 'Inga uppgifter funna',
                'info': 'Visar sida _PAGE_ av _PAGES_',
                'infoEmpty': 'Inga poster tillgängliga',
                'infoFiltered': '(filtreras från totalt _MAX_ poster)',
                'paginate': {
                    'first': 'Först',
                    'last': 'Sista',
                    'next': 'Nästa',
                    'previous': 'Tidigare'
                },
            }
        });
    }); 

</script>";
echo $str;
?>

