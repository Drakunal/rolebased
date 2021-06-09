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

    <title>Employee Details Form</title>

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

                    <h1 class="h3 mb-3">Employee Image</h1>

                    <div class="row">
                        <div class="">
                            <div class="card">
                                <div class="card-header">
                                    <!-- <h5 class="card-title">Add Employee form</h5> -->
                                    <h6 class="card-subtitle text-muted">Upload Employee Image</h6>
                                </div>
                                <div class="card-body">
                                    <form enctype="multipart/form-data" method="post" action="">


                                        <div class="mb-3">
                                            <label class="form-label">Image (Please select a square image for better result with less than 4mb size)<span style="color:red">*</span></label>
                                            <input type="file" required class="form-control" rows="1" name="image" id="image" value="" />

                                        </div>


                                        <button type="submit" name="upload" class="btn btn-primary">Submit</button>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </main>


            <?php
            if (isset($_POST["upload"])) {

                $email = $_GET['id'];
                $res = mysqli_query($db, "SELECT id from `users` WHERE user_id='$email';");
                $row = $res->fetch_assoc();



                $user_id = $row['id'];
                // $user_id = $_GET['id'];
                // Get Image Dimension
                $fileinfo = @getimagesize($_FILES["image"]["tmp_name"]);
                $width = $fileinfo[0];
                $height = $fileinfo[1];

                $allowed_image_extension = array(
                    "png",
                    "jpg",
                    "jpeg"
                );

                // Get image file extension
                $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

                // Validate file input to check if is not empty
                if (!file_exists($_FILES["image"]["tmp_name"])) {
                    $response = array(
                        "type" => "error",
                        "message" => "Choose image file to upload."
                    );
                }
                // Validate file input to check if is with valid extension
                else if (!in_array($file_extension, $allowed_image_extension)) {
                    $response = array(
                        "type" => "error",
                        "message" => "Upload valid images. Only PNG and JPEG are allowed."
                    );
                    // echo $result;
                }
                // Validate image file size
                else if (($_FILES["image"]["size"] > 4000000)) {
                    $response = array(
                        "type" => "error",
                        "message" => "Image size exceeds 4MB"
                    );
                }
                // Validate image file dimension
                else {
                    $date = date("Y_m_d_h_i_sa");

                    $target = "img/avatars/" . $date . "kd" . basename($_FILES["image"]["name"]);
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target)) {
                        mysqli_query($db, "INSERT INTO `employee_images` (employee_id, file_path) VALUES('$user_id', '$target');");
                        $response = array(
                            "type" => "success",
                            "message" => "Image uploaded successfully."
                        );
            ?>
                        <script>
                            // document.getElementById('success').className = "offset-md-4 alert alert-success alert-dismissible";
                            // var success_class = document.getElementById('success').className;
                            // var delayInMilliseconds = 1000; //1.5 second


                            window.location.href = "employee-list.php";
                        </script>
            <?php
                    } else {
                        $response = array(
                            "type" => "error",
                            "message" => "Problem in uploading image files."
                        );
                    }
                }
            }
            ?>
            <?php if (!empty($response)) { ?>
                <div class="response <?php echo $response["type"]; ?>">
                    <?php echo $response["message"]; ?>
                </div>
            <?php } ?>






            <?php include("footer.php"); ?>
        </div>
    </div>

    <script src="js/app.js"></script>


</body>

</html>