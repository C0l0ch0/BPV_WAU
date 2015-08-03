<?php 
  $user = 'openalonzo';
  $password = 'Wau123';
  $server = '192.168.2.101\SQLMercurio';
  $database = 'SMSNET_ADMIN';
  $conexión = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$server;Database=$database;", $user, $password);
  odbc_exec($conexión,"USE SMSNET_ADMIN");

$body = "<div id='dashboard-clients' class='row' style='visibility: hidden; position: absolute;'>
			<div class='row one-list-message'>
				<div class='col-xs-1'><i class='fa fa-users'></i></div>
				<div class='col-xs-2'><b>Serviciosasss</b></div>
				<div class='col-xs-2'>Detalle del servicio</div>
				<div class='col-xs-2'>Status</div>
			</div>";

$result = odbc_exec($conexión," select *
								FROM    
								OPENQUERY([192.168.3.11], 'EXEC WauReports.dbo.[GetMonitorService]')");
  while ($r= odbc_fetch_object($result)){
      $body = $body. "<div class='row one-list-message'>
						<div class='col-xs-1'><i class='fa fa-user'></i></div>";
      if(strlen($r->name)>30){
      	$body = $body. "<div class='col-xs-2'><b>".substr($r->name,0,30)."</b></div>";
      	$body = $body. "<div class='col-xs-2'>".$r->current_message."</div>";
      	$body = $body. "<div class='col-xs-2'>ERROR!!!</div>";
      }else{
      	$body = $body. "<div class='col-xs-2'><b>".$r->name."</b></div>";
      	$body = $body. "<div class='col-xs-2'>".$r->current_message."</div>";
      	$body = $body. "<div class='col-xs-2'>ERROR!!!</div>";
      }
  }

$body = $body."</div>";

echo $body;

?>
