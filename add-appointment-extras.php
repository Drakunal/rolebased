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

    <title>Extra charges for the appointment</title>

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

                    <h1 class="h3 mb-3">Extras</h1>

                    <div class="row">
                        <div class="">
                            <div class="card">
                                <div class="card-header">
                                    <!-- <h5 class="card-title">Add Employee form</h5> -->
                                    <h6 class="card-subtitle text-muted">Add all the extra charges here.</h6>
                                </div>
                                <div class="card-body">
                                    <form enctype="multipart/form-data" method="post" action="">
                                        <div class="mb-3 col-md-2">
                                            <label class="form-label">Additional Charges</label>
                                            <input type="number" step="0.01" name="additional_charge" class="form-control" placeholder="Extra Charges">

                                        </div>
                                        <div class="mb-3 col-md-2">
                                            <label class="form-label">Invoice Charges</label>
                                            <input type="number" step="0.01" name="invoice_charge" class="form-control" placeholder="Invoice Charges">

                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Comments</label>
                                            <textarea class="form-control" name="comments" placeholder="Comments" rows="1"></textarea>
                                        </div>


                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </main>



            <?php
            if (isset($_POST['submit'])) {
                $appointment_id = $_GET['id'];
                $res = mysqli_query($db, "SELECT * from `appointments` WHERE id='$appointment_id';");
                $row = $res->fetch_assoc();



                $date = $row['date'];
                $customer_id = $row['customer_id'];
                $employee_id=$row['employee_id'];

                $additional_charge= $_POST['additional_charge'];
                $invoice_charge = $_POST['invoice_charge'];
                $comment = $_POST['comments'];





                $p=mysqli_query($db,"UPDATE `appointments` SET additional_charge = '$additional_charge', invoice_charge = '$invoice_charge', comment = '$comment' WHERE id='$appointment_id' ;")or die("Unsuccessful appointment");

                $q=mysqli_query($db,"SELECT id from `events` WHERE date='$date' AND employee_id='$employee_id' AND customer_id='$customer_id' AND deleted_at is NULL")or die("Unsuccessful event");
                $qrow=$q->fetch_assoc();
                $event_id=$qrow['id'];
            ?>
                <script>
                    document.getElementById('success').className = "offset-md-4 alert alert-success alert-dismissible";
                    var success_class = document.getElementById('success').className;
                    var delayInMilliseconds = 1000; //1.5 second

                    setTimeout(function() {
                        window.location.href = "show.php?id=<?php echo $event_id ?>";
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