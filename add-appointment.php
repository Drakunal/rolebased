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

	<title>Form Layouts | AdminKit Demo</title>

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
					<h1 class="h3 mb-3">Add Customer Appointment</h1>
						<?php
							$customer_id = $_GET['id'];
							$role='employee';
							$customer_details=mysqli_query($db,"SELECT appointment_type,user_id from `customer_details` where user_id='$customer_id';");
							$result = mysqli_query($db,"SELECT id,name from `users` where role='$role';");
							$customer_query = mysqli_query($db,"SELECT name,id from `users` where id='$customer_id';");
							$customer_row= $customer_query->fetch_assoc();
							$customer_details_row= $customer_details->fetch_assoc();
							// echo $customer_details_row['appointment_type'];
							// echo $customer_id;
							// if($customer_details_row>0)
							// echo "bye";
							// else
							// echo "Tata";
						?>
					<div class="row">
						<div class="card">
							<iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Europe%2FStockholm&amp;src=ZzYzMGhkdjRmOWFhM2o3NDU0NDdoc29tMmNiaGlxM3BAaW1wb3J0LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;color=%23D50000&amp;showPrint=0&amp;showTitle=1&amp;showTabs=0&amp;showTz=0&amp;showNav=0&amp;showCalendars=0" style="border-width:0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
						</div>
					</div>
					<div class="row">
						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h4 class="card-subtitle text-muted">Add Appointment for this customer.</h4>
								</div>
								<div class="card-body">
									<form enctype="multipart/form-data" method="post" action="">
										<label class="form-label">Employee</label>
										<select class="form-control mb-3" id="employee_id" name="employee-id">
											<option value="0"selected>Select an Employee</option>
											<?php 
											// while($row = $result->fetch_assoc())
											// echo "<option value='".$row['id']."'>".$row['name']."</option>"
											 ?>
										</select>
										
											<div class="mb-3">
												<label class="form-label">Customer Name</label>
												<input type="text"  name="customer_name"class="form-control" placeholder="name" readonly value="<?php echo $customer_row['name'];?>">
											</div>
											<div class="mb-3">
												<label class="form-label">Date</label>
												<input type="date" name="date" class="form-control" placeholder="appointment-date">
											</div>
											<div class="mb-3">
												<label class="form-label">Time</label>
												<input type="time" name="time" class="form-control" placeholder="appointment-time">
											</div>
											<?php 
											if($customer_details_row['appointment_type']!='not-regular'){
												?>
											<div class="mb-3">
												<label class="form-label">Fix the Duration of the appointment</label>
												<select class="form-control mb-3" id="appointment-duration" name="appointment-duration">
													<option value="3"selected>3 Months</option>
													<option value="6">6 Months</option>
													<option value="9">9 Months</option>
													<option value="12">12 Months</option>
												</select>
											</div>
											<?php

											}
											else{?>
											<input type="number" value="1" name="appointment-duration" hidden class="form-control">
											<?php

											}
											?>
											<button type="submit" name="submit"class="btn btn-primary">Submit</button>
									</form>
									
								</div>
							</div>
						</div>
						<div class="col-md-6">
						<div class="card">
						<div class="ajax">
						
						<div id="appointments">
						

						</div>
						</div>
						</div></div>
					</div>

				</div>
			</main>



			<?php
				if(isset($_POST['submit']))
				{
						// $user_email_id = $_GET['id'];
						$customer_id=$customer_row['id'];
						$employee_id=$_POST['employee-id'];
						$time=$_POST['time'];
						$date=$_POST['date'];
						$appointment_duration=$_POST['appointment-duration'];
						// echo $appointment_duration;
                    
			?>
								
			<?php
				if($customer_details_row['appointment_type']=='bi-weekly')
				{
					for ($x = 1; $x <= 2*$appointment_duration; $x++) {
						mysqli_query($db,"INSERT INTO `appointments` (customer_id, employee_id, date, time) VALUES('$customer_id','$employee_id', '$date','$time');");	
						$customer_user_id=mysqli_query($db,"SELECT user_id from `users` where id=$customer_id;");?><?php
						// echo $customer_user_id;
						$customer_row = $customer_user_id->fetch_assoc();
						$c_id=$customer_row["user_id"];
						mysqli_query($db,"INSERT INTO `events` (title,start_event,customer_id, employee_id, date, time) VALUES('$c_id', '$date','$customer_id','$employee_id', '$date','$time');");
						$date=date('Y-m-d', strtotime($date. ' + 14 days'));
					}
					
				}
				elseif($customer_details_row['appointment_type']=='monthly')
				{
					for ($x = 1; $x <= $appointment_duration; $x++) {
						mysqli_query($db,"INSERT INTO `appointments` (customer_id, employee_id, date, time) VALUES('$customer_id','$employee_id', '$date','$time');");
						

						//for events section
						$customer_user_id=mysqli_query($db,"SELECT user_id from `users` where id=$customer_id;");?><?php
						// echo $customer_user_id;
						$customer_row = $customer_user_id->fetch_assoc();
						$c_id=$customer_row["user_id"];
						mysqli_query($db,"INSERT INTO `events` (title,start_event,customer_id, employee_id, date, time) VALUES('$c_id', '$date','$customer_id','$employee_id', '$date','$time');");

						

						$date_temp=date('Y-m-d', strtotime($date));
						$date_temp_month=date("F",strtotime($date_temp));  //month
						// $date_temp_week=date("d",$date_temp); // day of the date
						// $temp_week_number=ceil($date_temp_week/7); // week of the date


						$date=date('Y-m-d', strtotime($date. ' + 28 days'));
						$date_month=date("F",strtotime($date));
						// $date_week=date("d",$date);
						// $week_number=ceil($date_week/7);
						if($date_temp_month==$date_month){ // it means the previous and current appointment are in same month so add +7
							$date=date('Y-m-d', strtotime($date. ' + 7 days'));
						}
						// if($week_number!=$temp_week_number){

						// 	$difference=abs($week_number-$temp_week_number);
						// 	$difference_in_days=$difference*7;
						// 	$date=date('Y-m-d', strtotime($date. ' - '.$difference_in_days.' days'));

						// }

					}
					
				}
				elseif($customer_details_row['appointment_type']=='not-regular')
				{
					
						mysqli_query($db,"INSERT INTO `appointments` (customer_id, employee_id, date, time) VALUES('$customer_id','$employee_id', '$date','$time');");	
						$customer_user_id=mysqli_query($db,"SELECT user_id from `users` where id=$customer_id;");?><?php
						// echo $customer_user_id;
						$customer_row = $customer_user_id->fetch_assoc();
						$c_id=$customer_row["user_id"];
						mysqli_query($db,"INSERT INTO `events` (title,start_event,customer_id, employee_id, date, time) VALUES('$c_id', '$date','$customer_id','$employee_id', '$date','$time');");

					
					
					
				}
				
			?>
			<script>
				
				alert("Customer Details Saved");
				window.location.href = "customer-list.php";
			
			</script>
			<?php
				}
			?>
			<?php include("footer.php"); ?>
		</div>
	</div>
	<script type="text/javascript" src="jquery/jquery.js"></script>
	<script src="js/app.js"></script>
	<script type="text/javascript">
  $(document).ready(function(){
  	function loadData(type, category_id){
  		$.ajax({
  			url : "employee-ajax.php",
  			type : "POST",
  			data: {type : type, id : category_id},
  			success : function(data){
  				if(type == "stateData"){
  					$("#appointments").html(data);
  				}else{
  					$("#employee_id").append(data);
  				}
  				
  			}
  		});
  	}

  	loadData();

  	$("#employee_id").on("change",function(){
  		var country = $("#employee_id").val();

  		if(country != ""){
  			loadData("stateData", country);
  		}else{
  			$("#appointments").html("");
  		}

  		
  	})
  });
</script>


</body>
</html>