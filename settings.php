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

	<title>Settings</title>

	<link href="css/app.css" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
        <div class="sidebar-content js-simplebar">
        <?php include "sidebar.php";?>
</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
          <i class="hamburger align-self-center"></i>
        </a>


        <?php include "navbar.php";?>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Settings</h1>

					<div class="row">
						<div class="col-md-3 col-xl-2">

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Profile Settings</h5>
								</div>

								<div class="list-group list-group-flush" role="tablist">
									<!-- <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
                                         Account
                                    </a> -->
									<a class="list-group-item list-group-item-action active" data-toggle="list" href="#password" role="tab">
                                        Password
                                    </a>
									<!-- <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                                        Privacy and safety
                                        </a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                                    Email notifications
                                    </a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                                    Web notifications
                                    </a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                                        Widgets
                                        </a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                                    Your data
                                    </a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
                                    Delete account
                                    </a> -->
								</div>
							</div>
						</div>

						<div class="col-md-9 col-xl-10">
							<div class="tab-content">
								<!-- <div class="tab-pane fade show active" id="account" role="tabpanel">

									<div class="card">
										<div class="card-header">

											<h5 class="card-title mb-0">Public info</h5>
										</div>
										<div class="card-body">
											<form>
												<div class="row">
													<div class="col-md-8">
														<div class="mb-3">
															<label class="form-label" for="inputUsername">Username</label>
															<input type="text" class="form-control" id="inputUsername" placeholder="Username">
														</div>
														<div class="mb-3">
															<label class="form-label" for="inputUsername">Biography</label>
															<textarea rows="2" class="form-control" id="inputBio" placeholder="Tell something about yourself"></textarea>
														</div>
													</div>
													<div class="col-md-4">
														<div class="text-center">
															<img alt="Charles Hall" src="img/avatars/avatar.jpg" class="rounded-circle img-responsive mt-2" width="128" height="128" />
															<div class="mt-2">
																<span class="btn btn-primary"><i class="fas fa-upload"></i> Upload</span>
															</div>
															<small>For best results, use an image at least 128px by 128px in .jpg format</small>
														</div>
													</div>
												</div>

												<button type="submit" class="btn btn-primary">Save changes</button>
											</form>

										</div>
									</div>

									<div class="card">
										<div class="card-header">

											<h5 class="card-title mb-0">Private info</h5>
										</div>
										<div class="card-body">
											<form>
												<div class="row">
													<div class="mb-3 col-md-6">
														<label class="form-label" for="inputFirstName">First name</label>
														<input type="text" class="form-control" id="inputFirstName" placeholder="First name">
													</div>
													<div class="mb-3 col-md-6">
														<label class="form-label" for="inputLastName">Last name</label>
														<input type="text" class="form-control" id="inputLastName" placeholder="Last name">
													</div>
												</div>
												<div class="mb-3">
													<label class="form-label" for="inputEmail4">Email</label>
													<input type="email" class="form-control" id="inputEmail4" placeholder="Email">
												</div>
												<div class="mb-3">
													<label class="form-label" for="inputAddress">Address</label>
													<input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
												</div>
												<div class="mb-3">
													<label class="form-label" for="inputAddress2">Address 2</label>
													<input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
												</div>
												<div class="row">
													<div class="mb-3 col-md-6">
														<label class="form-label" for="inputCity">City</label>
														<input type="text" class="form-control" id="inputCity">
													</div>
													<div class="mb-3 col-md-4">
														<label class="form-label" for="inputState">State</label>
														<select id="inputState" class="form-control">
                                                        <option selected>Choose...</option>
                                                        <option>...</option>
                                                    </select>
													</div>
													<div class="mb-3 col-md-2">
														<label class="form-label" for="inputZip">Zip</label>
														<input type="text" class="form-control" id="inputZip">
													</div>
												</div>
												<button type="submit" class="btn btn-primary">Save changes</button>
											</form>

										</div>
									</div>

								</div> -->
								<div class="tab-pane fade show active" id="password" role="tabpanel">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">Password</h5>

											<form method="POST">
												<div class="mb-3">
													<label class="form-label" for="inputPasswordCurrent">Current password</label>
													<input type="password" class="form-control" id="inputPasswordCurrent" name="inputPasswordCurrent">
													<!-- <small><a href="#">Forgot your password?</a></small> -->
												</div>
												<div class="mb-3">
													<label class="form-label" for="inputPasswordNew">New password</label>
													<input type="password" class="form-control" id="inputPasswordNew" name="inputPasswordNew" onkeyup='check();'>
												</div>
												
												<div class="mb-3">
													<label class="form-label" for="inputPasswordNew2">Verify password  <span id='message'></span></label>
													<input type="password" class="form-control" id="inputPasswordNew2" name="inputPasswordNew2" onkeyup='check();'>
												</div>
												<button type="submit" class="btn btn-primary" name="submit" id="submit">Save changes</button>
											</form>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<script>
					var check = function() {
						if (document.getElementById('inputPasswordNew').value ==
							document.getElementById('inputPasswordNew2').value) {
							document.getElementById('message').style.color = 'green';
							document.getElementById('message').innerHTML = 'matching';
						} else {
							document.getElementById('message').style.color = 'red';
							document.getElementById('message').innerHTML = 'not matching';
						}
						}
				</script>
				
				<?php
					if (isset($_POST['submit'])) {
						$id=$_SESSION['id'];
						$current_password = $_POST['inputPasswordCurrent'];
						$new_password = $_POST['inputPasswordNew'];
						$verify_password = $_POST['inputPasswordNew2'];
						// $Existing_Username = mysqli_query($db,"SELECT * from `users` where user_id='$email';");
						// if(mysqli_num_rows($Existing_Username)!=0)
						//     {
						if($new_password!=$verify_password){

   							 ?>
								<script>

									alert("Passwords do not match!");

									</script>
									<?php

    								}
									else{

										

    								mysqli_query($db,"UPDATE `users` SET password = '$new_password' WHERE id='$id' ;") or die("Unsuccessful");

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

							}

						?>
			</main>

			<?php include "footer.php";?>

		</div>
	</div>

	<script src="js/app.js"></script>

</body>

</html>