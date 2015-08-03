
<?php 
  $user = 'openalonzo';
  $password = 'Wau123';
  $server = '192.168.2.101\SQLMercurio';
  $database = 'SMSNET_ADMIN';
  $conexión = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$server;Database=$database;", $user, $password);
  odbc_exec($conexión,"USE SMSNET_ADMIN");

/*$body='<!-- ****************************** Inicio de reporte de colas ************************************* -->
<div class="box col-md-12">
<div class="box col-md-6">
<div class="box-inner">
  <div class="box-header well" data-original-title="">
    <h2>Queues</h2>
    <div class="box-icon">
      <a href="#" class="btn btn-minimize btn-round btn-default"><i
        class="glyphicon glyphicon-chevron-up"></i></a>
      <a href="#" class="btn btn-close btn-round btn-default"><i
        class="glyphicon glyphicon-remove"></i></a>
    </div>
  </div>
  <div class="box-content">
    <table class="table table-condensed">
      <thead>
        <tr>
          <th>QueueName</th>
          <th>Cantidad</th>
        </tr>
      </thead>
      <tbody>';
  $result = odbc_exec($conexión,"exec GetTopQueues;");
  while ($r= odbc_fetch_object($result)){ 
      $body = $body."<tr><td>";
      $body = $body. $r->QueueName.'</td><td class="center">';
      if($r->Qty <= 65000){
        $body = $body.'<span class="label-success label label-default">'.$r->Qty.'</span>';
      }
      if(($r->Qty > 65000) and ($r->Qty <= 85000)){
        $body = $body.'<span class="label-warning label label-default">'.$r->Qty.'</span>';
      }
      if(($r->Qty > 85000)){
        $body = $body.'<span class="label-default label label-danger">'.$r->Qty.'</span>';
      }


      $body = $body."</td></tr>";
  } 

$body = $body.'</tbody>
    </table>
  </div>
</div>
</div>*/
$body =  '<!-- ****************************** Fin de reporte de colas ************************************* -->
<!-- ****************************** Inicio de top cobros **************************************** -->
<div class="box col-md-6">
<div class="box-inner">
  <div class="box-header well" data-original-title="">
    <h2>Top cobros</h2>
    <div class="box-icon">
      <a href="#" class="btn btn-minimize btn-round btn-default"><i
        class="glyphicon glyphicon-chevron-up"></i></a>
      <a href="#" class="btn btn-close btn-round btn-default"><i
        class="glyphicon glyphicon-remove"></i></a>
    </div>
  </div>
  <div class="box-content">
    <table class="table table-condensed">
      <thead>
        <tr>
          <th>Carrier</th>
          <th>Cantidad</th>
          <th>Ultimo cobro</th>
        </tr>
      </thead>
      <tbody>';
  $result = odbc_exec($conexión,"select top 5 * FROM  SMSNET_ADMIN.dbo.MessageLogSent_Monitoring order by registros desc");
  while ($r= odbc_fetch_object($result)){ 
      $body = $body. "<tr><td>";
      $body = $body. $r->Pais.'</td><td class="center">'.$r->Registros."</td><td>".$r->Date;
      $body = $body. "</td></tr>";
  } 

$body = $body.'</tbody>
    </table>
  </div>
</div>
</div>
</div>
<!-- ****************************** Fin de top cobros ******************************************* -->
<div align="center"><h4>Status Fobos</h4></div>
<!-- ****************************** Inicio Alarmas Gateway ************************************** -->
<div class="box col-md-12">
<div class="box-inner">
  <div class="box-header well" data-original-title="">
    <h2>Servicios Gateway Alarmados</h2>
    <div class="box-icon">
      <a href="#" class="btn btn-minimize btn-round btn-default"><i
        class="glyphicon glyphicon-chevron-up"></i></a>
      <a href="#" class="btn btn-close btn-round btn-default"><i
        class="glyphicon glyphicon-remove"></i></a>
    </div>
  </div>
  <div class="box-content">
    <table class="table table-condensed">
      <thead>
        <tr>
          <th>Gateway</th>
          <th>Descripcion</th>
          <th>Last OK Status</th>
        </tr>
      </thead>
      <tbody>';
  $result = odbc_exec($conexión,"exec ServiceMonitor_GetGatewayClients");
  while ($r= odbc_fetch_object($result)){ 
      $body = $body."<tr><td>";
      $body = $body.$r->GatewayDescription.'</td><td class="center">'.$r->Description."</td><td>";
      $body = $body.'<span class="label-warning label label-default">'.$r->LastOkStatus.'</span>';
      $body = $body."</td></tr>";
  } 

$body = $body.'</tbody>
    </table>
  </div>
</div>
</div>
<!-- ****************************** Fin Alarmas Gateway ****************************************** -->
<!-- ****************************** Inicio Alarmas Beconected ************************************ -->
<div class="box col-md-12">
<div class="box-inner">
  <div class="box-header well" data-original-title="">
    <h2>Servicios Beconected Alarmados</h2>
    <div class="box-icon">
      <a href="#" class="btn btn-minimize btn-round btn-default"><i
        class="glyphicon glyphicon-chevron-up"></i></a>
      <a href="#" class="btn btn-close btn-round btn-default"><i
        class="glyphicon glyphicon-remove"></i></a>
    </div>
  </div>
  <div class="box-content">
    <table class="table table-condensed">
      <thead>
        <tr>
          <th>Servicio</th>
          <th>Descripcion</th>
          <th>Last OK Status</th>
        </tr>
      </thead>
      <tbody>';
  $result = odbc_exec($conexión," select *
                                  from SMSNET_ADMIN..ServiceMonitor
                                  where servicename like '%beco%' and ServiceTypeID = 1 and Severity != 0");
  while ($r= odbc_fetch_object($result)){ 
      $body = $body."<tr><td>";
      $body = $body.$r->ServiceName.'</td><td class="center">'.$r->Description."</td><td>";
      $body = $body.'<span class="label-warning label label-default">'.$r->LastOKStatus.'</span>';
      $body = $body."</td></tr>";
  } 

$body = $body.'</tbody>
    </table>
  </div>
</div>
</div>
<!-- ****************************** FIN Alarmas Beconected ***************************************** -->
<div align="center"><h4>Status Hermes/Ares</h4></div>
<!-- ****************************** Inicio Alarmas RX/TX ******************************************* -->
<div class="box col-md-12">
<div class="box-inner">
  <div class="box-header well" data-original-title="">
    <h2>Servicios Alarmados</h2>
    <div class="box-icon">
      <a href="#" class="btn btn-minimize btn-round btn-default"><i
        class="glyphicon glyphicon-chevron-up"></i></a>
      <a href="#" class="btn btn-close btn-round btn-default"><i
        class="glyphicon glyphicon-remove"></i></a>
    </div>
  </div>
  <div class="box-content">
    <table class="table table-condensed">
      <thead>
        <tr>
          <th>Servicio</th>
          <th>Descripcion</th>
          <th>Last OK Status</th>
        </tr>
      </thead>
      <tbody>';
  $result = odbc_exec($conexión," select ServiceName,Description,LastOKStatus
                                  from SMSNET_ADMIN..ServiceMonitor
                                  where TelcoID != 0 and Severity != 0");
  while ($r= odbc_fetch_object($result)){ 
      $body = $body."<tr><td>";
      $body = $body.$r->ServiceName.'</td><td class="center">'.$r->Description."</td><td>";
      $body = $body.'<span class="label-warning label label-default">'.$r->LastOKStatus.'</span>';
      $body = $body."</td></tr>";
  } 

$body = $body.'</tbody>
    </table>
  </div>
</div>
</div>
<!-- ****************************** Fin Alarmas RX/TX ********************************************* -->

<!-- ****************************** Inicio Alarmas Scheduler ************************************** -->
<div class="box col-md-6">
  <div align="center"><h4>Status Kore</h4></div>
<div class="box-inner">
  <div class="box-header well" data-original-title="">
    <h2>Envios de Scheduler</h2>
    <div class="box-icon">
      <a href="#" class="btn btn-minimize btn-round btn-default"><i
        class="glyphicon glyphicon-chevron-up"></i></a>
      <a href="#" class="btn btn-close btn-round btn-default"><i
        class="glyphicon glyphicon-remove"></i></a>
    </div>
  </div>
  <div class="box-content">
    <table class="table table-condensed">
      <thead>
        <tr>
          <th>Ultimo Envio</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>';
  $result = odbc_exec($conexión," select top 1 UpdatedDate,StatusDescription 
                                  from SCHEDULELOGS.dbo.ScheduleActivity 
                                  where StatusDescription = 'Finalizado'
                                  order by CreatedDate desc");
  while ($r= odbc_fetch_object($result)){ 
      $body = $body."<tr><td>";
      $body = $body.$r->UpdatedDate.'</td><td class="center">';
      if ($r->StatusDescription == 'Finalizado'){
        $body = $body.'<span class="label-success label label-default">'.$r->StatusDescription.'</span>';
      }else{
        $body = $body.'<span class="label-warning label label-default">'.$r->StatusDescription.'</span>';
      }
      $body = $body."</td></tr>";
  } 

$body = $body.'</tbody>
    </table>
  </div>
</div>
</div>
<!-- ****************************** Fin Alarmas Scheduler ***************************************** -->

<!-- ****************************** Inicio Alarmas encolados ************************************** -->
<div class="box col-md-6">
  <div align="center"><h4>Status Titan</h4></div>
<div class="box-inner">
  <div class="box-header well" data-original-title="">
    <h2>Encolados en Pending</h2>
    <div class="box-icon">
      <a href="#" class="btn btn-minimize btn-round btn-default"><i
        class="glyphicon glyphicon-chevron-up"></i></a>
      <a href="#" class="btn btn-close btn-round btn-default"><i
        class="glyphicon glyphicon-remove"></i></a>
    </div>
  </div>
  <div class="box-content">
    <table class="table table-condensed">
      <thead>
        <tr>
          <th>Descripcion</th>
          <th>Cantidad</th>
        </tr>
      </thead>
      <tbody>';
  $result = odbc_exec($conexión," exec GetPendingQueue;");
  while ($r= odbc_fetch_object($result)){ 
      $body = $body."<tr><td> Cantidad Encolados";
      $body = $body.'</td><td class="center">';
      if($r->Encolados <= 65000){
        $body = $body.'<span class="label-success label label-default">'.$r->Encolados.'</span>';
      }
      if(($r->Encolados > 65000) and ($r->Encolados <= 85000)){
        $body = $body.'<span class="label-warning label label-default">'.$r->Encolados.'</span>';
      }
      if(($r->Encolados > 85000)){
        $body = $body.'<span class="label-default label label-danger">'.$r->Encolados.'</span>';
      }

      $body = $body."</td></tr>";
  } 

$body = $body.'</tbody>
    </table>
  </div>
</div>
</div>
<!-- ****************************** Fin Alarmas encolados ***************************************** -->
<div align="center"><h4>Status Base de Datos Legacy</h4></div>
<!-- ****************************** Inicio Alarmas RX/TX ******************************************* -->
<div class="box col-md-12">
<div class="box-inner">
  <div class="box-header well" data-original-title="">
    <h2>Servicios Alarmados</h2>
    <div class="box-icon">
      <a href="#" class="btn btn-minimize btn-round btn-default"><i
        class="glyphicon glyphicon-chevron-up"></i></a>
      <a href="#" class="btn btn-close btn-round btn-default"><i
        class="glyphicon glyphicon-remove"></i></a>
    </div>
  </div>
  <div class="box-content">
    <table class="table table-condensed">
      <thead>
        <tr>
          <th>Servicio</th>
          <th>Descripcion</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>';
  $result = odbc_exec($conexión," exec GetDatabaseStatus");
  while ($r= odbc_fetch_object($result)){
      $body = $body."<tr><td>";
      $body = $body.$r->Base.'</td><td class="center">'.$r->Base_de_Datos."</td><td>";
      if ($r->DatabaseStatus == 'ONLINE'){
        $body = $body.'<span class="label-success label label-default">'.$r->DatabaseStatus.'</span>';
      }else{
        $body = $body.'<span class="label-default label label-danger">'.$r->DatabaseStatus.'</span>';
      }
      $body = $body."</td></tr>";
  } 
$body = $body.'</tbody>
    </table>
  </div>
</div>
</div>';
echo $body;
$_SESSION['bodyL'] = $body;
odbc_close($conexión);
?>