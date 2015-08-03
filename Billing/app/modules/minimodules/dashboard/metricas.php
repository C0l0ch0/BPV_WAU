<?php
  /********************************Inicio Llamado de cada grafica******************************/
  /**/$conexion                 =   new MySQL(0);
  /**/$query                    =   'CALL GetGraphList();';
  /**/$result                   =   $conexion->consulta($query);
  /**/$conexion->prepareNextResult();
  /**/$IhaveSomeChargeInfo      =   '';
  /**/$HtmlCode                 =   '';
  /**/$JSCode                   =   '';
  /**/
  /**/if(! $result){
  /**/  throw new Exception ("No se logro obtener informacion de cobros....\n");
  /**/}else{
  /**/  $IhaveSomeChargeInfo  = DrawSomeTables();
  /**/  $contData             =   0;
  /**/  while ($carrier = $conexion->fetch_row($result)){
          $carrierN         =   ($carrier[0] == 'SACA') ? 'SAGUA' : $carrier[0];
  /**/    $dataMericas      =   getData($carrier[0],$contData);
  /**/    $HtmlCode         =   $HtmlCode.getMyHTMLCode($carrierN);
  /**/    $JSCode           =   $JSCode.getMyJSCode($carrierN,$contData,$dataMericas);
  /**/    $contData++;
  /**/  }
  /**/}
  /**///print_r($dataMericas);
  /**/$conexion->MySQLClose();
  /***********************************Fin Llamado de cada grafica******************************/

  function getData($name,$num){
    $dataArray = "";
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
            $dataArray = $dataArray."\t\t\tdata".$num.'.addRow(['.$cont.', '.number_format($valor2,0,'','').', '.$valor.' , '.$valor1.']);'."\n";
            $cont++;
          }
      }
      $conexion->MySQLClose();
      }catch(Exception $e){
        echo 'Excepcion capturada: ',  $e->getMessage(), "\n";
      }
      return $dataArray;
  }
  function getMyHTMLCode($name){
    $HtmlCode     =   '       <!-- begin '.$name.' -->';
    $HtmlCode     =   $HtmlCode.'           <div class="col-md-4">
                    <div class="panel panel-inverse" data-sortable-id="flot-chart-6">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>                               
                            </div>
                            <h4 class="panel-title">'.$name.'</h4>
                        </div>
                        <div class="panel-body">
                            <div id="'.$name.'" class="height-sm"></div>
                        </div>
                    </div>
            </div>';
    return $HtmlCode;
  }
  function getMyJSCode($name,$num,$data){
    $JSCode     = '
                        var data'.$num.' = new google.visualization.DataTable();
                        data'.$num.'.addColumn(\'number\', \'Hora\');
                        data'.$num.'.addColumn(\'number\', \'Promedio\');
                        data'.$num.'.addColumn(\'number\', \'Ayer\');
                        data'.$num.'.addColumn(\'number\', \'Hoy\');
                        '.$data.'
                        var options'.$num.' = {
                                        title: \'Cobro '.$name.'\',
                                        hAxis: {title: \'Hora\',  titleTextStyle: {color: \'#333\'}, ticks: data'.$num.'.getDistinctValues(0)},
                                        vAxis: {minValue: 0},
                                        pointSize: 5,
                                        series:{
                                                0: {lineDashStyle: [2, 2]},
                                                1: {lineDashStyle: [2, 2]}
                                        },
                                        colors: [\'#9EABB4\',\'#01AEBF\',\'#0fd43a\'],
                                        legend: { position: \'top\' },
                                        chartArea:{width:\'70%\',height:\'60%\'}
                                      };
                        var formatter'.$num.' = new google.visualization.NumberFormat(
                                        {negativeColor: \'black\', negativeParens: true, pattern: \'###,###\'});
                        formatter'.$num.'.format(data'.$num.', 1); 
                        formatter'.$num.'.format(data'.$num.', 2); 
                        formatter'.$num.'.format(data'.$num.', 3);
                        var chart'.$num.' = new google.visualization.AreaChart(document.getElementById(\''.$name.'\'));
                        chart'.$num.'.draw(data'.$num.', options'.$num.');';
    return $JSCode;
  }
  function DrawSomeTables(){
    $Table      =   '';
    $conexionD   =   new MySQL(0);

    $query      =   'call GetMaxTable();';
    $exec       =   $conexionD->consulta($query);
    $conexionD->prepareNextResult();
    $resultado  =   $conexionD->fetch_row($exec);
    $numFields  =   $resultado[1];

    $query      =   'call GetDataTable();';
    $exec       =   $conexionD->consulta($query);
    $conexionD->prepareNextResult();

    $tempT2 = $tempT1     =   '
                    <div class="CSSTableGenerator" style="display:inline-block;">
                      <table>
                        <tr>
                          <td >Super Agregador</td>
                          <td >Cobros Hoy</td>
                          <td >Promedio</td>
                          <td >Porcentaje</td>
                        </tr>
                        ';

    while ($row = $conexionD->fetch_row($exec)){
      $nombreC    =   ($row[0] == 'saca') ? 'SAGUA' : $row[0];
      $CantHoy    =   number_format($row[1]);
      $CantProm   =   number_format($row[2]);
      $CantPor    =   ($CantProm == 0) ? 0 : number_format(($CantHoy*100)/$CantProm);
      switch ($row[3]) {
        case 1:
          $tempT1 = $tempT1 .'<tr><td align="center"><a href="http://'.URL.DS.'detalle/'.strtolower($nombreC).'"> '.strtoupper($nombreC).' </a> </td><td align="right">'.$CantHoy.'</td><td align="right">'.$CantProm.'</td><td align="right">'.$CantPor.'%</td></tr>';
          break;
        
        case 2:
          $tempT2 = $tempT2 .'<tr><td align="center"><a href="http://'.URL.DS.'detalle/'.strtolower($nombreC).'"> '.strtoupper($nombreC).' </a> </td><td align="right">'.$CantHoy.'</td><td align="right">'.$CantProm.'</td><td align="right">'.$CantPor.'%</td></tr>';
          break;
      }
    }
    $tempT1 = $tempT1 .'
                      </table>
                    </div>
                    <div style="display:inline-block;"></div>';
    $tempT2 = $tempT2 .'
                      </table>
                    </div>
                    <div style="display:inline-block;"></div>';
    $Table      =   $tempT1.$tempT2;

    return $Table;
  }

?>