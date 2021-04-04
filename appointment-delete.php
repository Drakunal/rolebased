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

					<h1 class="h3 mb-3">Employee List</h1>

					<div class="row">
						

						
					

					

						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<!-- <h5 class="card-title">Employee Table</h5> -->
									<!-- <h6 class="card-subtitle text-muted">Add <code>.table-bordered</code> for borders on all sides of the table and cells.</h6> -->
								</div>
								
							</div>
						</div>

						

						
					</div>

				</div>
			</main>

			<?php include("footer.php"); ?>
		</div>
	</div>
	<?php
							$appointment_id = $_GET['id'];
							$date=date('Y-m-d');
							// echo $date;
							// echo $appointment_id;

							$sql1="SELECT date,customer_id,employee_id from `appointments` WHERE id=$appointment_id";
							$query1 = mysqli_query($db,$sql1) or die("Query Unsuccessful1.");
							$row = $query1->fetch_assoc();


							$sql="UPDATE appointments
							SET deleted_at = '$date'
							WHERE id =$appointment_id";
							$query = mysqli_query($db,$sql) or die("Query Unsuccessful2.");


						
							$customer_id=$row['customer_id'];
							$employee_id=$row['employee_id'];
							$date=$row['date'];
							$sql_temp="SELECT id from events WHERE customer_id=$customer_id AND employee_id=$employee_id AND date='$date'";
							$query_temp = mysqli_query($db,$sql_temp) or die("Query Unsuccessful3.");
							$row=$query_temp->fetch_assoc();
							$id=$row['id'];
							$sql2="DELETE FROM events where id=$id";
?>
<script>
console.log(<?php $id?>);
</script>
<?php
							echo $id;
							$query2 = mysqli_query($db,$sql2);

							if(true){
						?>
									<script>
								
									
										alert("Appointment Cancelled");
										window.location.href = "admin-panel.php";
								
									</script>
									<?php } ?>

	<script src="js/app.js"></script>

</body>

</html>