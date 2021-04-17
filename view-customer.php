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

	<title>Monika</title>

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

					<h1 class="h3 mb-3">Kund</h1>

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
											<th style="width:40%;">Kundnummer</th>
											<th style="width:25%">Namn</th>
											<!-- <th class="d-none d-md-table-cell" style="width:25%">Date of Birth</th> -->
											<th>Roll</th>
                                            <th>Lösenord</th>
										</tr>
									</thead>
									<tbody>
                                   
                                        <?php 
                                        $user_id = $_GET['id'];
										$role="customer";
										$sql = "SELECT user_id, name FROM users WHERE user_id=`$user_id`";
										$result = mysqli_query($db,"SELECT id,user_id,name,role,password from `users` where user_id='$user_id';");
										$row = $result->fetch_assoc();
										$idd=$row["id"];
										// echo $idd;
										$result2 = mysqli_query($db,"SELECT base_price,appointment_type,details,time_alloted,admin_note from `customer_details` where user_id='$idd';");
										$row2 = $result2->fetch_assoc();
										// echo $result;
										if ($result) {?>
                                             <?php
                                                // output data of each row
                                                
                                                echo "<tr><td>".$row["user_id"]."</td><td>".$row["name"]."</td><td class='table-action'>".$row["role"]."</td></td><td class='table-action'>".$row["password"]."</td></tr>";
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
                                                         // ?>
                                                     <!-- </td> -->
                                                    <!-- <td class="table-action">
                                                        <a href="#"><i class="align-middle" data-feather="edit-2"></i></a>
                                                        <a href="#"><i class="align-middle" data-feather="trash"></i></a>
                                                    </td> -->
                                                </tr>
                                                <?php

                                                
                                                
                                            }
                                            ?>
										
									</tbody>
								</table>
								</br></br></br>
								<?php if($row2){
									?>
								<div>
								<div class="card-body">
								<h4>Ytterligare Detaljer</h4>
								<p><strong>Detaljer :</strong></p> <?php echo $row2["details"]; ?></br></br>
								<p><strong>Baspris (Pris per timme) : </strong><?php echo $row2['base_price']; ?> Kr</p>
								<p><strong>Antal timmar per möte :</strong></p> <?php echo $row2["time_alloted"]; ?> timmar</br></br>
								<p><strong>Admin detaljer(Enbart synligt för admin) : </strong><?php echo $row2['admin_note']; ?></p>
								<p><strong>Utnämningstyp :</strong></p> <?php 
								if($row2["appointment_type"]=="monthly")
								{
									echo "Månadsvis";
								}
								elseif($row2["appointment_type"]=="bi-weekly")
								{
									echo "Varannan vecka";
								} 
								elseif($row2["appointment_type"]=="not-regular")
								{
									echo "Inte regelbunden";
								} ?>
								<div class='card'>
								<div class="mb-3">

								<?php 
								$result3 = mysqli_query($db,"SELECT date,time,employee_id,customer_id from `appointments` where customer_id='$idd' AND deleted_at is NULL AND date >= CURRENT_DATE AND date<= CURRENT_DATE+ interval 1 month AND deleted_at is NULL;");
								$row3 = $result3->fetch_assoc();
								if($row3){
									?>
								</br>
								<?php 
									$employee_id=$row3["employee_id"];
									$employee_query=mysqli_query($db,"SELECT name from `users` where id='$employee_id' AND deleted_at is NULL");
									$employee_row = $employee_query->fetch_assoc();
								 ?>
								<h4>Utnämning Detaljer</h4>
								<p><strong>Tid :</strong></p> <?php 
								echo date('g:ia', strtotime($row3["time"]));
								 ?></br></br>
								<p><strong>Datum :</strong></p> <?php echo $row3["date"]; ?></br></br>
								<p><strong>Anställd Namn :</strong></p> <?php echo $employee_row['name']; ?></br></br>
								<?php
									if($row2["appointment_type"]=="bi-weekly"){
										// $result4 = mysqli_query($db,"SELECT date,time,employee_id,customer_id from `appointments` where customer_id='$idd';");
										$row3 = $result3->fetch_assoc();
										if($row3){
											?>
										
										<h4>Andra Utnämning Detaljer</h4>
										<p><strong>Tid :</strong></p> <?php 
										echo date('g:ia', strtotime($row3["time"]));
										 ?></br></br>
										<p><strong>Datum :</strong></p> <?php echo $row3["date"]; ?></br></br>
										<p><strong>Anställd Namn :</strong></p> <?php echo $employee_row['name']; ?></br></br>
										<?php

										}
										else{
											?>
											<h4>Nej Andra Utnämning</h4>
											
										
											<?php }
										
									}
									 }
									 else{
										 ?>
										 <div class="mb-3">
										<button class="btn btn-primary"><a style="text-decoration:none; color:white;" href="add-appointment.php?id=<?php echo $idd ?>">Lägg till kundavtal</a></button>
										</div>
										<?php
									 } 
								 ?>
									
								</div>
							</div>
								<?php } 
								else{
									?>
									<h4>Inga ytterligare detaljer närvarande</h4>
									
								<div class="mb-3">
									<button class="btn btn-primary"><a style="text-decoration:none; color:white;" href="add-customer-details.php?id=<?php echo $row['user_id'] ?>">Lägg till kundinformation</a></button>
								</div>
									<?php } ?>
								
							</div>
							</div>
							</div>
					
						</div>

						

						
					</div>

				</div>
			</main>

		</div>
		
	</div>
	<?php include("footer.php"); ?>
	<script src="js/app.js"></script>

</body>

</html>