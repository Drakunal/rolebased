<?php
session_start();
include "connection.php";
if (!isset($_SESSION['login_user']) || $_SESSION['role'] != "employee") {
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Calendar</title>
	<link href="css/app.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" /> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
</head>
<style>
	#calendar {

		margin: 0 auto;
	}

	.fc-title {
		color: black;
		font-size: 10px;
	}
</style>

<?php
$id = $_SESSION['id'];
?>
<script>
	$(document).ready(function() {
		var employee = $("#employee-id").val();
		console.log(employee);
		if (employee != "") {
			d = 'load.php?ids=' + employee;
			console.log(d);

			$('#calendar').fullCalendar({
				editable: false,
				header: {
					left: 'prev,next today',
					center: 'title',
					right: '',
					display: 'none',
				},
				events: d,
				selectable: true,
				displayEventTime: false,
				weekends: true,
				editable: false,
				weekNumbers: true,
				firstDay: 1,
				selectHelper: true,
				eventClick: function(event) {
					if (confirm("View details?")) {
						var id = event.id;
						var url = "show-c.php?id=" + id;
						window.location.href = url;
					}
				},
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
							<h3><strong>Analytics</strong> Dashboard</h3>
						</div>

						<div class="col-auto ml-auto text-right mt-n1">
							<nav aria-label="breadcrumb">
							</nav>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
								</div>
							</div>
						</div>
					</div>
					<div class="container-fluid p-0">
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
					</div>
			</main>
			<?php include "footer.php"; ?>
		</div>
	</div>
	<script src="js/app.js"></script>
	<!-- <script type="text/javascript" src="jquery/jquery.js"></script> -->

	<!-- <script type="text/javascript">
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
	</script> -->
	<!-- <script>
		document.addEventListener("DOMContentLoaded", function() {
			document.getElementById("datetimepicker-dashboard").flatpickr({
				inline: true,
				prevArrow: "<span class=\"fas fa-chevron-left\" title=\"Previous month\"></span>",
				nextArrow: "<span class=\"fas fa-chevron-right\" title=\"Next month\"></span>",
			});
		});
	</script> -->
</body>

</html>