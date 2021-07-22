<?php
session_start();
include "connection.php";
if (!isset($_SESSION['login_user']) || $_SESSION['role'] != "admin") {
    header("location:index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">

                <?php include "sidebar.php"; ?>


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
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>



                <?php include "navbar.php"; ?>

            </nav>

            <main class="content">
                <?php

                //for employee count
                $role_e = "employee";
                // $sql = "SELECT user_id, name FROM users WHERE role=`employee`";
                $employee = mysqli_query($db, "SELECT count(id) from `users` where role='$role_e' AND deleted_at is NULL;");
                $employee_count = $employee->fetch_assoc();
                // echo $employee_count['count(id)'];

                //for customer count
                $role_c = "customer";
                $customer = mysqli_query($db, "SELECT count(id) from `users` where role='$role_c' AND deleted_at is NULL;");
                $customer_count = $customer->fetch_assoc();
                $month = date("m");
                $year = date("Y");

                $appointment_query = mysqli_query($db, "SELECT count(id)
				FROM `appointments`
				WHERE Month(date)=$month AND
				 Year(date)=$year  AND
				   deleted_at is NULL; ") or die("Query Unsuccessfuls.");
                $appointment_count = $appointment_query->fetch_assoc();


                $appointment_query2 = mysqli_query($db, "SELECT count(id)
				FROM `appointments`
				WHERE date=CURDATE()  AND
				   deleted_at is NULL; ") or die("Query Unsuccessfuls.");
                $appointment_count2 = $appointment_query2->fetch_assoc();


                // echo $customer_count['count(id)'];

                ?>
                <div class="container-fluid p-0">

                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3><strong>Översikt</strong></h3>
                        </div>

                        <div class="col-auto ml-auto text-right mt-n1">
                            <nav aria-label="breadcrumb">
                                <!-- breadcrumb -->
                                <!-- <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">AdminKit</a></li>
									<li class="breadcrumb-item"><a href="#">Dashboards</a></li>
									<li class="breadcrumb-item active" aria-current="page">Analytics</li>
								</ol> -->
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-xl-6 col-xxl-5 d-flex"> -->
                            <!-- <div class="w-100"> -->
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-4">Antal anställda</h5>
                                                <h1 class="mt-1 mb-3"><?php echo $employee_count['count(id)']; ?></h1>
                                                <div class="mb-1">
                                                    <!-- <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span> -->
                                                    <!-- <span class="text-muted">Since last week</span> -->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-4">Antal kunder</h5>
                                                <h1 class="mt-1 mb-3"><?php echo $customer_count['count(id)']; ?></h1>
                                                <div class="mb-1">

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-sm-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-4">Bokningar denna månad</h5>
                                                <h1 class="mt-1 mb-3"><?php echo $appointment_count['count(id)']; ?></h1>
                                                <div class="mb-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-4">Bokningar idag</h5>
                                                <h1 class="mt-1 mb-3"><?php echo $appointment_count2['count(id)']; ?></h1>
                                                <div class="mb-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                    </div>
                            <!-- </div> -->
                        <!-- </div> -->
                                    <!-- <div class="col-xl-6 col-xxl-5 d-flex"> -->
                            <!-- <div class="w-100"> -->
                                <!-- <div class="row"> -->
                                    
                            <!-- </div> -->
                        <!-- </div> -->
                    <!-- </div> -->
                    <div class="row">
                        <!-- <div class="col-xl-6 col-xxl-7"> -->
                            <div class="col-sm-6">
                            <div class="card flex-fill">

                                <div class="card-header">

                                    <h5 class="card-title mb-0">Beräknade timmar arbetade denna månad</h5>
                                </div>
                                <div class="card-body py-3">
                                  
                                        <div class="card-header">
                                            <div class="flatpickr-months">
                                                <div>
                                                    <?php
                                                    $role2 = "employee";
                                                    $result2 = mysqli_query($db, "SELECT id,name from `users` where role='$role2' AND deleted_at is NULL;");
                                                    ?>
                                                    <select class="form-control mb-3" id="e-id2">
                                                        <option value="0" selected>Alla anställda</option>
                                                        <?php
                                                        while ($row2 = $result2->fetch_assoc())
                                                            echo "<option value='" . $row2['id'] . "'>" . $row2['name'] . "</option>"
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="flatpickr-month">
                                                    <div class="flatpickr-current-month">
                                                        <?php
                                                        $month = date("F");
                                                        ?>
                                                        <select class="flatpickr-monthDropdown-months" id="employee_id2" aria-label="Month" tabindex="-1">
                                                            <?php
                                                            if ($month == "January") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="1" tabindex="-1" selected>Januari</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="1" tabindex="-1">Januari</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "February") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="2" tabindex="-1" selected>Februari</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="2" tabindex="-1">Februari</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "March") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="3" tabindex="-1" selected>Mars</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="3" tabindex="-1">Mars</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "April") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="4" tabindex="-1" selected>April</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="4" tabindex="-1">April</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "May") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="5" tabindex="-1" selected>Maj</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="5" tabindex="-1">Maj</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "June") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="6" tabindex="-1" selected>Juni</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="6" tabindex="-1">Juni</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "July") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="7" tabindex="-1" selected>Juli</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="7" tabindex="-1">Juli</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "August") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="8" tabindex="-1" selected>Augusti</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="8" tabindex="-1">Augusti</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "September") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="9" tabindex="-1" selected>September</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="9" tabindex="-1">September</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "October") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="10" tabindex="-1" selected>Oktober</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="10" tabindex="-1">Oktober</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "November") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="11" tabindex="-1" selected>November</option>
                                                            <?php } else {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="11" tabindex="-1">November</option>
                                                            <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($month == "December") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="12" tabindex="-1" selected>December</option>
                                                            <?php } else {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="12" tabindex="-1">December</option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="numInputWrapper">
                                                    <div>
                                                        <!-- <input class="numInput cur-year" type="number" tabindex="-1"aria-label="Year" value="2021"> -->
                                                        <select class="form-control mb-3" id="year2" aria-label="Month" tabindex="-1">
                                                            <?php

                                                            $year = date("Y");

                                                            ?>

                                                            <?php
                                                            if ($year == 2020) {
                                                            ?>
                                                                <option value="2020" tabindex="-1" selected>2020</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2020" tabindex="-1">2020</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2021) {
                                                            ?>
                                                                <option value="2021" tabindex="-1" selected>2021</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2021" tabindex="-1">2021</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2022) {
                                                            ?>
                                                                <option value="2022" tabindex="-1" selected>2022</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2022" tabindex="-1">2022</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2023) {
                                                            ?>
                                                                <option value="2023" tabindex="-1" selected>2023</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2023" tabindex="-1">2023</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2024) {
                                                            ?>
                                                                <option value="2024" tabindex="-1" selected>2024</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2024" tabindex="-1">2024</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2025) {
                                                            ?>
                                                                <option value="2025" tabindex="-1" selected>2025</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2025" tabindex="-1">2025</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2026) {
                                                            ?>
                                                                <option value="2026" tabindex="-1" selected>2026</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2026" tabindex="-1">2026</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2027) {
                                                            ?>
                                                                <option value="2027" tabindex="-1" selected>2027</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2027" tabindex="-1">2027</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2028) {
                                                            ?>
                                                                <option value="2028" tabindex="-1" selected>2028</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2028" tabindex="-1">2028</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2029) {
                                                            ?>
                                                                <option value="2029" tabindex="-1" selected>2029</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2029" tabindex="-1">2029</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2030) {
                                                            ?>
                                                                <option value="2030" tabindex="-1" selected>2030</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2030" tabindex="-1">2030</option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            </br>
                                            <div class="ajax2">
                                                <div id="hours-worked">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                        <!-- <div class="col-xl-6 col-xxl-7"> -->
                            <div class="col-sm-6">
                            <div class="card flex-fill">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Förväntat resultat för denna månad</h5>
                                </div>
                                <div class="card-body py-3">
                                    
                                        <div class="card-header">
                                            <div class="flatpickr-months">
                                                <div>
                                                    <?php
                                                    $role2 = "employee";
                                                    $result2 = mysqli_query($db, "SELECT id,name from `users` where role='$role2' AND deleted_at is NULL;");
                                                    ?>
                                                    <select class="form-control mb-3" id="e-id3">
                                                        <option value="0" selected>Alla anställda</option>
                                                        <?php
                                                        while ($row2 = $result2->fetch_assoc())
                                                            echo "<option value='" . $row2['id'] . "'>" . $row2['name'] . "</option>"
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="flatpickr-month">
                                                    <div class="flatpickr-current-month">
                                                        <?php
                                                        $month = date("F");
                                                        ?>
                                                        <select class="flatpickr-monthDropdown-months" id="employee_id3" aria-label="Month" tabindex="-1">
                                                            <?php
                                                            if ($month == "January") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="1" tabindex="-1" selected>Januari</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="1" tabindex="-1">Januari</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "February") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="2" tabindex="-1" selected>Februari</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="2" tabindex="-1">Februari</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "March") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="3" tabindex="-1" selected>Mars</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="3" tabindex="-1">Mars</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "April") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="4" tabindex="-1" selected>April</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="4" tabindex="-1">April</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "May") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="5" tabindex="-1" selected>Maj</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="5" tabindex="-1">Maj</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "June") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="6" tabindex="-1" selected>Juni</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="6" tabindex="-1">Juni</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "July") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="7" tabindex="-1" selected>Juli</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="7" tabindex="-1">Juli</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "August") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="8" tabindex="-1" selected>Augusti</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="8" tabindex="-1">Augusti</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "September") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="9" tabindex="-1" selected>September</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="9" tabindex="-1">September</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "October") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="10" tabindex="-1" selected>Oktober</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="10" tabindex="-1">Oktober</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "November") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="11" tabindex="-1" selected>November</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="11" tabindex="-1">November</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($month == "December") {
                                                            ?>
                                                                <option class="flatpickr-monthDropdown-month" value="12" tabindex="-1" selected>December</option>
                                                            <?php } else {
                                                            ?>

                                                                <option class="flatpickr-monthDropdown-month" value="12" tabindex="-1">December</option>
                                                            <?php
                                                            }
                                                            ?>

                                                        </select>







                                                    </div>
                                                </div>
                                                <div class="numInputWrapper">
                                                    <div>
                                                        <select class="form-control mb-3" id="year3" aria-label="Month" tabindex="-1">
                                                            <?php

                                                            $year = date("Y");

                                                            ?>

                                                            <?php
                                                            if ($year == 2020) {
                                                            ?>
                                                                <option value="2020" tabindex="-1" selected>2020</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2020" tabindex="-1">2020</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2021) {
                                                            ?>
                                                                <option value="2021" tabindex="-1" selected>2021</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2021" tabindex="-1">2021</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2022) {
                                                            ?>
                                                                <option value="2022" tabindex="-1" selected>2022</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2022" tabindex="-1">2022</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2023) {
                                                            ?>
                                                                <option value="2023" tabindex="-1" selected>2023</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2023" tabindex="-1">2023</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2024) {
                                                            ?>
                                                                <option value="2024" tabindex="-1" selected>2024</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2024" tabindex="-1">2024</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2025) {
                                                            ?>
                                                                <option value="2025" tabindex="-1" selected>2025</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2025" tabindex="-1">2025</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2026) {
                                                            ?>
                                                                <option value="2026" tabindex="-1" selected>2026</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2026" tabindex="-1">2026</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2027) {
                                                            ?>
                                                                <option value="2027" tabindex="-1" selected>2027</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2027" tabindex="-1">2027</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2028) {
                                                            ?>
                                                                <option value="2028" tabindex="-1" selected>2028</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2028" tabindex="-1">2028</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2029) {
                                                            ?>
                                                                <option value="2029" tabindex="-1" selected>2029</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2029" tabindex="-1">2029</option>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($year == 2030) {
                                                            ?>
                                                                <option value="2030" tabindex="-1" selected>2030</option>
                                                            <?php } else {
                                                            ?>

                                                                <option value="2030" tabindex="-1">2030</option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            </br>
                                            <div class="ajax3">

                                                <div id="earned">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                    </div>
                    <div class="row">
                    </div>
            </main>
            <?php include "footer.php"; ?>

        </div>
    </div>
    <script src="js/app.js"></script>
    <script type="text/javascript" src="jquery/jquery.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            function loadData(type, category_id, year_id, e_id) {
                $.ajax({
                    url: "dashboard-appointment-ajax.php",
                    type: "POST",
                    data: {
                        type: type,
                        id: category_id,
                        year: year_id,
                        e_id: e_id
                    },
                    success: function(data) {
                        if (type == "stateData" || type == "yearData" || type == "employeeData") {
                            $("#appointments").html(data);
                        } else {
                            $("#employee_id").append(data);
                        }

                    }
                });
            }
            var country = $("#employee_id").val();
            var year = $("#year").val();
            var e_id = $("#e-id").val();
            loadData("stateData", country, year, e_id);

            $("#employee_id").on("change", function() {
                var country = $("#employee_id").val();
                var year = $("#year").val();
                var e_id = $("#e-id").val();
                console.log(country);
                if (country != "") {
                    loadData("stateData", country, year, e_id);
                } else {
                    $("#appointments").html("");
                }


            })

            $("#year").on("change", function() {
                var country = $("#employee_id").val();
                var year = $("#year").val();
                var e_id = $("#e-id").val();
                console.log(year);
                if (year != "") {
                    loadData("yearData", country, year, e_id);
                } else {
                    $("#appointments").html("");
                }


            })

            $("#e-id").on("change", function() {
                var country = $("#employee_id").val();
                var year = $("#year").val();
                var e_id = $("#e-id").val();
                console.log(e_id);
                if (e_id != "") {
                    loadData("employeeData", country, year, e_id);
                } else {
                    $("#appointments").html("");
                }


            })
        });
    </script>




    <script type="text/javascript">
        $(document).ready(function() {
            function loadData(type, category_id, year_id, e_id) {
                $.ajax({
                    url: "dashboard-hours-worked-ajax.php",
                    type: "POST",
                    data: {
                        type: type,
                        id: category_id,
                        year: year_id,
                        e_id: e_id
                    },
                    success: function(data) {
                        if (type == "stateData" || type == "yearData" || type == "employeeData") {
                            $("#hours-worked").html(data);
                        } else {
                            $("#employee_id2").append(data);
                        }

                    }
                });
            }
            var country = $("#employee_id2").val();
            var year = $("#year2").val();
            var e_id = $("#e-id2").val();
            loadData("stateData", country, year, e_id);

            $("#employee_id2").on("change", function() {
                var country = $("#employee_id2").val();
                var year = $("#year2").val();
                var e_id = $("#e-id2").val();
                console.log(country);
                if (country != "") {
                    loadData("stateData", country, year, e_id);
                } else {
                    $("#hours-worked").html("");
                }


            })

            $("#year2").on("change", function() {
                var country = $("#employee_id2").val();
                var year = $("#year2").val();
                var e_id = $("#e-id2").val();
                console.log(year);
                if (year != "") {
                    loadData("yearData", country, year, e_id);
                } else {
                    $("#hours-worked").html("");
                }


            })

            $("#e-id2").on("change", function() {
                var country = $("#employee_id2").val();
                var year = $("#year2").val();
                var e_id = $("#e-id2").val();
                console.log(e_id);
                if (e_id != "") {
                    loadData("employeeData", country, year, e_id);
                } else {
                    $("#hours-worked").html("");
                }


            })
        });
    </script>



    <script type="text/javascript">
        $(document).ready(function() {
            function loadData(type, category_id, year_id, e_id) {
                $.ajax({
                    url: "earned-ajax.php",
                    type: "POST",
                    data: {
                        type: type,
                        id: category_id,
                        year: year_id,
                        e_id: e_id
                    },
                    success: function(data) {
                        if (type == "stateData" || type == "yearData" || type == "employeeData") {
                            $("#earned").html(data);
                        } else {
                            $("#employee_id3").append(data);
                        }

                    }
                });
            }
            var country = $("#employee_id3").val();
            var year = $("#year3").val();
            var e_id = $("#e-id3").val();
            loadData("stateData", country, year, e_id);

            $("#employee_id3").on("change", function() {
                var country = $("#employee_id3").val();
                var year = $("#year3").val();
                var e_id = $("#e-id3").val();
                console.log(country);
                if (country != "") {
                    loadData("stateData", country, year, e_id);
                } else {
                    $("#earned").html("");
                }


            })

            $("#year3").on("change", function() {
                var country = $("#employee_id3").val();
                var year = $("#year3").val();
                var e_id = $("#e-id3").val();
                console.log(year);
                if (year != "") {
                    loadData("yearData", country, year, e_id);
                } else {
                    $("#earned").html("");
                }


            })

            $("#e-id3").on("change", function() {
                var country = $("#employee_id3").val();
                var year = $("#year3").val();
                var e_id = $("#e-id3").val();
                console.log(e_id);
                if (e_id != "") {
                    loadData("employeeData", country, year, e_id);
                } else {
                    $("#earned").html("");
                }


            })
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("datetimepicker-dashboard").flatpickr({
                inline: true,
                prevArrow: "<span class=\"fas fa-chevron-left\" title=\"Previous month\"></span>",
                nextArrow: "<span class=\"fas fa-chevron-right\" title=\"Next month\"></span>",
            });
        });
    </script>
    <script>
        function myFunction(appointment_id) {

            if (confirm("Do you want to cancel this appointment?")) {
                console.log(appointment_id);
                return true;
            }

        }
    </script>

</body>

</html>