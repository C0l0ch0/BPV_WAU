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
$curl = curl_init('https://api.newrelic.com/v2/applications.json');

					curl_setopt($curl, CURLOPT_HTTPHEADER, array(
					        "X-Api-Key:7157dea6a415fe0c854831ef8b65f8adcdbd825ca5274e4",
					        "Content-Type: application/json"
					    )
					);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);


					$resp = curl_exec($curl);
					$applications = json_decode($resp,true);
					curl_close($curl);
					$var = 0;
					for($i=0;$i<count($applications['applications']);$i++){
						
						if($applications['applications'][$i]['health_status'] != 'green'){
						$var++;
						$body = $body. "<tr><td>";
						
						switch ($applications['applications'][$i]['health_status']) {
							case 'green':
								$body = $body. '<span class="label label-success">'.$applications['applications'][$i]['name'].'</span></td>';
								break;
							case 'orange':
								$body = $body. '<span class="label label-warning">'.$applications['applications'][$i]['name'].'</span></td>';
								break;
							case 'red':
								$body = $body. '<span class="label-default label label-danger">'.$applications['applications'][$i]['name'].'</span></td>';
								break;
							case "gray":
								$body = $body. '<span class="label-default label">'.$applications['applications'][$i]['name'].'</span></td>';
								break;
						}

						if (isset($applications['applications'][$i]['application_summary']['response_time'])){
							$body = $body. '<td>';
							$body = $body. $applications['applications'][$i]['application_summary']['response_time'].'ms </td>';
						}else{$body = $body. '<td class="center">N/A</td>';}
						if (isset($applications['applications'][$i]['application_summary']['throughput'])){
							$body = $body. '<td >';
							$body = $body. $applications['applications'][$i]['application_summary']['throughput'].'rpm </td>';
						}else{$body = $body. '<td >N/A</td>';}
						if (isset($applications['applications'][$i]['application_summary']['error_rate'])){
							$body = $body. '<td>';
							$body = $body. $applications['applications'][$i]['application_summary']['error_rate'].'% ';
						}else{$body = $body. '<td >N/A';}
						$body = $body. "</td></tr>";
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