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
<!-- begin row -->
      <div class="row">
          <!-- begin col-12 -->
          <div class="col-md-12">
              <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                            </div>
                            <h4 class="panel-title">Data Table - Default</h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ServiceName</th>
                                            <th>Description</th>
                                            <th>LastOKStatus</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
  $result = odbc_exec($conexión," select ServiceName,Description,LastOKStatus
                                  from SMSNET_ADMIN..ServiceMonitor
                                  where TelcoID != 0 and Severity != 0");
  while ($r= odbc_fetch_object($result)){ 
      $body = $body."<tr><td>";
      $body = $body.$r->ServiceName.'</td><td>'.$r->Description."</td><td>";
      $body = $body.'<span class="label-warning label label-default">'.$r->LastOKStatus.'</span>';
      $body = $body."</td></tr>";
  }
  $body = $body.'
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->';
odbc_close($conexión);
echo $body;
  //24A7FF
?>