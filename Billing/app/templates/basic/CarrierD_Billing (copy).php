<!--Begin Grafica CarrierD_Billing-->
<?php
  require_once LIB.DS."MySQL.php";  
  //include(MINMODULES.DS.'detalle/metricas_int.php');
?>

<?php include(TEMPLATE.DS.'header.php');?>
<body>
	<?php include(TEMPLATE.DS.'top.php');?>
	
		
		<?php include(TEMPLATE.DS.'menu.php');?>
		
		<!--********************************* begin #content ********************************************************************-->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb hidden-print pull-right">
				<li><a href="javascript:;">Home</a></li>
				<li class="active">Billing</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header hidden-print">Billing <small>Detalle de cobros...</small></h1>
			<!-- end page-header -->
			
			<!-- begin invoice -->
			<div class="invoice">
                <div class="invoice-company">
                    <span class="pull-right hidden-print">
                    <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success m-b-10"><i class="fa fa-print m-r-5"></i> Print</a>
                    </span>
                    Super Agregador: <?php echo strtoupper($name1);?>
                </div>
                <div class="invoice-header">
                    <div class="invoice-from">
                        <address class="m-t-5 m-b-5">
                            <strong>Wau Movil S.A.</strong><br />
                            Diagonal 6, 12-42, Edificio Design Center Z-10<br />
                            Guatemala/Guatemala<br />
                            Phone: (502) 2503-0000<br />
                        </address>
                    </div>
                    <div class="invoice-date">
                        <small>Billing / <?php echo date("M");?></small>
                        <div class="date m-t-5"><?php echo date('l jS \of F Y');?></div>
                        <div class="invoice-detail">
                            Detalle cobro
                        </div>
                    </div>
                </div>
                <div class="invoice-content">
                    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>Nombre del Integrador</th>
                                    <th style="text-align: right;">Gross</th>
                                    <th style="text-align: right;">Earning</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                	$totalE = 0;
                                	$totalG = 0;
                                	$conexion = new MySQL(0);
                                	$query = '	select name,sum(gross)
												from '.$name1.'_billing
												where created_date = date(date_add(now(), interval -30 hour))
												group by name
												order by sum(gross) desc;';
									$exec = $conexion->consulta($query);
									while ($row2= $conexion->fetch_row($exec)){
										$totalG = $totalG + $row2[1];
										echo "<tr><td> Integrador".strtoupper($row2[0]).'</td><td style="text-align: right;">$'.number_format($row2[1],2,'.','').'</td><td style="text-align: right;">$'.number_format(($row2[1]*0.01349999116),2,'.','')."</td></tr>";
										$totalE = $totalE + ($row2[1]*0.01349999116);
									}
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="invoice-price">
                        <div class="invoice-price-left">
                            <div class="invoice-price-row">
                                <div class="sub-price">
                                    <small>Gross USD</small>
                                    <?php echo "$".number_format($totalG,2,'.','');?>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-price-right">
                            <small>TOTAL Earning</small> <?php echo "$".number_format($totalE,2,'.','');?>
                        </div>
                    </div>
                </div>
                <div class="invoice-note">
                    * Los valores de cobros son referenciales.<br />
                    * El Gross es generado en base a la tarifa sin IVA<br />
                </div>
                <div class="invoice-footer text-muted">
                    <p class="text-center m-b-5">
                        THANK YOU FOR YOUR BUSINESS
                    </p>
                    <p class="text-center">
                        <span class="m-r-10"><i class="fa fa-globe"></i> www.waumovil.com</span>
                        <span class="m-r-10"><i class="fa fa-phone"></i> T:(502) 2503-0000</span>
                        <span class="m-r-10"><i class="fa fa-envelope"></i> noc@waumovil.com</span>
                    </p>
                </div>
            </div>
			<!-- end invoice -->
		</div>
		<!--********************************* end #content ********************************************************************-->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	<?php include(TEMPLATE.DS.'footer.php');?>
	<script src="<?=WEBROOT.DS;?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/masked-input/masked-input.min.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/password-indicator/js/password-indicator.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="<?=WEBROOT.DS;?>plugins/bootstrap-select/bootstrap-select.min.js"></script>


<script>
        $(document).ready(function() {
            App.init();
        });
</script>	
	
	

</body>
</html>