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

	<title>Monika</title>

	<link href="css/app.css" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">

		<?php include "sidebar.php";?>


				<!-- <div class="sidebar-cta">
					<div class="sidebar-cta-content">
						<strong class="d-inline-block mb-2">Upgrade to Pro</strong>
						<div class="mb-3 text-sm">
							Are you looking for more components? Check out our premium version.
						</div>
						<a href="https://adminkit.io/pricing" target="_blank" class="btn btn-primary btn-block">Upgrade to Pro</a>
					</div>
				</div> -->
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
          <i class="hamburger align-self-center"></i>
        </a>



				<?php include "navbar.php";?>

			</nav>

			<main class="content">
				<?php

//for employee count
$role_e = "employee";
// $sql = "SELECT user_id, name FROM users WHERE role=`employee`";
$employee = mysqli_query($db, "SELECT count(id) from `users` where role='$role_e' AND deleted_at is NULL;");
$employee_count = $employee->fetch_assoc();
// echo $employee_count['count(id)'];

//for customer count
$role_c = "customer";
$customer = mysqli_query($db, "SELECT count(id) from `users` where role='$role_c' AND deleted_at is NULL;;");
$customer_count = $customer->fetch_assoc();
// echo $customer_count['count(id)'];

?>
				<div class="container-fluid p-0">

					<div class="row mb-2 mb-xl-3">
						<div class="col-auto d-none d-sm-block">
							<h3>Överblick</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
								<!-- breadcrumb -->
								<!-- <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">AdminKit</a></li>
									<li class="breadcrumb-item"><a href="#">Dashboards</a></li>
									<li class="breadcrumb-item active" aria-current="page">Analytics</li>
								</ol> -->
							</nav>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title mb-4">Antal anställda</h5>
												<h1 class="mt-1 mb-3"><?php echo $employee_count['count(id)']; ?></h1>
												<div class="mb-1">
													<!-- <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span> -->
													<!-- <span class="text-muted">Since last week</span> -->
												</div>
											</div>
										</div>
										<!-- <div class="card">
											<div class="card-body">
												<h5 class="card-title mb-4">Visitors</h5>
												<h1 class="mt-1 mb-3">14.212</h1>
												<div class="mb-1">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
													<span class="text-muted">Since last week</span>
												</div>
											</div>
										</div> -->
									</div>
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title mb-4">Antal kunder</h5>
												<h1 class="mt-1 mb-3"><?php echo $customer_count['count(id)']; ?></h1>
												<div class="mb-1">
													<!-- <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65% </span> -->
													<!-- <span class="text-muted">Since last week</span> -->
												</div>
											</div>
										</div>
										<!-- <div class="card">
											<div class="card-body">
												<h5 class="card-title mb-4">Orders</h5>
												<h1 class="mt-1 mb-3">64</h1>
												<div class="mb-1">
													<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25% </span>
													<span class="text-muted">Since last week</span>
												</div>
											</div>
										</div> -->
									</div>
									<!-- <div class="">
										<div class="card">
											<div class="card-body">
											
												
											</div>
										</div>
									</div> -->
						
					
								</div>
							</div>
						</div>

						<!-- <div class="col-xl-6 col-xxl-7">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Recent Movement</h5>
								</div>
								<div class="card-body py-3">
									<div class="chart chart-sm">
										<canvas id="chartjs-dashboard-line"></canvas>
									</div>
								</div>
							</div>
						</div> -->


						
						<div class="col-xl-6 col-xxl-7">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Beräknade timmar arbetade denna månad</h5>
								</div>
								<div class="card-body py-3">
								<div class="card flex-fill">
								<div class="card-header">
									<div class="flatpickr-months">
									<div>
									<?php 
										$role2="employee";
										$result2 = mysqli_query($db,"SELECT id,name from `users` where role='$role2' AND deleted_at is NULL;");
									?>
										<select class="form-control mb-3" id="e-id2">
											<option value="0"selected>Alla anställda</option>
											<?php 
											while($row2 = $result2->fetch_assoc())
											echo "<option value='".$row2['id']."'>".$row2['name']."</option>"
											 ?>
										</select>
									</div>
									
										<!-- <span class="flatpickr-prev-month">
											<span class="fas fa-chevron-left" title="Previous month"></span>
										</span> -->
										<div class="flatpickr-month">
											<div class="flatpickr-current-month">
														<?php
															$month= date("F");
														?>
													<select class="flatpickr-monthDropdown-months" id="employee_id2" aria-label="Month" tabindex="-1">
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
														<select class="form-control mb-3"  id="year2" aria-label="Month" tabindex="-1">
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



															
															
														</select></div>	
														<!-- <span class="arrowUp"></span>
														<span class="arrowDown"></span> -->
													</div>
										<!-- <span class="flatpickr-next-month">
											<span class="fas fa-chevron-right" title="Next month"></span>
										</span> -->
									</div>
									</br>
									<div class="ajax2">
						
									<div id="hours-worked">
									<!-- <p>hi</p> -->

									</div>
									</div>
								</div>
							</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<!-- <div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Demo Chart</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="py-3">
											<div class="chart chart-xs">
												<canvas id="chartjs-dashboard-pie"></canvas>
											</div>
										</div>

										<table class="table mb-0">
											<tbody>
												<tr>
													<td>Chrome</td>
													<td class="text-right">4306</td>
												</tr>
												<tr>
													<td>Firefox</td>
													<td class="text-right">3801</td>
												</tr>
												<tr>
													<td>IE</td>
													<td class="text-right">1689</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div> -->
						<!-- <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Real-Time</h5>
								</div>
								<div class="card-body px-4">
									<div id="world_map" style="height:350px;"></div>
								</div>
							</div>
						</div> -->
						<!-- <div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Calendar</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="chart">
											<div id="datetimepicker-dashboard">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->


					<div class="col-12 col-md-12 col-xxl-3 d-flex order-1 order-xxl-1">
							<div class="card flex-fill">
								<div class="card-header">
									<div class="flatpickr-months">
									<div>
									<?php 
										$role="employee";
										$result = mysqli_query($db,"SELECT id,name from `users` where role='$role' and deleted_at is NULL;");
									?>
										<select class="form-control mb-3" id="e-id">
											<option value="0"selected>Alla anställda</option>
											<?php 
											while($row = $result->fetch_assoc())
											echo "<option value='".$row['id']."'>".$row['name']."</option>"
											 ?>
										</select>
									</div>
									
										<!-- <span class="flatpickr-prev-month">
											<span class="fas fa-chevron-left" title="Previous month"></span>
										</span> -->
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



															
															
														</select></div>	
														<!-- <span class="arrowUp"></span>
														<span class="arrowDown"></span> -->
													</div>
										<!-- <span class="flatpickr-next-month">
											<span class="fas fa-chevron-right" title="Next month"></span>
										</span> -->
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
					<!-- <div class="row">
						<div class="col-12 col-lg-8 col-xxl-9 d-flex">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Latest Projects</h5>
								</div>
								<table class="table table-hover my-0">
									<thead>
										<tr>
											<th>Name</th>
											<th class="d-none d-xl-table-cell">Start Date</th>
											<th class="d-none d-xl-table-cell">End Date</th>
											<th>Status</th>
											<th class="d-none d-md-table-cell">Assignee</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Project Apollo</td>
											<td class="d-none d-xl-table-cell">01/01/2020</td>
											<td class="d-none d-xl-table-cell">31/06/2020</td>
											<td><span class="badge bg-success">Done</span></td>
											<td class="d-none d-md-table-cell">Vanessa Tucker</td>
										</tr>
										<tr>
											<td>Project Fireball</td>
											<td class="d-none d-xl-table-cell">01/01/2020</td>
											<td class="d-none d-xl-table-cell">31/06/2020</td>
											<td><span class="badge bg-danger">Cancelled</span></td>
											<td class="d-none d-md-table-cell">William Harris</td>
										</tr>
										<tr>
											<td>Project Hades</td>
											<td class="d-none d-xl-table-cell">01/01/2020</td>
											<td class="d-none d-xl-table-cell">31/06/2020</td>
											<td><span class="badge bg-success">Done</span></td>
											<td class="d-none d-md-table-cell">Sharon Lessman</td>
										</tr>
										<tr>
											<td>Project Nitro</td>
											<td class="d-none d-xl-table-cell">01/01/2020</td>
											<td class="d-none d-xl-table-cell">31/06/2020</td>
											<td><span class="badge bg-warning">In progress</span></td>
											<td class="d-none d-md-table-cell">Vanessa Tucker</td>
										</tr>
										<tr>
											<td>Project Phoenix</td>
											<td class="d-none d-xl-table-cell">01/01/2020</td>
											<td class="d-none d-xl-table-cell">31/06/2020</td>
											<td><span class="badge bg-success">Done</span></td>
											<td class="d-none d-md-table-cell">William Harris</td>
										</tr>
										<tr>
											<td>Project X</td>
											<td class="d-none d-xl-table-cell">01/01/2020</td>
											<td class="d-none d-xl-table-cell">31/06/2020</td>
											<td><span class="badge bg-success">Done</span></td>
											<td class="d-none d-md-table-cell">Sharon Lessman</td>
										</tr>
										<tr>
											<td>Project Romeo</td>
											<td class="d-none d-xl-table-cell">01/01/2020</td>
											<td class="d-none d-xl-table-cell">31/06/2020</td>
											<td><span class="badge bg-success">Done</span></td>
											<td class="d-none d-md-table-cell">Christina Mason</td>
										</tr>
										<tr>
											<td>Project Wombat</td>
											<td class="d-none d-xl-table-cell">01/01/2020</td>
											<td class="d-none d-xl-table-cell">31/06/2020</td>
											<td><span class="badge bg-warning">In progress</span></td>
											<td class="d-none d-md-table-cell">William Harris</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-12 col-lg-4 col-xxl-3 d-flex">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Monthly Sales</h5>
								</div>
								<div class="card-body d-flex w-100">
									<div class="align-self-center chart chart-lg">
										<canvas id="chartjs-dashboard-bar"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div> -->

				</div>
			</main>
			<?php include "footer.php";?>

		</div>
	</div>

	<script src="js/app.js"></script>


	


	<script type="text/javascript" src="jquery/jquery.js"></script>
	<script type="text/javascript">
  $(document).ready(function(){
  	function loadData(type, category_id, year_id, e_id){
  		$.ajax({
  			url : "dashboard-appointment-ajax.php",
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




<script type="text/javascript">
  $(document).ready(function(){
  	function loadData(type, category_id, year_id, e_id){
  		$.ajax({
  			url : "dashboard-hours-worked-ajax.php",
  			type : "POST",
  			data: {type : type, id : category_id, year : year_id, e_id:e_id},
  			success : function(data){
  				if(type == "stateData"||type == "yearData"||type == "employeeData"){
  					$("#hours-worked").html(data);
  				}else{
  					$("#employee_id2").append(data);
  				}
  				
  			}
  		});
  	}
	  var country = $("#employee_id2").val();
	  var year = $("#year2").val();
	  var e_id = $("#e-id2").val();
  	  loadData("stateData", country,year,e_id);

  	$("#employee_id2").on("change",function(){
  		var country = $("#employee_id2").val();
		var year = $("#year2").val();
		var e_id = $("#e-id2").val();
	console.log(country);
  		if(country != ""){
  			loadData("stateData", country,year,e_id);
  		}else{
  			$("#hours-worked").html("");
  		}

  		
  	})

	  $("#year2").on("change",function(){
		var country = $("#employee_id2").val();
  		var year = $("#year2").val();
		var e_id = $("#e-id2").val();
	console.log(year);
  		if(year != ""){
  			loadData("yearData",country, year,e_id);
  		}else{
  			$("#hours-worked").html("");
  		}

  		
  	})

	  $("#e-id2").on("change",function(){
		var country = $("#employee_id2").val();
  		var year = $("#year2").val();
		var e_id = $("#e-id2").val();
	console.log(e_id);
  		if(e_id != ""){
  			loadData("employeeData",country, year, e_id);
  		}else{
  			$("#hours-worked").html("");
  		}

  		
  	})
  });
</script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			document.getElementById("datetimepicker-dashboard").flatpickr({
				inline: true,
				prevArrow: "<span class=\"fas fa-chevron-left\" title=\"Previous month\"></span>",
				nextArrow: "<span class=\"fas fa-chevron-right\" title=\"Next month\"></span>",
			});
		});
	</script>
	<script>
function myFunction(appointment_id) {

  if (confirm("Do you want to cancel this appointment?")) {
    console.log(appointment_id);
	return true;
 }

}
</script>

</body>

</html>