<div class="navbar-collapse collapse">
										<div id="success" class="offset-md-4 alert alert-success alert-dismissible d-none" role="alert">	
											<div class="alert-message">
												<strong>SUCCESS!</strong>
											</div>
										</div>
										<div id="danger" class="offset-md-4 alert alert-danger alert-dismissible d-none" role="alert">
											<!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button> -->
											<div class="alert-message">
												<strong>DELETED!</strong>
											</div>
										</div>
					<ul class="navbar-nav navbar-align">
						
									<li class="nav-item dropdown">
										<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
							<i class="align-middle" data-feather="settings"></i>
						</a>

											<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
								<img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded mr-1" alt="Charles Hall" /> <span class="text-dark"><?= $_SESSION['name'] ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="settings-c.php"><i class="align-middle mr-1" data-feather="settings"></i> Settings & Privacy</a>
								<a class="dropdown-item" href="logout.php"><i class="align-middle mr-1" data-feather="log-out"></i>Log out</a>
							</div>
						</li>
					</ul>
				</div>