
<?php
	session_start();
    include "connection.php";
?><!DOCTYPE html>

<html lang="en">
<head>
	<title>Monika</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action= "" method="post">
					<span class="login100-for1m-logo">
					<img src="img/logo.png">
						<!-- <i class="zmdi zmdi-landscape"></i> -->
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<!-- <div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div> -->

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" value="login" name="login">
							Login
						</button>

						
					</div>

					<!-- <div class="text-center p-t-90">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div> -->
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>


	<?php 

        if(isset($_POST['login']))
        {
            $username=$_POST['username'];
            $password=$_POST['pass'];
           

           
                $res=mysqli_query($db,"SELECT * from `users` where user_id='$username' && password='$password' and deleted_at is NULL;");
            

           
            
            $count=mysqli_num_rows($res);
			// echo $count;
            

            if($count==0)
            {
                ?>

						<script>
						
						alert("Invalid credentials");
					
						</script>
                    <!-- <script type="text/javascript">
                        Swal.fire({
                            title: 'Error!',
                            text: 'The Username and Password doest not match.....',
                            type: 'error',
                            confirmButtonText: 'Try Again'
                        })
                    </script> -->
                <?php
            }

            else
            {
                $row=mysqli_fetch_assoc($res);

				$_SESSION['name']=$row['name'];
                $_SESSION['login_user']=$row['user_id'];
				$_SESSION['role']=$row['role'];
				$_SESSION['id'] = $row['id'];
				// print_r($row);
				// echo $row['role'];


                if($_SESSION['role']=="admin")
                {
					// header("location:admin-panel.php");
                    echo "<meta http-equiv=Refresh content=0.2;url=admin-panel.php>";
                }

                elseif($_SESSION['role']=="employee")
                {
					// header("locationemployee-panel.php");
                    echo "<meta http-equiv=Refresh content=0.2;url=employee-panel.php>";
                }

				elseif($_SESSION['role']=="customer")
                {
					// header("location:customer-panel.php");
                    echo "<meta http-equiv=Refresh content=0.2;url=customer-panel.php>";
                }
                
            }
        }
    ?>


</body>
</html>