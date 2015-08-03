<html lang="en">
<head>
  
  <!-- start: Meta -->
  <meta charset="utf-8">
  <title>Cobros DAVID</title>
  <meta name="description" content="Bootstrap Metro Dashboard">
  <meta name="author" content="Dennis Ji">
  <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <!-- end: Meta -->
  
  <!-- start: Mobile Specific -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- end: Mobile Specific -->
  
  <!-- start: CSS -->
  <link id="bootstrap-style" href="<?=MODULE.DS;?>minimodules/guardia/PETARDO/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=MODULE.DS;?>minimodules/guardia/PETARDO/css/bootstrap-responsive.min.css" rel="stylesheet">
  <link id="base-style" href="<?=MODULE.DS;?>minimodules/guardia/PETARDO/css/style.css" rel="stylesheet">
  <link id="base-style-responsive" href="<?=MODULE.DS;?>minimodules/guardia/PETARDO/css/style-responsive.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
  <!-- end: CSS -->
  

  <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link id="ie-style" href="css/ie.css" rel="stylesheet">
  <![endif]-->
  
  <!--[if IE 9]>
    <link id="ie9style" href="css/ie9.css" rel="stylesheet">
  <![endif]-->
    
  <!-- start: Favicon -->
  <link rel="shortcut icon" href="<?=MODULE.DS;?>minimodules/guardia/PETARDO/img/favicon.ico">
  <!-- end: Favicon -->
  
    
    
    
</head>
<?php
  $name = "SAPER";
  $data = "";
  $data = $data.getData($name,$name);
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
    try{
    $conexión = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$keyAccess[2];Database=$keyAccess[3];", $keyAccess[0], $keyAccess[1]);
    $result = odbc_exec($conexión,"USE WauReports");
    @$result = odbc_exec($conexión,"  select ".$name." ,HORA
                                      from cobros_SA
                                      where FECHA between (GETDATE()-2) and (GETDATE()-1)
                                            and HORA <= DATEPART(HOUR, GETDATE())-1
                                      order by FECHA,HORA");
    @$result1 = odbc_exec($conexión,"  select ".$name.",HORA
                                      from cobros_SA
                                      where FECHA between (GETDATE()-1) and (GETDATE())
                                      order by FECHA,HORA");
    @$result2 = odbc_exec($conexión,"select ".$name." ,HORA
                                      from cobros_SA
                                      where FECHA between (GETDATE()-8) and (GETDATE()-7)
                                            and HORA <= DATEPART(HOUR, GETDATE())-1
                                      order by FECHA,HORA");
    @$result3 = odbc_exec($conexión,"select ".$name." ,HORA
                                      from cobros_SA
                                      where FECHA between (GETDATE()-15) and (GETDATE()-14)
                                            and HORA <= DATEPART(HOUR, GETDATE())-1
                                      order by FECHA,HORA");
    if ((! $result) or (! $result1) or (! $result2) or (! $result3)){
      throw new Exception ("No se logro obtener informacion de cobros....\n");
    }else{
    while ($r= odbc_fetch_object($result)){
      $r1=odbc_fetch_object($result1);
      $r2=odbc_fetch_object($result2);
      $r3=odbc_fetch_object($result3);
      if($nombre1 == "SAPER"){
        if($r->$name == ''){$r->$name=0;}
        if($r1->$name == ''){$r1->$name=0;}
        if($r2->$name == ''){$r2->$name=0;}
        if($r3->$name == ''){$r3->$name=0;}
        $dataArray = $dataArray."data.addRow([".$r->HORA.", ".(($r2->$name+$r3->$name)/2).", ".$r->$name." , ".$r1->$name."]);\n";
      }
      if($nombre1 == "SAMEX"){
        if($r->$name == ''){$r->$name=0;}
        if($r1->$name == ''){$r1->$name=0;}
        if($r2->$name == ''){$r2->$name=0;}
        $dataArray = $dataArray."data1.addRow([".$r->HORA.", ".(($r2->$name+$r3->$name)/2).", ".$r->$name." , ".$r1->$name."]);\n";
      }  
      if($nombre1 == "SANIC"){
        if($r->$name == ''){$r->$name=0;}
        if($r1->$name == ''){$r1->$name=0;}
        if($r2->$name == ''){$r2->$name=0;}
        $dataArray = $dataArray."data2.addRow([".$r->HORA.", ".(($r2->$name+$r3->$name)/2).", ".$r->$name." , ".$r1->$name."]);\n";
      }
      if($nombre1 == "SAECU"){
        if($r->$name == ''){$r->$name=0;}
        if($r1->$name == ''){$r1->$name=0;}
        if($r2->$name == ''){$r2->$name=0;}
        $dataArray = $dataArray."data3.addRow([".$r->HORA.", ".(($r2->$name+$r3->$name)/2).", ".$r->$name." , ".$r1->$name."]);\n";
      }
      if($nombre1 == "SAPAN"){
        if($r->$name == ''){$r->$name=0;}
        if($r1->$name == ''){$r1->$name=0;}
        if($r2->$name == ''){$r2->$name=0;}
        $dataArray = $dataArray."data4.addRow([".$r->HORA.", ".(($r2->$name+$r3->$name)/2).", ".$r->$name." , ".$r1->$name."]);\n";
      } 
    }
    }
    }catch(Exception $e){
      echo 'Excepcion capturada: ',  $e->getMessage(), "\n";
    }
    return $dataArray;
  }
  function getDataTable(){
    $keyAccess = getAccess();
    $conexion = odbc_connect("Driver={SQL Server Native Client 10.0};Server=$keyAccess[2];Database=$keyAccess[3];", $keyAccess[0], $keyAccess[1]);
    $result = odbc_exec($conexion,"USE WauReports");
    $result = odbc_exec($conexion,"EXEC GetChargesSA");
    $r= odbc_fetch_object($result);
    $result2 = odbc_exec($conexion,"GetpercentageSA");
    $r2= odbc_fetch_object($result2);
    $body = "<tr><td align=\"center\"> SAMEX </td><td align=\"right\">".number_format($r->SAMEX)."</td><td align=\"right\">".number_format($r2->SAMEX)."</td><td align=\"right\">  ".number_format((($r->SAMEX*100)/$r2->SAMEX));
    $body = $body. "%</td></tr>";
    $body = $body. "<tr><td align=\"center\"> SAPER </td><td align=\"right\">".number_format($r->SAPER)."</td><td align=\"right\">".number_format($r2->SAPER)."</td><td align=\"right\">  ".number_format((($r->SAPER*100)/$r2->SAPER));
    $body = $body. "%</td></tr>";
    $body = $body. "<tr><td align=\"center\"> SAECU </td><td align=\"right\">".number_format($r->SAECU)."</td><td align=\"right\">".number_format($r2->SAECU)."</td><td align=\"right\">  ".number_format((($r->SAECU*100)/$r2->SAECU));
    $body = $body. "%</td></tr>";
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
    $body = $body. "<tr><td align=\"center\"> SAPAN </td><td align=\"right\">".number_format($r->SAPAN)."</td><td align=\"right\">".number_format($r2->SAPAN)."</td><td align=\"right\">  "/*.number_format((($r->SAPAN*100)/$r2->SAPAN))*/;
    $body = $body. "%</td></tr>";
    return $body;
  }
  function getAccess(){
    $keyAccess = array("openalonzo","wau123","192.168.3.11","WauReports");
    return $keyAccess;
  }
?>
<body>
<div class="navbar">
    <div class="navbar-inner">
      <H4>WAU MOVIL COBROS <H4>
      
    </div>
  </div>  
     


<!-- Begin: Content --> 
<br>

    <div style="display:inline-block; align: center; margin-left: 25px;">
  
      <p><?php echo date("F j, Y");?> 
      <?php echo date("H:i:s");?></p>
    </div><br></br>
<style type="text/css">
        
.CSSTableGenerator {
  margin:0px;padding:0px;
  width:30%;
  border:1px solid #bababa;
  
  -moz-border-radius-bottomleft:9px;
  -webkit-border-bottom-left-radius:9px;
  border-bottom-left-radius:9px;
  
  -moz-border-radius-bottomright:9px;
  -webkit-border-bottom-right-radius:9px;
  border-bottom-right-radius:9px;
  
  -moz-border-radius-topright:9px;
  -webkit-border-top-right-radius:9px;
  border-top-right-radius:9px;
  
  -moz-border-radius-topleft:9px;
  -webkit-border-top-left-radius:9px;
  border-top-left-radius:9px; }
  
  
.CSSTableGenerator table{
    border-collapse: collapse;
        border-spacing: 0;
  width:100%;
  height:20%;
  margin:0px;padding:0px;
  
}.CSSTableGenerator tr:last-child td:last-child {
  -moz-border-radius-bottomright:9px;
  -webkit-border-bottom-right-radius:9px;
  border-bottom-right-radius:9px;
}
.CSSTableGenerator table tr:first-child td:first-child {
  -moz-border-radius-topleft:9px;
  -webkit-border-top-left-radius:9px;
  border-top-left-radius:9px;
}
.CSSTableGenerator table tr:first-child td:last-child {
  -moz-border-radius-topright:9px;
  -webkit-border-top-right-radius:9px;
  border-top-right-radius:9px;
  
}.CSSTableGenerator tr:last-child td:first-child{
  -moz-border-radius-bottomleft:9px;
  -webkit-border-bottom-left-radius:9px;
  border-bottom-left-radius:9px;
  
}.CSSTableGenerator tr:hover td{
  
}
.CSSTableGenerator tr:nth-child(odd){ background-color:#e5e5e5; }
.CSSTableGenerator tr:nth-child(even)    { background-color:#ffffff; }


.CSSTableGenerator td{
  vertical-align:middle;  
  border:1px solid #bababa;
  border-width:0px 1px 1px 0px;
  text-align:left;
  padding:8px;
  font-size:13px;
  font-family:Arial;
  font-weight:normal;
  color:#000000;
  
}.CSSTableGenerator tr:last-child td{
  border-width:0px 1px 0px 0px;
  
}.CSSTableGenerator tr td:last-child{
  border-width:0px 0px 1px 0px;
  
}.CSSTableGenerator tr:last-child td:last-child{
  border-width:0px 0px 0px 0px;
}

.CSSTableGenerator tr:first-child td{
    background:-o-linear-gradient(bottom, #cccccc 5%, #777777 100%);  
    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #cccccc), color-stop(1, #777777) );
  background:-moz-linear-gradient( center top, #cccccc 5%, #777777 100% );
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#cccccc", endColorstr="#777777");  background: -o-linear-gradient(top,#cccccc,777777);

  background-color:#cccccc;
  border:0px solid #bababa;
  text-align:center;
  border-width:0px 0px 1px 1px;
  font-size:14px;
  font-family:Trebuchet MS;
  font-weight:bold;
  color:#ffffff;
}
.CSSTableGenerator tr:first-child:hover td{
  background:-o-linear-gradient(bottom, #cccccc 5%, #777777 100%);  
  background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #cccccc), color-stop(1, #777777) );
  background:-moz-linear-gradient( center top, #cccccc 5%, #777777 100% );
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#cccccc", endColorstr="#777777");  background: -o-linear-gradient(top,#cccccc,777777);

  background-color:#cccccc;
}
.CSSTableGenerator tr:first-child td:first-child{
  border-width:0px 0px 1px 0px;
}
.CSSTableGenerator tr:first-child td:last-child{
  border-width:0px 0px 1px 1px;
}

.displayed {
    display: block;
    margin-left: auto;
    margin-right: auto
 float: left; }

</style>
<!--::::::::::::Empieza el otro estilo:::::::::::::::::-->
<style type="text/css">
  
.CSSTableGenerator2 {
  margin:0px;padding:0px;
  width:30%;
  border:1px solid #bababa;
  
  -moz-border-radius-bottomleft:9px;
  -webkit-border-bottom-left-radius:9px;
  border-bottom-left-radius:9px;
  
  -moz-border-radius-bottomright:9px;
  -webkit-border-bottom-right-radius:9px;
  border-bottom-right-radius:9px;
  
  -moz-border-radius-topright:9px;
  -webkit-border-top-right-radius:9px;
  border-top-right-radius:9px;
  
  -moz-border-radius-topleft:9px;
  -webkit-border-top-left-radius:9px;
  border-top-left-radius:9px; }
  
  
.CSSTableGenerator2 table{
    border-collapse: collapse;
        border-spacing: 0;
  width:100%;
  height:15%;
  margin:0px;padding:0px;
  
}.CSSTableGenerator2 tr:last-child td:last-child {
  -moz-border-radius-bottomright:9px;
  -webkit-border-bottom-right-radius:9px;
  border-bottom-right-radius:9px;
}
.CSSTableGenerator2 table tr:first-child td:first-child {
  -moz-border-radius-topleft:9px;
  -webkit-border-top-left-radius:9px;
  border-top-left-radius:9px;
}
.CSSTableGenerator2 table tr:first-child td:last-child {
  -moz-border-radius-topright:9px;
  -webkit-border-top-right-radius:9px;
  border-top-right-radius:9px;
  
}.CSSTableGenerator2 tr:last-child td:first-child{
  -moz-border-radius-bottomleft:9px;
  -webkit-border-bottom-left-radius:9px;
  border-bottom-left-radius:9px;
  
}.CSSTableGenerator2 tr:hover td{
  
}
.CSSTableGenerator2 tr:nth-child(odd){ background-color:#e5e5e5; }
.CSSTableGenerator2 tr:nth-child(even)    { background-color:#ffffff; }


.CSSTableGenerator2 td{
  /*vertical-align:middle;  */
  border:1px solid #bababa;
  border-width:0px 1px 1px 0px;
  text-align:left;
  padding:8px;
  font-size:13px;
  font-family:Arial;
  font-weight:normal;
  color:#000000;
  
}.CSSTableGenerator2 tr:last-child td{
  border-width:0px 1px 0px 0px;
  
}.CSSTableGenerator2 tr td:last-child{
  border-width:0px 0px 1px 0px;
  
}.CSSTableGenerator2 tr:last-child td:last-child{
  border-width:0px 0px 0px 0px;
}

.CSSTableGenerator2 tr:first-child td{
    background:-o-linear-gradient(bottom, #cccccc 5%, #777777 100%);  
    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #cccccc), color-stop(1, #777777) );
  background:-moz-linear-gradient( center top, #cccccc 5%, #777777 100% );
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#cccccc", endColorstr="#777777");  background: -o-linear-gradient(top,#cccccc,777777);

  background-color:#cccccc;
  border:0px solid #bababa;
  text-align:center;
  border-width:0px 0px 1px 1px;
  font-size:14px;
  font-family:Trebuchet MS;
  font-weight:bold;
  color:#ffffff;
}
.CSSTableGenerator2 tr:first-child:hover td{
  background:-o-linear-gradient(bottom, #cccccc 5%, #777777 100%);  
  background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #cccccc), color-stop(1, #777777) );
  background:-moz-linear-gradient( center top, #cccccc 5%, #777777 100% );
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#cccccc", endColorstr="#777777");  background: -o-linear-gradient(top,#cccccc,777777);

  background-color:#cccccc;
}
.CSSTableGenerator2 tr:first-child td:first-child{
  border-width:0px 0px 1px 0px;
}
.CSSTableGenerator2 tr:first-child td:last-child{
  border-width:0px 0px 1px 1px;
  
  
}

displayed {
   
    margin: 0 auto;
  }

    </style>
  
  
  
  

   <center> <div class="CSSTableGenerator" style="display:inline-block;">
    <table >
      <tr>
        <td >Super Agregador</td>
        <td >Cobros Hoy</td>
        <td >Promedio</td>
        <td >Porcentaje</td>
      </tr>
      
        <?php echo $data5;?>
    
    </table>
    </div>

   <div  class="CSSTableGenerator2 " style="display:inline-block; vertical-align: top;">
    <table >
      <tr>
        <td >Super Agregador</td>
        <td >Cobros Hoy</td>
        <td >Promedio</td>
        <td >Porcentaje</td>
      </tr>
      
        <?php echo $data6;?>
    
    </table>
    </div>
   </center> 
             

<br>
<br>


<center><table class="table-responsive">
<tr>
<td>
        <div class="box span4" onTablet="span6" onDesktop="span4">
          <div class="box-header">
            <h2><i class="halflings-icon white check"></i><span class="break"></span>SAMEX</h2>
            <div class="box-icon">
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              
            </div>
          </div>
          <div class="box-content">
              <div id="SAMEX" style="width: 400px; height: 250px; display:inline-block;"></div>
          </div>
        </div><!--/span-->
</td>
<td>
        
            <div class="box span4" onTablet="span6" onDesktop="span4">
          <div class="box-header">
            <h2><i class="halflings-icon white check"></i><span class="break"></span>SAPER</h2>
            <div class="box-icon">
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              
            </div>
          </div>
          <div class="box-content">
            <div id="SAPER" style="width: 400px; height: 250px; display:inline-block;"></div>
          
          </div>
        </div><!--/span-->
</td>
<td>
        
            <div class="box span4" onTablet="span6" onDesktop="span4">
          <div class="box-header">
            <h2><i class="halflings-icon white check"></i><span class="break"></span>SAECU</h2>
            <div class="box-icon">
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              
            </div>
          </div>
          <div class="box-content">
            <div id="SAECU" style="width: 400px; height: 250px; display:inline-block;"></div>
          </div>
        </div><!--/span-->
</td>
</tr>
</table>
</center>   


<center><table class="table-responsive">
<tr>
<td>
        
            <div class="box span4" onTablet="span6" onDesktop="span4">
          <div class="box-header">
            <h2><i class="halflings-icon white check"></i><span class="break"></span>SANIC</h2>
            <div class="box-icon">
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              
            </div>
          </div>
          <div class="box-content">
         <div id="SANIC" style="width: 400px; height: 250px; display:inline-block;"></div>
          </div>
        </div><!--/span-->
</td>       
<td>
        
            <div class="box span4" onTablet="span6" onDesktop="span4">
          <div class="box-header">
            <h2><i class="halflings-icon white check"></i><span class="break"></span>SAPAN</h2>
            <div class="box-icon">
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              
            </div>
          </div>
          <div class="box-content">
        <div id="SAPAN" style="width: 400px; height: 250px; display:inline-block;"></div>
          </div>
        </div><!--/span-->
</td> 
<td>      
        
            <div class="box span4" onTablet="span6" onDesktop="span4">
          <div class="box-header">
            <h2><i class="halflings-icon white check"></i><span class="break"></span>SAGT</h2>
            <div class="box-icon">
              <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
              
            </div>
          </div>
          <div class="box-content">
          <div id="SAPAN" style="width: 400px; height: 250px; display:inline-block;"></div>
          </div>
        </div><!--/span-->
</td>
</tr>
</table>
</center>   
        
        
    <footer>

    <p>
      <span style="text-align:left;float:left">&copy; 2014-2015  <a href="http://192.168.64.54/paseguardia/getmetricas" alt="Bootstrap_Metro_Dashboard">By NOC Wau Movil</a></span>
      
    </p>
  

  </footer>
  

   
<!-- end: Content -->
  
    



          
<!-- start: JavaScript-->

    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery-1.9.1.min.js"></script>
  <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery-migrate-1.0.0.min.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery-ui-1.10.0.custom.min.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.ui.touch-punch.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/modernizr.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/bootstrap.min.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.cookie.js"></script>
  
    <script src='<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/fullcalendar.min.js'></script>
  
    <script src='<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.dataTables.min.js'></script>

    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/excanvas.js"></script>
  <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.flot.js"></script>
  <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.flot.pie.js"></script>
  <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.flot.stack.js"></script>
  <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.flot.resize.min.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.chosen.min.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.uniform.min.js"></script>
    
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.cleditor.min.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.noty.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.elfinder.min.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.raty.min.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.iphone.toggle.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.uploadify-3.1.min.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.gritter.min.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.imagesloaded.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.masonry.min.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.knob.modified.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/jquery.sparkline.min.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/counter.js"></script>
  
    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/retina.js"></script>

    <script src="<?=MODULE.DS;?>minimodules/guardia/PETARDO/js/custom.js"></script>
  <!-- end: JavaScript-->
  
</body>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Hora');
        data.addColumn('number', 'Mismo dia, semana pasada');
        data.addColumn('number', 'Cobros Ayer');
        data.addColumn('number', 'Cobros Hoy');
        
        <?php
          echo $data;
        ?>
/*0fd43a
  01AEBF
  9EABB4
*/
        var options = {
          title: '<?php echo 'Cobros '.$name;?>',
          hAxis: {title: 'Hora',  titleTextStyle: {color: '#333'}, ticks: data.getDistinctValues(0)},
          vAxis: {minValue: 0},
          pointSize: 5,
          series:{
            0: {lineDashStyle: [2, 2]},
            1: {lineDashStyle: [2, 2]}
          },
          colors: ['#9EABB4','#01AEBF','#0fd43a'],
        };
        var formatter = new google.visualization.NumberFormat(
          {negativeColor: 'black', negativeParens: true, pattern: '###,###'});
        var formatterH = new google.visualization.NumberFormat(
          {negativeColor: 'black', negativeParens: true, sufrix: '00', pattern: '##:'});
        formatter.format(data, 1); 
        formatter.format(data, 2); 
        formatterH.format(data, 0); 

        var chart = new google.visualization.AreaChart(document.getElementById('SAPER'));
        /*var my_div = document.getElementById('SAPER');
        google.visualization.events.addListener(chart, 'ready', function () {
          var imgUri = chart.getImageURI();
          my_div.innerHTML = '<img src="' + imgUri + '">';
            // do something with the image URI, like:
          //window.open(imgUri);
        });*/
        chart.draw(data, options);

        /*----------------------*/
        var data1 = new google.visualization.DataTable();
        data1.addColumn('number', 'Hora');
        data1.addColumn('number', 'Mismo dia, semana pasada');
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
            0: {lineDashStyle: [2, 2]},
            1: {lineDashStyle: [2, 2]}
          },
          colors: ['#9EABB4','#01AEBF','#0fd43a'],
        };
        var formatter1 = new google.visualization.NumberFormat(
          {negativeColor: 'black', negativeParens: true, pattern: '###,###'});
        formatter1.format(data1, 1); 
        formatter1.format(data1, 2);

        var chart1 = new google.visualization.AreaChart(document.getElementById('SAMEX'));
        chart1.draw(data1, options1);
        /*----------------------*/
        var data2 = new google.visualization.DataTable();
        data2.addColumn('number', 'Hora');
        data2.addColumn('number', 'Mismo dia, semana pasada');
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
            0: {lineDashStyle: [2, 2]},
            1: {lineDashStyle: [2, 2]}
          },
          colors: ['#9EABB4','#01AEBF','#0fd43a'],
        };
        var formatter2 = new google.visualization.NumberFormat(
          {negativeColor: 'black', negativeParens: true, pattern: '###,###'});
        formatter2.format(data2, 1); 
        formatter2.format(data2, 2);
        var chart2 = new google.visualization.AreaChart(document.getElementById('SANIC'));
        chart2.draw(data2, options2);
        /*----------------------*/
        var data3 = new google.visualization.DataTable();
        data3.addColumn('number', 'Hora');
        data3.addColumn('number', 'Mismo dia, semana pasada');
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
            0: {lineDashStyle: [2, 2]},
            1: {lineDashStyle: [2, 2]}
          },
          colors: ['#9EABB4','#01AEBF','#0fd43a'],
        };
        var formatter3 = new google.visualization.NumberFormat(
          {negativeColor: 'black', negativeParens: true, pattern: '###,###'});
        formatter3.format(data3, 1); 
        formatter3.format(data3, 2);
        var chart3 = new google.visualization.AreaChart(document.getElementById('SAECU'));
        chart3.draw(data3, options3);
        /*----------------------*/
        var data4 = new google.visualization.DataTable();
        data4.addColumn('number', 'Hora');
        data4.addColumn('number', 'Mismo dia, semana pasada');
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
            0: {lineDashStyle: [2, 2]},
            1: {lineDashStyle: [2, 2]}
          },
          colors: ['#9EABB4','#01AEBF','#0fd43a'],
        };
        var formatter4 = new google.visualization.NumberFormat(
          {negativeColor: 'black', negativeParens: true, pattern: '###,###'});
        formatter4.format(data4, 1); 
        formatter4.format(data4, 2);
        var chart4 = new google.visualization.AreaChart(document.getElementById('SAPAN'));
        chart4.draw(data4, options4);
      }
    </script>
</html>

