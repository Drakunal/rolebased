<?php
session_start();
include "connection.php";
if (!isset($_SESSION['login_user']) || $_SESSION['role'] != "admin") {
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

					<h1 class="h3 mb-3">Customer</h1>

					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">


									<table class="table table-bordered">
										<thead>
											<tr>
												<th style="width:40%;">Customer ID</th>
												<th style="width:25%">Name</th>

												<th>Role</th>
												<th>Password</th>
											</tr>
										</thead>
										<tbody>

											<?php
											$user_id = $_GET['id'];
											$role = "customer";
											$sql = "SELECT user_id, name FROM users WHERE user_id=`$user_id`";
											$result = mysqli_query($db, "SELECT id,user_id,name,role,password from `users` where user_id='$user_id';");
											$row = $result->fetch_assoc();
											$idd = $row["id"];
											// echo $idd;
											$result2 = mysqli_query($db, "SELECT base_price,appointment_type,details,time_alloted,admin_note,is_personal from `customer_details` where user_id='$idd';");
											$row2 = $result2->fetch_assoc();
											// echo $result;
											if ($result) { ?>
												<?php
												// output data of each row
												$customer_id = $row["user_id"];
												echo "<tr><td>" . $customer_id . "</td><td>" . $row["name"] . "</td><td class='table-action'>" . $row["role"] . "</td></td><td class='table-action'>" . $row["password"] . "</td></tr>";
												?>

												</tr>
											<?php

											}
											?>

										</tbody>
									</table>
									</br></br></br>
									<?php if ($row2) {

										$time_alloted = $row2["time_alloted"];

										$pos = strpos($time_alloted, '.');
										if ($pos === false) { // it is integer number
											$time_alloted = $time_alloted;
										} else { // it is decimal number
											$time_alloted = rtrim(rtrim($time_alloted, '0'), '.');
										}

									?>


										<h4>Additional Details</h4>
										<?php if ($row2["details"] != NULL) {
										?>
											<p><strong>Details :</strong> <?php echo $row2["details"]; ?></p>
										<?php } ?>
										<p><strong>Customer Type :</strong>
											<?php if ($row2["is_personal"] == 0) {
												echo "Private Company";
											} elseif ($row2["is_personal"] == 1) {
												echo "Personal Use";
											} ?></p>

										<p><strong>Base Price : </strong><?php echo $row2['base_price']; ?> Kr</p>
										<p><strong>Time Alloted : </strong><?php echo $time_alloted; ?> hours</p>
										<?php if ($row2["admin_note"] != NULL) {
										?>
											<p><strong>Admin Note(can be viewed by Admin only) : </strong><?php echo $row2['admin_note']; ?></p>
										<?php } ?>

										<p><strong>Appointment Type : </strong> <?php
																				if ($row2["appointment_type"] == "monthly") {
																					echo "Monthly";
																				} elseif ($row2["appointment_type"] == "bi-weekly") {
																					echo "Bi-weekly";
																				} elseif ($row2["appointment_type"] == "not-regular") {
																					echo "Not-regular";
																				} elseif ($row2["appointment_type"] == "weekly") {
																					echo "Weekly";
																				} ?></p>



										<!-- <div style='float:left'> -->



										<div style='float:center'>
											<button class='btn btn-primary'>
												<i class="align-middle" data-feather="edit-3"></i>
												<a style='color:white;text-decoration: none;' href='edit-customer-details.php?id=<?php echo $idd; ?>'>Edit Additional Details</a>
											</button>
										</div>

										</br>

										<?php
										$result3 = mysqli_query($db, "SELECT date,time,employee_id,customer_id from `appointments` where customer_id='$idd' AND deleted_at is NULL AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month AND deleted_at is NULL;");
										$row3 = $result3->fetch_assoc();
										if ($row3) {
										?>
											</br>
											<?php
											$employee_id = $row3["employee_id"];
											$employee_query = mysqli_query($db, "SELECT name from `users` where id='$employee_id' AND deleted_at is NULL");
											$employee_row = $employee_query->fetch_assoc();
											?>
											<hr>
											<h4>Appointment Details</h4>
											<p><strong>Time : </strong><?php echo date('G:i', strtotime($row3["time"])); ?></p>
											<p><strong>Date : </strong><?php echo $row3["date"]; ?></p> 
											<p><strong>Employee-Name : </strong><?php echo $employee_row['name']; ?></p> 
											<?php
											if ($row2["appointment_type"] == "bi-weekly") {
												// $result4 = mysqli_query($db,"SELECT date,time,employee_id,customer_id from `appointments` where customer_id='$idd';");
												$row3 = $result3->fetch_assoc();
												if ($row3) {
											?>

													<h4><u>Second Appointment Details</u></h4>
													<p><strong>Time : </strong> <?php
																					echo date('G:i', strtotime($row3["time"]));
																					?></p>
													<p><strong>Date : </strong> <?php echo $row3["date"]; ?></p>
													<p><strong>Employee-Name : </strong><?php echo $employee_row['name']; ?></p> 
												<?php

												} else {
												?>
													<h4>No Second Appointment present</h4>


											<?php }
											}
										} else {
											?>
											<div class="mb-3">
												<button class="btn btn-primary"><a style="text-decoration:none; color:white;" href="add-appointment.php?id=<?php echo $idd ?>">Add Customer Appointment</a></button>
											</div>
										<?php
										}
										?>

										<!-- </div> -->

									<?php } else {
									?>
										<h4>No Additional Details present</h4>

										<div class="mb-3">
											<button class="btn btn-primary"><a style="text-decoration:none; color:white;" href="add-customer-details.php?id=<?php echo $row['user_id'] ?>">Add Customer details</a></button>
										</div>
									<?php } ?>







								</div>

							</div>
			</main>


			<?php include("footer.php"); ?>
			<script src="js/app.js"></script>

</body>

</html>