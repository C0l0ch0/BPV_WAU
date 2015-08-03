<?php include(TEMPLATE.DS.'header.php');?>
<body>
	<?php include(TEMPLATE.DS.'top.php');?>
		
		<?php include(TEMPLATE.DS.'menu.php');?>
		
		<!--********************************* begin #content ********************************************************************-->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Registro de nuevo Pais<small></small></h1>
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
							<div class="modal-footer">
								<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- begin col-6 -->
			    			<div class="col-md-12">
			        		<!-- begin panel -->
                    			<div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        			<div class="panel-heading">
                            			<div class="panel-heading-btn">
                            			</div>
                            		<h4 class="panel-title">Creacion de usuarios</h4>
                        			</div>
                        			<div class="panel-body">
                            			<form class="form-horizontal form-bordered" data-parsley-validate="true" name="demo-form">
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4" for="fullname">Nombre * :</label>
												<div class="col-md-6 col-sm-6">
													<input class="form-control" type="text" id="fullname" name="fullname" placeholder="Required" data-parsley-required="true" />
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4" for="website">Website :</label>
												<div class="col-md-6 col-sm-6">
													<input class="form-control" type="url" id="website" name="website" data-parsley-type="url" placeholder="url" />
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4" for="email">Email * :</label>
												<div class="col-md-6 col-sm-6">
													<input class="form-control" type="text" id="email" name="email" data-parsley-type="email" placeholder="Email" data-parsley-required="true" />
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4" for="message">Message (20 chars min, 200 max) :</label>
												<div class="col-md-6 col-sm-6">
													<textarea class="form-control" id="message" name="message" rows="4" data-parsley-range="[20,200]" placeholder="Range from 20 - 200"></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4" for="message">Digits :</label>
												<div class="col-md-6 col-sm-6">
													<input class="form-control" type="text" id="digits" name="digits" data-parsley-type="digits" placeholder="Digits" />
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4" for="message">Number :</label>
												<div class="col-md-6 col-sm-6">
													<input class="form-control" type="text" id="number" name="number" data-parsley-type="number" placeholder="Number" />
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4" for="message">Phone :</label>
												<div class="col-md-6 col-sm-6">
													<input class="form-control" type="text" id="data-phone" data-parsley-type="number" placeholder="(XXX) XXXX XXX" />
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-4 col-sm-4"></label>
												<div class="col-md-6 col-sm-6">
													<button type="submit" class="btn btn-primary">Submit</button>
												</div>
											</div>
                            			</form>
                        			</div>
                    			</div>
                    			<!-- end panel -->
                			</div>
                			<!-- end col-6 -->		    
		</div>
		<!--********************************* end #content ********************************************************************-->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	<script src="<?=ROOT.DS;?>js/ui-modal-notification.demo.min.js"></script>
</body>
</html>
<script src="<?=ROOT.DS;?>js/dashboard-v2.js"></script>
<?php include(TEMPLATE.DS.'footer.php');?>
<script>
		$(document).ready(function() {
			App.init();
			TableManageDefault.init();
		});
	</script>

