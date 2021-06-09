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
					<h1 class="h3 mb-3">Employee</h1>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<!-- <h5 class="card-title">Employee Table</h5> -->
									<!-- <h6 class="card-subtitle text-muted">Add <code>.table-bordered</code> for borders on all sides of the table and cells.</h6> -->
								</div>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th style="width:40%;">Email ID</th>
											<th style="width:25%">Name</th>
											<!-- <th class="d-none d-md-table-cell" style="width:25%">Date of Birth</th> -->
											<th>Role</th>
											<th>Password</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$user_id = $_GET['id'];
										$role = "employee";
										$sql = "SELECT user_id, name FROM users WHERE user_id=`$user_id`";
										$result = mysqli_query($db, "SELECT id,user_id,name,role,password from `users` where user_id='$user_id';");
										// echo $result;
										if ($result) { ?>
											<?php
											// output data of each row
											while ($row = $result->fetch_assoc()) {
												$e_id = $row['id'];
												$sql1 = "SELECT details,color,officer FROM employee_details WHERE user_id=$e_id";
												$result1 = mysqli_query($db, $sql1);
												$row1 = $result1->fetch_assoc();
												$role_employee = $row1['officer'];
												if ($role_employee == 0) {
													$role_name = "Employee";
												} else {
													$role_name = "Officer";
												}
												echo "<tr><td>" . $row["user_id"] . "</td><td>" . $row["name"] . "</td><td class='table-action'>" . $role_name . "</td></td><td class='table-action'>" . $row["password"] . "</td></tr>";
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
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									<div class="float-left">
										<h5 class="card-title mb-4">Employee Details</h5>
										<?php
										if ($row1) {
										?>
											<p><strong>Details : </strong><?php echo $row1['details']; ?></p>
											<p><strong>Color : </strong></p>
											<div class="col-md-5">
												<?php $color = $row1['color']; ?>
												<div style="background-color:<?php echo $color; ?>;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</div>
											</div>
											<?php // for appointment of the employee
											// $sql2 =   "SELECT date,time,employee_id,customer_id from `appointments` where employee_id = $e_id AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month AND deleted_at is NULL";
											// $query2 = mysqli_query($db, $sql2) or die("Query Unsuccessful.");
											// while ($row2 = $query2->fetch_assoc()) {		
											// }
											?>
										<?php
										} else { ?>
											<div class="mb-3">
												<button class="btn btn-primary"><a style="text-decoration:none; color:white;" href="add-employee-details.php?id=<?php echo $e_id ?>">Add Employee Details</a></button>
											</div>
										<?php }
										?>
										</br>
										<div style='float:center'>
										<?php
										$sql_img =   "SELECT * from `employee_images` where employee_id = $e_id AND deleted_at is NULL";
										$query_img = mysqli_query($db, $sql_img) or die("Query Unsuccessfuls.");
										$row_img = $query_img->fetch_assoc();

										?>
											<button class='btn btn-primary'>
												<i class="align-middle" data-feather="edit-3"></i>
												<a style='color:white;text-decoration: none;' href='edit-employee-details.php?id=<?php echo $e_id; ?>'>Edit Additional Details</a>
											</button>
											<?php if(!$row_img) {
										?>
											</br></br>
											
											<div class="mb-3">
												<button class="btn btn-primary"><a style="text-decoration:none; color:white;" href="employee-image.php?id=<?php echo $e_id ?>">Add Employee Image</a></button>
											</div>
										<?php

										}else {
										?>
											</br></br>
											
											<div class="mb-3">
												<button class="btn btn-primary"><a style="text-decoration:none; color:white;" href="edit-employee-image.php?id=<?php echo $e_id ?>">Change Employee Image</a></button>
											</div>
										<?php

										} ?>
										</div>
										</br>
									</div>

									<div class="float-right">
										<?php
										
										if ($row_img) {
											$path = $row_img["file_path"];

										?>
											<img float="right" height="200px" src="<?php echo ($path); ?>">
										<?php
										} 
										?>

										</br>

									</div>
								</div>
							</div>


						</div>


					</div>
			</main>

			<?php include("footer.php"); ?>
		</div>
	</div>

	<script src="js/app.js"></script>

</body>

</html>