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

	<title>Form Layouts | AdminKit Demo</title>

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

					<h1 class="h3 mb-3">Add Holiday form</h1>

					<div class="row">
						<div class="">
							<div class="card">
								<div class="card-header">
									<h6 class="card-subtitle text-muted">Add your holidays here.</h6>
								</div>
								<div class="card-body">
									<form enctype="multipart/form-data" method="post" action="">
										<div class="mb-3">
											<label class="form-label">Holiday Name</label>
											<input type="text" required name="title" class="form-control" placeholder="title">
										</div>
										<div class="mb-3">
											<label class="form-label">Date</label>
											<input type="date" required  name="date"class="form-control" placeholder="date">
										</div>
                                        <div class="mb-3">
											<label class="form-label">Is this every year on the same date?</label>
										
                                                <label class="form-check">
                                                    <input name="every_year" type="radio" class="form-check-input" value="1" checked>
                                                    <span class="form-check-label">Yes</span>
                                                </label>
                                                <label class="form-check">
                                                    <input name="every_year" type="radio" value="0"class="form-check-input">
                                                    <span class="form-check-label">No</span>
                                                </label>
                                         
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
					$title=$_POST['title'];
					$every_year=$_POST['every_year']; //if 1 then yes
					$date=$_POST['date'];
					$color="red";
                    if($every_year==1){

                        for($x=0;$x<100;$x++){
                            mysqli_query($db,"INSERT INTO `events` (title,start_event,color) VALUES('$title','$date', '$color');");
                            $date=date('Y-m-d', strtotime($date. '+1 year'));
                        }

                        
                    }
                    else{
                        mysqli_query($db,"INSERT INTO `events` (title,start_event,color) VALUES('$title','$date', '$color');");

                    }
					
					?>
					<script>
				
				document.getElementById('success').className = "offset-md-4 alert alert-success alert-dismissible";
                					var success_class = document.getElementById('success').className;
									var delayInMilliseconds = 1000; //1.5 second

									setTimeout(function() {
										window.location.href = "admin-panel.php";
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