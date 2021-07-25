<?php
session_start();
include "connection.php";
if (!isset($_SESSION['login_user']) || $_SESSION['role'] != "customer") {
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Monika</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link href="css/app.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" /> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/gcal.min.js" integrity="sha512-7a/GdV+Yb2nLt7zgXbufsOsTJ3NHu4zF1Vdtsn50oRjdeVwAU8EcE4twos9YAnj9MhpvFnEewM4QsbLhSeAH0w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<style>
	#calendar {

		margin: 0 auto;
	}

	.fc-title {
		
		font-size: 10px;
	}
</style>

<?php
$id = $_SESSION['id'];
?>
 <script src="sc/a.js"></script>
<script>
	$(document).ready(function() {
		var employee = $("#employee-id").val();
		console.log(employee);
		if (employee != "") {
			d = 'load.php?ids=' + employee;
			console.log(d);

			$('#calendar').fullCalendar({
				googleCalendarApiKey: bc,
				monthNames: ['Januari', 'Februari', 'Mars', 'April', 'Maj', 'Juni', 'Juli', 'Augusti', 'September', 'Oktober', 'November', 'December'],
				monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
				dayNames: ['Söndag', 'Måndag', 'Tisdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lördag'],
				dayNamesShort: ['Sön', 'Mån', 'Tis', 'Ons', 'Tor', 'Fre', 'Lör'],
				buttonText: {
					today: 'I dag',
					week: 'Vecka',
				},
				weekNumberTitle: 'V',
				editable: false,
				header: {
					left: 'prev,next today',
					center: 'title',
					right: '',
					display: 'none',
				},
				eventSources: [{
                            googleCalendarId: 'g630hdv4f9aa3j745447hsom2cbhiq3p@import.calendar.google.com',
                            color: 'red',
                            textColor:'white'
                        },
                        {
                            url:d,
                            textColor:'black'
                        }
                    ],
				selectable: true,
				displayEventTime: false,
				weekends: true,
				editable: false,
				weekNumbers: true,
				firstDay: 1,
				selectHelper: true,
				
			});


		}

	});
</script>


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
					<div class="row">
						<div class="card">
							<div class="card-body">
								<div class="container">
									<div>
										<div class="col-sm-4">
										</div>
										</br>
										<input type=number id="employee-id" hidden value="<?php echo $id ?>">
									</div>
									<div id="calendar"></div>
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


</body>

</html>