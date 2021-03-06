<?php 
  /*$user = 'openalonzo';
  $password = 'Wau123';
  $server = '192.168.2.101\SQLMercurio';
  $database = 'SMSNET_ADMIN';
  $conexión = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$server;Database=$database;", $user, $password);
  odbc_exec($conexión,"USE SMSNET_ADMIN");*/
  require_once($_SERVER['DOCUMENT_ROOT'].'/core/import.php');
  import::load('lib', 'MySQL');
  $conexion = new MySQL();
?>
<!-- ****************************** Server Newrelic ******************************************* -->
<div class="box col-md-3">
<?php
	/*$curl = curl_init('https://api.newrelic.com/v2/servers.json');
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("X-Api-Key:7157dea6a415fe0c854831ef8b65f8adcdbd825ca5274e4","Content-Type: application/json"));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
	$resp = curl_exec($curl);
	$servers = json_decode($resp,true);
	echo $resp;
	curl_close($curl);
	if(count($servers['servers'])>0){
		$var=0;
		for($i=0;$i<count($servers['servers']);$i++){
			if ($servers['servers'][$i]['health_status'] != 'green'){
				$var++;
			}
		}
	}*/
	$strConsulta = "select cantidad from monitor where id_servicio =4";
    $consulta = $conexion->consulta($strConsulta);
    $row= $conexion->fetch_array($consulta);
	if($row['cantidad'] > 0){//if($var>0){
?>
	<span class="notification red">Alarmas: <?= $row['cantidad'];?></span>
<?php
	}else{
?>
	<span class="notification green">OK</span>
<?php
	}
?>
	<div class="box-inner">
  		<div class="box-header well" data-original-title="">
    		<h2>Servidores NewRelic</h2>
    		<div class="box-icon">
    		<a class="btn btn-setting btn-round btn-default" onclick="clickButton(4);"><i
                            class="glyphicon glyphicon-tasks"></i></a>
    	</div>
  	</div>
  	<div class="box-content" align="center">

    <img src="<?=ROOT.DS?>img/server1.png" class="animated rubberBand" alt="Sample Image 1">
  	</div>
 	</div>
 </div>
<!-- ****************************** Servicios Newrelic ******************************************* -->
<div class="box col-md-3">
<?php
/*odbc_close($conexión);

	$curl = curl_init('https://api.newrelic.com/v2/applications.json');
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("X-Api-Key:7157dea6a415fe0c854831ef8b65f8adcdbd825ca5274e4","Content-Type: application/json"));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
	$resp = curl_exec($curl);
	$servers = json_decode($resp,true);
	curl_close($curl);
	if(count($servers['applications'])>0){
		$var=0;
		for($i=0;$i<count($servers['applications']);$i++){
			if ($servers['applications'][$i]['health_status'] != 'green'){
				$var++;
			}
		}
	}
	if($var>0){*/
	$strConsulta = "select cantidad from monitor where id_servicio =5";
    $consulta = $conexion->consulta($strConsulta);
    $row= $conexion->fetch_array($consulta);
	if($row['cantidad'] > 0){
?>
	<span class="notification red">Alarmas: <?= $row['cantidad'];?></span>
<?php
	}else{
?>
	<span class="notification green">OK</span>
<?php
	}
?>
	<div class="box-inner">
  		<div class="box-header well" data-original-title="">
    		<h2>Apps NewRelic</h2>
    		<div class="box-icon">
    		<a class="btn btn-setting btn-round btn-default" onclick="clickButton(5);"><i
                            class="glyphicon glyphicon-tasks"></i></a>
    	</div>
  	</div>
  	<div class="box-content" align="center">

    <img src="<?=ROOT.DS?>img/apps1.png" class="animated rubberBand" alt="Sample Image 1">
  	</div>
 	</div>
 </div>
<!-- ****************************** Key Transactions Newrelic ******************************************* -->
<div class="box col-md-3">
<?php
	/*$curl = curl_init('https://api.newrelic.com/v2/key_transactions.json');
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("X-Api-Key:7157dea6a415fe0c854831ef8b65f8adcdbd825ca5274e4","Content-Type: application/json"));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
	$resp = curl_exec($curl);
	//echo $resp;
	$servers = json_decode($resp,true);
	curl_close($curl);
	if(count($servers['key_transactions'])>0){
		$var=0;
		for($i=0;$i<count($servers['key_transactions']);$i++){
			//if ($servers['key_transactions'][$i]['health_status'] != 'green'){
				$var++;
			//}
		}
	}
	if($var>0){*/
	$strConsulta = "select cantidad from monitor where id_servicio =6";
    $consulta = $conexion->consulta($strConsulta);
    $row= $conexion->fetch_array($consulta);
	if($row['cantidad'] > 0){
?>
	<span class="notification red">Alarmas: <?= $row['cantidad'];?></span>
<?php
	}else{
?>
	<span class="notification green">OK</span>
<?php
	}
?>
	<div class="box-inner">
  		<div class="box-header well" data-original-title="">
    		<h2>KeyTransact NewRelic</h2>
    		<div class="box-icon">
    		<a class="btn btn-setting btn-round btn-default" onclick="clickButton(6);"><i
                            class="glyphicon glyphicon-tasks"></i></a>
    	</div>
  	</div>
  	<div class="box-content" align="center">

    <img src="<?=ROOT.DS?>img/porcess1.png" class="animated rubberBand" alt="Sample Image 1">
  	</div>
 	</div>
 </div>
<!-- ****************************** Monitoring ******************************************* -->
<div class="box col-md-3">
<?php
	$strConsulta = "select cantidad from monitor where id_servicio =7";
    $consulta = $conexion->consulta($strConsulta);
    $row= $conexion->fetch_array($consulta);
	if($row['cantidad'] > 0){
?>
	<span class="notification red">Alarmas: <?= $row['cantidad'];?></span>
<?php
	}else{
?>
	<span class="notification green">OK</span>
<?php
	}
?>
	<div class="box-inner">
  		<div class="box-header well" data-original-title="">
    		<h2>Monitoring David</h2>
    		<div class="box-icon">
    		<a class="btn btn-setting btn-round btn-default" onclick="clickButton(7);"><i
                            class="glyphicon glyphicon-tasks"></i></a>
    	</div>
  	</div>
  	<div class="box-content" align="center">

    <img src="<?=ROOT.DS?>img/monitoring1.png" class="animated rubberBand" alt="Sample Image 1">
  	</div>
 	</div>
 </div>
<!-- ****************************** Monitoring ******************************************* -->
<div class="box col-md-3">
	<div class="box-inner">
  		<div class="box-header well" data-original-title="">
    		<h2>Cobros David</h2>
    		<div class="box-icon">
    		<a class="btn btn-setting btn-round btn-default" onclick="clickButton(8);"><i
                            class="glyphicon glyphicon-tasks"></i></a>
    	</div>
  	</div>
  	<div class="box-content" align="center">

    <img src="<?=ROOT.DS?>img/coin1.png" class="animated rubberBand" alt="Sample Image 1">
  	</div>
 	</div>
 </div>
 <!-- ****************************** Metricas ******************************************* -->
<div class="box col-md-3">
	<div class="box-inner">
  		<div class="box-header well" data-original-title="">
    		<h2>Metricas</h2>
    		<div class="box-icon">
    		<a class="btn btn-setting btn-round btn-default" onclick="clickButton(9);"><i
                            class="glyphicon glyphicon-tasks"></i></a>
    	</div>
  	</div>
  	<div class="box-content" align="center">
	

    <img src="<?=ROOT.DS?>img/chart1.png" class="animated rubberBand" alt="Sample Image 1">
  	</div>
 	</div>
 </div>
 <!-- ****************************** Grafica ******************************************* -->

