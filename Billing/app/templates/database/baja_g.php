<?php include(TEMPLATE.DS.'header.php');?>
<body>
	<?php include(TEMPLATE.DS.'top.php');?>
		
		<?php include(TEMPLATE.DS.'menu.php');
			if(isset($_POST['combo'])){$valor=$_POST['combo'];unset($_POST['combo']);}else{$valor = 0;}
		?>
		
		<!--********************************* begin #content ********************************************************************-->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Altas/Bajas Servicio<small></small></h1>
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
            <!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Detalle de Servicios</h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Descripcion</th>
                                            <th>Ruta</th>
                                            <th>Estado</th>
                                            <th>Accion</th>
                                            <th>Display</th>
                                        </tr>
                                    </thead>
                                    <tbody>
	                                    <?php
	                                    	import::load('lib', 'MySQL'); 
	                                    	$query = "	select c.descripcion,bc.descripcion,cc.estatus,cc.id_cobro_carrier,cc.display_graph
														from billing.cobro_carrier cc
														join billing.carrier c on cc.id_carrier=c.id_carrier
														join billing.bases_cobro bc on cc.id_base=bc.id_base;";
	                                    	$conexion = new MySQL(0);											
											$exec = $conexion->consulta($query);
											while ($row2= $conexion->fetch_row($exec)){
												if ($row2[2] == 1){$value = "Activo"; $upd = 0;}else{$value = "Baja"; $upd = 1;}
    											echo "	<tr>
    														<td>$row2[0]</td>
    														<td>$row2[1]</td>
    														<td>".$value.'</td>
    														<td align="center"><a onclick="seleccion('.$row2[3].','.$upd.')"class="btn btn-';
    											if ($row2[2] == 1){
    												echo 'danger btn-icon btn-circle btn-xs"><i class="fa fa-times"></i></a></td>';
    											}else{
    												echo 'success btn-icon btn-circle btn-xs"><i class="fa fa-repeat"></i></a></td>';
    											}
    											if ($row2[4] == 1){$upd1 = 0;}else{$upd1 = 1;}
    											echo '<td align="center"><a onclick="ActionDisplay('.$row2[3].','.$upd1.')"class="btn btn-';
    											if ($row2[4] == 1){
    												echo 'danger btn-icon btn-circle btn-xs"><i class="fa fa-times"></i></a></td></tr>';
    											}else{
    												echo 'success btn-icon btn-circle btn-xs"><i class="fa fa-repeat"></i></a></td></tr>';
    											}
    											//</tr>
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
			FormPlugins.init();
		});
		function seleccion(opcion,upd) {
			$.post('disable_sa', { key: opcion, key2: upd}).done(function(data) {
    			location.href=data;
			});
		}
		function ActionDisplay(opcion,upd) {
			$.post('display_sa', { key3: opcion, key4: upd}).done(function(data) {
    			location.href=data;
			});
		}
</script>

