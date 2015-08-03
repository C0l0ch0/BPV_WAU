<!--Begin Grafica CarrierD_I-->
<?php
  require_once LIB.DS."MySQL.php";  
  //include(MINMODULES.DS.'detalle/metricas_prod.php');
?>
<!--End Grafica CarrierD_I -->


<?php include(TEMPLATE.DS.'header.php');?>
<body>
	<?php include(TEMPLATE.DS.'top.php');?>
	
		
		<?php include(TEMPLATE.DS.'menu.php');?>
		
		<!--********************************* begin #content ********************************************************************-->
		<div id="content" class="content">			
			<!-- begin page-header -->
			<h1 class="page-header"><?php echo strtoupper($name1);?> <small>Detalle General de Productos <?php echo $pais;?></small></h1>
			<!-- end page-header -->
			<div class="row">
				<div class="col-md-12">
				<div class="panel panel-inverse" data-sortable-id="ui-buttons-1"->
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>                               
                            </div>
                            <h4 class="panel-title">Integradores</h4>
                        </div>
                        <div class="panel-body">
							<div class="table-responsive">
                                <table id="data-table69" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Producto</th>
	                                    <th>Detalle del Servicio</th>
	                                    <th>Tarifa</th>
	                                    <th >Cobros Hoy</th>
	                                    <th>Cobros Exitoso</th>
	                                    <th>Cobros Exitoso DCO</th>
	                                    <th>Cobros Semana Pasada</th>
	                                    <th>Cobros Exitosos Semana Pasada</th>
	                                    <th>Cobros Exitosos Semana DCO</th>
	                                    <th>Diferencia Transacciones</th>
	                                    <th>Diferencia Exitosos</th>
	                                    <th>Diferencia dco</th>
                                            <!--  <th>Cobros</th> -->
                                        </tr>
                                    </thead>
									<tbody>
                                    <?php
                                    	$conexion = new MySQL($bd_id);
                                    	$query = 'call '.$schema.'.Billing_monitor_data(5);';
                                    	$exec = $conexion->consulta($query);
                                    	while ($row2= $conexion->fetch_row($exec)){
    										echo "<tr>
    											<td>".$row2[0]."</td>
    											<td>".$row2[1]."</td>
    											<td>".$row2[2]."</td>
    											<td>".$row2[3]."</td>
    											<td>".$row2[4]."</td>
    											<td>".$row2[5]."</td>
    											<td>".$row2[6]."</td>
    											<td>".$row2[7]."</td>
    											<td>".$row2[8]."</td>
    											<td>".$row2[9]."</td>
    											<td>".$row2[10]."</td>
    											<td>".$row2[11]."</td>
    										</tr>";
    									}
                                    ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
					</div>
			<!-- end row -->
			</div><br>
		</div>
		<!--********************************* end #content ********************************************************************-->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	<?php include(TEMPLATE.DS.'footer.php');?>
	<script src="<?=WEBROOT.DS;?>plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/bootstrap-select/bootstrap-select.min.js"></script>


<script>
        $(document).ready(function() {
            App.init();
            TableManageDefault.init();
			FormPlugins.init();
        });
</script>	
	
	

</body>
</html>




