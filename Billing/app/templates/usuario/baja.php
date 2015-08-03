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
			<h1 class="page-header">Altas/Bajas Usuario<small></small></h1>
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
                            <h4 class="panel-title">Detalle de Usuario</h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre de Usuario</th>
                                            <th>Alias</th>
                                            <th>Email</th>
                                            <th>Estatus</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
	                                    <?php
	                                    	import::load('lib', 'MySQL'); 
	                                    	$query = "	select nombre,status,usuario,email,id_usuario
														from usuario;";
	                                    	$conexion = new MySQL(0);											
											$exec = $conexion->consulta($query);
											while ($row2= $conexion->fetch_row($exec)){
												if ($row2[1] == "Activo"){$value = "Activo"; $upd = 0;}else{$value = "Baja"; $upd = 1;}
    											echo "<tr><td>$row2[0]</td><td>$row2[2]</td><td>$row2[3]</td><td>".$value.'</td><td align="center"><a onclick="seleccion('.$row2[4].','.$upd.')"class="btn btn-';
    											if ($row2[1] == "Activo"){echo 'danger btn-icon btn-circle btn-xs"><i class="fa fa-times"></i></a></td></tr>';}
    											else{echo 'success btn-icon btn-circle btn-xs"><i class="fa fa-repeat"></i></a></td></tr>';}
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
			if (upd == 1){
				estado = "Activo";
			}else{
				estado = "Baja";
			}
			$.post('disable', { key: opcion, key2: estado}).done(function(data) {
    			location.href=data;
			});
		}
</script>

