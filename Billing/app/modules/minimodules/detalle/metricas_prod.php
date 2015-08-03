<?php


if (isset($_POST['combo1'])){
  if(isset($integrador)){
    //echo "test->".$integrador . " ".$_POST['combo1']." " ;
    
  }else{
    $integrador = $_POST['combo1'];
    $producto = 0;
    if(isset($_POST['combo2'])){
      if($integrador == $_POST['combo1']){
        $producto = $_POST['combo2'];
        //echo $producto."PP \n";
      }else{
        $integrador = $_POST['combo1'];
        $producto = 0;
      } 
    }
  }  
}else{
  $integrador = 0;
  $producto = 0;
}


  	if(($integrador!=0)&&($producto != 0)){
      unset($_POST['combo2']);
      unset($_POST['combo1']);
      $data1 = getData($name1,$name1,$integrador,$producto);
    }else{
      $data1 = '';
    }
  	
    function getData($name,$nombre1,$integrador,$producto){
    	$dataArray = "";

		$fecha = date('H');
		$dia = date('d', (strtotime ("+1 day")));
    	try{
			$conexion 		= 	new MySQL(0);
			$query0 		= 	'	select hour(date_add(NOW(), INTERVAL -'.HOURDB.' hour));';
			$result0 		= 	$conexion->consulta($query0);
			$exec0			= 	$conexion->fetch_row($result0);
			$fecha 			= 	$exec0[0];

			$query 			= 	'CALL GetProductChargeToday("'.strtolower($name).'",'.HOURDB.",".$integrador.','.$producto.');';
			$result 		= 	$conexion->consulta($query);
			$conexion->prepareNextResult();

			$query1 		= 	'CALL GetProductChargeYesterday("'.strtolower($name).'",'.HOURDB.",".$integrador.','.$producto.');';
			$result1 		= 	$conexion->consulta($query1);
			$conexion->prepareNextResult();

			$query2 		= 	'CALL GetProductChargeProm("'.strtolower($name).'",'.HOURDB.",".$integrador.','.$producto.');';
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
