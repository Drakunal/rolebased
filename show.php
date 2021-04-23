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

					<h1 class="h3 mb-3">Appointment/Holiday Details</h1>

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

											$result = mysqli_query($db,$sql) or die("Query unsuccessful");
											
											// echo $result;
											if ($result) {?>
                                             <?php
                                             $row = $result->fetch_assoc();
                                             $color=$row['color'];
                                             if($color=="red"){
                                                ?>
                                                <script>
                                            
                                                
                                                    alert("Holiday");
                                                    window.location.href = "appointment-calendar.php?id=0";
                                            
                                                </script>
                                                <?php } 
												if($color=="#f21f38"){

													$employee_id=$row['employee_id'];
													$sql0 = "SELECT name  FROM users WHERE id='$employee_id';";
													$result0 = mysqli_query($db,$sql0) or die("Query unsuccessful1");
													$row0 = $result0->fetch_assoc();
                                                    $employee_name = $row0['name'];
													$start_date=$row['start_event'];
													$start_date=date("Y-m-d", strtotime($start_date));
													$end_date=$row['end_event'];
													$end_date=date("Y-m-d", strtotime($end_date));
													?>
													<thead>
													<tr>
														<th style="width:40%;">Employee Name</th>
														<th style="width:25%">Start Date</th>
														<!-- <th class="d-none d-md-table-cell" style="width:25%">Date of Birth</th> -->
														<th>End Date</th>
														<th>Reason</th>
													</tr>
												</thead>
												<tbody>
													
													<?php
													echo "<tr><td>".$row0["name"]."</td><td>".$start_date."</td><td class='table-action'>".$end_date."</td></td><td class='table-action'>".$row['title']."</td></tr>";
													?>
													</tr>
																							
																					
																							</tbody>
																						</table>
																					</div>
																				</div>
			
																				
			
																				
																			</div>
																			</div>
																			<?php
																			$event_id=$_GET['id'];
																			?>
													<!-- <div style='float:left'>
                                                        <button class='btn btn-primary'>
                                                        <i class='fa fa-question'></i>
                                                        <a style='color:white;text-decoration: none;' href='holiday-reschedule.php?id=<?php 
														// echo $event_id;
														?>'>Reschedule Holiday</a>
                                                        
                                                        </button>
                                                        </div> -->
                                                        
                                                    
                                                        <div style='float:center	' >
                                                        <button class='btn btn-danger' >
                                                        <i class='fas fa-times'></i> 
                                                        <a style='color:white;text-decoration: none;' href='holiday-delete.php?id=<?php echo $event_id;?>'>Cancel Holiday</a>
                                                        </button></div>

														<?php


												}
												else{
																				?>
																							<thead>
																								<tr>
																									<th style="width:40%;">Customer ID</th>
																									<th style="width:25%">Employee ID</th>
																									<!-- <th class="d-none d-md-table-cell" style="width:25%">Date of Birth</th> -->
																									<th>Date</th>
																									<th>Time</th>
																								</tr>
																							</thead>
																							<tbody>
																							<?php

																							
																							// output data of each row
																						
																								$customer_id=$row['customer_id'];
																								$employee_id=$row['employee_id'];

																								$sql0 = "SELECT name  FROM users WHERE id='$employee_id';";
																								$result0 = mysqli_query($db,$sql0) or die("Query unsuccessful1");
																								$row0 = $result0->fetch_assoc();
																								$employee_name = $row0['name'];

																								$date=$row['date'];
																								$time=date('g:ia', strtotime($row["time"]));
																								$sql1 = "SELECT id  FROM appointments WHERE customer_id='$customer_id' AND employee_id='$employee_id' AND date='$date'";
																								$result1 = mysqli_query($db,$sql1) or die("Query unsuccessful1");
																								$row11=$result1->fetch_assoc();
																								$appointment_id=$row11['id'];
																								echo "<tr><td>".$row["customer_id"]."</td><td>".$row0["name"]."</td><td class='table-action'>".$row["date"]."</td></td><td class='table-action'>".$time."</td></tr>";
																							?>
																						
																									<?php
																									
																									?> 
																							
																								<?php
																								
																									// ?>
																								
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
																						<h5 class="card-title mb-4">Customer Details</h5>
																						<?php 
																						$sql2="SELECT name  FROM users WHERE id='$customer_id';";
																						$result2 = mysqli_query($db,$sql2) or die("Query unsuccessful1");
																						$row2 = $result2->fetch_assoc();


																						$result3 = mysqli_query($db,"SELECT base_price,appointment_type,details,time_alloted,admin_note from `customer_details` where user_id='$customer_id';");
																						$row3 = $result3->fetch_assoc();
																						
																							?>
																							
																							<p><strong>Customer Name : </strong><?php echo $row2['name']; ?></p>

																							<p><strong>Details :</strong></p> <?php echo $row3["details"]; ?></br></br>
																							<p><strong>Base Price : </strong><?php echo $row3['base_price']; ?> Kr</p>
																							<p><strong>Time Alloted :</strong></p> <?php echo $row3["time_alloted"]; ?> hours</br></br>
																							<p><strong>Admin Note(can be viewed by Admin only) : </strong><?php echo $row3['admin_note']; ?></p>
																							<p><strong>Appointment Type :</strong></p> <?php 
																							if($row3["appointment_type"]=="monthly")
																							{
																								echo "Monthly";
																							}
																							elseif($row3["appointment_type"]=="bi-weekly")
																							{
																								echo "Bi-weekly";
																							} 
																							elseif($row3["appointment_type"]=="not-regular")
																							{
																								echo "Not-regular";
																							} ?>
																							</br>
																						
																							<div style='float:left'>
																									<button class='btn btn-primary'>
																									<i class='fa fa-question'></i>
																									<a style='color:white;text-decoration: none;' href='appointment-reschedule.php?id=<?php echo $appointment_id;?>'>Reschedule</a>
																									
																									</button>
																									</div>
																									
																								
																									<div style='float:right' >
																									<button class='btn btn-danger' >
																									<i class='fas fa-times'></i> 
																									<a style='color:white;text-decoration: none;' href='appointment-delete.php?id=<?php echo $appointment_id;?>'>Cancel</a>
																									</button></div>
																							
																									</div>
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