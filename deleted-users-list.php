<?php
session_start();
include "connection.php";
if(!isset($_SESSION['login_user'])||$_SESSION['role']!="admin")
{
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>Tables | AdminKit Demo</title>

	<link href="css/app.css" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				

                <?php include("sidebar.php"); ?>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
                     <i class="hamburger align-self-center"></i>
                 </a>

				
				<?php include("navbar.php"); ?>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Deleted User List</h1>

					<div class="row">
						<div class="col-md-12">
						</br>
							<div class="card">
								<div class="card-header">
								
								</div>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th style="width:40%;">Email ID</th>
											<th style="width:25%">Name</th>
											<!-- <th class="d-none d-md-table-cell" style="width:25%">Date of Birth</th> -->
											<th>Role</th>
										</tr>
									</thead>
									<tbody>
                                   
                                        <?php 
          
           
                                                 $result = mysqli_query($db,"SELECT id,user_id,name,role from `users` where deleted_at is not NULL;");
                                                        if ($result->num_rows > 0) {?>
                                             <?php
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    if($row["role"]=="customer"){
                                                        $role="Customer";
                                                    }
                                                    else if($row["role"]=="employee"){
                                                        $role="Employee";
                                                    }
                                                echo "<tr><td>".$row["user_id"]."</td><td>".$row["name"]."</td><td>".$role."</td></tr>";
                                                ?>
                                         
                                                </tr>
                                                <?php

                                                }
                                                
                                            }
                                            ?>
										
									</tbody>
								</table>
							</div>
						</div>

						

						
					</div>

                    
                     <div class="col-12 col-md-12 col-xxl-3 d-flex order-1 order-xxl-1">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <div class="flatpickr-months">
                                    <div>
                                    <?php 
                                        $role="employee";
                                        $result = mysqli_query($db,"SELECT id,name from `users` where role='$role' and deleted_at is not NULL;");
                                    ?>
                                        <select class="form-control mb-3" id="e-id">
                                            <option value="0"selected>All Deleted Employees</option>
                                            <?php 
                                            while($row = $result->fetch_assoc())
                                            echo "<option value='".$row['id']."'>".$row['name']."</option>"
                                            ?>
                                        </select>
                                    </div>
                                
                                        <div class="flatpickr-month">
                                                <div class="flatpickr-current-month">
                                                        <?php
                                                            $month= date("F");
                                                        ?>
                                                    <select class="flatpickr-monthDropdown-months" id="employee_id" aria-label="Month" tabindex="-1">
                                                        <?php
                                                            if($month=="January"){
                                                        ?>
                                                        <option class="flatpickr-monthDropdown-month" value="1" tabindex="-1" selected>January</option>
                                                        <?php }
                                                        else{
                                                            ?>
                                                            
                                                            <option class="flatpickr-monthDropdown-month" value="1" tabindex="-1">January</option>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php
                                                            if($month=="February"){
                                                        ?>
                                                        <option class="flatpickr-monthDropdown-month" value="2" tabindex="-1" selected>February</option>
                                                        <?php }
                                                        else{
                                                            ?>
                                                            
                                                            <option class="flatpickr-monthDropdown-month" value="2" tabindex="-1">February</option>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php
                                                            if($month=="March"){
                                                        ?>
                                                        <option class="flatpickr-monthDropdown-month" value="3" tabindex="-1" selected>March</option>
                                                        <?php }
                                                        else{
                                                            ?>
                                                            
                                                            <option class="flatpickr-monthDropdown-month" value="3" tabindex="-1">March</option>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php
                                                            if($month=="April"){
                                                        ?>
                                                        <option class="flatpickr-monthDropdown-month" value="4" tabindex="-1" selected>April</option>
                                                        <?php }
                                                        else{
                                                            ?>
                                                            
                                                            <option class="flatpickr-monthDropdown-month" value="4" tabindex="-1">April</option>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php
                                                            if($month=="May"){
                                                        ?>
                                                        <option class="flatpickr-monthDropdown-month" value="5" tabindex="-1" selected>May</option>
                                                        <?php }
                                                        else{
                                                            ?>
                                                            
                                                            <option class="flatpickr-monthDropdown-month" value="5" tabindex="-1">May</option>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php
                                                            if($month=="June"){
                                                        ?>
                                                        <option class="flatpickr-monthDropdown-month" value="6" tabindex="-1" selected>June</option>
                                                        <?php }
                                                        else{
                                                            ?>
                                                            
                                                            <option class="flatpickr-monthDropdown-month" value="6" tabindex="-1">June</option>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php
                                                            if($month=="July"){
                                                        ?>
                                                        <option class="flatpickr-monthDropdown-month" value="7" tabindex="-1" selected>July</option>
                                                        <?php }
                                                        else{
                                                            ?>
                                                            
                                                            <option class="flatpickr-monthDropdown-month" value="7" tabindex="-1">July</option>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php
                                                            if($month=="August"){
                                                        ?>
                                                        <option class="flatpickr-monthDropdown-month" value="8" tabindex="-1" selected>August</option>
                                                        <?php }
                                                        else{
                                                            ?>
                                                            
                                                            <option class="flatpickr-monthDropdown-month" value="8" tabindex="-1">August</option>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php
                                                            if($month=="September"){
                                                        ?>
                                                        <option class="flatpickr-monthDropdown-month" value="9" tabindex="-1" selected>September</option>
                                                        <?php }
                                                        else{
                                                            ?>
                                                            
                                                            <option class="flatpickr-monthDropdown-month" value="9" tabindex="-1">September</option>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php
                                                            if($month=="October"){
                                                        ?>
                                                        <option class="flatpickr-monthDropdown-month" value="10" tabindex="-1" selected>October</option>
                                                        <?php }
                                                        else{
                                                            ?>
                                                            
                                                            <option class="flatpickr-monthDropdown-month" value="10" tabindex="-1">October</option>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php
                                                            if($month=="November"){
                                                        ?>
                                                        <option class="flatpickr-monthDropdown-month" value="11" tabindex="-1" selected>November</option>
                                                        <?php }
                                                        else{
                                                            ?>
                                                            
                                                            <option class="flatpickr-monthDropdown-month" value="11" tabindex="-1">November</option>
                                                            <?php
                                                        }
                                                        ?>

                                                        <?php
                                                            if($month=="December"){
                                                        ?>
                                                        <option class="flatpickr-monthDropdown-month" value="12" tabindex="-1" selected>December</option>
                                                        <?php }
                                                        else{
                                                            ?>
                                                            
                                                            <option class="flatpickr-monthDropdown-month" value="12" tabindex="-1">December</option>
                                                            <?php
                                                        }
                                                        ?>
                                                        
                                                    </select>
                                                    
                                            
                                        
                            
                                                    
                                                    
                                                    
                                            </div>
                                        </div>
                                        <div class="numInputWrapper">
                                                    <div>													<!-- <input class="numInput cur-year" type="number" tabindex="-1"aria-label="Year" value="2021"> -->
                                                        <select class="form-control mb-3"  id="year" aria-label="Month" tabindex="-1">
                                                                    <?php

                                                                    $year=date("Y");

                                                                    ?>

                                                                <?php
                                                                    if($year==2020){
                                                                ?>
                                                                <option  value="2020" tabindex="-1" selected>2020</option>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    
                                                                    <option  value="2020" tabindex="-1">2020</option>
                                                                    <?php
                                                                }
                                                                ?>

                                                                <?php
                                                                    if($year==2021){
                                                                ?>
                                                                <option  value="2021" tabindex="-1" selected>2021</option>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    
                                                                    <option  value="2021" tabindex="-1">2021</option>
                                                                    <?php
                                                                }
                                                                ?>

                                                                <?php
                                                                    if($year==2022){
                                                                ?>
                                                                <option  value="2022" tabindex="-1" selected>2022</option>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    
                                                                    <option  value="2022" tabindex="-1">2022</option>
                                                                    <?php
                                                                }
                                                                ?>

                                                                <?php
                                                                    if($year==2023){
                                                                ?>
                                                                <option  value="2023" tabindex="-1" selected>2023</option>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    
                                                                    <option  value="2023" tabindex="-1">2023</option>
                                                                    <?php
                                                                }
                                                                ?>

                                                                <?php
                                                                    if($year==2024){
                                                                ?>
                                                                <option  value="2024" tabindex="-1" selected>2024</option>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    
                                                                    <option  value="2024" tabindex="-1">2024</option>
                                                                    <?php
                                                                }
                                                                ?>

                                                                <?php
                                                                    if($year==2025){
                                                                ?>
                                                                <option  value="2025" tabindex="-1" selected>2025</option>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    
                                                                    <option  value="2025" tabindex="-1">2025</option>
                                                                    <?php
                                                                }
                                                                ?>

                                                                <?php
                                                                    if($year==2026){
                                                                ?>
                                                                <option  value="2026" tabindex="-1" selected>2026</option>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    
                                                                    <option  value="2026" tabindex="-1">2026</option>
                                                                    <?php
                                                                }
                                                                ?>

                                                                <?php
                                                                    if($year==2027){
                                                                ?>
                                                                <option  value="2027" tabindex="-1" selected>2027</option>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    
                                                                    <option  value="2027" tabindex="-1">2027</option>
                                                                    <?php
                                                                }
                                                                ?>

                                                                <?php
                                                                    if($year==2028){
                                                                ?>
                                                                <option  value="2028" tabindex="-1" selected>2028</option>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    
                                                                    <option  value="2028" tabindex="-1">2028</option>
                                                                    <?php
                                                                }
                                                                ?>

                                                                <?php
                                                                    if($year==2029){
                                                                ?>
                                                                <option  value="2029" tabindex="-1" selected>2029</option>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    
                                                                    <option  value="2029" tabindex="-1">2029</option>
                                                                    <?php
                                                                }
                                                                ?>

                                                                <?php
                                                                    if($year==2030){
                                                                ?>
                                                                <option  value="2030" tabindex="-1" selected>2030</option>
                                                                <?php }
                                                                else{
                                                                    ?>
                                                                    
                                                                    <option  value="2030" tabindex="-1">2030</option>
                                                                    <?php
                                                                }
                                                                ?>



                                                            
                                                            
                                                        </select>
                                                        </div>	
                                                        
                                                    </div>
                                        
                                    </div>
                                    </br>
                                    <div class="ajax">
                        
                                    <div id="appointments">
                                    <!-- <p>hi</p> -->

                                    </div>
                                    </div>
                                </div>
                            </div>
                     </div>
                    

                    <!-- </div> -->

				</div>
			</main>

			<?php include("footer.php"); ?>
		</div>
	</div>

	<script src="js/app.js"></script>

    <script type="text/javascript" src="jquery/jquery.js"></script>
	<script type="text/javascript">
        $(document).ready(function(){
            function loadData(type, category_id, year_id, e_id){
                $.ajax({
                    url : "deleted-users-appointment-ajax.php",
                    type : "POST",
                    data: {type : type, id : category_id, year : year_id, e_id:e_id},
                    success : function(data){
                        if(type == "stateData"||type == "yearData"||type == "employeeData"){
                            $("#appointments").html(data);
                        }else{
                            $("#employee_id").append(data);
                        }
                        
                    }
                });
            }
            var country = $("#employee_id").val();
            var year = $("#year").val();
            var e_id = $("#e-id").val();
            loadData("stateData", country,year,e_id);

            $("#employee_id").on("change",function(){
                var country = $("#employee_id").val();
                var year = $("#year").val();
                var e_id = $("#e-id").val();
            console.log(country);
                if(country != ""){
                    loadData("stateData", country,year,e_id);
                }else{
                    $("#appointments").html("");
                }

                
            })

            $("#year").on("change",function(){
                var country = $("#employee_id").val();
                var year = $("#year").val();
                var e_id = $("#e-id").val();
            console.log(year);
                if(year != ""){
                    loadData("yearData",country, year,e_id);
                }else{
                    $("#appointments").html("");
                }

                
            })

            $("#e-id").on("change",function(){
                var country = $("#employee_id").val();
                var year = $("#year").val();
                var e_id = $("#e-id").val();
            console.log(e_id);
                if(e_id != ""){
                    loadData("employeeData",country, year, e_id);
                }else{
                    $("#appointments").html("");
                }

                
            })
        });
    </script>



</body>

</html>