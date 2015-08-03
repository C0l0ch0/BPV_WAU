<div class="box col-md-12">
	<div class="box-inner">
		<div class="box-header well" data-original-title="">
			<h2>Servicios Monitoring</h2>

			<div class="box-icon">
				<a href="#" class="btn btn-minimize btn-round btn-default"><i
					class="glyphicon glyphicon-chevron-up"></i></a>
				<a href="#" class="btn btn-close btn-round btn-default"><i
					class="glyphicon glyphicon-remove"></i></a>
			</div>
		</div>
	<div class="box-content">
		<table class="table table-bordered table-striped table-condensed">
			<thead>
				<tr>
					<th>Titulo</th>
					<th>Fecha</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>

<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/core/import.php');
    import::load('lib', 'MySQL');

    $conexion = new MySQL();
    $strConsulta = "select Titulo, fecha, estado
                    from falla 
                    where estado <>'cerrada'
                    order by fecha desc";
	$consulta = $conexion->consulta($strConsulta);
	while($row2= $conexion->fetch_array($consulta)){ 
		echo "<tr><td>";
		echo $row2[0]."</td><td>".$row2[1]."</td>";
		if($row2[2] == 'Abierta'){
			echo '<td><span class="label label-success">'.$row2[2].'<span>';
		}else{
			echo '<td><span class="label label-warning">'.$row2[2].'<span>';
		}

		echo "</td></tr>";
	}

?>

			</tbody>
		</table>
	</div>
	</div>
</div>