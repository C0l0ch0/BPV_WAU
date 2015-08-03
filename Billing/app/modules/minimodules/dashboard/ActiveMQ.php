<?php 

  import::load('lib', 'MySQL');
  $conexion = new MySQL(6);
  $strConsulta = "select amq_name,descripcion,pendiente,consumidores from monitor_queue;";
					$consulta = $conexion->consulta($strConsulta);
					if($conexion->num_rows($consulta)>0){
						echo '<h1 class="page-header">ActiveMQ <small>Detalle de colas Alarmadas</small></h1>
						<div>';
						while ($row2= $conexion->fetch_row($consulta)){
							echo '
						<div class="col-md-3 " >
				        <div class="widget widget-stats bg-black">
				            <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
				            <div class="stats-title">'.$row2[0].'<small> '.$row2[1].'</small></div>
				            <div class="stats-number"><small>Encolados:</small> '.$row2[2].'</div>
				            <div class="stats-progress progress">
	                            <div class="progress-bar" style="width: 100%;"></div>
	                        </div>
	                        <div class="stats-desc">Consumidores: '.$row2[3].'</div>
				        </div>
				        </div>';
						}
						echo '</div>';
					}
?>