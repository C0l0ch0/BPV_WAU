<?php include(TEMPLATE.DS.'header.php');?>
<body>
	<?php include(TEMPLATE.DS.'top.php');?>
		
		<?php include(TEMPLATE.DS.'menu.php');?>
		
		<!--********************************* begin #content ********************************************************************-->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Registro de nuevo Usuario<small></small></h1>
			<!-- end page-header -->
			
			<div class="row">
			    <div  id="DavidMod"></div>
			    <!-- #modal-dialog -->
				<div class="modal fade" id="modal-dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title">Detalle de Alarmas.</h4>
							</div>
							<div class="modal-footer">
								<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- begin col-6 -->
			<div class="col-md-6">
			    <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                        </div>
                        <h4 class="panel-title">Agregar Usuario</h4>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" name="demo-form" method="post" autocomplete="off">
                        	<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname">Nombre * :</label>
								<div class="col-md-6 col-sm-6">
									<input class="form-control" type="text" id="nombre" name="nombre" placeholder="Required" data-parsley-required="true" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname">Alias * :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="alias1" name="alias1" placeholder="Required" data-parsley-required="true" />
									</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname">Password * :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="password" id="pass1" name="pass1" placeholder="Required" data-parsley-required="true" autocomplete="off"/>
									</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="email">Email * :</label>
								<div class="col-md-6 col-sm-6">
									<input class="form-control" type="text" id="email" name="email" data-parsley-type="email" placeholder="Email" data-parsley-required="true" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname">Pais * :</label>
								<div class="col-md-6 col-sm-6">
                        			<select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" name="pais" id="pais";>
										<?php
	                       					import::load('lib', 'MySQL'); 
	                                    	$query = "	select id_pais,descripcion
														from pais 
														where estado = 1;";
	                                    	$conexion = new MySQL(0);											
											$exec = $conexion->consulta($query);										
											while ($row2= $conexion->fetch_row($exec)){
    											echo "<option value= ".$row2[0]." >".$row2[1]."</option>";
    										}
	                                    ?>
                            			</select>
                            	</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname">Rol * :</label>
								<div class="col-md-6 col-sm-6">
                        			<select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" name="rol" id="rol";>
										<?php
	                       					import::load('lib', 'MySQL'); 
	                                    	$query = "	select id_rol,descripcion
														from rol;";
	                                    	$conexion = new MySQL(0);											
											$exec = $conexion->consulta($query);										
											while ($row2= $conexion->fetch_row($exec)){
    											echo "<option value= ".$row2[0]." >".$row2[1]."</option>";
    										}
	                                    ?>
                            			</select>
                            	</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4"></label>
								<div class="col-md-6 col-sm-6">
									<button type="submit" class="btn btn-primary" onclick = "this.form.action = 'http://<?=URL.DS;?>usuario/save'">Submit</button>
								</div>
							</div>
                        </form>
                        <?php if (isset($_SESSION['value']) and ($_SESSION['value'] == "ok")) {unset($_SESSION['value']);?>
                        <div class="alert alert-success fade in m-b-15">
								<strong>Success!</strong>
								Usuario creado correctamente.
								<span class="close" data-dismiss="alert">&times;</span>
						</div>
						<?php }?>
						<?php if (isset($_SESSION['value']) and ($_SESSION['value'] == "error")) {unset($_SESSION['value']);?>
                        <div class="alert alert-danger fade in m-b-15">
								<strong>error!</strong>
								campos vacios!!!.
								<span class="close" data-dismiss="alert">&times;</span>
						</div>
						<?php }?>
						<?php if (isset($_SESSION['value']) and ($_SESSION['value'] == "error2")) {unset($_SESSION['value']);?>
                        <div class="alert alert-danger fade in m-b-15">
								<strong>error!</strong>
								El Alias que decea crear ya existe.
								<span class="close" data-dismiss="alert">&times;</span>
						</div>
						<?php }?>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->	
            <!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-6">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Detalle de Usuarios</h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Correo</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
	                                    <?php
	                                    	import::load('lib', 'MySQL'); 
	                                    	$query = "	Select usuario,email,status
	                                    				from usuario;";
	                                    	$conexion = new MySQL(0);											
											$exec = $conexion->consulta($query);
											while ($row2= $conexion->fetch_row($exec)){
												if ($row2[2] == "Activo"){$value = "Activo";}else{$value = "Baja";}
    											echo "<tr><td>$row2[0]</td><td>$row2[1]</td><td>".$value."</td></tr>";
    										}

	                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->	    
		</div>

		<!--********************************* end #content ********************************************************************-->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	<script src="<?=WEBROOT.DS;?>js/ui-modal-notification.demo.min.js"></script>
</body>
</html>
<script src="<?=WEBROOT.DS;?>js/dashboard-v2.js"></script>
<?php include(TEMPLATE.DS.'footer.php');?>
<script>
		$(document).ready(function() {
			App.init();
			TableManageDefault.init();
		});
	</script>

