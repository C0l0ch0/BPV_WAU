<!--Begin Grafica SAECU-->
<?php
  require_once LIB.DS."MySQL.php";  
  include(MINMODULES.DS.'detalle/metricas.php');
?>
<!--End Grafica SAECU -->

<!-- BEGIN Chart2 SAECU -->
<?php
$meses= array('','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sept','Oct','Nov','Dic');
for($x=1;$x<=12;$x=$x+1){
$dinero[$x]=0;
}
$anno=date('Y');

$conexion = new MySQL(0);

$query3 = 'select max(cantidad) as "total", fecha
from '.$name1.'
group by fecha';

$resultfox= $conexion->consulta($query3);

											
while($rfox= $conexion->fetch_row($resultfox)){ 
$y=date('Y', strtotime($rfox[1]));
$mes=(int)date('m', strtotime($rfox[1]));
											
if ($y==$anno){
$dinero[$mes]=$dinero[$mes]+$rfox[0];
}
											
};
?>
<!-- END Chart2 SAECU -->

<?php include(TEMPLATE.DS.'header.php');?>
<body>
	<?php include(TEMPLATE.DS.'top.php');?>
	
		
		<?php include(TEMPLATE.DS.'menu.php');?>
		
		<!--********************************* begin #content ********************************************************************-->
		<div id="content" class="content">			
			<!-- begin page-header -->
			<h1 class="page-header"><?php echo strtoupper($name1);?> <small>Detalle General Movistar <?php echo $pais;?></small></h1>
			<!-- end page-header -->
			    
		<div class="row">
					
			    <!-- begin col-4 -->
			    <div class="col-md-4">
				  <!-- BEGIN CarrierD -->
			        <div class="panel panel-inverse" data-sortable-id="ui-buttons-2">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>                               
                            </div>
                            <h4 class="panel-title"><?php echo strtoupper($pais);?></h4>
                        </div>
                        <div class="panel-body">
					  <div id="CarrierD" class="height-sm"></div>
                        </div>
                    </div>
				  <!-- END CarrierD -->
				
				  <!-- BEGIN TOTALES POR MES -->
				  
			        <div class="panel panel-inverse" data-sortable-id="ui-buttons-2">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>                               
                            </div>
                            <h4 class="panel-title">Cobros Mensuales</h4>
                        </div>
                        <div class="panel-body">
					   <div id="ex0" class="height-sm"></div>
                        </div>
                    </div>
				
				  <!-- END TOTALES POR MES -->
					
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
											<th>Plataforma</th>
											<th>Cobros Hoy</th>
											<th>Promedio de Cobros</th>
											<th>Porcentaje del Dia</th>																						
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo strtoupper($name1);?></td>																					
											 <?php
											$conexion = new MySQL($bd_id);											
											$query = 'select sum(qty) Cobros
											from '.$schema.'.resume_carrier 
											where created_date >= left(NOW() - INTERVAL 6 HOUR,10) and type in ("DB") and status = "Success"';
											$exec = $conexion->consulta($query);
											$row = $conexion->fetch_row($exec);
											$value = $row[0];
											$query = 'select sum(qty) Cobros_ECU 
											from '.$schema.'.resume_carrier 
											where created_date between left((CURDATE() - INTERVAL 168 HOUR),10) and left((CURDATE()) - INTERVAL 6 HOUR,10) 
											and type in ("DB") and status = "Success"';
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
							<small>* Los valores de cobros son referenciales.</small>
							</div>
					</div>
                    
					<!-- End Panel Promedios-->
					
					
					<!--Begin Panel Integradores-->
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
                                            <th>Id_Integrador</th>
                                            <th>Nombre</th>
                                            <th>Productos</th>
											<th>Cobros Hoy</th>											
                                         <!--   <th>Mensajes MT</th> -->
                                            <!--  <th>Cobros</th> -->
                                        </tr>
                                    </thead>
									
									<?php	
									$conexion = new MySQL($bd_id);																									
									$query2 = 'select a.integrator_id, b.name, c.cuenta, sum(a.qty)as "total"
									from '.$schema.'.resume_carrier a
									join '.$schema.'.integratordetails b on a.integrator_id = b.integrator_id
									join(select integror_id as integror_id, count(product_id) as "cuenta"
									from '.$schema.'.product_master 									
									group by integror_id ) c on a.integrator_id = c.integror_id
									where a.created_date >= left(NOW() - INTERVAL 6 HOUR,10) and a.type in ("DB") and a.status = "Success"
									group by a.integrator_id';	
									$resultfox2= $conexion->consulta($query2);
                                    echo "<tbody>";
                                     while($row2= $conexion->fetch_row($resultfox2)){ 				
									echo "<tr><td>$row2[0]</td><td><a onclick=\"GotoDetails($row2[0])\">$row2[1]<a></td><td>$row2[2]</td><td>".number_format($row2[3])."</td></tr>";
									  };                                        
                                    echo"</tbody>"?>
                                </table>
                            </div>
                        </div>
                    </div>
				     <!-- End Panel Integradores-->
					 
				</div>
			    <!-- end col-8  Integradores-->
				
				<!-- Begin Panel Contactos MOVISTAR-->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="table-basic-7">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">                            
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>                                
                            </div>
                            <h4 class="panel-title">Contactos Movistar <?php echo $pais;?></h4>
                        </div>
                        <div class="panel-body" style="display: none;">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>#</th>
											<th>Organizacion</th>
											<th>Nombre</th>
											<th>Email</th>
											<th>Telefono</th>											
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Helpdesk</td>
											<td>Helpdesk</td>
											<td>SISnotificacionesHD.ec@telefonica.com</td>
											<td> (+593) 2227700 ext. 2730</td>										
										</tr>
										<tr>
											<td>2</td>
											<td>Jefe de Proyectos IT</td>
											<td>Juan Jerónimo Andráde</td>
											<td>juanjeronimo.andrade@telefonica.com</td>
											<td>+593 9 9920 0036</td>											
										</tr>
										<tr>
											<td>3</td>
											<td>Jefe de Contenidos y Mensajería</td>
											<td>Alicia Vicente</td>
											<td>alicia.vicente@telefonica.com</td>
											<td>+593  99 3645049</td>											
										</tr>								
									</tbody>
								</table>
							</div>
						</div>
					</div>
                    <!-- end panel -->
			    </div>
			    <!-- end Panel Contactos MOVISTAR -->	
		
		
		</div><br>

			
		</div>
		<!--********************************* end #content ********************************************************************-->
		
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
			//Chart.init();
			$('#data-table69').dataTable( {
			"order": [[ 3, 'desc' ]]
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
        var options3 = {
          title: '<?php echo 'Cobros '.$name1;?>',
          hAxis: {title: 'Hora',  titleTextStyle: {color: '#333'}, ticks: data1.getDistinctValues(0)},
          vAxis: {minValue: 0},
          pointSize: 5,
          series:{
            0: {lineDashStyle: [2, 2]},
            1: {lineDashStyle: [2, 2]}
          },
          colors: ['#9EABB4','#01AEBF','#0fd43a'],
		   legend: { position: 'top' },
		   chartArea:{width:'70%',height:'60%'}
        };
        var formatter3 = new google.visualization.NumberFormat(
          {negativeColor: 'black', negativeParens: true, pattern: '###,###'});
        formatter3.format(data1, 1); 
        formatter3.format(data1, 2);
		formatter3.format(data1, 3);
        var chart3 = new google.visualization.AreaChart(document.getElementById('CarrierD'));
        chart3.draw(data1, options3);
        /*----------------------*/
 
<!--comienza-->
              
     var data = google.visualization.arrayToDataTable([
        ['Mes',          'Cobros'],
        <?php
		for($x=1;$x<=12;$x=$x+1){
		?>
        ['<?php echo $meses[$x];?>', <?php echo $dinero[$x]?>],
		<?php } ?>
      ]);

      var options = {
        title: 'Cobros totales por mes',  
	legend: { position: 'top' },
chartArea:{width:'70%',height:'60%'},	
        hAxis: {
          title: 'Cobros',
          minValue: 0
        },
        vAxis: {
          title: 'Mes'
        }
      };
	  
	  var formatter2 = new google.visualization.NumberFormat(
          {negativeColor: 'black', negativeParens: true, pattern: '###,###'});
        formatter2.format(data, 1); 

      var chart = new google.visualization.BarChart(
        document.getElementById('ex0'));

      chart.draw(data, options);
  
   }
    $(window).resize(function(){
        drawChart();
		
      });
	function GotoDetails(inte) {
		var redirect = 'http://<?php echo URL; ?>/detalle/<?php echo $name1;?>I';
		$.redirectPost(redirect, {combo: inte});
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


