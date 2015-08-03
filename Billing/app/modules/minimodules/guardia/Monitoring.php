<?php 
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
                                            <th>Nombre del Servicio</th>
											<th>Detalle del servicio</th>
											<th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
$result = odbc_exec($conexión," select *
								FROM    
								OPENQUERY([192.168.3.11], 'EXEC WauReports.dbo.[GetMonitorService]')");
  while ($r= odbc_fetch_object($result)){
      $body = $body. "<tr><td>";
      if(strlen($r->name)>30){
      	$body = $body. substr($r->name,0,30)."</td><td >".$r->current_message;
      }else{
      	$body = $body.$r->name."</td><td >".$r->current_message;
      }
      $body = $body. "</td><td>
						<span class=\"label-default label label-danger\">Error</span>
					</td></tr>";
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

echo $body;

?>