<?php 

  import::load('lib', 'MySQL');
  $conexion = new MySQL(6);
?>
<!-- begin page-header -->
            <h1 class="page-header">Servicios <small>Detalle de servicios alarmados para Legacy y David</small></h1>
            <!-- end page-header -->
<!-- ****************************** Server Newrelic ******************************************* -->
<div>
				<!-- begin col-4 -->
			    <div class="col-md-4">
			        <!-- begin panel -->
			        <div class="panel panel-inverse" data-sortable-id="index-2">
			            <div class="panel-heading">
			                <h4 class="panel-title">Servidores NewRelic 
			                	<?php
									$strConsulta = "select cantidad from monitor where id_servicio =4";
					    			$consulta = $conexion->consulta($strConsulta);
    								$row= $conexion->fetch_array($consulta);
									if($row['cantidad'] > 0){//if($var>0){
								?>
			                	<span class="label label-danger pull-right">Alarmas: <?= $row['cantidad'];?></span>
			                	<?php
									}else{
								?>
								<span class="label label-Success pull-right">OK</span>
								<?php } ?>
			                </h4>
			            </div>
			            <div class="panel-body bg-silver">
                            <div data-scrollbar="true" data-height="225px">
                            	<center>
                                	<img src="<?=WEBROOT.DS?>img/server1.png" class="animated rubberBand" alt="Sample Image 1">
                            	</center>
                            	<a href="#modal-dialog" class="btn btn-sm btn-success" onclick="clickButton(4);" data-toggle="modal">Detalle</a>
                            </div>
                        </div>
			        </div>
			        <!-- end panel -->
			    </div>
			    <!-- end col-4 -->
<!-- ****************************** Servicios Newrelic ******************************************* -->
				<!-- begin col-4 -->
			    <div class="col-md-4">
			        <!-- begin panel -->
			        <div class="panel panel-inverse" data-sortable-id="index-2">
			            <div class="panel-heading">
			                <h4 class="panel-title">Servicios NewRelic 
			                	<?php
									$strConsulta = "select cantidad from monitor where id_servicio =5";
					    			$consulta = $conexion->consulta($strConsulta);
    								$row= $conexion->fetch_array($consulta);
									if($row['cantidad'] > 0){//if($var>0){
								?>
			                	<span class="label label-danger pull-right">Alarmas: <?= $row['cantidad'];?></span>
			                	<?php
									}else{
								?>
								<span class="label label-Success pull-right">OK</span>
								<?php } ?>
			                </h4>
			            </div>
			            <div class="panel-body bg-silver">
                            <div data-scrollbar="true" data-height="225px">
                                <center>
                                	<img src="<?=WEBROOT.DS?>img/apps1.png" class="animated rubberBand" alt="Sample Image 1">
                            	</center>
                            	<a href="#modal-dialog" class="btn btn-sm btn-success" onclick="clickButton(5);" data-toggle="modal">Detalle</a>
                            </div>
                        </div>
			        </div>
			        <!-- end panel -->
			    </div>
			    <!-- end col-4 -->
<!-- ****************************** Key Transaction Newrelic ******************************************* -->
				<!-- begin col-4 -->
			    <div class="col-md-4">
			        <!-- begin panel -->
			        <div class="panel panel-inverse" data-sortable-id="index-2">
			            <div class="panel-heading">
			                <h4 class="panel-title">Key Transaction
			                	<?php
									$strConsulta = "select cantidad from monitor where id_servicio =6";
					    			$consulta = $conexion->consulta($strConsulta);
    								$row= $conexion->fetch_array($consulta);
									if($row['cantidad'] > 0){//if($var>0){
								?>
			                	<span class="label label-danger pull-right">Alarmas: <?= $row['cantidad'];?></span>
			                	<?php
									}else{
								?>
								<span class="label label-Success pull-right">OK</span>
								<?php } ?>
			                </h4>
			            </div>
			            <div class="panel-body bg-silver">
                            <div data-scrollbar="true" data-height="225px">
                                <center>
                                	<img src="<?=WEBROOT.DS?>img/porcess1.png" class="animated rubberBand" alt="Sample Image 1">
                            	</center>
                            	<a href="#modal-dialog" class="btn btn-sm btn-success" onclick="clickButton(6);" data-toggle="modal">Detalle</a>
                            </div>
                        </div>
			        </div>
			        <!-- end panel -->
			    </div>
			    <!-- end col-4 -->
<!-- ****************************** Monitoring ******************************************* -->
				<!-- begin col-4 -->
			    <div class="col-md-4">
			        <!-- begin panel -->
			        <div class="panel panel-inverse" data-sortable-id="index-2">
			            <div class="panel-heading">
			                <h4 class="panel-title">Monitoring
			                	<?php
									$strConsulta = "select cantidad from monitor where id_servicio =7";
					    			$consulta = $conexion->consulta($strConsulta);
    								$row= $conexion->fetch_array($consulta);
									if($row['cantidad'] > 0){//if($var>0){
								?>
			                	<span class="label label-danger pull-right">Alarmas: <?= $row['cantidad'];?></span>
			                	<?php
									}else{
								?>
								<span class="label label-Success pull-right">OK</span>
								<?php } ?>
			                </h4>
			            </div>
			            <div class="panel-body bg-silver">
                            <div data-scrollbar="true" data-height="225px">
                                <center>
                                	<img src="<?=WEBROOT.DS?>img/monitoring1.png" class="animated rubberBand" alt="Sample Image 1">
                            	</center>
                            	<a href="#modal-dialog" class="btn btn-sm btn-success" onclick="clickButton(7);" data-toggle="modal">Detalle</a>
                            </div>
                        </div>
			        </div>
			        <!-- end panel -->
			    </div>
			    <!-- end col-4 -->
<!-- ****************************** RXTX Legacy ******************************************* -->
				<!-- begin col-4 -->
			    <div class="col-md-4">
			        <!-- begin panel -->
			        <div class="panel panel-inverse" data-sortable-id="index-2">
			            <div class="panel-heading">
			                <h4 class="panel-title">RX/TX Legacy
			                	<?php
									$strConsulta = "select cantidad from monitor where id_servicio =1";
					    			$consulta = $conexion->consulta($strConsulta);
    								$row= $conexion->fetch_array($consulta);
									if($row['cantidad'] > 0){//if($var>0){
								?>
			                	<span class="label label-danger pull-right">Alarmas: <?= $row['cantidad'];?></span>
			                	<?php
									}else{
								?>
								<span class="label label-Success pull-right">OK</span>
								<?php } ?>
			                </h4>
			            </div>
			            <div class="panel-body bg-silver">
                            <div data-scrollbar="true" data-height="225px">
                                <center>
                                	<img src="<?=WEBROOT.DS?>img/RXTX.png" class="animated rubberBand" alt="Sample Image 1">
                            	</center>
                            	<a href="#modal-dialog" class="btn btn-sm btn-success" onclick="clickButton(1);" data-toggle="modal">Detalle</a>
                            </div>
                        </div>
			        </div>
			        <!-- end panel -->
			    </div>
			    <!-- end col-4 -->
<!-- ****************************** GATEWAY Legacy ******************************************* -->
				<!-- begin col-4 -->
			    <div class="col-md-4">
			        <!-- begin panel -->
			        <div class="panel panel-inverse" data-sortable-id="index-2">
			            <div class="panel-heading">
			                <h4 class="panel-title">Status Gateway
			                	<?php
									$strConsulta = "select cantidad from monitor where id_servicio =2";
					    			$consulta = $conexion->consulta($strConsulta);
    								$row= $conexion->fetch_array($consulta);
									if($row['cantidad'] > 0){//if($var>0){
								?>
			                	<span class="label label-danger pull-right">Alarmas: <?= $row['cantidad'];?></span>
			                	<?php
									}else{
								?>
								<span class="label label-Success pull-right">OK</span>
								<?php } ?>
			                </h4>
			            </div>
			            <div class="panel-body bg-silver">
                            <div data-scrollbar="true" data-height="225px">
                                <center>
                                	<img src="<?=WEBROOT.DS?>img/gateway1.png" class="animated rubberBand" alt="Sample Image 1">
                            	</center>
                            	<a href="#modal-dialog" class="btn btn-sm btn-success" onclick="clickButton(2);" data-toggle="modal">Detalle</a>
                            </div>
                        </div>
			        </div>
			        <!-- end panel -->
			    </div>
			    <!-- end col-4 -->
</div>