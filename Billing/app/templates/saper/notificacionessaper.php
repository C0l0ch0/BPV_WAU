
<?php include(TEMPLATE.DS.'header.php');?>
<body>
	<?php include(TEMPLATE.DS.'top.php');?>
		
		<?php include(TEMPLATE.DS.'menu.php');?>
		
		<!-- begin #content -->
		<div id="content" class="content">			
			<!-- begin page-header -->
			<h1 class="page-header">Notificaciones <small>Busqueda de Notificaciones</small></h1>
			<!-- end page-header -->
			
			
			<!-- begin row -->
			    <div class="row">
			
                   <!-- begin col-6 -->
			    <div class="col-md-6">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <div class="panel-heading">                            
                            <h4 class="panel-title">Ingrese Datos</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <form method="POST" action="http://<?=URL.DS;?>detalle/notificacionessaper" class="form-horizontal form-bordered" data-parsley-validate="true" name="demo-form">
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4" for="fullname">Productid* :</label>
									<div class="col-md-6 col-sm-6">
										<input class="form-control" type="text" id="fullname" name="username" placeholder="Required" data-parsley-required="true" />
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4">Seleccione Evento:</label>
									<div class="col-md-6 col-sm-6">
										<select class="form-control" id="select-required" name="supera"  data-parsley-required="true">
										<option value="">-- Eventos --</option>
										<option value="renew">Renew</option>
										<option value="active">Active</option>																				
										<option value="active">OptOut</option>
										<option value="cancelled">Cancelled</option>
										<option value="pendingcharge">Pending Charge</option>										
										</select>
									</div>
								</div>
													
								<div class="form-group">
									<label class="control-label col-md-4 col-sm-4"></label>
									<div class="col-md-6 col-sm-6">
										<button type="submit" class="btn btn-primary">Buscar</button>
									</div>
								</div>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->								  			   
                </div>
                   <!-- end col-6 -->
				
				  <!-- begin col-6 -->
			    <div class="col-md-6">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="table-basic-7">
                        <div class="panel-heading">                            
                            <h4 class="panel-title">Detalle del Producto</h4>
                        </div>
                        <div class="panel-body">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>											
											<th>ProductId</th>
											<th>Nombre</th>
											<th>Integrador</th>
											<th>Estado</th>
											<th>Pais</th>
										
										</tr>
									</thead>
									<tbody>
									
						<?php
						 require_once LIB.DS."MySQL.php"; 
					    
						 if (isset($_POST["username"])) {
						 $busca = $_POST["username"];
						} else {
						$busca = "";
						};

						if (isset($_POST["supera"])) {
						 $evento=$_POST["supera"];
						} else {
						$evento = "";
						};	
						
						$conexion = new MySQL(1);
						$super="per_david";
						
						
						if ($busca!=""){
						
						
						
						$query ="select a.product_id , a.product_name, c.name,b.description,d.carrier_name
						from $super.product_master a
						join $super.product_status_master b on a.product_status_id = b.product_status_id
						join $super.integratordetails c on a.integror_id =c.integrator_id 
						join $super.carrier_master d on d.carrier_id = c.carrier_id
						where product_id = $busca";
						$result= $conexion->consulta($query);
						$row = $conexion->fetch_row($result);
						echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td>";   
						echo"</tbody>";};
						
						?>
					
				
								</table>
							</div>
						</div>
					</div>
                    <!-- end panel -->
                </div>
				
                <!-- end col-6 -->
				
				 <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>                                
                            </div>
                            <h4 class="panel-title">Detalle Notificaciones</h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Url Integrador</th>
                                            <th>Fecha</th>
                                            <th>Event_Status</th>
                                            <th>Notificaciones</th>
                                            
                                        </tr>
                                    </thead>
									
									<?php												
									echo "<tbody>";
									if ($busca!=""){
									$query2 = "select * from $super.notification_retry_success 
									where event_status= \"$evento\" and created_date_time >= DATE_SUB(now(),INTERVAL 1 HOUR) and sample_data like \"%product_id=$busca%\" order by
									created_date_time desc limit 25";
									
									$result2= $conexion->consulta($query2);											
									while($row2= $conexion->fetch_row($result2)){ 				
									echo "<tr><td>$row2[2]</td><td>$row2[8]</td><td>$row2[5]</td><td>$row2[3]</td>";					
									};
									echo"</tbody>";				  
									} else {
									echo "Ingrese Datos";};			  
									?>																												
									
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
		<!-- end #content -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->

<?php include(TEMPLATE.DS.'footer.php');?>
<script>
        $(document).ready(function() {
            App.init();
            TableManageDefault.init();
        });
</script>	
	
	

</body>
</html>


