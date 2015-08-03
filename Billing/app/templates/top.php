<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="http://<?=URL.DS;?>" class="navbar-brand"> <span class="navbar-logo"></span> Billing.Vas-Pass <span style="font-size:9px;">V.2.1</span></a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown navbar-user">
					<?php
						$var1 = WEBROOT.DS.'img/users/'.$_SESSION['login'].'.jpg';
						if (file_exists($var1)) {
							$nombreimg = $_SESSION['login'];
							$nombreDisplay = $_SESSION['login'];
						} else {
							$nombreimg = 'default';
							$nombreDisplay = $_SESSION['login'];
						}
					?>
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<img src=<?php echo WEBROOT.DS.'img/users/'.$nombreimg.'.jpg';?> alt="" /> 
							<span class="hidden-xs"><?php echo $_SESSION['login'];?></span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="http://<?=URL.DS;?>usuario/profile">Edit Profile</a></li>
							<li class="divider"></li>
							<li><a href="http://<?=URL.DS;?>login/logout">Log Out</a></li>
						</ul>
					</li>
				</ul>

				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->