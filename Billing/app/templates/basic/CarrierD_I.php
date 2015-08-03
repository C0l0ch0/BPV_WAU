<!--Begin Grafica CarrierD_I-->
<?php
  require_once LIB.DS."MySQL.php";  
  include(MINMODULES.DS.'detalle/metricas_int.php');
?>
<!--End Grafica CarrierD_I -->

<!-- BEGIN Chart3 CarrierD_I -->
<?php
$conexion = new MySQL(0);
$tituloG = "";
$query3 = ' select * from (select id_transaction,max(cantidad) as Total,fecha
            from billing.'.$name1.'_i  
            where id_integrador = '.$integrador.'
            group by fecha, id_integrador
            order by fecha desc
            limit 30)orden order by fecha asc
            		';
$resultfox= $conexion->consulta($query3);
$data10 = '';										
while($rfox= $conexion->fetch_row($resultfox)){ 
  $y=date('d-m', strtotime($rfox[2]));
  $data10 = $data10."data3.addRow(['".$y."',".$rfox[1]."]);\n";
};											
?>
<!-- END Chart3 CarrierD_I -->

<?php include(TEMPLATE.DS.'header.php');?>
<body>
	<?php include(TEMPLATE.DS.'top.php');?>
	
		
		<?php include(TEMPLATE.DS.'menu.php');?>
		
		<!--********************************* begin #content ********************************************************************-->
		<div id="content" class="content">			
			<!-- begin page-header -->
			<h1 class="page-header"><?php echo strtoupper($name1);?> <small>Detalle Por Integrador Movistar <?php echo $pais;?></small></h1>
			<!-- end page-header -->
			    
		<div class="row">
				 <!-- begin col-4 -->
			    <div class="col-md-4">
				 <!-- begin COMBO INTEGRADORES -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-4">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                            </div>
                            <h4 class="panel-title">Selecciona el integrador</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered" method ='POST'>
								<div class="form-group">
									<label class="control-label col-md-4">Integrador</label>
									<div class="col-md-8">
									    <select class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" id="combo" name="combo"; onchange="submit();";>
                                            <?php
                                            	$plat = 1;
                                            	$horaActual = date('H', (strtotime ("+1 Hours")));
                                            	try{
                                            	$conexion = new MySQL(0);
                                            	if ($horaActual >= 22){
													$query = '	select id_integrador, descripcion 
																from billing.'.strtolower($name1).'_i  
																where fecha = date(date_add((NOW()), INTERVAL -6 hour))
																group by id_integrador, descripcion
																order by descripcion asc;';
												}else{
													$query = '	select id_integrador, descripcion 
																from billing.'.strtolower($name1).'_i 
					 											where fecha = date(date_add((NOW()), INTERVAL -6 hour))
					 											group by id_integrador, descripcion
																order by descripcion asc;';
												}
												$combo= $conexion->consulta($query);
												if ((! $combo)){
      												throw new Exception ("No se logro obtener informacion de cobros....\n");
    											}else{
    												if($integrador == 0){
    													echo "<option value='' selected>Integrador</option>";
    												}
    												while ($dato= $conexion->fetch_row($combo)){
    													if($integrador == $dato[0]){
                                							$tituloG = $dato[1];
    														echo '<option value='.$dato[0].' selected>'.$dato[1].'</option>';
    													}else{
    														echo '<option value='.$dato[0].'>'.$dato[1].'</option>';
    													}
    												}
    											}
                                            	$conexion->MySQLClose();
                                            	}catch(Exception $e){
      												echo 'Excepcion capturada: ',  $e->getMessage(), "\n";
    											}
                                            ?>
                                        </select>
									</div>
								</div>
							</form>
                        </div>
                    </div>
                    <!-- end panel -->

				  <!-- BEGIN CarrierD_I -->
			        <div class="panel panel-inverse" data-sortable-id="ui-buttons-2">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>                                
                            </div>
                            <h4 class="panel-title"><?php if($tituloG == ''){echo "Integrador";}else{echo $tituloG;}?></h4>
                        </div>
                        <div class="panel-body">
					  <div id="CarrierD_I" class="height-sm"></div>
                        </div>
                    </div>
				  <!-- END CarrierD_I -->
			    </div>
				<!-- end col-4 -->
				<!-- begin col-8 Integradores -->
			    <div class="col-md-8">
					 <!--Begin Panel Promedios-->
					<div class="panel panel-inverse" data-sortable-id="table-basic-7">
                        <div class="panel-heading">                            
                            <h4 class="panel-title">Transacciones</h4>
                        </div>
                        <div class="panel-body">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>Integrador</th>
											<th>Cobros Hoy</th>
											<th>Promedio de Cobros</th>
											<th>Porcentaje del Dia</th>																							
										</tr>
									</thead>
									<tbody>
										<tr> <?php
											echo '<td>'.$tituloG.'</td>';																				
											
											$conexion = new MySQL($bd_id);											
											$query = 'select sum(qty) Cobros 
											from '.$schema.'.resume_carrier 
											where created_date >= left(NOW() - INTERVAL 6 HOUR,10) and type in ("DB") and status = "Success" and integrator_id ='.$integrador.' ';
											$exec = $conexion->consulta($query);
											$row = $conexion->fetch_row($exec);
											$value = $row[0];
											$query = 'select sum(qty) Cobros 
											from '.$schema.'.resume_carrier 
											where created_date between left((CURDATE() - INTERVAL 168 HOUR),10) and left((CURDATE()) - INTERVAL 6 HOUR,10) 
											and type in ("DB") and status = "Success" and integrator_id ='.$integrador.' and integrator_id <> 0;';
											$exec = $conexion->consulta($query);
											$row = $conexion->fetch_row($exec);
											$value2 = $row[0]/7;
											$value3 = ($value2 == 0) ? 0 : (($value*100)/$value2);
										echo"<td>".number_format($value)."</td><td align=\"center\">".number_format($value2)."</td>";
										echo"<td align=\"left\">".number_format($value3)."%</td>";
  
											 ?>
										</tr>																				
									</tbody>
								</table>
							</div>
							</div>
					</div>
				    <!-- End Panel Promedios-->
					<!--Begin Panel Integradores-->
			        <div class="panel panel-inverse" data-sortable-id="ui-buttons-1"->
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>                                
                            </div>
                            <h4 class="panel-title">Productos</h4>
                        </div>
                        <div class="panel-body">
							<div class="table-responsive">
                                <table id="data-table69" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id Producto</th>
                                            <th>Descripcion</th>
                                            <th>Transacciones Exitosas</th>								
                                        </tr>
                                    </thead>
									
									<?php
										$fecha = date('H', (strtotime ("+1 Hours")));
                                        $fecha1 = date("Y-m-d");
										$query = '	select a.product_id,b.product_name,sum(a.qty)
                                                    from '.$schema.'.resume_billing a
                                                    join '.$schema.'.product_master b on a.product_id=b.product_id
                                                    where a.integrator_id = '.$integrador.' and a.created_date = date(date_add((NOW()), INTERVAL -6 hour))
                                                          and date(now()) and a.price > 0
                                                    group by a.product_id ,b.product_name
                                                    order by sum(a.qty) desc;';
										$conexion = new MySQL($bd_id);
										$exec = $conexion->consulta($query);
										echo "<tbody>";
										while ($row2= $conexion->fetch_row($exec)){
    										echo "<tr><td>$row2[0]</td><td><a onclick=\"GotoDetails($integrador,$row2[0])\">$row2[1]<a></td><td>".number_format($row2[2])."</td></tr>";
    									}
    									echo"</tbody>"
									?>
                                </table>
                            </div>
                        </div>
                    </div>
				     <!-- End Panel Integradores--> 
				</div>
			    <!-- end col-8  Integradores-->
				 <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="table-basic-7">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>                                
                            </div>
                            <h4 class="panel-title">Cobros Por Dia</h4>
                        </div>
                        <div class="panel-body">	
						<div id="ex0" class="height-sm"></div>						
						</div>
					</div>
                    <!-- end panel -->
					
					 <!-- begin panel contactos integradores -->
                    <div class="panel panel-inverse" data-sortable-id="table-basic-7">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">                            
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>                                
                            </div>
                            <h4 class="panel-title">Contactos Integrador</h4>
                        </div>
                        <div class="panel-body" style="display: none;">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>#</th>
											<th>Nombre</th>
											<th>Organizacion</th>
											<th>Email</th>
											<th>Telefono</th>											
										</tr>
									</thead>
									<tbody>
										<?php
										$numero=1;
										$conexion = new MySQL(0);
										$contactos='select * from contacts where id_carrier=1 and id_integrador ='.$integrador.'';
										$result69= $conexion->consulta($contactos);
										while($row69= $conexion->fetch_row($result69)){																				
										echo"<tr><td>$numero</td><td>$tituloG</td><td>$row69[3]</td><td>$row69[4]</td><td>$row69[5]</td></tr>";											
										$numero++;}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                    <!-- end panel contactos integradores -->
					
					
			    </div>
			    <!-- end col-12 -->
		</div><br>
		</div>
		<!--********************************* end #content ********************************************************************-->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	<?php include(TEMPLATE.DS.'footer.php');?>
	<script src="<?=WEBROOT.DS;?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/masked-input/masked-input.min.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/password-indicator/js/password-indicator.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/bootstrap-select/bootstrap-select.min.js"></script>

	


<script>
        $(document).ready(function() {
            App.init();
            TableManageDefault.init();
			//Chart.init();
			FormPlugins.init();
			$('#data-table69').dataTable( {
			"order": [[ 2, 'desc' ]]
			} );
        });
</script>	
	
	

</body>
</html>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
	  <!--Comienza-->
        var data1 = new google.visualization.DataTable();
        data1.addColumn('number', 'Hora');
        data1.addColumn('number', 'Promedio');
        data1.addColumn('number', 'Ayer');
        data1.addColumn('number', 'Hoy');
        
        <?php
          echo $data1;
        ?>

        var options1 = {
          title: '<?php echo 'Cobros '.$tituloG;?>',
          hAxis: {title: 'Hora',  titleTextStyle: {color: '#333'}, ticks: data1.getDistinctValues(0)},
          vAxis: {minValue: 0},
          pointSize: 5,
          series:{
            0: {lineDashStyle: [2, 2]},
            1: {lineDashStyle: [2, 2]},
			
          },
		  
          colors: ['#9EABB4','#01AEBF','#0fd43a'],
		   legend: { position: 'top' },
		  chartArea:{width:'70%',height:'60%'}
        };
		
        var formatter1 = new google.visualization.NumberFormat(
          {negativeColor: 'black', negativeParens: true, pattern: '###,###'});
        formatter1.format(data1, 1); 
        formatter1.format(data1, 2);
		formatter1.format(data1, 3);

        var chart1 = new google.visualization.AreaChart(document.getElementById('CarrierD_I'));
        chart1.draw(data1, options1);
        /*----------------------*/
		
		var data3 = new google.visualization.DataTable();
    data3.addColumn('string', 'Dia');
    data3.addColumn('number', 'Cobros');
    <?php
      echo $data10;
    ?>
      var options = {
		   colors:['#1DB05A'],
        title: 'Cobros totales por Dia',  
	legend: { position: 'top' },
chartArea:{width:'76%',height:'60%'},

        hAxis: {
          title: 'Dia',
          minValue: 0
        },
        vAxis: {
          title: 'Cobros'
        }
      };
	  
	  var formatter2 = new google.visualization.NumberFormat(
          {negativeColor: 'black', negativeParens: true, pattern: '###,###'});
        formatter2.format(data3, 1); 

      var chart = new google.visualization.ColumnChart(
        document.getElementById('ex0'));

      chart.draw(data3, options);
		
  
   }
    $(window).resize(function(){
        drawChart();
		
      });
    function GotoDetails(inte,prod) {
		var redirect = 'http://<?php echo URL; ?>/detalle/<?php echo $name1;?>P';
		$.redirectPost(redirect, {combo1: inte, combo2: prod});
    }
    $.extend({
    	redirectPost: function(location, args)
    	{
        	var form = '';
        	$.each( args, function( key, value ) {
        	    form += '<input type="hidden" name="'+key+'" value="'+value+'">';
        	});
        	$('<form action="'+location+'" method="POST">'+form+'</form>').submit();
    	}
	});
  </script>


