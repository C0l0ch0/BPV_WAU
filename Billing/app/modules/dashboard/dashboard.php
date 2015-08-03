<?php
	import::load('lib', 'Validate_Auth');
	import::load('lib', 'Start_Page');
	import::load('lib', 'Session');
	import::load('lib', 'MySQL');
	import::load('lib', 'view');

	class dashboard{

		function __construct(){
			$this->titulo = 'Billing Vas Pass';
			$this->mensaje = '';
		}

		function start($mensaje){
			if(self::check()){
				$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
				//self::LoadTemplate("dashboard/dash.php",$data);
				self::LoadTemplate("dashboard/dashboard.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function metricas($mensaje){
			if(self::check()){
				$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
				//self::LoadTemplate("dashboard/dash.php",$data);
				self::LoadTemplate("dashboard/dashboardMetricas.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		
			function notificaciones($mensaje){
			if(self::check()){
				$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
				//self::LoadTemplate("dashboard/dash.php",$data);
				self::LoadTemplate("dashboard/notificaciones.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}					
		
		
		function start2($mensaje){
			if(self::check()){
				$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
				self::LoadTemplate("dashboard/dashboardTest.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function content($mensaje){
			if(self::check()){
				$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
				//self::LoadTemplate("dashboard/dash.php",$data);
				self::LoadTemplate("dashboard/content.php",$data);
				//require_once TEMPLATE.DS."dashboard/dashboard.php"; 
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function getLegacyInfo(){
			include(MINMODULES.DS.'guardia/guardiaL2.php');
		}
		function getDavidInfo2(){
			include(MINMODULES.DS.'dashboard/guardia.php');
		}
		function getActiveMQInfo(){
			include(MINMODULES.DS.'dashboard/ActiveMQ.php');
		}
		function getTXRX(){
			include(MINMODULES.DS.'guardia/TX_RX.php');
		}
		function getGateway(){
			include(MINMODULES.DS.'guardia/Gateway.php');
		}
		function getBD(){
			include(MINMODULES.DS.'guardia/BD.php');
		}
		function getServers(){
			include(MINMODULES.DS.'guardia/Servers.php');
		}
		function getServiocios(){
			include(MINMODULES.DS.'guardia/Servicios.php');
		}
		function getMonitoring(){
			include(MINMODULES.DS.'guardia/Monitoring.php');
		}
		function getKeyTransactions(){
			include(MINMODULES.DS.'guardia/KeyTransaction.php');
		}
		function getChargins(){
			include(MINMODULES.DS.'guardia/Chargins.php');
		}
		function getMetricas(){
			include(MINMODULES.DS.'guardia/metricas.php');
		}
		function cobros(){
			include(MINMODULES.DS.'guardia/cobros.php');
		}
		private function check(){
			return Validate_Auth::check();
		}
		private function LoadTemplate($template, $dataArr){
			if (file_exists(TEMPLATE.DS.$template)){
					Validate_Auth::start();
					$view = new view($template);
				if (!empty($dataArr)){
					$view->render($dataArr);
				}else{
					$tempArr = array('NO' => 'DATA');
					$view->render($tempArr);
				}
			}else{
				echo 'Error!!! el template al que deseas accesar no existe. ';
				echo $template;
			}
		}


	}

?>
