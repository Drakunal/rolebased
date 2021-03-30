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

					<h1 class="h3 mb-3">Add Customer Details form</h1>

					<div class="row">
						<div class="">
							<div class="card">
								<div class="card-header">
									<!-- <h5 class="card-title">Add Employee form</h5> -->
									<h6 class="card-subtitle text-muted">Add your customer details here.</h6>
								</div>
								<div class="card-body">
									<form enctype="multipart/form-data" method="post" action="">
										
										<div class="mb-3">
											<label class="form-label">Time alloted in minutes</label>
											<input type="number" required name="time"class="form-control" placeholder="number of minutes">
										</div>
                                        
                                        
										<div class="mb-3">
											<label class="form-label">Details</label>
											<textarea required class="form-control"name="details" placeholder="Details" rows="1"></textarea>
										</div>
										<div class="mb-3">
											<label class="form-check"><input class="form-check-input" type="radio" value="not-regular" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" checked>
														<span class="form-check-label">
															Not Regular
														</span></label>
											<label class="form-check">
													<input class="form-check-input" type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" value="regular">
														<span class="form-check-label">
															Regular
														</span>
												</label>
												<div  id="ifYes" style="display:none">
												<label class="form-check">
													<input class="form-check-input" type="radio" value="bi-weekly" name="appointment-type" checked>
														<span class="form-check-label">
															Bi-weekly
														</span>
												</label>
												<label class="form-check">
            										<input class="form-check-input" type="radio" value="monthly" name="appointment-type">
           												 <span class="form-check-label">
             												 Monthly
           												 </span>
        										  </label>

												</div>
												
										</div>
										
										<button type="submit" name="submit"class="btn btn-primary">Submit</button>
									</form>
								</div>
							</div>
						</div>
						
							</div>
						</div>
					</div>

				</div>
			</main>



			<?php
			if(isset($_POST['submit']))
			{
                    $user_email_id = $_GET['id'];
					$time=$_POST['time'];
					$appointment_type=$_POST['appointment-type'];
					$regularity=$_POST['yesno'];
					if($regularity=="not-regular"){
						$appointment_type=$regularity;
					}
					$details=$_POST['details'];
                    $result = mysqli_query($db,"SELECT id from `users` where user_id='$user_email_id';");
                    $row = $result->fetch_assoc();
                    $user_id=$row['id'];
				
						
							?>
								
									<?php
						

					mysqli_query($db,"INSERT INTO `customer_details` (user_id, details, time_alloted,appointment_type) VALUES('$user_id', '$details','$time','$appointment_type');");
				
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

	<script src="js/app.js"></script>
	

</body>

</html>