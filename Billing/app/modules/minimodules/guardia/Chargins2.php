<?php 
  $user = 'openalonzo';
  $password = 'Wau123';
  $server = '192.168.2.101\SQLMercurio';
  $database = 'SMSNET_ADMIN';
  $conexión = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$server;Database=$database;", $user, $password);
  odbc_exec($conexión,"USE SMSNET_ADMIN");

$body = "				<table id='ticker-table' class='table m-table table-bordered table-hover table-heading'>
					<thead>
						<tr>
							<th>Super Agregador</th>
							<th>Cobros</th>
							<th>Promedio</th>
							<th>Weekly Chart</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class='m-ticker'><b>SAMEX</b><span>Wau Movil.</span></td>";

$result = odbc_exec($conexión," select *
								FROM    
								OPENQUERY([192.168.3.11], 'EXEC WauReports.dbo.[GetChargesSA]')");
$r= odbc_fetch_object($result);
$result2 = odbc_exec($conexión," select *
								FROM    
								OPENQUERY([192.168.3.11], 'EXEC WauReports.dbo.[GetpercentageSA]')");
$r2= odbc_fetch_object($result2);
/***************************************************  SAMEX ********************************************************************/
$body = $body. "<td class='m-price'>".$r->SAMEX."</td>";
$body = $body. "<td class='m-change'>".$r2->SAMEX." (".(($r->SAMEX*100)/$r2->SAMEX)."&#37;)</td>";
$body = $body. "<td class='td-graph'></td>
						</tr>
						<tr>
							<td class='m-ticker'><b>SAPER</b><span>Wau Movil.</span></td>";
/***************************************************  SAPER ********************************************************************/
$body = $body. "<td class='m-price'>".$r->SAPER."</td>";
$body = $body. "<td class='m-change'>".$r2->SAPER." (".(($r->SAPER*100)/$r2->SAPER)."&#37;)</td>";
$body = $body. "<td class='td-graph'></td>
						</tr>
						<tr>
							<td class='m-ticker'><b>SANIC</b><span>Wau Movil.</span></td>";
/***************************************************  SANIC ********************************************************************/
$body = $body. "<td class='m-price'>".$r->SANIC."</td>";
$body = $body. "<td class='m-change'>".$r2->SANIC." (".(($r->SANIC*100)/$r2->SANIC)."&#37;)</td>";
$body = $body. "<td class='td-graph'></td>
						</tr>
						<tr>
							<td class='m-ticker'><b>SAECU</b><span>Wau Movil.</span></td>";
/***************************************************  SAECU ********************************************************************/
$body = $body. "<td class='m-price'>".$r->SAECU."</td>";
$body = $body. "<td class='m-change'>".$r2->SAECU." (".(($r->SAECU*100)/$r2->SAECU)."&#37;)</td>";
$body = $body. "<td class='td-graph'></td>
						</tr>
						<tr>
							<td class='m-ticker'><b>SAPAN</b><span>Wau Movil.</span></td>";
/***************************************************  SAPAN ********************************************************************/
$body = $body. "<td class='m-price'>".$r->SAPAN."</td>";
$body = $body. "<td class='m-change'>".$r2->SAPAN." (".(($r->SAPAN*100)/$r2->SAPAN)."&#37;)</td>";
$body = $body. "<td class='td-graph'></td>
						</tr>
					</tbody>
				</table>";

echo $body;

?>