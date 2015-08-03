<?php 
  $user = 'openalonzo';
  $password = 'wau123';
  $server = '192.168.3.11';
  $database = 'WauReports';
  $conexión = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$server;Database=$database;", $user, $password);
  odbc_exec($conexión,"USE WauReports");

$body = "<div class=\"box col-md-12\">
	<div class=\"box-inner\">
		<div class=\"box-header well\" data-original-title=\"\">
			<h2>Servicios Monitoring</h2>
		</div>
	<div class=\"box-content\">
		<table class=\"table table-striped table-bordered bootstrap-datatable datatable responsive\" style=\"width:100%\">
			<thead>
				<tr>
					<th>Super Agregador</th>
					<th>Cobros Hoy</th>
					<th>Promedio</th>
					<th>Porcentaje</th>
			</thead>
			</tr>
			<tbody>";

$result = odbc_exec($conexión," EXEC [GetChargesSA]");
$r= odbc_fetch_object($result);
$result2 = odbc_exec($conexión," EXEC [GetpercentageSA]");
$r2= odbc_fetch_object($result2);
$body = $body. "<tr><td class=\"center\"> SAMEX </td><td class=\"center\">".$r->SAMEX."</td><td class=\"center\">".$r2->SAMEX."</td><td class=\"center\">".(($r->SAMEX*100)/$r2->SAMEX);
$body = $body. "%</td></tr>";
$body = $body. "<tr><td class=\"center\"> SAPER </td><td class=\"center\">".$r->SAPER."</td><td class=\"center\">".$r2->SAPER."</td><td class=\"center\">".(($r->SAPER*100)/$r2->SAPER);
$body = $body. "%</td></tr>";
$body = $body. "<tr><td class=\"center\"> SANIC </td><td class=\"center\">".$r->SANIC."</td><td class=\"center\">".$r2->SANIC."</td><td class=\"center\">".(($r->SANIC*100)/$r2->SANIC);
$body = $body. "%</td></tr>";
$body = $body. "<tr><td class=\"center\"> SAECU </td><td class=\"center\">".$r->SAECU."</td><td class=\"center\">".$r2->SAECU."</td><td class=\"center\">".(($r->SAECU*100)/$r2->SAECU);
$body = $body. "%</td></tr>";
$body = $body. "<tr><td class=\"center\"> SAPAN </td><td class=\"center\">0</td><td class=\"center\">0</td><td class=\"center\">0";
$body = $body. "%</td></tr>";
$body = $body."</tbody>
		</table>
	</div>
	</div>
</div>";

echo $body;

?>