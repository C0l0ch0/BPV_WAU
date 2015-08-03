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
								<label class="control-label col-md-4 col-sm-4" for="fullname">Super Agregador * :</label>
								<div class="col-md-6 col-sm-6">
                        			<select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" name="carrier" id="carrier";>
										<?php
	                       					import::load('lib', 'MySQL'); 
	                                    	$query = "	select id_carrier,descripcion
														from billing.carrier
														where id_carrier not in (
														select id_carrier
														from cobro_carrier);";
	                                    	$conexion = new MySQL(0);											
											$exec = $conexion->consulta($query);	
											echo "<option value= '' ></option>";											
											while ($row2= $conexion->fetch_row($exec)){
    											echo "<option value= ".$row2[0]." >".$row2[1]."</option>";
    										}
											$conexion->MySQLClose();
	                                    ?>
                            		</select>
                            	</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname">Host * :</label>
								<div class="col-md-6 col-sm-6">
                        			<select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" name="host" id="host";>
										<?php
	                       					import::load('lib', 'MySQL'); 
	                                    	$query = "	select id_base,descripcion
														from billing.bases_cobro;";
	                                    	$conexion = new MySQL(0);											
											$exec = $conexion->consulta($query);	
											echo "<option value= '' ></option>";											
											while ($row2= $conexion->fetch_row($exec)){
    											echo "<option value= ".$row2[0]." >".$row2[1]."</option>";
    										}
											$conexion->MySQLClose();
	                                    ?>
                            		</select>
                            	</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname">Esquema BD * :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="esquema" name="esquema" placeholder="Required" data-parsley-required="true" />
									</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname">Tabla * :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="tabla" name="tabla" placeholder="Required" data-parsley-required="true" />
									</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname">Campo Sum()* :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="campo" name="campo" placeholder="Required" data-parsley-required="true" />
									</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4" for="fullname">Condicion (sin Where) * :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="cond" name="cond" placeholder="Required" data-parsley-required="true" />
									</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-4 col-sm-4"></label>
								<div class="col-md-6 col-sm-6">
									<button type="submit" class="btn btn-primary" onclick = "this.form.action = 'http://<?=URL.DS;?>database/save_g'">Submit</button>
								</div>
							</div>
                        </form>
                        <?php if (isset($_SESSION['value']) and ($_SESSION['value'] == "ok")) {unset($_SESSION['value']);?>
                        <div class="alert alert-success fade in m-b-15">
								<strong>Success!</strong>
								Relacion creada correctamente.
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
                                
                            </div>
                            <h4 class="panel-title">Detalle Base de Datos</h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Super Agregador</th>
                                            <th>Host</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
	                                    <?php
	                                    	import::load('lib', 'MySQL'); 
	                                    	$query = "	select c.descripcion,bc.descripcion,cc.estatus
														from billing.cobro_carrier cc
														join billing.carrier c on cc.id_carrier=c.id_carrier
														join billing.bases_cobro bc on cc.id_base=bc.id_base;";
	                                    	$conexion = new MySQL(0);											
											$exec = $conexion->consulta($query);
											while ($row2= $conexion->fetch_row($exec)){
												if ($row2[2] == 1){$value = "Activo";}else{$value = "Baja";}
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

