<?php 
$data1 = getData($name1,1);
  function getData($name,$num){
    $dataArray = "";
    $fecha     = date('H', (strtotime ("+1 Hours")));
    $dia       = date('d', (strtotime ("+1 day")));
    try{
		  $conexion   = new MySQL(0);

      $query0     =   ' select hour(date_add(NOW(), INTERVAL -'.HOURDB.' hour));';
      $result0    =   $conexion->consulta($query0);
      $exec0      =   $conexion->fetch_row($result0);
      $fecha      =   $exec0[0];

		  $query      =  'CALL GetCarrierChargeToday("'.strtolower($name).'",'.HOURDB.');';
		  $result     =   $conexion->consulta($query);
      $conexion->prepareNextResult();

		  $query1     =   'CALL GetCarrierChargeYesterday("'.strtolower($name).'",'.HOURDB.');';
      $result1    =   $conexion->consulta($query1);
      $conexion->prepareNextResult();

      $query2     =   'CALL GetCarrierChargeProm("'.strtolower($name).'",'.HOURDB.');';
		  $result2    =   $conexion->consulta($query2);
      $conexion->prepareNextResult();

      if ((! $result) or (! $result1) or (! $result2)){
        throw new Exception ("No se logro obtener informacion de cobros....\n");
      }else{
        $cont   = 0;
        @$hoy   = $conexion->fetch_row($result);
        @$ayer  = $conexion->fetch_row($result1);
        @$prom  = $conexion->fetch_row($result2);

        while ($cont <= $fecha){
            if(($ayer[1] == $cont) and ($ayer[1] != '')){
              @$valor   = $ayer[0];
              @$ayer    = $conexion->fetch_row($result1);
            }else{
              $valor = 0;
            }
            if(($hoy[1] == $cont) and ($hoy[1] != '')){
              @$valor1  = $hoy[0];
              @$hoy     = $conexion->fetch_row($result);
            }else{
              $valor1 = 0;
            }
            if(($prom[1] == $cont) and ($prom[1] != '')){
              @$valor2  = $prom[0];
              @$prom    = $conexion->fetch_row($result2);
            }else{
              $valor2 = 0;
            }
            $dataArray = $dataArray."data".$num.".addRow([".$cont.", ".number_format($valor2,0,'','').", ".$valor." , ".$valor1."]);\n";
            //$dataArray = $dataArray."data1.addRow([".$cont.", ".$valor2.",".$valor.", ".$valor1."]);\n";
            $cont++;
          }

        /*while ($hoy = $conexion->fetch_row($result)){
          if( @$ayer  = $conexion->fetch_row($result1) and
              @$prom1 = $conexion->fetch_row($result2)){
              if($hoy[0]    == ''){$hoy[0]    = 0;}
              if($ayer[0]   == ''){$ayer[0]   = 0;}
              if($prom1[0]  == ''){$prom1[0]  = 0;}
              $dataArray = $dataArray."data".$num.".addRow([".$hoy[1].", ".number_format($prom1[0],0,'','').", ".$ayer[0]." , ".$hoy[0]."]);\n";
          }
        }*/
      }
      $conexion->MySQLClose();
      }catch(Exception $e){
        echo 'Excepcion capturada: ',  $e->getMessage(), "\n";
      }
      return $dataArray;
  }
?>