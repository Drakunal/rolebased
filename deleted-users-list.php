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

	<title>Borttagen användarlista</title>

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

					<h1 class="h3 mb-3">Borttagen användarlista</h1>

					<div class="row">
						<div class="col-md-12">
						</br>
							<div class="card">
								<div class="card-header">
								
								</div>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th style="width:40%;">ID</th>
											<th style="width:25%">Namn</th>
											<!-- <th class="d-none d-md-table-cell" style="width:25%">Date of Birth</th> -->
											<th>Roll</th>
										</tr>
									</thead>
									<tbody>
                                   
                                        <?php 
          
           
                                                 $result = mysqli_query($db,"SELECT id,user_id,name,role from `users` where deleted_at is not NULL;");
                                                        if ($result->num_rows > 0) {?>
                                             <?php
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    if($row["role"]=="customer"){
                                                        $role="Customer";
                                                    }
                                                    else if($row["role"]=="employee"){
                                                        $role="Employee";
                                                    }
                                                echo "<tr><td>".$row["user_id"]."</td><td>".$row["name"]."</td><td>".$role."</td></tr>";
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

                    
                    
                    

                    <!-- </div> -->

				</div>
			</main>

			<?php include("footer.php"); ?>
		</div>
	</div>

	<script src="js/app.js"></script>

    <script type="text/javascript" src="jquery/jquery.js"></script>
	<script type="text/javascript">
        $(document).ready(function(){
            function loadData(type, category_id, year_id, e_id){
                $.ajax({
                    url : "deleted-users-appointment-ajax.php",
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



</body>

</html>