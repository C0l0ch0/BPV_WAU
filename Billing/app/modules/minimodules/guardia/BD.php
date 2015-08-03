<?php

  /*require_once($_SERVER['DOCUMENT_ROOT'].'/core/import.php');
  import::load('lib', 'MySQL');
  $conexion = new MySQL();*/

  $user = 'openalonzo';
  $password = 'Wau123';
  $server = '192.168.2.101\SQLMercurio';
  $database = 'SMSNET_ADMIN';
  $conexión = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$server;Database=$database;", $user, $password);
  odbc_exec($conexión,"USE SMSNET_ADMIN");
  $body = '
<!-- ****************************** Inicio Alarmas Gateway ******************************************* -->
<div class="box col-md-12">
<div class="box-inner">
  <div class="box-header well" data-original-title="">
    <h2>Servicios Alarmados</h2>
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
odbc_close($conexión);
echo $body;
  //24A7FF
?>