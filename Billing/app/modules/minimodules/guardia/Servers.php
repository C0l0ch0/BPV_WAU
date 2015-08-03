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
                                            <th>Nombre del Servidor</th>
											<th>CPU</th>
											<th>Disk IO</th>
											<th>Memory</th>
											<th>Fullest disk</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
$curl = curl_init('https://api.newrelic.com/v2/servers.json');

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			"X-Api-Key:7157dea6a415fe0c854831ef8b65f8adcdbd825ca5274e4",
			"Content-Type: application/json")
			);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
$servers = json_decode($resp,true);
curl_close($curl);
$var = 0;
for($i=0;$i<count($servers['servers']);$i++){				
	if (isset($servers['servers'][$i]['health_status'])){
	if ($servers['servers'][$i]['health_status'] != 'green'){
	$var++;
	$body = $body."<tr><td>";
	switch ($servers['servers'][$i]['health_status']) {
		case 'green':
			$body = $body.'<span class="label label-success">'.$servers['servers'][$i]['name'].'</span></td>';
			break;
		case 'orange':
			$body = $body. '<span class="label label-warning">'.$servers['servers'][$i]['name'].'</span></td>';
			break;
		case 'red':
			$body = $body. '<span class="label-default label label-danger">'.$servers['servers'][$i]['name'].'</span></td>';
			break;
		case 'gray':
			$body = $body. '<span class="label-default label">'.$servers['servers'][$i]['name'].'</span></td>';
			break;
	}
	if (isset($servers['servers'][$i]['summary']['cpu'])){
		$body = $body. '<td >';
		$body = $body. $servers['servers'][$i]['summary']['cpu'].'% </td>';
	}else{$body = $body. '<td class="center">N/A</td>';}
	if (isset($servers['servers'][$i]['summary']['memory'])){
		$body = $body. '<td >';
		$body = $body. $servers['servers'][$i]['summary']['memory'].'% </td>';
	}else{$body = $body. '<td >N/A</td>';}
	if (isset($servers['servers'][$i]['summary']['disk_io'])){
		$body = $body. '<td class="center">';
		$body = $body. $servers['servers'][$i]['summary']['disk_io'].'% </td>';
	}else{$body = $body. '<td >N/A</td>';}
	if (isset($servers['servers'][$i]['summary']['fullest_disk'])){
		$body = $body. '<td >';
		$body = $body. $servers['servers'][$i]['summary']['fullest_disk'].'%';
	}else{$body = $body. '<td >N/A';}
		$body = $body. "</td></tr>";
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