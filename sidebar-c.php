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

              <li class="sidebar-item active">
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

            </ul>