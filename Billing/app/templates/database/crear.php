<?php include(TEMPLATE.DS.'header.php');?>
<body>
	<?php include(TEMPLATE.DS.'top.php');?>
		
		<?php include(TEMPLATE.DS.'menu.php');?>
		
		<!--********************************* begin #content ********************************************************************-->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Registro de nuevo Host DB<small></small></h1>
			<!-- end page-header -->
			
			<div class="row">
			    <div  id="DavidMod"></div>
			    <!-- #modal-dialog -->
				<div class="modal fade" id="modal-dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title">Detalle de Servicio.</h4>
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
                        <h4 class="panel-title">Agregar Base de Datos</h4>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" name="demo-form" method="post">
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname">Descripcion * :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="descripcion" name="descripcion" placeholder="Required" data-parsley-required="true" />
									</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname">Host * :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="host" name="host" placeholder="Required" data-parsley-required="true" />
									</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname">User * :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="user" name="user" placeholder="Required" data-parsley-required="true" />
									</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname">Pass * :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="pass" name="pass" placeholder="Required" data-parsley-required="true" />
									</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4"></label>
								<div class="col-md-6 col-sm-6">
									<button type="submit" class="btn btn-primary" onclick = "this.form.action = 'http://<?=URL.DS;?>database/save'">Submit</button>
								</div>
							</div>
                        </form>
                        <?php if (isset($_SESSION['value']) and ($_SESSION['value'] == "ok")) {unset($_SESSION['value']);?>
                        <div class="alert alert-success fade in m-b-15">
								<strong>Success!</strong>
								Pais creado correctamente.
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
                            <h4 class="panel-title">Detalle Base de Datos</h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Descripcion</th>
                                            <th>Host</th>
                                            <th>Usuario</th>
                                        </tr>
                                    </thead>
                                    <tbody>
	                                    <?php
	                                    	import::load('lib', 'MySQL'); 
	                                    	$query = "	select descripcion,host_conexion,user
	                                    				from billing.bases_cobro
														order by id_base;";
	                                    	$conexion = new MySQL(0);											
											$exec = $conexion->consulta($query);
											while ($row2= $conexion->fetch_row($exec)){
												//if ($row2[2] == 1){$value = "Activo";}else{$value = "Baja";}
    											echo "<tr><td>$row2[0]</td><td>$row2[1]</td><td>$row2[2]</td></tr>";
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
	<script src="<?=ROOT.DS;?>js/ui-modal-notification.demo.min.js"></script>
</body>
</html>
<script src="<?=ROOT.DS;?>js/dashboard-v2.js"></script>
<?php include(TEMPLATE.DS.'footer.php');?>
<script>
		$(document).ready(function() {
			App.init();
			TableManageDefault.init();
		});
	</script>

