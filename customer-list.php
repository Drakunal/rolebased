<?php
session_start();
include "connection.php";
if (!isset($_SESSION['login_user']) || $_SESSION['role'] != "admin") {
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

					<h1 class="h3 mb-3">Kundsektion</h1>

					<div class="row">
						<div class="col-md-12">

							<button class="btn btn-primary" style="float:right;"><a style="color:white;text-decoration: none;" href="add-customer.php"><i class="align-middle" data-feather="user-plus"></i> Ny kund</a></button>
						</div>




						<div class="col-md-12">

							</br>
							<!-- <div class="card"> -->
							<!-- <div class="card-header">
									<h5 class="card-title">Employee Table</h5>
									<h6 class="card-subtitle text-muted">Add <code>.table-bordered</code> for borders on all sides of the table and cells.</h6>
								</div> -->

							<table id="customer-list" class="table table-striped">
								<thead>
									<tr>
										<th style="width:40%;">Kundnummer</th>
										<th style="width:25%">Namn</th>
										<!-- <th class="d-none d-md-table-cell" style="width:25%">Date of Birth</th> -->
										<th>Inställningar</th>
									</tr>
								</thead>
								<tbody>

									<?php
									$role = "customer";
									$sql = "SELECT id,user_id, name FROM users WHERE role=`customer`";
									$result = mysqli_query($db, "SELECT id,user_id,name from `users` where role='$role' AND deleted_at is NULL;");
									if ($result->num_rows > 0) { ?>
										<?php
										// output data of each row
										while ($row = $result->fetch_assoc()) {
											echo "<tr><td>" . $row["user_id"] . "</td><td>" . $row["name"] . "</td><td class='table-action'><a href='edit-customer.php?id=" . $row['user_id'] . "'><i class='align-middle' data-feather='edit-2'></i></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href='view-customer.php?id=" . $row['user_id'] . "'><i class='align-middle' data-feather='eye'></i></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href='delete-customer.php?id=" . $row['id'] . "'><i class='align-middle' data-feather='trash-2'></i></a></td></tr>";
										?>
											<!-- <tr>
                                                    <td>Vanessa Tucker</td>
                                                    <td>864-348-0485</td>
                                                    
                                                    <td class="table-action">
                                                        <a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
                                                        <a href="#"><i class="align-middle" data-feather="trash"></i></a>
                                                    </td>
										        </tr> -->
											<!-- <tr>
                                                    <td> -->
											<?php
											//$row["user_id"];
											?>
											<!-- </td>
                                                    <td> -->
											<?php
											//  $row["name"];
											// 
											?>
											<!-- </td> -->
											<!-- <td class="table-action">
                                                        <a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
                                                        <a href="#"><i class="align-middle" data-feather="trash"></i></a>
                                                    </td> -->
											</tr>
									<?php

										}
									}
									?>

								</tbody>
								<!-- <tfoot>
									<tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
									</tfoot> -->
							</table>
							<!-- </div> -->
						</div>


						<!-- <p id="test" class="bal">HI</p> -->

					</div>

				</div>
			</main>

			<?php include("footer.php"); ?>
		</div>
	</div>

	<?php include("scripts.php"); ?>
	<script>
		$(document).ready(function() {
			var table = $('#customer-list').DataTable({
				lengthChange: false,
				language: {
					"search": "Sök",
					"lengthMenu": "Display _MENU_ records per page",
					"zeroRecords": "Inga uppgifter funna",
					"info": "Visar sida _PAGE_ av _PAGES_",
					"infoEmpty": "Inga poster tillgängliga",
					"infoFiltered": "(filtreras från totalt _MAX_ poster)",
					"paginate": {
						"first": "Först",
						"last": "Sista",
						"next": "Nästa",
						"previous": "Tidigare"
					},
				}
				// buttons: [ 'copy', 'excel', 'pdf' ]
			});

			// table.buttons().container()
			//     .appendTo( '#example_wrapper .col-md-6:eq(0)' );
		});

		document.getElementById("customer-list").className = "table table-striped";
	</script>

</body>

</html>