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

	<title>Employee Details Form</title>

	<link href="css/app.css" rel="stylesheet">
</head>

<body>
<?php
                $user_id = $_GET['id'];
                
                $result = mysqli_query($db,"SELECT details,color FROM `employee_details` WHERE user_id='$user_id';")or die("Unsuccessful");
                $res = mysqli_fetch_assoc($result);
				$color=$res['color'];
                $details=$res['details'];
            // print_r($res);
                
            ?>
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

					<h1 class="h3 mb-3">Edit Employee Details form</h1>

					<div class="row">
						<div class="">
							<div class="card">
								<div class="card-header">
									<!-- <h5 class="card-title">Add Employee form</h5> -->
									<h6 class="card-subtitle text-muted">Edit your Employee details here.</h6>
								</div>
								<div class="card-body">
									<form enctype="multipart/form-data" method="post" action="">
											<div class="mb-3 col-md-2">
												<label class="form-label">Color for the Employee</label>
												<input type="color"  name="color"class="form-control" id="color"  value='<?php echo $color;?>'>

											</div>
										
                                        
										<div class="mb-3">
											<label class="form-label">Details</label>
											<textarea required class="form-control"name="details" placeholder="Details" rows="1"><?php echo $details; ?></textarea>
										</div>
								
										
										<button type="submit" name="submit"class="btn btn-primary">Submit</button>
									</form>
								</div>
							</div>
						</div>
						
							</div>
						</div>
					
			</main>



			<?php
                    if(isset($_POST['submit']))
                    {
                        $user_id = $_GET['id'];
                        
                        $details=$_POST['details'];
						$color=$_POST['color'];
                       
                    
                            
                                
                            

                        mysqli_query($db,"UPDATE `employee_details` SET details='$details',color='$color' where user_id='$user_id';");
				
			?>
                        <script>
                            
                            document.getElementById('success').className = "offset-md-4 alert alert-success alert-dismissible";
                					var success_class = document.getElementById('success').className;
									var delayInMilliseconds = 1000; //1.5 second

									setTimeout(function() {
										window.location.href = "employee-list.php";
									}, delayInMilliseconds);
                            
                        
                        </script>
			<?php

				    }
	
					
				
			?>

<?php include("footer.php"); ?>
		</div>
	</div>

	<script src="js/app.js"></script>
	

</body>

</html>