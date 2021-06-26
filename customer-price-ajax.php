

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
    $str = "<table id='price' class='table table-striped'  style='width:100%'>
        <th>Customer id</th>
        <th>Customer name</th>
        <th>Personal</th>
        <th>Gov</th>
        <th>Company</th>
        <th>Extra</th>
        <th>Total</th>";
    $c_role = "customer";
    $customer_list_query = mysqli_query($db, "SELECT id,user_id,name from `users` where role='$c_role' AND  deleted_at is NULL") or die("Unsuccessful list");

    while ($customer_list_row = $customer_list_query->fetch_assoc()) {

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


        $sql2 = "SELECT time_alloted,base_price,is_personal from `customer_details` where user_id=$c_id";
        $query2 = mysqli_query($db, $sql2) or die("Query Unsuccessful.");
        $row2 = mysqli_fetch_assoc($query2);
        $base_price = $row2['base_price'];
        $time_alloted = $row2['time_alloted'];


        while ($row1 = mysqli_fetch_assoc($query1)) {
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
            </tr>";
        } else if ($rut != 0 && $non_rut == 0) {
            $str = $str . "
            <tr>
            <td>" . $c_id . "
            </td>
            <td>" . $c_name . "
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
            </tr>";
        } else if ($rut == 0 && $non_rut == 0){
            $str = $str . "
            <tr>
            <td>" . $c_id . "
            </td>
            <td>" . $c_name . "
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
    $str = $str . "</table>
    <script src='https://code.jquery.com/jquery-3.5.1.js'></script>

    <script src='https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js'></script>
    
    <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>
    
    <script src='https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js'></script>
    
    <script src='https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js'></script>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
    
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js'></script> -->
    
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js'></script> -->
    <script src='https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js'></script>
    <!-- <script scr='https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js'></script> -->
    <!-- <script scr='https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js'></script> -->
    <!-- <script scr='https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js'></script> -->
    <script>
    $(document).ready(function() {
        var table = $('#price').DataTable( {
            lengthChange: false,
            // buttons: [ 'copy', 'excel', 'pdf' ]
        } );
     
        // table.buttons().container()
        //     .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
    
    document.getElementById('appointment-list').className = 'table table-striped';
    </script>
 
    
    ";
}


if ($_POST['type'] == "yearData") {
    $str = "<table id='price' class='table table-striped'  style='width:100%'>
        <th>Customer id</th>
        <th>Customer name</th>
        <th>Personal</th>
        <th>Gov</th>
        <th>Company</th>
        <th>Extra</th>
        <th>Total</th>";
    $c_role = "customer";
    $customer_list_query = mysqli_query($db, "SELECT id,user_id,name from `users` where role='$c_role' AND  deleted_at is NULL") or die("Unsuccessful list");

    while ($customer_list_row = $customer_list_query->fetch_assoc()) {

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


        $sql2 = "SELECT time_alloted,base_price,is_personal from `customer_details` where user_id=$c_id";
        $query2 = mysqli_query($db, $sql2) or die("Query Unsuccessful.");
        $row2 = mysqli_fetch_assoc($query2);
        $base_price = $row2['base_price'];
        $time_alloted = $row2['time_alloted'];


        while ($row1 = mysqli_fetch_assoc($query1)) {
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
            </tr>";
        } else if ($rut != 0 && $non_rut == 0) {
            $str = $str . "
            <tr>
            <td>" . $c_id . "
            </td>
            <td>" . $c_name . "
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
            </tr>";
        } else if ($rut == 0 && $non_rut == 0){
            $str = $str . "
            <tr>
            <td>" . $c_id . "
            </td>
            <td>" . $c_name . "
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
    $str = $str . "</table>
    <script src='https://code.jquery.com/jquery-3.5.1.js'></script>

    <script src='https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js'></script>
    
    <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>
    
    <script src='https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js'></script>
    
    <script src='https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js'></script>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
    
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js'></script> -->
    
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js'></script> -->
    <script src='https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js'></script>
    <!-- <script scr='https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js'></script> -->
    <!-- <script scr='https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js'></script> -->
    <!-- <script scr='https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js'></script> -->
    <script>
    $(document).ready(function() {
        var table = $('#price').DataTable( {
            lengthChange: false,
            // buttons: [ 'copy', 'excel', 'pdf' ]
        } );
     
        // table.buttons().container()
        //     .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
    
    document.getElementById('appointment-list').className = 'table table-striped';
    </script>
 
    
    ";
}

if ($_POST['type'] == "employeeData") {
    $str = "<table id='price' class='table table-striped'  style='width:100%'>
        <th>Customer id</th>
        <th>Customer name</th>
        <th>Personal</th>
        <th>Gov</th>
        <th>Company</th>
        <th>Extra</th>
        <th>Total</th>";
    $c_role = "customer";
    $customer_list_query = mysqli_query($db, "SELECT id,user_id,name from `users` where role='$c_role' AND  deleted_at is NULL") or die("Unsuccessful list");

    while ($customer_list_row = $customer_list_query->fetch_assoc()) {

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


        $sql2 = "SELECT time_alloted,base_price,is_personal from `customer_details` where user_id=$c_id";
        $query2 = mysqli_query($db, $sql2) or die("Query Unsuccessful.");
        $row2 = mysqli_fetch_assoc($query2);
        $base_price = $row2['base_price'];
        $time_alloted = $row2['time_alloted'];


        while ($row1 = mysqli_fetch_assoc($query1)) {
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
            </tr>";
        } else if ($rut != 0 && $non_rut == 0) {
            $str = $str . "
            <tr>
            <td>" . $c_id . "
            </td>
            <td>" . $c_name . "
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
            </tr>";
        } else if ($rut == 0 && $non_rut == 0){
            $str = $str . "
            <tr>
            <td>" . $c_id . "
            </td>
            <td>" . $c_name . "
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
    $str = $str . "</table>
    <script src='https://code.jquery.com/jquery-3.5.1.js'></script>

    <script src='https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js'></script>
    
    <script src='https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js'></script>
    
    <script src='https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js'></script>
    
    <script src='https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js'></script>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
    
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js'></script> -->
    
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js'></script> -->
    <script src='https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js'></script>
    <!-- <script scr='https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js'></script> -->
    <!-- <script scr='https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js'></script> -->
    <!-- <script scr='https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js'></script> -->
    <script>
    $(document).ready(function() {
        var table = $('#price').DataTable( {
            lengthChange: false,
            // buttons: [ 'copy', 'excel', 'pdf' ]
        } );
     
        // table.buttons().container()
        //     .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
    
    document.getElementById('appointment-list').className = 'table table-striped';
    </script>
 
    
    ";
}


echo $str;
?>

