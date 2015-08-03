
<?php

  require_once($_SERVER['DOCUMENT_ROOT'].'/core/import.php');
  import::load('lib', 'MySQL');
  $conexion = new MySQL();

  /*$user = 'openalonzo';
  $password = 'Wau123';
  $server = '192.168.2.101\SQLMercurio';
  $database = 'SMSNET_ADMIN';
  $conexión = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$server;Database=$database;", $user, $password);
  odbc_exec($conexión,"USE SMSNET_ADMIN");*/
  //24A7FF
?>
	<!-- ****************************** Inicio de reporte de colas ************************************* -->
	<div class="box col-md-3">
  <?php
    $strConsulta = "select cantidad from monitor where id_servicio =1";
    $consulta = $conexion->consulta($strConsulta);
    $row= $conexion->fetch_array($consulta);

    /*$result = odbc_exec($conexión," select count(1) cont
                                  from SMSNET_ADMIN..ServiceMonitor
                                  where TelcoID != 0 and Severity != 0");
    $var=odbc_fetch_object($result);*/
    if($row['cantidad'] > 0){
  ?>
	   <span class="notification red">Alarmas <?=$row['cantidad']?></span>
  <?php }else{?>
    <span class="notification green">OK</span>
  <?php }
  //odbc_free_result($result);
  ?>
	 <div class="box-inner">
  		<div class="box-header well" data-original-title="">
    		<h2>RX/TX Legacy</h2>
    		<div class="box-icon">
    		  <a class="btn btn-setting btn-round btn-default" onclick="clickButton(1);"><i
              class="glyphicon glyphicon-tasks"></i></a>
        </div>
      </div>
      <div class="box-content" align="center">
        <img src="<?=ROOT.DS?>img/RXTX.png" class="animated rubberBand" alt="Sample Image 1">
      </div>
    </div>
 	</div>
<!-- ****************************** Gateway ******************************************* -->
  <div class="box col-md-3">
  <?php
    /*odbc_exec($conexión,"USE SMSNET_ADMIN;");
    $result1 = odbc_exec($conexión,"exec ServiceMonitor_GetGatewayClients;");
    $var= odbc_num_fields($result1);*/
    $strConsulta = "select cantidad from monitor where id_servicio =2";
    $consulta = $conexion->consulta($strConsulta);
    $row= $conexion->fetch_array($consulta);
  if($row['cantidad'] > 0){
  ?>
    <span class="notification red">Alarmas <?=$row['cantidad']?></span>
  <?php }else{?>
    <span class="notification green">OK</span>
  <?php }
  //odbc_free_result($result1);
  ?>
  <div class="box-inner">
      <div class="box-header well" data-original-title="">
        <h2>Status Gateways</h2>
        <div class="box-icon">
        <a class="btn btn-setting btn-round btn-default" onclick="clickButton(2);"><i
                            class="glyphicon glyphicon-tasks"></i></a>
      </div>
    </div>
    <div class="box-content" align="center">
      <img src="<?=ROOT.DS?>img/gateway1.png" class="animated rubberBand" alt="Sample Image 1">
    </div>
  </div>
  </div>
<!-- ****************************** Bae de datos Legacy ******************************************* -->
  <div class="box col-md-3">
  <?php

    /*$result = odbc_exec($conexión," exec GetDatabaseStatus");
    $var=0;
    while ($r= odbc_fetch_object($result)){
      if ($r->DatabaseStatus != 'ONLINE'){
        $var++;
      }
    }
  odbc_close($conexión);
  if($var > 0){*/
  $strConsulta = "select cantidad from monitor where id_servicio =3";
    $consulta = $conexion->consulta($strConsulta);
    $row= $conexion->fetch_array($consulta);
  if($row['cantidad'] > 0){
  ?>
    <span class="notification red">Alarmas <?=$row['cantidad']?></span>
  <?php }else{?>
    <span class="notification green">OK</span>
  <?php }?>
  <div class="box-inner">
      <div class="box-header well" data-original-title="">
        <h2>Status DB Legacy</h2>
        <div class="box-icon">
        <a class="btn btn-setting btn-round btn-default" onclick="clickButton(3);"><i
                            class="glyphicon glyphicon-tasks"></i></a>
      </div>
    </div>
    <div class="box-content" align="center">
      <img src="<?=ROOT.DS?>img/database1.png" class="animated rubberBand" alt="Sample Image 1">
    </div>
  </div>
  </div>






