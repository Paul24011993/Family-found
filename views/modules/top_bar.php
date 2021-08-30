<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner ">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="<?php echo SERVER_URL ?>home/"> <img class="logo-default" alt="logo" src="<?php echo SERVER_URL ?>assets/images/logo.png"> </a>
		</div>
		<!-- END LOGO -->
		<div class="library-menu"> 
			<span class="one">-</span> 
			<span class="two">-</span> 
			<span class="three">-</span> 
		</div>
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<li class="dropdown">
					<a href="#" data-toggle="dropdown" class="dropdown-toggle count-info"> 
						<i class="fa fa-envelope"></i>
						<span class="badge badge-info">6</span> 
					</a>
					<ul class="dropdown-menu dropdown-messages menuBig">
						<li>
							<div class="dropdown-messages-box">
								<a class="pull-left" href="profile.html"> 
									<img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" class="img-circle" alt="image"> 
								</a>
								<div class="media-body"> 
									<small class="pull-right">46h ago</small> 
									<strong>Mike Loreipsum</strong> started following <strong>Olivia Wenscombe</strong>.
									<br>
									<small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small> 
								</div>
							</div>
						</li>
						<li class="divider"></li>
						<li>
							<div class="dropdown-messages-box">
								<a class="pull-left" href="profile.html"> 
								<img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" class="img-circle" alt="image"> </a>
								<div class="media-body "> 
									<small class="pull-right text-navy">5h ago</small> <strong>Alex Smith </strong> started following <strong>Olivia Wenscombe</strong>.
									<br>
									<small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small> 
								</div>
							</div>
						</li>
						<li class="divider"></li>
						<li>
							<div class="dropdown-messages-box">
								<a class="pull-left" href="profile.html"> 
									<img src="<?php echo SERVER_URL ?>assets/images/teem/placeholders.jpg" class="img-circle" alt="image"> 
								</a>
								<div class="media-body "> 
									<small class="pull-right">23h ago</small> <strong>Olivia Wenscombe</strong> love <strong>Sophie </strong>. 
									<br>
									<small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small> 
								</div>
							</div>
						</li>
						<li class="divider"></li>
						<li>
							<div class="text-center link-block">
								<a href="mailbox.html">
									<i class="fa fa-envelope"></i>
									<strong>Read All Messages</strong> 
								</a>
							</div>
						</li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown" class="dropdown-toggle count-info"> 
						<i class="fa fa-bell"></i> <span class="badge badge-primary">8</span>
					</a>
					<ul class="dropdown-menu dropdown-alerts menuBig">
						<li>
							<a href="mailbox.html">
								<div> 
									<i class="fa fa-envelope fa-fw"></i> You have 16 messages 
									<span class="pull-right text-muted small">4 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="profile.html">
								<div> 
									<i class="fa fa-twitter fa-fw"></i> 3 New Followers 
									<span class="pull-right text-muted small">12 minutes ago</span>	
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="grid_options.html">
								<div> 
									<i class="fa fa-upload fa-fw"></i> Server Rebooted 
									<span class="pull-right text-muted small">4 minutes ago</span>		
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<div class="text-center link-block">
								<a href="mailbox.html"> 
									<strong>See All Alerts</strong> 
									<i class="fa fa-angle-right"></i> 
								</a>
							</div>
						</li>
					</ul>
				</li>
				<!-- START USER LOGIN DROPDOWN -->
				<li class="dropdown dropdown-user">
					<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="javascript:;"> 
						<img src="../assets/images/uploads/<?php echo $_COOKIE['user_image']?>" class="img-circle" alt=""> 
						<span class="username username-hide-on-mobile"> <?php echo $_COOKIE['user_name']?></span>							
						<i class="fa fa-angle-down"></i> 
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li> 
							<a href="<?php echo SERVER_URL; ?>perfil/"> 
								<i class="icon-user"></i> Mi perfil
							</a>
						</li>
						<li>
							<a href="<?php echo SERVER_URL; ?>calendario/"> 
								<i class="icon-calendar"></i> Recordatorios 
							</a>
						</li>
						<li>
							<a href="<?php echo SERVER_URL; ?>actualizarClave/"> 
								<i class="icon-envelope-open"></i>Cambiar Contraseña 
							</a>
						</li>
						<li>
							<a href="<?php echo $_COOKIE['Token_user']; ?>" title="Salir del sistema" class="btn-exit-system">
								<i class="icon-key"></i> Cerrar sesión
							</a>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>