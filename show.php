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

	<!-- <title>Tables | AdminKit Demo</title> -->

	<link href="css/app.css" rel="stylesheet">
	<style>
		.btn-group button {
			/* background-color: #04AA6D; */
			/* Green background */
			border: 1px solid white;
			/* Green border */
			color: white;
			/* White text */
			padding: 10px 24px;
			/* Some padding */
			cursor: pointer;
			/* Pointer/hand icon */
			float: left;
			/* Float the buttons side by side */
		}

		/* Clear floats (clearfix hack) */
		.btn-group:after {
			content: "";
			clear: both;
			display: table;
		}

		.btn-group button:not(:last-child) {
			border-right: none;
			/* Prevent double borders */
		}

		/* Add a background color on hover */
		/* .btn-group button:hover {
			background-color: #3e8e41;
		} */
	</style>
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

					<h1 class="h3 mb-3">Utnämning / semesterinformation</h1>

					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<!-- <h5 class="card-title">Employee Table</h5> -->
									<!-- <h6 class="card-subtitle text-muted">Add <code>.table-bordered</code> for borders on all sides of the table and cells.</h6> -->
								</div>
								<table class="table table-bordered">


									<?php
									$event_id = $_GET['id'];

									$sql = "SELECT title,start_event,end_event,time,customer_id,employee_id,date,color  FROM events WHERE id='$event_id'";

									$result = mysqli_query($db, $sql) or die("Query unsuccessful");

									// echo $result;
									if ($result) { ?>
										<?php
										$row = $result->fetch_assoc();
										$color = $row['color'];
										if ($color == "red") {
										?>
											<script>
												alert("Holiday");
												window.location.href = "appointment-calendar.php?id=0";
											</script>
										<?php }
										if ($color == "#ff726f") {

											$employee_id = $row['employee_id'];
											$sql0 = "SELECT name  FROM users WHERE id='$employee_id';";
											$result0 = mysqli_query($db, $sql0) or die("Query unsuccessful1");
											$row0 = $result0->fetch_assoc();
											$employee_name = $row0['name'];
											$start_date = $row['start_event'];
											$start_date = date("Y-m-d", strtotime($start_date));
											$date = $row['end_event'];
											$date = date("Y-m-d", strtotime($date));
											$date = date_create_from_format('Y-m-d', $date);
											$date->getTimestamp();
											date_sub($date, date_interval_create_from_date_string("1 days"));
											$end_date = date_format($date, "Y-m-d");


										?>
											<thead>
												<tr>
													<th style="width:40%;">Anställd Namn</th>
													<th style="width:25%">Start Datum</th>
													<!-- <th class="d-none d-md-table-cell" style="width:25%">Date of Birth</th> -->
													<th>Slutdatum</th>
													<th>Anledning</th>
												</tr>
											</thead>
											<tbody>

												<?php
												echo "<tr><td>" . $row0["name"] . "</td><td>" . $start_date . "</td><td class='table-action'>" . $end_date . "</td></td><td class='table-action'>" . $row['title'] . "</td></tr>";
												?>
												</tr>


											</tbody>
								</table>
							</div>
						</div>




					</div>
				</div>
				<?php
											$event_id = $_GET['id'];
				?>
				<!-- <div style='float:left'>
                                                        <button class='btn btn-primary'>
                                                        <i class='fa fa-question'></i>
                                                        <a style='color:white;text-decoration: none;' href='holiday-reschedule.php?id=<?php
																																		// echo $event_id;
																																		?>'>Reschedule Holiday</a>
                                                        
                                                        </button>
                                                        </div> -->


				<div style='float:center	'>
					<button class='btn btn-danger'>
						<i class='fas fa-times'></i>
						<a style='color:white;text-decoration: none;' href='holiday-delete.php?id=<?php echo $event_id; ?>'>Cancel Holiday</a>
					</button>
				</div>

			<?php


										} else {
			?>
				<thead>
					<tr>
						<th style="width:40%;">Kundnummer</th>
						<th style="width:25%">Anställd</th>
						<!-- <th class="d-none d-md-table-cell" style="width:25%">Date of Birth</th> -->
						<th>Datum</th>
						<th>Tid</th>
					</tr>
				</thead>
				<tbody>
					<?php


											// output data of each row

											$customer_id = $row['customer_id'];
											$employee_id = $row['employee_id'];

											$sql22 = "SELECT user_id  FROM users WHERE id='$customer_id';";
											$result22 = mysqli_query($db, $sql22) or die("Query unsuccessful1");
											$row22 = $result22->fetch_assoc();


											$sql0 = "SELECT name  FROM users WHERE id='$employee_id';";
											$result0 = mysqli_query($db, $sql0) or die("Query unsuccessful1");
											$row0 = $result0->fetch_assoc();
											$employee_name = $row0['name'];

											$date = $row['date'];
											$time = date('G:i', strtotime($row["time"]));
											$sql1 = "SELECT id  FROM appointments WHERE customer_id='$customer_id' AND employee_id='$employee_id' AND date='$date'";
											$result1 = mysqli_query($db, $sql1) or die("Query unsuccessful1");
											$row11 = $result1->fetch_assoc();
											$appointment_id = $row11['id'];
											echo "<tr><td>" . $row22["user_id"] . "</td><td>" . $row0["name"] . "</td><td class='table-action'>" . $row["date"] . "</td></td><td class='table-action'>" . $time . "</td></tr>";
					?>

					<?php

					?>

					<?php

											// 
					?>

					</tr>


				</tbody>
				</table>
		</div>
	</div>




	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title mb-4">Kunddetaljer</h5>
							<?php
											$sql2 = "SELECT name  FROM users WHERE id='$customer_id';";
											$result2 = mysqli_query($db, $sql2) or die("Query unsuccessful1");
											$row2 = $result2->fetch_assoc();


											$result3 = mysqli_query($db, "SELECT base_price,appointment_type,details,time_alloted,admin_note from `customer_details` where user_id='$customer_id';");
											$row3 = $result3->fetch_assoc();
											$time_alloted = $row3["time_alloted"];

											$pos = strpos($time_alloted, '.');
											if ($pos === false) { // it is integer number
												$time_alloted = $time_alloted;
											} else { // it is decimal number
												$time_alloted = rtrim(rtrim($time_alloted, '0'), '.');
											}

											$sql77 = "SELECT additional_charge,invoice_charge,comment  FROM appointments WHERE id='$appointment_id'";
											$result77 = mysqli_query($db, $sql77) or die("Query unsuccessful1");
											$row77 = $result77->fetch_assoc();

							?>

							<p><strong>Kundnamn : </strong><?php echo $row2['name']; ?></p>
							<?php if ($row3['details'] != NULL) { ?>
								<p><strong>Detaljer : </strong> <?php echo $row3["details"]; ?></p>
							<?php } ?>
							<p><strong>Baspris : </strong><?php echo $row3['base_price']; ?> Kr</p>
							<p><strong>Antal timmar per möte : </strong> <?php echo $time_alloted; ?> timmar</p>
							<?php if ($row3['admin_note'] != NULL) { ?>
								<p><strong>Admin detaljer : </strong><?php echo $row3['admin_note']; ?></p>
							<?php } ?>
							<p><strong>Utnämningstyp : </strong><?php
																	if ($row3["appointment_type"] == "monthly") {
																		echo "Månadsvis";
																	} elseif ($row3["appointment_type"] == "bi-weekly") {
																		echo "Varannan vecka";
																	} elseif ($row3["appointment_type"] == "not-regular") {
																		echo "Not-regular";
																	} elseif ($row3["appointment_type"] == "weekly") {
																		echo "Inte vanligt";
																	} ?></p>
							<?php if ($row77['additional_charge'] != 0.00) { ?>
								<p><strong>Extra kostnad : </strong><?php echo $row77['additional_charge']; ?> Kr</p>
							<?php } ?>
							<?php if ($row77['invoice_charge'] != 0.00) { ?>
								<p><strong>Fakturakostnad : </strong><?php echo $row77['invoice_charge']; ?> Kr</p>
							<?php } ?>
							<?php if ($row77['comment'] != Null) { ?>
								<p><strong>Kommentar : </strong><?php echo $row77['comment']; ?></p>
							<?php } ?>

							</br>


							<!-- <div style='float:left'>
								<button class='btn btn-primary'>
									<i class='fa fa-question'></i>
									<a style='color:white;text-decoration: none;' href='appointment-reschedule.php?id=<?php echo $appointment_id; ?>'>Reschedule</a>

								</button>
								<button class='btn btn-primary'>
									<i class='fa fa-question'></i>
									<a style='color:white;text-decoration: none;' href='employee-change.php?id=<?php echo $appointment_id; ?>'>Change Employee for All</a>

								</button>
							</div> -->




							<!-- <div style='float:right'>
								<button class='btn btn-danger'>
									<i class='fas fa-times'></i>
									<a style='color:white;text-decoration: none;' href='appointment-delete.php?id=<?php echo $appointment_id; ?>'>Cancel</a>
								</button>
							</div> -->
							<hr>


							<div class="btn-group" style="width:100%">
								<button class='btn btn-primary'>
									<i class='fa fa-edit'></i>
									<a style='color:white;text-decoration: none;' href='appointment-reschedule.php?id=<?php echo $appointment_id; ?>'>Boka om</a>

								</button>
								<button class='btn btn-primary'>
									<i class='fa fa-edit'></i>
									<a style='color:white;text-decoration: none;' href='employee-change.php?id=<?php echo $appointment_id; ?>'>Byt anställd för alla möten</a>

								</button>
								<?php if ($row77['comment'] != Null || $row77['invoice_charge'] != 0.00 || $row77['additional_charge'] != 0.00) { ?>
									<button class='btn btn-primary'>
										<i class='fas fa-plus'></i>
										<a style='color:white;text-decoration: none;' href='edit-appointment-extras.php?id=<?php echo $appointment_id; ?>'>Redigera extra</a>
									</button>
								<?php } else { ?>
									<button class='btn btn-primary'>
										<i class='fas fa-plus'></i>
										<a style='color:white;text-decoration: none;' href='add-appointment-extras.php?id=<?php echo $appointment_id; ?>'>Lägg till extra</a>
									</button>
								<?php } ?>
								<button class='btn btn-danger'>
									<i class='fas fa-times'></i>
									<a style='color:white;text-decoration: none;' href='appointment-delete.php?id=<?php echo $appointment_id; ?>'>Avbryt</a>
								</button>
							</div>
						</div>

						<!-- <div style='float:right' > -->

						<!-- </div> -->

					</div>


				</div>
			</div>

		</div>
	</div>
<?php

										}
?>
<?php




									}
?>
<!-- <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65% </span> -->
<!-- <span class="text-muted">Since last week</span> -->
<!-- </div> -->


</main>

<?php include("footer.php"); ?>
</div>
</div>

<script src="js/app.js"></script>

</body>

</html>