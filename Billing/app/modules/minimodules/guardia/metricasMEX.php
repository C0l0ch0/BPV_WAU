<?php
  $name = "SAPER";
  $data = "";
  $data = getData($name,$name);
  //echo getData($name,$name). "<br></br>";
  $name1 = "SAMEX";
  $data1 = "";
  $data1 = getData($name1,$name1);
  //echo getData($name1,$name1);
  $name2 = "SANIC";
  $data2 = "";
  $data2 = getData($name2,$name2);
  $name3 = "SAECU";
  $data3 = "";
  $data3 = getData($name3,$name3);
  $name4 = "SAPAN";
  $data4 = "";
  $data4 = getData($name4,$name4);
  $data5 = "";
  $data5 = getDataTable();
  $data6 = "";
  $data6 = getDataTableSACA();
  //@odbc_close($conexión);
  function getData($name,$nombre1){
    $keyAccess = getAccess();
    $dataArray = "";
    $conexión = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$keyAccess[2];Database=$keyAccess[3];", $keyAccess[0], $keyAccess[1]);
    $result = odbc_exec($conexión,"USE WauReports");
    $result = odbc_exec($conexión,"  select ".$name." ,HORA
                                      from cobros_SA
                                      where FECHA between (GETDATE()-2) and (GETDATE()-1)
                                            and HORA <= DATEPART(HOUR, GETDATE())-1
                                      order by FECHA,HORA");
    $result1 = odbc_exec($conexión,"  select ".$name.",HORA
                                      from cobros_SA
                                      where FECHA between (GETDATE()-1) and (GETDATE())
                                      order by FECHA,HORA");
    while ($r= odbc_fetch_object($result)){
      if(@$r1=odbc_fetch_object($result1){
      if($nombre1 == "SAPER"){
        if($r->$name == ''){$r->$name=0;}
        if($r1->$name == ''){$r1->$name=0;}
        $dataArray = $dataArray."data.addRow([".$r->HORA.", ".$r->$name.", ".$r1->$name."]);\n";
      }
      if($nombre1 == "SAMEX"){
        if($r->$name == ''){$r->$name=0;}
        if($r1->$name == ''){$r1->$name=0;}
        $dataArray = $dataArray."data1.addRow([".$r->HORA.", ".$r->$name.", ".$r1->$name."]);\n";
      }  
      if($nombre1 == "SANIC"){
        if($r->$name == ''){$r->$name=0;}
        if($r1->$name == ''){$r1->$name=0;}
        $dataArray = $dataArray."data2.addRow([".$r->HORA.", ".$r->$name.", ".$r1->$name."]);\n";
      }
      if($nombre1 == "SAECU"){
        if($r->$name == ''){$r->$name=0;}
        if($r1->$name == ''){$r1->$name=0;}
        $dataArray = $dataArray."data3.addRow([".$r->HORA.", ".$r->$name.", ".$r1->$name."]);\n";
      }
      if($nombre1 == "SAPAN"){
        if($r->$name == ''){$r->$name=0;}
        if($r1->$name == ''){$r1->$name=0;}
        $dataArray = $dataArray."data4.addRow([".$r->HORA.", ".$r->$name.", ".$r1->$name."]);\n";
      } 
    }
    }
    return $dataArray;
  }
  function getDataTable(){
    $keyAccess = getAccess();
    $conexion = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$keyAccess[2];Database=$keyAccess[3];", $keyAccess[0], $keyAccess[1]);
    $result = odbc_exec($conexion,"USE WauReports");
    @$result = odbc_exec($conexion,"EXEC GetChargesSA");
    $r= odbc_fetch_object($result);
    @$result2 = odbc_exec($conexion,"GetpercentageSA");
    if(@$r2= odbc_fetch_object($result2)){
    $body = "<tr><td align=\"center\"> SAMEX </td><td align=\"right\">".number_format($r->SAMEX)."</td><td align=\"right\">".number_format($r2->SAMEX)."</td><td align=\"right\">  ".number_format((($r->SAMEX*100)/$r2->SAMEX));
    $body = $body. "%</td></tr>";
    $body = $body. "<tr><td align=\"center\"> SAPER </td><td align=\"right\">".number_format($r->SAPER)."</td><td align=\"right\">".number_format($r2->SAPER)."</td><td align=\"right\">  ".number_format((($r->SAPER*100)/$r2->SAPER));
    $body = $body. "%</td></tr>";
    $body = $body. "<tr><td align=\"center\"> SAECU </td><td align=\"right\">".number_format($r->SAECU)."</td><td align=\"right\">".number_format($r2->SAECU)."</td><td align=\"right\">  ".number_format((($r->SAECU*100)/$r2->SAECU));
    $body = $body. "%</td></tr>";
    }
    return $body;
  }
  function getDataTableSACA(){
    $keyAccess = getAccess();
    $conexion = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$keyAccess[2];Database=$keyAccess[3];", $keyAccess[0], $keyAccess[1]);
    $result = odbc_exec($conexion,"USE WauReports");
    $result = odbc_exec($conexion,"EXEC GetChargesSA");
    $r= odbc_fetch_object($result);
    $result2 = odbc_exec($conexion,"GetpercentageSA");
    $r2= odbc_fetch_object($result2);
    $body = "<tr><td align=\"center\"> SANIC </td><td align=\"right\">".number_format($r->SANIC)."</td><td align=\"right\">".number_format($r2->SANIC)."</td><td align=\"right\">  ".number_format((($r->SANIC*100)/$r2->SANIC));
    $body = $body. "%</td></tr>";
    $body = $body. "<tr><td align=\"center\"> SAPAN </td><td align=\"right\">".number_format($r->SAPAN)."</td><td align=\"right\">".number_format($r2->SAPAN)."</td><td align=\"right\">  ".number_format((($r->SAPAN*100)/$r2->SAPAN));
    $body = $body. "%</td></tr>";
    return $body;
  }
  function getAccess(){
    $keyAccess = array("openalonzo","wau123","192.168.3.11","WauReports");
    return $keyAccess;
  }
?>

<body>
    <div>
      <div id="SAMEX" style="width: 440px; height: 250px; display:inline-block;"></div>
      <div id="SAPER" style="width: 440px; height: 250px; display:inline-block;"></div>
      <div id="SAECU" style="width: 440px; height: 250px; display:inline-block;"></div>
      <div id="SANIC" style="width: 440px; height: 250px; display:inline-block;"></div>
      <div id="SAPAN" style="width: 440px; height: 250px; display:inline-block;"></div>
    </div>
</body>
<?php //include_once "metricasMEX.php"; ?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      var body = "";
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Hora');
        data.addColumn('number', 'Cobros Ayer');
        data.addColumn('number', 'Cobros Hoy');

        <?php
          echo $data;
        ?>
        var options = {
          title: '<?php echo 'Cobros '.$name;?>',
          hAxis: {title: 'Hora',  titleTextStyle: {color: '#333'}, ticks: data.getDistinctValues(0)},
          vAxis: {minValue: 0},
          pointSize: 5,
          series:{
            0: {color: '#9EABB4'},
            1: {color: '#0fd43a'}
          }
        };
        var formatter = new google.visualization.NumberFormat(
          {negativeColor: 'black', negativeParens: true, pattern: '###,###'});
        var formatterH = new google.visualization.NumberFormat(
          {negativeColor: 'black', negativeParens: true, sufrix: '00', pattern: '##:'});
        formatter.format(data, 1); 
        formatter.format(data, 2); 
        formatterH.format(data, 0); 

        var chart = new google.visualization.AreaChart(document.getElementById('SAPER'));
        google.visualization.events.addListener(chart, 'ready', function () {
          var imgUri = chart.getImageURI();
          body = body+imgUri+"\n";
        });
        chart.draw(data, options);
        /*----------------------*/
        var data1 = new google.visualization.DataTable();
        data1.addColumn('number', 'Hora');
        data1.addColumn('number', 'Cobros Ayer');
        data1.addColumn('number', 'Cobros Hoy');

        <?php
          echo $data1;
        ?>

        var options1 = {
          title: '<?php echo 'Cobros '.$name1;?>',
          hAxis: {title: 'Hora',  titleTextStyle: {color: '#333'}, ticks: data1.getDistinctValues(0)},
          vAxis: {minValue: 0},
          pointSize: 5,
          series:{
            0: {color: '#9EABB4'},
            1: {color: '#0fd43a'}
          }
        };
        var formatter1 = new google.visualization.NumberFormat(
          {negativeColor: 'black', negativeParens: true, pattern: '###,###'});
        formatter1.format(data1, 1); 
        formatter1.format(data1, 2);

        var chart1 = new google.visualization.AreaChart(document.getElementById('SAMEX'));
        google.visualization.events.addListener(chart1, 'ready', function () {
          var imgUri1 = chart1.getImageURI();
          body = body+" <img alt='Embedded Image' src='"+imgUri1+"'/>";
        });
        chart1.draw(data1, options1);
        /*----------------------*/
        var data3 = new google.visualization.DataTable();
        data3.addColumn('number', 'Hora');
        data3.addColumn('number', 'Cobros Ayer');
        data3.addColumn('number', 'Cobros Hoy');
        <?php
          echo $data3;
        ?>
        var options3 = {
          title: '<?php echo 'Cobros '.$name3;?>',
          hAxis: {title: 'Hora',  titleTextStyle: {color: '#333'}, ticks: data3.getDistinctValues(0)},
          vAxis: {minValue: 0},
          pointSize: 5,
          series:{
            0: {color: '#9EABB4'},
            1: {color: '#0fd43a'}
          }
        };
        var formatter3 = new google.visualization.NumberFormat(
          {negativeColor: 'black', negativeParens: true, pattern: '###,###'});
        formatter3.format(data3, 1); 
        formatter3.format(data3, 2);
        var chart3 = new google.visualization.AreaChart(document.getElementById('SAECU'));
        google.visualization.events.addListener(chart3, 'ready', function () {
          var imgUri3 = chart3.getImageURI();
          body = body+" <img alt='Embedded Image' src='"+imgUri3+"'/>";
        });
        chart3.draw(data3, options3);
        /*----------------------*/
        var data2 = new google.visualization.DataTable();
        data2.addColumn('number', 'Hora');
        data2.addColumn('number', 'Cobros Ayer');
        data2.addColumn('number', 'Cobros Hoy');
        <?php
          echo $data2;
        ?>
        var options2 = {
          title: '<?php echo 'Cobros '.$name2;?>',
          hAxis: {title: 'Hora',  titleTextStyle: {color: '#333'}, ticks: data2.getDistinctValues(0)},
          vAxis: {minValue: 0},
          pointSize: 5,
          series:{
            0: {color: '#9EABB4'},
            1: {color: '#0fd43a'}
          }
        };
        var formatter2 = new google.visualization.NumberFormat(
          {negativeColor: 'black', negativeParens: true, pattern: '###,###'});
        formatter2.format(data2, 1); 
        formatter2.format(data2, 2);
        var chart2 = new google.visualization.AreaChart(document.getElementById('SANIC'));
        google.visualization.events.addListener(chart2, 'ready', function () {
          var imgUri2 = chart2.getImageURI();
          body = body+" <img alt='Embedded Image' src='"+imgUri2+"'/>";
        });
        chart2.draw(data2, options2);
        /*----------------------*/
        var data4 = new google.visualization.DataTable();
        data4.addColumn('number', 'Hora');
        data4.addColumn('number', 'Cobros Ayer');
        data4.addColumn('number', 'Cobros Hoy');
        <?php
          echo $data4;
        ?>
        var options4 = {
          title: '<?php echo 'Cobros '.$name4;?>',
          hAxis: {title: 'Hora',  titleTextStyle: {color: '#333'}, ticks: data4.getDistinctValues(0)},
          vAxis: {minValue: 0},
          pointSize: 5,
          series:{
            0: {color: '#9EABB4'},
            1: {color: '#0fd43a'}
          }
        };
        var formatter4 = new google.visualization.NumberFormat(
          {negativeColor: 'black', negativeParens: true, pattern: '###,###'});
        formatter4.format(data4, 1); 
        formatter4.format(data4, 2);
        var chart4 = new google.visualization.AreaChart(document.getElementById('SAPAN'));
        google.visualization.events.addListener(chart4, 'ready', function () {
          var imgUri4 = chart4.getImageURI();
          body = body+" <img alt='Embedded Image' src='"+imgUri4+"'/>";
        });
        chart4.draw(data4, options4);
        console.log(body);
        document.write(body);
      }
    </script>
