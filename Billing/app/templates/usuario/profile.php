<?php include(TEMPLATE.DS.'header.php');?>
<body>
	<?php include(TEMPLATE.DS.'top.php');?>
		
		<?php include(TEMPLATE.DS.'menu.php');?>
		
		<!--********************************* begin #content ********************************************************************-->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">

			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Servicios <small>Detalle de servicios alarmados para Legacy y David</small></h1>
			<!-- end page-header -->
			<div class="row">
			    <div  id="DavidMod"></div>
			    <!-- #modal-dialog -->
				<div class="modal fade" id="modal-dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title">Detalle de Alarmas.</h4>
							</div>
							<div class="modal-body" id="alerta">
								todavia no esta mongol!!!!
								ya eran las 2am
								sigo al rato,
								fin del mensaje.....
								pd: chupela XD
							</div>
							<div class="modal-footer">
								<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
							</div>
						</div>
					</div>
				</div>
			</div>		    
		</div>
		<!--********************************* end #content ********************************************************************-->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	<script src="<?=WEBROOT.DS;?>js/ui-modal-notification.demo.min.js"></script>
</body>
</html>
<script src="<?=WEBROOT.DS;?>js/dashboard-v2.js"></script>
<?php include(TEMPLATE.DS.'footer.php');?>
<script>
		$(document).ready(function() {
			App.init();
			Notification.init();
			TableManageDefault.init();
            var name = "<?php echo $_SESSION['login'];?>";
			<?php if(isset($_SESSION['start'])){
                    unset($_SESSION['start']);
            ?>
            DashboardV2.init(name);
            <?php }?>

		});
</script>