<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/core/import.php');
	import::load('lib', 'Validate_Auth');
	import::load('core', 'Start_page');
	import::load('lib', 'Session');
	import::load('lib', 'MySQL');
	import::load('lib', 'view');

	class Usuario{

		function __construct(){
			$this->titulo = 'Billing Vas Pass';
			$this->mensaje = '';
		}

		function start($mensaje){
			if(self::check()){
				if($_SESSION['access'] == 1){ 
					$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
					self::LoadTemplate("usuario/usuario.php",$data);
				}else{
					$_SESSION['value'] = 'Acceso denegado';
					session_write_close();
					exit(header( 'Location: http://'.URL.DS.'dashboard'.DS.'start'));
				}
				
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function edit($mensaje){
			if(self::check()){
				if($_SESSION['access'] == 1){ 
					$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
					self::LoadTemplate("usuario/editar.php",$data);
				}else{
					$_SESSION['value'] = 'Acceso denegado';
					session_write_close();
					exit(header( 'Location: http://'.URL.DS.'dashboard'.DS.'start'));
				}
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function delete($mensaje){
			if(self::check()){
				if($_SESSION['access'] == 1){
					$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
					self::LoadTemplate("usuario/baja.php",$data);
				}else{
					$_SESSION['value'] = 'Acceso denegado';
					session_write_close();
					exit(header( 'Location: http://'.URL.DS.'dashboard'.DS.'start'));
				}
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function profile($mensaje){
			if(self::check()){
			$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
			self::LoadTemplate("login/profile.php",$data);
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function save(){
			if( (isset($_POST["User"])) and (isset($_POST["pass"])) and (isset($_POST["email"])) and (isset($_POST["selector"])) and (isset($_POST["nombre"])) 
				and ($_POST["User"] != '') and ($_POST["pass"] != '')  and ($_POST["email"] != '') and ($_POST["selector"] != '') and ($_POST["nombre"] != '') ){

					$conexion = new MySQL(0);

					$strIngreso = "select usuario from usuario where usuario = '".$_POST["User"]."';";
					$value1 = $conexion->consulta($strIngreso);
					$cant = $conexion->num_rows($value1);
					if ($cant==0){
						$strIngreso = "	insert into usuario (usuario, pass, fecha, estatus, id_rol,nombre, email) 
										values('".$_POST["User"]."','".$_POST["pass"]."',now(),'Activo',".$_POST["selector"].",'".$_POST["nombre"]."','".$_POST["email"]."');" ;
						$value = $conexion->consulta($strIngreso);
						$conexion->MySQLClose();
						$_SESSION['value'] = 'Usuario creado exitosamente.';
						session_write_close();
						exit(header( 'Location: http://'.URL.DS.'dashboard'.DS.'start'));
					}else{
						//self::start('error2');
						$_SESSION['value'] = "error2";
						session_write_close();
						exit(header( 'Location: http://'.URL.DS.'usuario'.DS.'start'));
					}
			}else{
				//self::start('error');
				$_SESSION['value'] = "error";
				session_write_close();
				exit(header( 'Location: http://'.URL.DS.'usuario'.DS.'start'));
			}
		}
		function save1(){
			if( (isset($_POST["pass"])) and (isset($_POST["pass1"])) and (isset($_POST["pass2"])) and ($_POST["pass"] != '') and ($_POST["pass1"] != '') and ($_POST["pass2"] != '')){
				if ($_POST["pass"]===$_POST["pass1"]){
					$conexion = new MySQL(0);
					$p = $_POST["pass"];
					$strIngreso = "select pass from usuario where usuario = '".$_SESSION["login"]."';";
					$value1 = $conexion->consulta($strIngreso);
					$cant = $conexion->fetch_array($value1);

					if (($_POST["pass"] != $cant[0]) and ($_POST["pass2"] === $cant[0])) {
						

						$strIngreso = "update usuario set pass = '$p' where usuario = '".$_SESSION["login"]."';";
				
						$value1 = $conexion->consulta($strIngreso);

						$_SESSION['value'] = 'Contraseña actualizada exitosamente.';
						session_write_close();
						exit(header( 'Location: http://'.URL.DS.'dashboard'.DS.'start'));
					}else{
						$_SESSION['value'] = "error3";
						session_write_close();
						exit(header( 'Location: http://'.URL.DS.'usuario'.DS.'profile'));
					}
					
				}else{
					$_SESSION['value'] = "error2";
					session_write_close();
					exit(header( 'Location: http://'.URL.DS.'usuario'.DS.'profile'));
				}
			}else{
				$_SESSION['value'] = "error";
				session_write_close();
				exit(header( 'Location: http://'.URL.DS.'usuario'.DS.'profile'));
			}
		}
		function refresh(){
			if( (isset($_POST["User"])) and (isset($_POST["pass"])) and (isset($_POST["email"])) and (isset($_POST["selector"])) and (isset($_POST["nombre"])) 
				and ($_POST["User"] != '') and ($_POST["pass"] != '')  and ($_POST["email"] != '') and ($_POST["selector"] != '') and ($_POST["nombre"] != '') ){
					$conexion = new MySQL(0);
					$value = $conexion->consulta("select * from rol where usuario ='".$_POST["selector"]."';");
					$row= $conexion->fetch_array($value);
					$strIngreso = '	update usuario 
									set usuario = "'.$_POST["User"].'", pass ="'.$_POST["pass"].'",
									estatus="'.$_POST["selector3"].'", id_rol='.$row['ID_Rol'].',
									nombre ="'.$_POST["nombre"].'",email="'.$_POST["email"].'"
									where Id_usuario = "'.$_POST["usuario"].'";' ;
					$value1 = $conexion->consulta($strIngreso);
					$conexion->MySQLClose();
					$_SESSION['value'] = 'Usuario actualizado exitosamente.';
					session_write_close();
					exit(header( 'Location: http://'.URL.DS.'dashboard'.DS.'start'));
			}else{
				$_SESSION['value'] = "error";
				session_write_close();
				exit(header( 'Location: http://'.URL.DS.'usuario'.DS.'edit'));
			}	
		}
		function disable(){
			if ((isset($_POST["usuario"])) and ($_POST["usuario"] != '')){
				$conexion = new MySQL(0);
				$strIngreso = "update usuario set estatus = 'Baja' where Id_usuario = '".$_POST["usuario"]."';" ;
				$value = $conexion->consulta($strIngreso);
				$conexion->MySQLClose();
				$_SESSION['value'] = 'El usuario fue dado de baja.';
				session_write_close();
				exit(header( 'Location: http://'.URL.DS.'dashboard'.DS.'start'));
			}else{
				$_SESSION['value'] = "error";
				session_write_close();
				exit(header( 'Location: http://'.URL.DS.'usuario'.DS.'delete'));
			}
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