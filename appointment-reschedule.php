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
            <?php
                    // $appointment_id = $_GET['id'];
                    
                    // $result = mysqli_query($db,"SELECT name,user_id,password from `users` where user_id='$user_id';");
                    // $res = mysqli_fetch_assoc($result);
                    // print_r($res);
                
                 ?>
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
							$appointment_id = $_GET['id'];
                            $sql="SELECT * FROM `appointments` WHERE id=$appointment_id";
                            $query=mysqli_query($db,$sql);
                            $row=$query->fetch_assoc();
                            $customer_id=$row['customer_id'];
                            $sql2="SELECT name,user_id FROM `users` WHERE id=$customer_id";
                            $query2=mysqli_query($db,$sql2);
                            $row2=$query2->fetch_assoc();

							// $role='employee';
							// $customer_details=mysqli_query($db,"SELECT appointment_type,user_id from `customer_details` where user_id='$customer_id';");
							// $result = mysqli_query($db,"SELECT id,name from `users` where role='$role';");
							// $customer_query = mysqli_query($db,"SELECT name,id from `users` where id='$customer_id';");
							// $customer_row= $customer_query->fetch_assoc();
							// $customer_details_row= $customer_details->fetch_assoc();
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
									<h4 class="card-subtitle text-muted">Reschedule Appointment for this customer.</h4>
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
												<input type="text"  name="customer_name"class="form-control" placeholder="name" readonly value="<?php echo $row2['name'];?>">
											</div>
											<div class="mb-3">
												<label class="form-label">Date</label>
												<input type="date" name="date" class="form-control" placeholder="appointment-date" value="<?php echo $row['date'];?>"">
											</div>
											<div class="mb-3">
												<label class="form-label">Time</label>
												<input type="time" name="time" class="form-control" placeholder="appointment-time"value="<?php  echo date('H:i', strtotime($row["time"]));?>">
											</div>

 
											<?php 
											// if($customer_details_row['appointment_type']!='not-regular'){
												?>
											<!-- <div class="mb-3">
												<label class="form-label">Fix the Duration of the appointment</label>
												<select class="form-control mb-3" id="appointment-duration" name="appointment-duration">
													<option value="3"selected>3 Months</option>
													<option value="6">6 Months</option>
													<option value="9">9 Months</option>
													<option value="12">12 Months</option>
												</select>
											</div> -->
											<?php

											// }
											// else{
                                                ?>
											<!-- <input type="number" value="1" name="appointment-duration" hidden class="form-control"> -->
											<?php

											// }
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

                        $p=mysqli_query($db,"UPDATE `appointments` SET employee_id = '$employee_id', date = '$date', time = '$time' WHERE id='$appointment_id' ;");

						// echo $appointment_duration;
                    
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