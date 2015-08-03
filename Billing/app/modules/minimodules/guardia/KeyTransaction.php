<?php
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
                                            <th>Nombre del Servido</th>
											<th>App Server</th>
											<th>Throughput</th>
											<th>Error %</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

$curl = curl_init('https://api.newrelic.com/v2/key_transactions.json');
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
                    if ($servers['key_transactions'][$i]['health_status']=='gray'){
                            
						$body = $body. "<tr><td>";
						$body = $body. '<span class="label-default label label-danger">'.$servers['key_transactions'][$i]['name'].'</span></td>';
						$body = $body. '<td >';
						$body = $body. '0 ms </td>';
						$body = $body. '<td >';
						$body = $body. '0 rpm </td>';
						$body = $body. '<td >';
						$body = $body. '0 % ';
						$body = $body. "</td></tr>";
						$var++;
                        }else{

                            if (($servers['key_transactions'][$i]['application_summary']['error_rate'] > 1)){
						$body = $body. "<tr><td>";
						$body = $body. '<span class="label-default label label-danger">'.$servers['key_transactions'][$i]['name'].'</span></td>';
						$body = $body. '<td >';
						$body = $body. $servers['key_transactions'][$i]['application_summary']['response_time'].'ms </td>';
						$body = $body. '<td >';
						$body = $body. $servers['key_transactions'][$i]['application_summary']['throughput'].'rpm </td>';
						$body = $body. '<td >';
						$body = $body. $servers['key_transactions'][$i]['application_summary']['error_rate'].'% ';
						$body = $body. "</td></tr>";
						$var++;
					}
                        }
					
				}
			}
$body = $body.'</tbody>
		</table>';
if ($var < 1){
						$body = $body. '<tr>	<div align="center">
									<h5>No hay servicios alarmados</h5>
									<ul class="ajax-loaders">
										<li><img src="'.ROOT.DS.'img/ajax-loaders/ajax-loader-9.gif"
											title="img/ajax-loaders/ajax-loader-9.gif"></li>
									</ul>
								</div></tr>';
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