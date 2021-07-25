<?php
if ($_SESSION['role'] == "employee") {


?>
  <a class="sidebar-brand" href="employee-panel.php">
  <?php } else {
  ?>
    <a class="sidebar-brand" href="customer-panel.php">
    <?php
  }
    ?>




    <span class="align-middle"><img width="200em" src="img/logo.png"></span>
    </a>
    <ul class="sidebar-nav">
      <li class="sidebar-header">
        Sidor
      </li>

      <li class="sidebar-item">
        <?php
        if ($_SESSION['role'] == "employee") {


        ?>
          <a class="sidebar-link" href="employee-panel.php">
          <?php } else {
          ?>
            <a class="sidebar-link" href="customer-panel.php">
            <?php
          }
            ?>
            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Överblick</span>
            </a>
      </li>
      <?php
      if ($_SESSION['role'] == "employee") {


      ?>
        <li class="sidebar-item">
          <a data-target="#appointment" data-toggle="collapse" class="sidebar-link collapsed">
            <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Schema</span>
          </a>
          <ul id="appointment" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
            <li class="sidebar-item"><a class="sidebar-link" href="employee-calendar.php?id=0">Alla anställda</a></li>



            <?php
            $role = 'employee';
            $result = mysqli_query($db, "SELECT id,name from `users` where role='$role' AND deleted_at is NULL;");
            while ($row = $result->fetch_assoc()) {

            ?>
              <li class="sidebar-item"><a class="sidebar-link" href="employee-calendar.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></li>

            <?php
              // echo '<li class="sidebar-item"><a class="sidebar-link" href="appointment-calendar.php?id="'.$row['id'].'>'.$row['name'].'</a></li>';
              // ">Appointments</a></li>
            }

            ?>
            <!-- <li class="sidebar-item"><a class="sidebar-link" href="add-customer.php"><i class="align-middle" data-feather="user-plus"></i>Add Appointments</a></li> -->
          </ul>
        </li>
      <?php } else {
      ?>
        <li class="sidebar-item">
          <a class="sidebar-link" href="upcoming-bookings.php">
            <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Kommande bokningar</span>
          </a>
        </li>
      <?php  } ?>

    </ul>