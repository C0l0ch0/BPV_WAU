<?php
if(isset($_POST['combo'])){$integrador=$_POST['combo'];unset($_POST['combo']);}else{$integrador = 0;}
  	$data1 = getData($name1,$name1,$integrador);
  	function getData($name,$nombre1,$integrador){
    	$dataArray = "";

		$fecha = date('H');
		$dia = date('d', (strtotime ("+1 day")));
    	try{
			$conexion 		= 	new MySQL(0);
			$query0 		= 	'	select hour(date_add(NOW(), INTERVAL -'.HOURDB.' hour));';
			$result0 		= 	$conexion->consulta($query0);
			$exec0			= 	$conexion->fetch_row($result0);
			$fecha 			= 	$exec0[0];

			$query 			= 	'CALL GetIntegratorChargeToday("'.strtolower($name).'",'.HOURDB.",".$integrador.');';
			$result 		= 	$conexion->consulta($query);
			$conexion->prepareNextResult();

			$query1 		= 	'CALL GetIntegratorChargeYesterday("'.strtolower($name).'",'.HOURDB.",".$integrador.');';
			$result1 		= 	$conexion->consulta($query1);
			$conexion->prepareNextResult();

			$query2 		= 	'CALL GetIntegratorChargeProm("'.strtolower($name).'",'.HOURDB.",".$integrador.');';
			$result2 		= 	$conexion->consulta($query2);
			$conexion->prepareNextResult();
			if ((! $result) or (! $result1) or (! $result2)){
      			throw new Exception ("No se logro obtener informacion de cobros....\n");
    		}else{
    			$cont=0;
	    		$hoy= $conexion->fetch_row($result);
    			$ayer= $conexion->fetch_row($result1);
				$prom= $conexion->fetch_row($result2);
	    		while ($cont <= $fecha){
    				if($ayer[1] == $cont){
    					$valor = $ayer[0];
    					$ayer= $conexion->fetch_row($result1);
    				}else{
    					$valor = 0;
    				}
    				if($hoy[1] == $cont){
   		 				$valor1 = $hoy[0];
    					$hoy= $conexion->fetch_row($result);
   		 			}else{
    					$valor1 = 0;
    				}
					if($prom[0] == $cont){
    					$valor2 = $prom[1];
    					$prom= $conexion->fetch_row($result2);
    				}else{
    					$valor2 = 0;
    				}
    				$dataArray = $dataArray."data1.addRow([".$cont.", ".$valor2.",".$valor.", ".$valor1."]);\n";
    				$cont++;
    			}
    		}
		$conexion->MySQLClose();
	    }catch(Exception $e){
    	  echo 'Excepcion capturada: ',  $e->getMessage(), "\n";
   		}
    	return $dataArray;
  	}
?>
