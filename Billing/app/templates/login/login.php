<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title><?php echo $Titulo;?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="<?=WEBROOT.DS;?>plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?=WEBROOT.DS;?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?=WEBROOT.DS;?>plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?=WEBROOT.DS;?>css/animate.min.css" rel="stylesheet" />
	<link href="<?=WEBROOT.DS;?>css/style.min.css" rel="stylesheet" />
	<link href="<?=WEBROOT.DS;?>css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?=WEBROOT.DS;?>css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<div class="login-cover">
	    <div class="login-cover-image"><img src="<?=WEBROOT.DS;?>img/login-bg/bg-1.jpg" data-id="login-cover-image" alt="" /></div>
	    <div class="login-cover-bg"></div>
	</div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-v2" data-pageload-addclass="animated flipInX">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    <span class="logo"></span> Billing.Vas-Pass
                    <small style="padding: 0 40px;">Monetizing Mobile Services</small>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in"></i>
                </div>
            </div>
            <!-- end brand -->
            <div class="login-content">
                <form action="http://<?=URL.DS;?>login/enter" method="post" autocomplete="off" class="margin-bottom-0">
                    <div class="form-group m-b-20">
                        <input type="text" class="form-control input-lg" name="login" placeholder="Usuario" />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" class="form-control input-lg" name="password" placeholder="Contraseña" />
                    </div>
                    <?php 

                        switch ($mensaje){
                            case "error":
                    ?>  
                    <div class="alert alert-danger fade in m-b-15">
						<strong>Error!</strong>
						Usuario o Contraseña Incorrecta.
						<span class="close" data-dismiss="alert">&times;</span>
					</div>              
                    <?php
                            break;
                            case "null":
                    ?>
                    <div class="alert alert-danger fade in m-b-15">
						<strong>Error!</strong>
						Campos vacios, ingrese sus credenciales.
						<span class="close" data-dismiss="alert">&times;</span>
					</div>  
                    <?php
                            break;
                            case "logged":
                    ?>
                    <div class="alert alert-danger fade in m-b-15">
						<strong>Error!</strong>
						usuairo ya se encuantra con sesion iniciada.
						<span class="close" data-dismiss="alert">&times;</span>
					</div>  
                    <?php
                            break;
							case "notexist":
                        
                    ?>
					<div class="alert alert-danger fade in m-b-15">
						<strong>Error!</strong>
						usuario no se encuentra registrado.
						<span class="close" data-dismiss="alert">&times;</span>
					</div>  
					<?php
                            break;
                        }
                    ?>

                    <div class="login-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">Inicio de Sesión</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end login -->     
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?=WEBROOT.DS;?>plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="<?=WEBROOT.DS;?>crossbrowserjs/html5shiv.js"></script>
		<script src="<?=WEBROOT.DS;?>crossbrowserjs/respond.min.js"></script>
		<script src="<?=WEBROOT.DS;?>crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?=WEBROOT.DS;?>plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?=WEBROOT.DS;?>js/login-v2.demo.min.js"></script>
	<script src="<?=WEBROOT.DS;?>js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});
	</script>
</body>
</html>