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
				<a class="sidebar-brand" href="index.html">
          <span class="align-middle">AdminKit</span>
        </a>

		<?php include("sidebar.php"); ?>

				<!-- <div class="sidebar-cta">
					<div class="sidebar-cta-content">
						<strong class="d-inline-block mb-2">Upgrade to Pro</strong>
						<div class="mb-3 text-sm">
							Are you looking for more components? Check out our premium version.
						</div>
						<a href="https://adminkit.io/pricing" target="_blank" class="btn btn-primary btn-block">Upgrade to Pro</a>
					</div>
				</div> -->
			</div>
		</nav>

		<div class="main">
            <?php
                $user_id = $_GET['id'];
                
                $result = mysqli_query($db,"SELECT name,user_id,password from `users` where user_id='$user_id';");
                $res = mysqli_fetch_assoc($result);
            // print_r($res);
                
            ?>
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
          <i class="hamburger align-self-center"></i>
        </a>

				<form class="d-none d-sm-inline-block">
					<div class="input-group input-group-navbar">
						<input type="text" class="form-control" placeholder="Search…" aria-label="Search">
						<button class="btn" type="button">
              <i class="align-middle" data-feather="search"></i>
            </button>
					</div>
				</form>
				<?php include("navbar.php"); ?>
				
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Edit Employee form</h1>

					<div class="row">
						<div class="">
							<div class="card">
								<div class="card-header">
									<!-- <h5 class="card-title">Edit Employee form</h5> -->
									<h6 class="card-subtitle text-muted">Edit your employees here.</h6>
								</div>
								<div class="card-body">
									<form enctype="multipart/form-data" method="post" action="">
										<div class="mb-3">
											<label class="form-label">Email address</label>
											<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $res['user_id'] ?>">
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input type="password"  name="password"class="form-control" placeholder="Password" value="<?php echo $res['password'] ?>">
										</div>
                                        <div class="mb-3">
											<label class="form-label">Name</label>
											<input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $res['name'] ?>">
										</div>
										<!-- <div class="mb-3">
											<label class="form-label">Textarea</label>
											<textarea class="form-control" placeholder="Textarea" rows="1"></textarea>
										</div> -->
										<!-- <div class="mb-3">
											<label class="form-label w-100">Upload Image</label>
											<input type="file" name="image"> -->
											<!-- <small class="form-text text-muted">Example block-level help text here.</small> -->
										<!-- </div> -->
										<!-- <div class="mb-3">
											<label class="form-check m-0">
                                            <input type="checkbox" class="form-check-input">
                                            <span class="form-check-label">Check me out</span>
                                            </label>
										</div> -->
										<button type="submit" name="submit"class="btn btn-primary">Submit</button>
									</form>
								</div>
							</div>
						</div>
						<!-- <div class="col-12 col-xl-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Horizontal form</h5>
									<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
								</div>
								<div class="card-body">
									<form>
										<div class="mb-3 row">
											<label class="col-form-label col-sm-2 text-sm-right">Email</label>
											<div class="col-sm-10">
												<input type="email" class="form-control" placeholder="Email">
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-form-label col-sm-2 text-sm-right">Password</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" placeholder="Password">
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-form-label col-sm-2 text-sm-right">Textarea</label>
											<div class="col-sm-10">
												<textarea class="form-control" placeholder="Textarea" rows="3"></textarea>
											</div>
										</div>
										<fieldset class="mb-3">
											<div class="row">
												<label class="col-form-label col-sm-2 text-sm-right pt-sm-0">Radios</label>
												<div class="col-sm-10">
													<label class="form-check">
                  <input name="radio-3" type="radio" class="form-check-input" checked>
                  <span class="form-check-label">Default radio</span>
                </label>
													<label class="form-check">
                  <input name="radio-3" type="radio" class="form-check-input">
                  <span class="form-check-label">Second default radio</span>
                </label>
													<label class="form-check">
                  <input name="radio-3" type="radio" class="form-check-input" disabled>
                  <span class="form-check-label">Disabled radio</span>
                </label>
												</div>
											</div>
										</fieldset>
										<div class="mb-3 row">
											<label class="col-form-label col-sm-2 text-sm-right pt-sm-0">Checkbox</label>
											<div class="col-sm-10">
												<label class="form-check m-0">
                <input type="checkbox" class="form-check-input">
                <span class="form-check-label">Check me out</span>
              </label>
											</div>
										</div>
										<div class="mb-3 row">
											<div class="col-sm-10 ml-sm-auto">
												<button type="submit" class="btn btn-primary">Submit</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Form row</h5>
									<h6 class="card-subtitle text-muted">Bootstrap column layout.</h6>
								</div>
								<div class="card-body">
									<form>
										<div class="row">
											<div class="mb-3 col-md-6">
												<label class="form-label" for="inputEmail4">Email</label>
												<input type="email" class="form-control" id="inputEmail4" placeholder="Email">
											</div>
											<div class="mb-3 col-md-6">
												<label class="form-label" for="inputPassword4">Password</label>
												<input type="password" class="form-control" id="inputPassword4" placeholder="Password">
											</div>
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
										<div class="mb-3">
											<label class="form-label" class="form-check m-0">
              <input type="checkbox" class="form-check-input">
              <span class="form-check-label">Check me out</span>
            </label>
										</div>
										<button type="submit" class="btn btn-primary">Submit</button>
									</form>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Inline form</h5>
									<h6 class="card-subtitle text-muted">Single horizontal row.</h6>
								</div>
								<div class="card-body">
									<form class="row row-cols-md-auto align-items-center">
										<div class="col-12">
											<label class="sr-only" for="inlineFormInputName2">Name</label>
											<input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Jane Doe">
										</div>

										<div class="col-12">
											<label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
											<div class="input-group mb-2 mr-sm-2">
												<div class="input-group-text">@</div>
												<input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username">
											</div>
										</div>

										<div class="col-12">
											<div class="form-check mb-1 mr-sm-2">
												<input type="checkbox" class="form-check-input" id="customControlInline">
												<label class="form-check-label" for="customControlInline">Remember me</label>
											</div>
										</div>

										<div class="col-12">
											<button type="submit" class="btn btn-primary mb-2">Submit</button>
										</div>
									</form>
								</div> -->
							</div>
						</div>
					</div>

				</div>
                <?php
			if(isset($_POST['submit']))
			{
					$emailo=$_POST['email'];
					$password=$_POST['password'];
					$name=$_POST['name'];
					$role="employee";
					// $Existing_Username = mysqli_query($db,"SELECT * from `users` where user_id='$email';");
					// if(mysqli_num_rows($Existing_Username)!=0)
					// 	{
							?>
								<!-- <script>
									
									alert("Email already exists!");
								
									</script> -->
									<?php
						// }
						// else{
					// 		$target_dir = "uploads/";
					// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
					// $uploadOk = 1;
					// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

					// // Check if image file is a actual image or fake image
					// if(isset($_POST["submit"])) {
					// $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					// if($check !== false) {
					// 	echo "File is an image - " . $check["mime"] . ".";
					// 	$uploadOk = 1;
					// } else {
					// 	echo "File is not an image.";
					// 	$uploadOk = 0;
					// }
					// }

					// // Check if file already exists
					// if (file_exists($target_file)) {
					// echo "Sorry, file already exists.";
					// $uploadOk = 0;
					// }

					// // Check file size
					// if ($_FILES["fileToUpload"]["size"] > 500000) {
					// echo "Sorry, your file is too large.";
					// $uploadOk = 0;
					// }

					// // Allow certain file formats
					// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					// && $imageFileType != "gif" ) {
					// echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					// $uploadOk = 0;
					// }

					// // Check if $uploadOk is set to 0 by an error
					// if ($uploadOk == 0) {
					// echo "Sorry, your file was not uploaded.";
					// // if everything is ok, try to upload file
					// } else {
					// if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					// 	echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
					// } else {
					// 	echo "Sorry, there was an error uploading your file.";
					// }
					// }
                    // UPDATE Customers
                    // SET ContactName = 'Alfred Schmidt', City= 'Frankfurt'
                    // WHERE CustomerID = 1;
					$p=mysqli_query($db,"UPDATE `users` SET user_id = '$emailo', password = '$password', role = '$role', name = '$name' WHERE user_id='$user_id' ;");
				// echo $emailo;
                // echo $user_id;
                // echo "HO";
					?>
								<script>
									
									alert("Employee Updted");
                                    window.location.href = "employee-list.php";
									</script>
									<?php
                                    

						}
		
					
				
				?>
			</main>



			
                

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-left">
							<p class="mb-0">
								<a href="index.html" class="text-muted"><strong>AdminKit Demo</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-right">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="js/app.js"></script>

</body>

</html>