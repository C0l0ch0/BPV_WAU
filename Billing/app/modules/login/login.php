<?php
	
	import::load('lib', 'Validate_Auth');
	import::load('lib', 'Start_Page');
	import::load('lib', 'Session');
	import::load('lib', 'MySQL');
	import::load('lib', 'view');

	class Login{

		function __construct(){
			$this->titulo = 'Billing Vas Pass';
			$this->mensaje = '';
		}

		function start($mensaje){
			if(self::check()){
				exit(header( 'Location: '.self::GoHome()));
				//exit(header( 'Location: '.$_SESSION['home']));
			}else{
				$data = array("Titulo" => "Billing Vas-Pass", "mensaje" => $mensaje);
				self::LoadTemplate("login/login.php",$data);
			}
		}
		function Error404($mensaje){
			if(self::check()){
				exit(header( 'Location: http://'.URL.DS.'dashboard'.DS.'start'));
			}else{
				$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
				self::LoadTemplate("404/404.php",$data);
			}
		}

		function check(){
			return Validate_Auth::check();
		}
		function enter(){
			import::load('lib', 'Validar');
		}
		function login($user,$pass){
			return Validate_Auth::login($user, $pass);
		}
		function logout(){
			Validate_Auth::logout();
			exit(header( 'Location: http://'.URL.DS));
		}
		function islogged($user){
			return Validate_Auth::getlogged($user);	
		}
		function GoHome(){
			$conexion = new MySQL(0);
				$query = 'call GetHomeURL('.$_SESSION['pais'].');';
				$result1 = $conexion->consulta($query);
				$row = $conexion->fetch_row($result1);
				$conexion->MySQLClose();

				switch ($_SESSION['access']) {
					case 1:
					case 2:
					case 3:
						$home = 'http://'.URL.DS.'dashboard'.DS.'metricas';
						break;
					default:
						$home = 'http://'.URL.DS.$row[0];
						break;
				}
			return $home;
		}
		function LoadTemplate($template, $dataArr){
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