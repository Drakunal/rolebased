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
    </div><div class='table-responsive'><table id='appointment-list' class='table table-striped' ><thead>
    <tr>
        <th>Anställd</th>
        <th>Kund</th>
        <th>Datum</th>
        <th>Dag</th>
        <th>Tid</th>
        <th>Insatser</th>
    </tr>
    </thead><tbody>";
    while($row = mysqli_fetch_assoc($query)){
        $day=date("l", strtotime($row['date']));
        $appointment_id=$row['id'];
        $str .= "<tr><td>{$row['employee_id']}</td><td>{$row['customer_id']}</td><td>{$row['date']}</td><td>{$day}</td><td>{$time}</td><td><button class='btn btn-primary btn-sm'><i class='fa fa-question'></i><a style='color:white;text-decoration: none;' href='appointment-reschedule.php?id=$appointment_id' onclick='return myFunction1($appointment_id)'>Boka om</a></button>&nbsp<button class='btn btn-danger '><i class='fas fa-times'></i> <a style='color:white;text-decoration: none;' href='appointment-delete.php?id=$appointment_id' onclick='return myFunction($appointment_id)'>Avboka</a></button></td></tr>";
    }

    $str .= "</tbody>
    </table><script src='https://code.jquery.com/jquery-3.5.1.js'></script>

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
        var table = $('#appointment-list').DataTable( {
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
            // buttons: [ 'copy', 'excel', 'pdf' ]
        } );
     
        // table.buttons().container()
        //     .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
    
    document.getElementById('appointment-list').className = 'table table-striped';
    </script></div>";
    
}
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
    </div><div class='table-responsive'><table id='appointment-list' class='table table-striped' ><thead>
    <tr>
        <th>Anställd</th>
        <th>Kund</th>
        <th>Datum</th>
        <th>Dag</th>
        <th>Tid</th>
        <th>Insatser</th>
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

        
        
        $time=date('G:i', strtotime($row['time']));
      $str .= "<tr><td>{$row1['name']}</td><td>{$row2['name']}</td><td>{$row['date']}</td><td>{$day}</td><td>{$time}</td><td><button class='btn btn-primary btn-sm'><i class='fa fa-question'></i><a style='color:white;text-decoration: none;' href='appointment-reschedule.php?id=$appointment_id' onclick='return myFunction1($appointment_id)'>Boka om</a></button>&nbsp<button  class='btn btn-danger btn-sm'><i class='fas fa-times'></i> <a style='color:white;text-decoration: none;' href='appointment-delete.php?id=$appointment_id' onclick='return myFunction($appointment_id)'>Avboka</a></button></td></tr>";
    }
    $str .= "</tbody>
    </table><script src='https://code.jquery.com/jquery-3.5.1.js'></script>

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
        var table = $('#appointment-list').DataTable( {
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
            // buttons: [ 'copy', 'excel', 'pdf' ]
        } );
     
        // table.buttons().container()
        //     .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
    
    document.getElementById('appointment-list').className = 'table table-striped';
    </script></div>";
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
    </div><div class='table-responsive'><table id='appointment-list' class='table table-striped' ><thead>
    <tr>
        <th>Anställd</th>
        <th>Kund</th>
        <th>Datum</th>
        <th>Dag</th>
        <th>Tid</th>
        <th>Insatser</th>
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
        $time=date('G:i', strtotime($row['time']));
      $str .= "<tr><td>{$row1['name']}</td><td>{$row2['name']}</td><td>{$row['date']}</td><td>{$day}</td><td>{$time}</td><td><button class='btn btn-primary btn-sm'><i class='fa fa-question'></i><a style='color:white;text-decoration: none;' href='appointment-reschedule.php?id=$appointment_id' onclick='return myFunction1($appointment_id)'>Boka om</a></button>&nbsp<button  class='btn btn-danger btn-sm'><i class='fas fa-times'></i><a style='color:white;text-decoration: none;' href='appointment-delete.php?id=$appointment_id' onclick='return myFunction($appointment_id)'>Avboka</a></button></td></tr>";
    }
    $str .= "</tbody>
    </table><script src='https://code.jquery.com/jquery-3.5.1.js'></script>

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
        var table = $('#appointment-list').DataTable( {
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
            // buttons: [ 'copy', 'excel', 'pdf' ]
        } );
     
        // table.buttons().container()
        //     .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
    
    document.getElementById('appointment-list').className = 'table table-striped';
    </script></div>";
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
    </div><div class='table-responsive'><table  id='appointment-list' class='table table-striped' ><thead>
    <tr>
        <th>Anställd</th>
        <th>Kund</th>
        <th>Datum</th>
        <th>Dag</th>
        <th>Tid</th>
        <th>Insatser</th>
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
        $time=date('G:i', strtotime($row['time']));
      $str .= "<tr><td>{$row1['name']}</td><td>{$row2['name']}</td><td>{$row['date']}</td><td>{$day}</td><td>{$time}</td><td><button class='btn btn-primary btn-sm'><i class='fa fa-question'></i><a style='color:white;text-decoration: none;' href='appointment-reschedule.php?id=$appointment_id' onclick='return myFunction1($appointment_id)'>Boka om</a></button>&nbsp<button class='btn btn-danger btn-sm'><i class='fas fa-times'></i> <a style='color:white;text-decoration: none;' href='appointment-delete.php?id=$appointment_id' onclick='return myFunction($appointment_id)'>Avboka</a></button></td></tr>";
    }
    $str .= "</tbody>
    </table><script src='https://code.jquery.com/jquery-3.5.1.js'></script>

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
        var table = $('#appointment-list').DataTable( {
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
            // buttons: [ 'copy', 'excel', 'pdf' ]
        } );
     
        // table.buttons().container()
        //     .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
    
    document.getElementById('appointment-list').className = 'table table-striped';
    </script></div>";
    }

    
}

echo $str;
?>

