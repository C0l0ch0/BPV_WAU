<?php 
include(TEMPLATE.DS.'header.php');
include(MINMODULES.DS.'dashboard/metricas.php');
// TableMetricas.css
?>
<link href="<?=WEBROOT.DS;?>css/TableMetricas.css" rel="stylesheet" />
<body>
	<?php include(TEMPLATE.DS.'top.php');?>
		
		<?php include(TEMPLATE.DS.'menu.php');?>
		
		<!--********************************* begin #content ********************************************************************-->
		<div id="content" class="content">			
			<!-- begin page-header -->
			<h1 class="page-header">Metricas David <small>Detalle de transacciones por país</small></h1>
			<!-- end page-header -->
			<br></br>
      <center >
        <?php echo $IhaveSomeChargeInfo;?>
      </center>
      <br>
      <br>
			
			<div class="row">
        <?php echo $HtmlCode;?>
			</div>
			
		</div>
		<!--********************************* end #content ********************************************************************-->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
</body>
</html>
<script src="<?=WEBROOT.DS;?>js/dashboard-v2.js"></script>
<?php include(TEMPLATE.DS.'footer.php');?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    <?php echo $JSCode;?>
  }
  $(window).resize(function(){
    drawChart();
  });
</script>
<script>
  $(document).ready(function() {
    App.init();
    <?php 
      $var1 = WEBROOT.DS.'img/users/'.$_SESSION['login'].'.jpg';
      if (file_exists($var1)) {
        $nombreimg = $_SESSION['login'];
        $nombreDisplay = $_SESSION['login'];
      } else {
        $nombreimg = 'default';
        $nombreDisplay = $_SESSION['login'];
      }
    ?>
    var name = "<?php echo $nombreimg; ?>";
    var nameD = "<?php echo $nombreDisplay; ?>";
    <?php 
      if(isset($_SESSION['start'])){
        unset($_SESSION['start']);
    ?>
      DashboardV2.init(name,nameD);
    <?php }?>
		});
	</script>
