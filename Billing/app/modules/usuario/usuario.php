<?php

	import::load('lib', 'MySQL');

	class Usuario{

		function __construct(){
			$this->titulo = 'Billing Vas Pass';
			$this->mensaje = '';
		}

		function start($mensaje){
			if(self::check()){
				if($_SESSION['access'] == 1){ 
					$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
					self::LoadTemplate("usuario/crear.php",$data);
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
			if( (isset($_POST["alias1"])) and (isset($_POST["pass1"])) and (isset($_POST["email"])) and (isset($_POST["pais"])) and (isset($_POST["nombre"])) and (isset($_POST["rol"])) 
				and ($_POST["alias1"] != '') and ($_POST["pass1"] != '')  and ($_POST["email"] != '') and ($_POST["pais"] != '') and ($_POST["nombre"] != '') and ($_POST["rol"] != '') ){

					$conexion = new MySQL(0);

					$strIngreso = "select usuario from usuario where usuario = '".$_POST["alias1"]."';";
					$value1 = $conexion->consulta($strIngreso);
					$cant = $conexion->num_rows($value1);
					if ($cant==0){
						$strIngreso = '	insert into usuario (id_usuario,id_rol,id_pais,nombre,usuario,pass,fecha,email,logged,date_logged,status,session_id)
										values (null,'.$_POST["rol"].','.$_POST["pais"].',"'.$_POST["nombre"].'","'.$_POST["alias1"].'","'.$_POST["pass1"].'",now(),"'.$_POST["email"].'",0,null,"Activo",null);';
						echo  $strIngreso;				
						$value = $conexion->consulta($strIngreso);
						$conexion->MySQLClose();
						$_SESSION['value'] = 'ok.';
						session_write_close();
						exit(header( 'Location: http://'.URL.DS.'usuario'.DS.'start'));
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
		function refresh(){
			//echo $_POST["alias"]."-".$_POST["pass"]."-".$_POST["email"]."-".$_POST["pais"]."-".$_POST["nombre"]."-".$_POST["rol"]."-".$_POST["combo"];
			if( (isset($_POST["pass"])) and (isset($_POST["email"])) and (isset($_POST["pais"])) and (isset($_POST["nombre"])) and (isset($_POST["rol"])) 
				and ($_POST["pass"] != '')  and ($_POST["email"] != '') and ($_POST["pais"] != '') and ($_POST["nombre"] != '') and ($_POST["rol"] != '') ){
					$conexion = new MySQL(0);
					$strIngreso = '	update usuario 
									set pass ="'.md5($_POST["pass"]).'",
									id_pais ="'.$_POST["pais"].'", id_rol='.$_POST['rol'].',
									nombre ="'.$_POST["nombre"].'",email="'.$_POST["email"].'"
									where Id_usuario = "'.$_POST["combo"].'";' ;
					$value1 = $conexion->consulta($strIngreso);
					$conexion->MySQLClose();
					$_SESSION['value'] = 'ok';
					session_write_close();
					exit(header( 'Location: http://'.URL.DS.'usuario'.DS.'edit'));
			}else{
				$_SESSION['value'] = "error";
				session_write_close();
				exit(header( 'Location: http://'.URL.DS.'usuario'.DS.'edit'));
			}	
		}
		function disable(){
			if ( (isset($_POST["key"])) and (isset($_POST["key2"])) ){
				$conexion = new MySQL(0);
				$strIngreso = "update usuario set status = '".$_POST["key2"]."' where Id_usuario = '".$_POST["key"]."';" ;
				$value = $conexion->consulta($strIngreso);
				$conexion->MySQLClose();
				$_SESSION['value'] = 'El usuario fue dado de baja.';
				session_write_close();
				echo 'http://'.URL.DS.'usuario'.DS.'delete';
				//exit(header( 'Location: http://'.URL.DS.'superagregador'.DS.'delete'));
			}else{
				$_SESSION['value'] = "error";
				session_write_close();
				echo 'http://'.URL.DS.'usuario'.DS.'delete';
				//exit(header( 'Location: http://'.URL.DS.'superagregador'.DS.'delete'));
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