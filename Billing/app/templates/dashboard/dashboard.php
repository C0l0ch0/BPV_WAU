<?php include(TEMPLATE.DS.'header.php');?>
<body>
	<?php include(TEMPLATE.DS.'top.php');?>
		
		<?php include(TEMPLATE.DS.'menu.php');?>
		
		<!--********************************* begin #content ********************************************************************-->
		<div id="content" class="content">			
			<div class="row">
                <div  id="ActiveMQ" ></div><br></br>
            </div>
			<div class="row">
                
			    <div  id="DavidMod" ></div>
			    <!-- #modal-dialog -->
				<div class="modal fade" id="modal-dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title">Detalle de Alarmas.</h4>
							</div>
							<div class="modal-body" id="alerta">
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
<script>
var refreshId = setInterval(function()
{
    var dir = "getDavidInfo2";
     $('#DavidMod').fadeOut("slow").load(dir).fadeIn("slow");
}, 40000);
var refreshId2 = setInterval(function()
{
    var dir = "getActiveMQInfo";
     $('#ActiveMQ').fadeOut("slow").load(dir).fadeIn("slow");
}, 40000);
</script>
<script>
$( document ).ready(function() {
    dir = "getDavidInfo2";
    $('#DavidMod').fadeOut("slow").load(dir).fadeIn("slow");
    dir = "getActiveMQInfo";
    $('#ActiveMQ').fadeOut("slow").load(dir).fadeIn("slow");
});
</script>
<script>
function clickButton(valor)
  {
    var resultado = "";
    switch (valor){
        case 1:
            var div = document.getElementById('alerta');
            div.innerHTML ="";
            $.get("getTXRX",function(data){
                resultado = data;
                div.innerHTML = data;
            });
            break;
        case 2:
            var div = document.getElementById('alerta');
            div.innerHTML ="";
            $.get("getGateway",function(data){
                resultado = data;
                div.innerHTML = data;
            });
            break;
        case 3:
            var div = document.getElementById('alerta');
            div.innerHTML ="";
            $.get("getBD",function(data){
                resultado = data;
                div.innerHTML = data;
            });
            break;
        case 4:
            var div = document.getElementById('alerta');
            div.innerHTML ="<h4>Cargando la información solicitada......</h4>";
            $.get("getServers",function(data){
                resultado = data;
                div.innerHTML = data;
            });
            break;
        case 5:
            var div = document.getElementById('alerta');
            div.innerHTML ="<h4>Cargando la información solicitada......</h4>";
            $.get("getServiocios",function(data){
                resultado = data;
                div.innerHTML = data;
            });
            break;
        case 6:
            var div = document.getElementById('alerta');
            div.innerHTML ="<h4>Cargando la información solicitada......</h4>";
            $.get("getKeyTransactions",function(data){
                resultado = data;
                div.innerHTML = data;
            });
            break;
        case 7:
            var div = document.getElementById('alerta');
            div.innerHTML ="<h4>Cargando la información solicitada......</h4>";
            $.get("getMonitoring",function(data){
                resultado = data;
                div.innerHTML = data;
            });
            break;
    }
  }
</script>