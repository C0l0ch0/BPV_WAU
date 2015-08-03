<?php
	import::load('lib', 'Validate_Auth');
	import::load('lib', 'Start_Page');
	import::load('lib', 'Session');
	import::load('lib', 'MySQL');
	import::load('lib', 'view');

	class detalle{

		function __construct(){
			$this->titulo = 'Billing Vas Pass';
			$this->mensaje = '';
		}

		function samex($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("samex",$mensaje);
				self::LoadTemplate("basic/carrierD.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function samexI($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("samex",$mensaje);
				self::LoadTemplate("basic/CarrierD_I.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function samexP($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("samex",$mensaje);
				self::LoadTemplate("basic/CarrierD_P.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function samexDetails($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("samex",$mensaje);
				self::LoadTemplate("basic/CarrierD_P_D.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function BillingSamex($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("samex",$mensaje);
				self::LoadTemplate("basic/CarrierD_Billing.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function notificacionessamex($mensaje){
			if(self::check()){
				$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
				//self::LoadTemplate("dashboard/dash.php",$data);
				self::LoadTemplate("samex/notificacionessamex.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function saper($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("saper",$mensaje);
				self::LoadTemplate("basic/carrierD.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function saperI($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("saper",$mensaje);
				self::LoadTemplate("basic/CarrierD_I.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function saperP($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("saper",$mensaje);
				self::LoadTemplate("basic/CarrierD_P.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function BillingSaper($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("saper",$mensaje);
				self::LoadTemplate("basic/CarrierD_Billing.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function notificacionessaper($mensaje){
			if(self::check()){
				$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
				//self::LoadTemplate("dashboard/dash.php",$data);
				self::LoadTemplate("saper/notificacionessaper.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function saecu($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("saecu",$mensaje);
				self::LoadTemplate("basic/carrierD.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function saecuI($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("saecu",$mensaje);
				self::LoadTemplate("basic/CarrierD_I.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function saecuP($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("saecu",$mensaje);
				self::LoadTemplate("basic/CarrierD_P.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function BillingSaecu($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("saecu",$mensaje);
				self::LoadTemplate("basic/CarrierD_Billing.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function notificacionessaecu($mensaje){
			if(self::check()){
				$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
				//self::LoadTemplate("dashboard/dash.php",$data);
				self::LoadTemplate("saecu/notificacionessaecu.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function sanic($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("sanic",$mensaje);
				self::LoadTemplate("basic/carrierD.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function sanicI($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("sanic",$mensaje);
				self::LoadTemplate("basic/CarrierD_I.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function sanicP($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("sanic",$mensaje);
				self::LoadTemplate("basic/CarrierD_P.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function BillingSanic($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("sanic",$mensaje);
				self::LoadTemplate("basic/CarrierD_Billing.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function sapan($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("sapan",$mensaje);
				self::LoadTemplate("basic/carrierD.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function sapanI($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("sapan",$mensaje);
				self::LoadTemplate("basic/CarrierD_I.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function sapanP($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("sapan",$mensaje);
				self::LoadTemplate("basic/CarrierD_P.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function BillingSapan($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("sapan",$mensaje);
				self::LoadTemplate("basic/CarrierD_Billing.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function saca($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("saca",$mensaje);
				self::LoadTemplate("basic/carrierD.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function sacaI($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("saca",$mensaje);
				self::LoadTemplate("basic/CarrierD_I.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function sacaP($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("saca",$mensaje);
				self::LoadTemplate("basic/CarrierD_P.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function BillingSaca($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("saca",$mensaje);
				self::LoadTemplate("basic/CarrierD_Billing.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function sasal($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("sasal",$mensaje);
				self::LoadTemplate("basic/carrierD.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function sasalI($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("sasal",$mensaje);
				self::LoadTemplate("basic/CarrierD_I.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function sasalP($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("sasal",$mensaje);
				self::LoadTemplate("basic/CarrierD_P.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function BillingSasal($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("sasal",$mensaje);
				self::LoadTemplate("basic/CarrierD_Billing.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function saven($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("saven",$mensaje);
				self::LoadTemplate("basic/carrierD.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function savenI($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("saven",$mensaje);
				self::LoadTemplate("basic/CarrierD_I.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function savenP($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("saven",$mensaje);
				self::LoadTemplate("basic/CarrierD_P.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function BillingSaven($mensaje){
			if(self::check()){
				$data = self::GetArrayInfo("saven",$mensaje);
				self::LoadTemplate("basic/CarrierD_Billing.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function notificacionessaven($mensaje){
			if(self::check()){
				$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
				//self::LoadTemplate("dashboard/dash.php",$data);
				self::LoadTemplate("saven/notificacionessamex.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		private function GetArrayInfo($option,$mensaje){
			$conexion 	= new MySQL(0);
			$query 		= "call GetDescriptionInfo('".$option."');";
			$exec 		= $conexion->consulta($query);
			$row2 		= $conexion->fetch_row($exec);
			$return 	= array(	"Titulo" 	=> "Billing Vas Pass", 
									"mensaje" 	=> $mensaje, 
									"name1" 	=> strtolower($row2[0]),
									"data1" 	=> "",
									"pais" 		=> $row2[1],
									"schema" 	=> $row2[2],
									"bd_id"		=> $row2[3]);
			$conexion->MySQLClose();
			return $return;
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
