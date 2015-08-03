<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<div class="image">
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
							<a href="javascript:;"><img src=<?php echo WEBROOT.DS.'img/users/'.$nombreimg.'.jpg';?> alt="" /></a>
							
						</div>
						<div class="info">
							<?php echo $_SESSION['login'];?>
							<small>Wau Movil</small>
						</div>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Navigation</li>
					<?php if((($_SESSION['access']==1)or($_SESSION['access']==2)or($_SESSION['access']==3))and($_SESSION['pais']==1)){?>
					<li <?php if(strpos($actual_link,'dashboard')){?>class="has-sub active"<?php }else{?>class="has-sub " <?php }?>>
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-laptop"></i>
						    <span>Dashboard</span>
					    </a>
						<ul class="sub-menu">
						    <li <?php if($actual_link == 'http://'.URL.DS.'dashboard/start'){?>class="active"<?php }?>><a href="http://<?=URL.DS;?>dashboard/start">Servicios</a></li>
						    <li <?php if($actual_link == 'http://'.URL.DS.'dashboard/Metricas'){?>class="active"<?php }?>><a href="http://<?=URL.DS;?>dashboard/Metricas">Metricas Generales</a></li>
							<li <?php if($actual_link == 'http://'.URL.DS.'dashboard/notificaciones'){?>class="active"<?php }?>><a href="http://<?=URL.DS;?>dashboard/notificaciones">Notificaciones</a></li>							
						</ul>
					</li>
					<?php  }?>

					<?php 
						if ($_SESSION['access']!=3) 
							include(MODULES.DS.'menu/menuSA.php');
					?>

					<?php if((($_SESSION['access']==1))){?>
					<li <?php if(strpos($actual_link,'usuario')){?>class="has-sub active"<?php }else{?>class="has-sub " <?php }?>>
					    <a href="javascript:;">
						    <b class="caret pull-right"></b>
					        <i class="fa fa-group"></i>
						    <span>Admin usuarios <span class="label label-theme m-l-5"></span></span>
						</a>
						<ul class="sub-menu">
						    <li <?php if($actual_link == 'http://'.URL.DS.'usuario/start'){?>class="active"<?php }?>><a href="http://<?=URL.DS;?>usuario/start">Creacion de Usuario</a></li>
						    <li <?php if($actual_link == 'http://'.URL.DS.'usuario/edit'){?>class="active"<?php }?>><a href="http://<?=URL.DS;?>usuario/edit">Edicion de usuarios</a></li>
						    <li <?php if($actual_link == 'http://'.URL.DS.'usuario/delete'){?>class="active"<?php }?>><a href="http://<?=URL.DS;?>usuario/delete">Altas/Bajas</a></li>
						</ul>
					</li>
					<?php  }?>
					<?php if(($_SESSION['access']==1)){?>
					<li <?php if(strpos($actual_link,'database')){?>class="has-sub active"<?php }else{?>class="has-sub " <?php }?>>
					    <a href="javascript:;">
						    <b class="caret pull-right"></b>
					        <i class="fa fa-cubes"></i>
						    <span>Admin cobros <span class="label label-theme m-l-5"></span></span>
						</a>
						<ul class="sub-menu">
						    <li <?php if($actual_link == 'http://'.URL.DS.'database/start'){?>class="active"<?php }?>><a href="http://<?=URL.DS;?>database/start">Creacion de Host</a></li>
						    <li <?php if($actual_link == 'http://'.URL.DS.'database/edit'){?>class="active"<?php }?>><a href="http://<?=URL.DS;?>database/edit">Modificacion Host</a></li>
							<li <?php if($actual_link == 'http://'.URL.DS.'database/create_sa'){?>class="active"<?php }?>><a href="http://<?=URL.DS;?>database/create_sa">Creacion de SA</a></li>
							<li <?php if($actual_link == 'http://'.URL.DS.'database/generate'){?>class="active"<?php }?>><a href="http://<?=URL.DS;?>database/generate">Generador de Cobros</a></li>
							<li <?php if($actual_link == 'http://'.URL.DS.'database/down'){?>class="active"<?php }?>><a href="http://<?=URL.DS;?>database/down">Baja/Alta Cobros</a></li>
						</ul>
					</li>
					<?php  }?>
			        <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->