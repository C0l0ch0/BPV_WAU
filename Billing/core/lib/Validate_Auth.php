<?php 

	//include_once("paths.php");
	//require_once('../core/import.php');
	import::load('lib', 'MySQL');
	import::load('lib', 'Session');

	class Validate_Auth{
	
		public static function start(){
			Session::start();
		}
		
		public static function logout(){
			$conexion = new MySQL(0);

			$query = "update usuario set logged = 0, date_logged = now(), session_id = '' where usuario = '".$_SESSION['login']."';";
			$result1= $conexion->consulta($query);
			$conexion->MySQLClose();
			Session::destroy();
		}
		
		public static function check(){
			$session = Session::get("login");
			if($session!=false){
				$conexion = new MySQL(0);
				$query = "select logged, date_logged,now() as fe from usuario where usuario = '".$_SESSION["login"]."';";
				$result1= $conexion->consulta($query);
				$row= $conexion->fetch_row($result1);
				$valor=$conexion->num_rows($result1);
				if ($valor==1){
					$fechaGuardada = $row[1];
					$ahora = $row[2];
    				$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
    				if($tiempo_transcurrido >= 875) { //7200 2H
    					self::logout();
    					return false;
    				}else{
    					$query = "update usuario set date_logged = now() where usuario = '".$_SESSION["login"]."'";
						$result1= $conexion->consulta($query);
      					return True;
    				}
				}else{
					return false;
				}
			}else{
				return false;
			}
			$conexion->MySQLClose();
		}
		public static function login($name, $pass){
			$conexion = new MySQL(0);
			$result = $conexion->start($name);

			$query = "select id_rol,id_pais from usuario where usuario = '$name'";
			$result1= $conexion->consulta($query);
			$row= $conexion->fetch_row($result1);
			
			$value = $row[0];
			$value2 = $row[1];
			echo $result[0]. " ".$result[1];
			//$result[0] == $name
			if($result[0]==$pass and $result[1]== 'Activo'){//$pass
				$query = "update usuario set logged = 1, date_logged = now(), session_id = '".$_SESSION['sid']."_".$name."' where usuario = '$name'";
				$result1= $conexion->consulta($query);
				$conexion->MySQLClose();
				Session::load("login.".$name,$value,$value2);//esto lo puedo cambiar(metodo)
				return true;
			}else{
				//Session::destroy();
				$conexion->MySQLClose();
				return false;
			}
		}
		public static function getlogged($name){
			$conexion = new MySQL(0);
			$query = "select logged, date_logged,session_id,now() as fe from usuario where usuario = '$name'";
			$result1= $conexion->consulta($query);
			$valor=$conexion->num_rows($result1);
			if ($valor==1){
				$row= $conexion->fetch_row($result1);
				$value1 = $row[0];
				$value2 = $row[1];
				$value3 = $row[2];
				$ahora = $row[3];
    			$tiempo_transcurrido = (strtotime($ahora)-strtotime($value2));
    			if($tiempo_transcurrido >= 875) {
    				$query = "update usuario set logged = 0, date_logged = now() where usuario = '$name';";
					$result1= $conexion->consulta($query);
					$value1 = 0;
    			}else{
    				if(isset($_COOKIE['billing'])){
    					if($_COOKIE['billing'] == $value3){
    						$query = "update usuario set logged = 0, date_logged = now(),session_id = '' where usuario = '$name';";
							$result1= $conexion->consulta($query);
							setcookie('billing', null, -1, '/');
							$value1 = 0;
    					}
    				}else{
    					if($value1 != 0){
    						$value1 = 1;
    					}
    				}
    			}
    			if ($value1 == 1){
					$return = "islogged";
				}else{
					$return = "notlogged";
				}
				$conexion->MySQLClose();
				return $return;
			}else{
				$conexion->MySQLClose();
				return "not.found";
			}
		}
	}

?>
