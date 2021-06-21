<a class="sidebar-brand" href="admin-panel.php">
          <span class="align-middle"><img width="200em" src="img/logo.png"></span>
        </a>
<ul class="sidebar-nav">
					        <li class="sidebar-header">
                                    Sidor
                                </li>

                                <li class="sidebar-item active">
                                    <a class="sidebar-link" href="admin-panel.php">
                        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Överblick</span>
                        </a>
                                </li>

                                <li class="sidebar-item">
                                    <a href="employee-list.php"   class="sidebar-link collapsed">
                                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Anställda</span>
                                    </a>
                                    <!-- <ul id="employee" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                                        <li class="sidebar-item"><a class="sidebar-link" href="employee-list.php">Employee List</a></li>
                                        <li class="sidebar-item"><a class="sidebar-link" href="add-employee.php"><i class="align-middle" data-feather="user-plus"></i>Add Employees</a></li>
                                    </ul> -->
                                </li>

                                <li class="sidebar-item">
                                    <a href="customer-list.php"  class="sidebar-link collapsed">
                                     <i class="align-middle" data-feather="target"></i> <span class="align-middle">Kundavdelning</span>
                                    </a>
                                    <!-- <ul id="customer" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                                        <li class="sidebar-item"><a class="sidebar-link" href="customer-list.php">Customer List</a></li>
                                        <li class="sidebar-item"><a class="sidebar-link" href="add-customer.php"><i class="align-middle" data-feather="user-plus"></i>Add Customers</a></li>
                                    </ul> -->
                                </li>

   
                                <li class="sidebar-item">
                                    <a data-target="#appointment" data-toggle="collapse" class="sidebar-link collapsed">
                                     <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Kalender</span>
                                    </a>
                                    <ul id="appointment" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                                        <li class="sidebar-item"><a class="sidebar-link" href="appointment-calendar.php?id=0">Alla anställda</a></li>



                                        <?php 
                                        	$role='employee';
                                        $result = mysqli_query($db,"SELECT id,name from `users` where role='$role' AND deleted_at is NULL;");
											while($row = $result->fetch_assoc())
                                            {

                                                ?>
                                                <li class="sidebar-item"><a class="sidebar-link" href="appointment-calendar.php?id=<?php echo $row['id'] ?>"><?php echo $row['name']?></a></li>

                                                <?php
                                                // echo '<li class="sidebar-item"><a class="sidebar-link" href="appointment-calendar.php?id="'.$row['id'].'>'.$row['name'].'</a></li>';
                                                // ">Appointments</a></li>
                                            }
											
											 ?>
                                        <!-- <li class="sidebar-item"><a class="sidebar-link" href="add-customer.php"><i class="align-middle" data-feather="user-plus"></i>Add Appointments</a></li> -->
                                    </ul>
                                </li>

                                <li class="sidebar-item">
                                    <a data-target="#calendars" data-toggle="collapse" class="sidebar-link collapsed">
                                     <i class="align-middle" data-feather="home"></i> <span class="align-middle">Röda dagar</span>
                                    </a>
                                    <ul id="calendars" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                                        <li class="sidebar-item"><a class="sidebar-link" href="add-holiday.php"><i class="align-middle" data-feather="plus"></i>Lägg till helgdagar</a></li>
                                        <li class="sidebar-item"><a class="sidebar-link" href="add-employee-holiday.php"><i class="align-middle" data-feather="user-plus"></i>Lägg till medarbetarsemester</a></li>
                                    </ul>
                                </li>
                                

                                
                                <li class="sidebar-item">
                                    <a href="deleted-users-list.php"  class="sidebar-link collapsed">
                                     <i class="align-middle" data-feather="user-x"></i> <span class="align-middle">Borttagna användare</span>
                                    </a>
                                    <!-- <ul id="customer" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                                        <li class="sidebar-item"><a class="sidebar-link" href="customer-list.php">Customer List</a></li>
                                        <li class="sidebar-item"><a class="sidebar-link" href="add-customer.php"><i class="align-middle" data-feather="user-plus"></i>Add Customers</a></li>
                                    </ul> -->
                                </li>


                               
                                <!-- <li class="sidebar-item">
                                    <a class="sidebar-link" href="pages-invoice.html">
                        <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Invoice</span>
                        </a>
                                </li> -->

                                <!-- <li class="sidebar-item">
                                    <a class="sidebar-link" href="pages-blank.html">
                        <i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
                        </a>
                                </li> -->

                                <!-- <li class="sidebar-header">
                                    Tools & Components
                                </li> -->
                                <!-- <li class="sidebar-item">
                                    <a data-target="#ui" data-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">UI Elements</span>
                        </a>
                                    <ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                                        <li class="sidebar-item"><a class="sidebar-link" href="ui-alerts.html">Alerts</a></li>
                                        <li class="sidebar-item"><a class="sidebar-link" href="ui-buttons.html">Buttons</a></li>
                                        <li class="sidebar-item"><a class="sidebar-link" href="ui-cards.html">Cards</a></li>
                                        <li class="sidebar-item"><a class="sidebar-link" href="ui-general.html">General</a></li>
                                        <li class="sidebar-item"><a class="sidebar-link" href="ui-grid.html">Grid</a></li>
                                        <li class="sidebar-item"><a class="sidebar-link" href="ui-modals.html">Modals</a></li>
                                        <li class="sidebar-item"><a class="sidebar-link" href="ui-typography.html">Typography</a></li>
                                    </ul>
                                </li> -->

                                <!-- <li class="sidebar-item">
                                    <a class="sidebar-link" href="icons-feather.html">
                        <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
                        </a>
                                </li> -->

                                <!-- <li class="sidebar-item">
                                    <a data-target="#forms" data-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Forms</span>
                        </a>
                                    <ul id="forms" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                                        <li class="sidebar-item"><a class="sidebar-link" href="forms-layouts.html">Form Layouts</a></li>
                                        <li class="sidebar-item"><a class="sidebar-link" href="forms-basic-inputs.html">Basic Inputs</a></li>
                                    </ul>
                                </li> -->

                                <!-- <li class="sidebar-item">
                                    <a class="sidebar-link" href="tables-bootstrap.html">
                        <i class="align-middle" data-feather="list"></i> <span class="align-middle">Tables</span>
                        </a>
                                </li> -->

                                        <!-- <li class="sidebar-header">
                                            Plugins & Addons
                                        </li>

                                        <li class="sidebar-item">
                                            <a class="sidebar-link" href="charts-chartjs.html">
                                <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
                                </a>
                                        </li>

                                        <li class="sidebar-item">
                                            <a class="sidebar-link" href="maps-google.html">
                                <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
                                </a>
                                        </li> -->
				</ul>
                                        </br>
                                        </br></br></br></br></br></br></br></br></br></br></br></br></br>