<?php
session_start();
include "connection.php";
if (!isset($_SESSION['login_user']) || $_SESSION['role'] != "customer") {
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">

				<?php include "sidebar-c.php"; ?>

			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
					<i class="hamburger align-self-center"></i>
				</a>



				<?php include "navbar-c.php"; ?>

			</nav>

			<main class="content">
				<div class="container-fluid p-0">
					<div class="row mb-2 mb-xl-3">
						<div class="col-auto d-none d-sm-block">
							<h3><strong>Översikt</strong></h3>
						</div>
					</div>
					<?php
					$temp = $_SESSION['id'];
					$query = mysqli_query($db, "SELECT * from `appointments` where date=CURDATE() AND customer_id=$temp AND deleted_at is NULL order by time;") or die("Query Unsuccessful.");
					?>
					<?php
					if ($query->num_rows > 0) {
					?>
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">

										<h3>Dagens möten</h3>
										<table id="appointment-lists" class="table table-striped">
											<thead>

												<tr>
													<th>Anställd</th>
													<th>Datum</th>
													<th>Tid</th>
												</tr>
											</thead>
											<tbody>
												<?php

												// output data of each row
												while ($row = $query->fetch_assoc()) {
													$employee_id = $row["employee_id"];
													$sql22 = "SELECT user_id,name  FROM users WHERE id='$employee_id';";
													$result22 = mysqli_query($db, $sql22) or die("Query unsuccessful1");
													$row22 = $result22->fetch_assoc();
													$time = date('G:i', strtotime($row["time"]));
													echo "<tr><td>" . $row22["name"] . "</td><td>" . $row["date"] . "</td><td>" . $time . "</td></tr>";
												?>
													</tr>
												<?php
												}
												?>


											</tbody>
										</table>
										</br>
									</div>
								</div>
							</div>
						</div>
					<?php
					}
					?>
					<!-- <div class="col-12 col-md-12 col-xxl-3 d-flex order-1 order-xxl-1"> -->
						<div class="card flex-fill w-100">
							<div class="card-header">
							Bokade tider
							</div>
							<div class="card-body py-3">
								<div class="card flex-fill">
									<div class="card-header">
										<div class="flatpickr-months">
											<div class="flatpickr-month">
												<div class="flatpickr-current-month">
													<?php
													$month = date("F");
													?>
													<select class="flatpickr-monthDropdown-months" id="employee_id2" aria-label="Month" tabindex="-1">
														<?php
														if ($month == "January") {
														?>
															<option class="flatpickr-monthDropdown-month" value="1" tabindex="-1" selected>Januari</option>
														<?php } else {
														?>

															<option class="flatpickr-monthDropdown-month" value="1" tabindex="-1">Januari</option>
														<?php
														}
														?>

														<?php
														if ($month == "February") {
														?>
															<option class="flatpickr-monthDropdown-month" value="2" tabindex="-1" selected>Februari</option>
														<?php } else {
														?>

															<option class="flatpickr-monthDropdown-month" value="2" tabindex="-1">Februari</option>
														<?php
														}
														?>

														<?php
														if ($month == "March") {
														?>
															<option class="flatpickr-monthDropdown-month" value="3" tabindex="-1" selected>Mars</option>
														<?php } else {
														?>

															<option class="flatpickr-monthDropdown-month" value="3" tabindex="-1">Mars</option>
														<?php
														}
														?>

														<?php
														if ($month == "April") {
														?>
															<option class="flatpickr-monthDropdown-month" value="4" tabindex="-1" selected>April</option>
														<?php } else {
														?>

															<option class="flatpickr-monthDropdown-month" value="4" tabindex="-1">April</option>
														<?php
														}
														?>

														<?php
														if ($month == "May") {
														?>
															<option class="flatpickr-monthDropdown-month" value="5" tabindex="-1" selected>Maj</option>
														<?php } else {
														?>

															<option class="flatpickr-monthDropdown-month" value="5" tabindex="-1">Maj</option>
														<?php
														}
														?>

														<?php
														if ($month == "June") {
														?>
															<option class="flatpickr-monthDropdown-month" value="6" tabindex="-1" selected>Juni</option>
														<?php } else {
														?>

															<option class="flatpickr-monthDropdown-month" value="6" tabindex="-1">Juni</option>
														<?php
														}
														?>

														<?php
														if ($month == "July") {
														?>
															<option class="flatpickr-monthDropdown-month" value="7" tabindex="-1" selected>Juli</option>
														<?php } else {
														?>

															<option class="flatpickr-monthDropdown-month" value="7" tabindex="-1">Juli</option>
														<?php
														}
														?>

														<?php
														if ($month == "August") {
														?>
															<option class="flatpickr-monthDropdown-month" value="8" tabindex="-1" selected>Augusti</option>
														<?php } else {
														?>

															<option class="flatpickr-monthDropdown-month" value="8" tabindex="-1">Augusti</option>
														<?php
														}
														?>

														<?php
														if ($month == "September") {
														?>
															<option class="flatpickr-monthDropdown-month" value="9" tabindex="-1" selected>September</option>
														<?php } else {
														?>

															<option class="flatpickr-monthDropdown-month" value="9" tabindex="-1">September</option>
														<?php
														}
														?>

														<?php
														if ($month == "October") {
														?>
															<option class="flatpickr-monthDropdown-month" value="10" tabindex="-1" selected>Oktober</option>
														<?php } else {
														?>

															<option class="flatpickr-monthDropdown-month" value="10" tabindex="-1">Oktober</option>
														<?php
														}
														?>

														<?php
														if ($month == "November") {
														?>
															<option class="flatpickr-monthDropdown-month" value="11" tabindex="-1" selected>November</option>
														<?php } else {
														?>

															<option class="flatpickr-monthDropdown-month" value="11" tabindex="-1">November</option>
														<?php
														}
														?>

														<?php
														if ($month == "December") {
														?>
															<option class="flatpickr-monthDropdown-month" value="12" tabindex="-1" selected>December</option>
														<?php } else {
														?>

															<option class="flatpickr-monthDropdown-month" value="12" tabindex="-1">December</option>
														<?php
														}
														?>

													</select>

												</div>
											</div>
											<div class="numInputWrapper">
												<div>
													<!-- <input class="numInput cur-year" type="number" tabindex="-1"aria-label="Year" value="2021"> -->
													<select class="form-control mb-3" id="year2" aria-label="Month" tabindex="-1">
														<?php

														$year = date("Y");

														?>

														<?php
														if ($year == 2020) {
														?>
															<option value="2020" tabindex="-1" selected>2020</option>
														<?php } else {
														?>

															<option value="2020" tabindex="-1">2020</option>
														<?php
														}
														?>

														<?php
														if ($year == 2021) {
														?>
															<option value="2021" tabindex="-1" selected>2021</option>
														<?php } else {
														?>

															<option value="2021" tabindex="-1">2021</option>
														<?php
														}
														?>

														<?php
														if ($year == 2022) {
														?>
															<option value="2022" tabindex="-1" selected>2022</option>
														<?php } else {
														?>

															<option value="2022" tabindex="-1">2022</option>
														<?php
														}
														?>

														<?php
														if ($year == 2023) {
														?>
															<option value="2023" tabindex="-1" selected>2023</option>
														<?php } else {
														?>

															<option value="2023" tabindex="-1">2023</option>
														<?php
														}
														?>

														<?php
														if ($year == 2024) {
														?>
															<option value="2024" tabindex="-1" selected>2024</option>
														<?php } else {
														?>

															<option value="2024" tabindex="-1">2024</option>
														<?php
														}
														?>

														<?php
														if ($year == 2025) {
														?>
															<option value="2025" tabindex="-1" selected>2025</option>
														<?php } else {
														?>

															<option value="2025" tabindex="-1">2025</option>
														<?php
														}
														?>

														<?php
														if ($year == 2026) {
														?>
															<option value="2026" tabindex="-1" selected>2026</option>
														<?php } else {
														?>

															<option value="2026" tabindex="-1">2026</option>
														<?php
														}
														?>

														<?php
														if ($year == 2027) {
														?>
															<option value="2027" tabindex="-1" selected>2027</option>
														<?php } else {
														?>

															<option value="2027" tabindex="-1">2027</option>
														<?php
														}
														?>

														<?php
														if ($year == 2028) {
														?>
															<option value="2028" tabindex="-1" selected>2028</option>
														<?php } else {
														?>

															<option value="2028" tabindex="-1">2028</option>
														<?php
														}
														?>

														<?php
														if ($year == 2029) {
														?>
															<option value="2029" tabindex="-1" selected>2029</option>
														<?php } else {
														?>

															<option value="2029" tabindex="-1">2029</option>
														<?php
														}
														?>

														<?php
														if ($year == 2030) {
														?>
															<option value="2030" tabindex="-1" selected>2030</option>
														<?php } else {
														?>

															<option value="2030" tabindex="-1">2030</option>
														<?php
														}
														?>





													</select>
												</div>
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
					<!-- </div> -->







				</div>
			</main>
			<?php include "footer.php"; ?>

		</div>
	</div>

	<script src="js/app.js"></script>





	<script type="text/javascript" src="jquery/jquery.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			function loadData(type, category_id, year_id) {
				$.ajax({
					url: "customer-ajax.php",
					type: "POST",
					data: {
						type: type,
						id: category_id,
						year: year_id
					},
					success: function(data) {
						if (type == "stateData" || type == "yearData" || type == "employeeData") {
							$("#hours-worked").html(data);
						} else {
							$("#employee_id2").append(data);
						}

					}
				});
			}
			var country = $("#employee_id2").val();
			var year = $("#year2").val();

			loadData("stateData", country, year);

			$("#employee_id2").on("change", function() {
				var country = $("#employee_id2").val();
				var year = $("#year2").val();

				console.log(country);
				if (country != "") {
					loadData("stateData", country, year);
				} else {
					$("#hours-worked").html("");
				}


			})

			$("#year2").on("change", function() {
				var country = $("#employee_id2").val();
				var year = $("#year2").val();

				console.log(year);
				if (year != "") {
					loadData("yearData", country, year);
				} else {
					$("#hours-worked").html("");
				}


			})

			//   $("#e-id2").on("change",function(){
			// 	var country = $("#employee_id2").val();
			// 	var year = $("#year2").val();
			// 	var e_id = $("#e-id2").val();
			// console.log(e_id);
			// 	if(e_id != ""){
			// 		loadData("employeeData",country, year, e_id);
			// 	}else{
			// 		$("#hours-worked").html("");
			// 	}


			// })
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


</body>

</html>