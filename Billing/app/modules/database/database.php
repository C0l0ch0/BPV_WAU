<?php

	import::load('lib', 'MySQL');

	class database{

		function __construct(){
			$this->titulo = 'Billing Vas Pass';
			$this->mensaje = '';
		}

		function start($mensaje){
			if(self::check()){
				if($_SESSION['access'] == 1){ 
					$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
					self::LoadTemplate("database/crear.php",$data);
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
					self::LoadTemplate("database/editar.php",$data);
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
					self::LoadTemplate("database/baja.php",$data);
				}else{
					$_SESSION['value'] = 'Acceso denegado';
					session_write_close();
					exit(header( 'Location: http://'.URL.DS.'dashboard'.DS.'start'));
				}
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function create_sa($mensaje){
			if(self::check()){
				if($_SESSION['access'] == 1){ 
					$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
					self::LoadTemplate("database/crear_sa.php",$data);
				}else{
					$_SESSION['value'] = 'Acceso denegado';
					session_write_close();
					exit(header( 'Location: http://'.URL.DS.'dashboard'.DS.'start'));
				}
				
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function generate($mensaje){
			if(self::check()){
				if($_SESSION['access'] == 1){ 
					$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
					self::LoadTemplate("database/generate.php",$data);
				}else{
					$_SESSION['value'] = 'Acceso denegado';
					session_write_close();
					exit(header( 'Location: http://'.URL.DS.'dashboard'.DS.'start'));
				}
				
			}else{
				exit(header( 'Location: http://'.URL.DS));
			}
		}
		function down($mensaje){
			if(self::check()){
				if($_SESSION['access'] == 1){ 
					$data = array("Titulo" => "Billing Vas Pass", "mensaje" => $mensaje);
					self::LoadTemplate("database/baja_g.php",$data);
				}else{
					$_SESSION['value'] = 'Acceso denegado';
					session_write_close();
					exit(header( 'Location: http://'.URL.DS.'dashboard'.DS.'down'));
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
			if( (isset($_POST["descripcion"])) and (isset($_POST["host"])) and (isset($_POST["user"])) and (isset($_POST["pass"]))
				and ($_POST["descripcion"] != '') and ($_POST["host"] != '') and ($_POST["user"] != '') and ($_POST["pass"] != '')){

					$conexion = new MySQL(0);
					$strIngreso = "	insert into billing.bases_cobro (id_base,descripcion,host_conexion,user,pass)
									values(null,'".$_POST["descripcion"]."','".$_POST["host"]."','".$_POST["user"]."','".$_POST["pass"]."');";
					$value = $conexion->consulta($strIngreso);
					$conexion->MySQLClose();
					$_SESSION['value'] = "ok";
					session_write_close();
					exit(header( 'Location: http://'.URL.DS.'database'.DS.'start'));
			}else{
				exit(header( 'Location: http://'.URL.DS.'database'.DS.'start'));
			}
		}
		function refresh(){
			if( (isset($_POST["descripcion"])) and (isset($_POST["host"])) and (isset($_POST["user"])) and (isset($_POST["pass"]))
				and ($_POST["descripcion"] != '') and ($_POST["host"] != '') and ($_POST["user"] != '') and ($_POST["pass"] != '')){
					$conexion = new MySQL(0);
					$strIngreso = '	update billing.bases_cobro 
									set descripcion = "'.$_POST["descripcion"].'", host_conexion = "'.$_POST["host"].'", user = "'.$_POST["user"].'", pass = "'.$_POST["pass"].'"
									where id_base = '.$_POST["combo"].';' ;
					//echo "\n\n".$strIngreso."\n\n";
					$value1 = $conexion->consulta($strIngreso);
					$conexion->MySQLClose();
					$_SESSION['value'] = 'ok';
					session_write_close();
					exit(header( 'Location: http://'.URL.DS.'database'.DS.'edit'));
			}else{
				//$_SESSION['value'] = 'error';
				//session_write_close();
				exit(header( 'Location: http://'.URL.DS.'database'.DS.'edit'));
			}	
		}
		function disable(){
			if ( (isset($_POST["key"])) and (isset($_POST["key2"])) ){
				$conexion = new MySQL(0);
				$strIngreso = "update servicio set estado = ".$_POST["key2"]." where Id_servicio = '".$_POST["key"]."';" ;
				$value = $conexion->consulta($strIngreso);
				$conexion->MySQLClose();
				$_SESSION['value'] = 'El usuario fue dado de baja.';
				session_write_close();
				echo 'http://'.URL.DS.'servicio'.DS.'delete';
				//exit(header( 'Location: http://'.URL.DS.'servicio'.DS.'delete'));
			}else{
				$_SESSION['value'] = "error";
				session_write_close();
				echo 'http://'.URL.DS.'servicio'.DS.'delete';
				//exit(header( 'Location: http://'.URL.DS.'servicio'.DS.'delete'));
			}
		}
		function save_sa(){
			if( (isset($_POST["descripcion"])) and (isset($_POST["pais"]))
				and ($_POST["descripcion"] != '') and ($_POST["pais"] != '')){

					$conexion = new MySQL(0);
					$strIngreso = "call CheckIfTableExist('".strtolower($_POST["descripcion"])."');";
					$execute = $conexion->consulta($strIngreso);
					$exist = $conexion->fetch_row($execute);
					$conexion->MySQLClose();
					echo "1";
					if ($exist[0] == 0){
						$conexion = new MySQL(0);
						$strIngreso = "call CheckIfTableExist('".strtolower($_POST["descripcion"])."_i');";
						$execute2 = $conexion->consulta($strIngreso);
						$exist2 = $conexion->fetch_row($execute2);
						$conexion->MySQLClose();
						echo "2";
						if ($exist2[0] == 0){
							$conexion = new MySQL(0);
							$strIngreso = "call CreateTables('".strtolower($_POST["descripcion"])."');";
							$execute = $conexion->consulta($strIngreso);
							$conexion->MySQLClose();
							echo "3";
							$conexion = new MySQL(0);
							$strIngreso = "insert into billing.carrier (id_carrier,descripcion, nombre) values(null,'".strtoupper($_POST["descripcion"])."','".strtoupper($_POST["pais"])."');";
							$execute = $conexion->consulta($strIngreso);
							$conexion->MySQLClose();
							echo "4";
							$_SESSION['value'] = "ok";
						}else{$_SESSION['value'] = "error1";}
					}else{$_SESSION['value'] = "error1";}
					session_write_close();
					exit(header( 'Location: http://'.URL.DS.'database'.DS.'create_sa'));
			}else{
				exit(header( 'Location: http://'.URL.DS.'database'.DS.'create_sa'));
			}
		}
		function disable_sa(){
			if ( (isset($_POST["key"])) and (isset($_POST["key2"])) ){
				$conexion = new MySQL(0);
				$strIngreso = "update cobro_carrier set estatus = ".$_POST["key2"]." where id_cobro_carrier = '".$_POST["key"]."';" ;
				$value = $conexion->consulta($strIngreso);
				$conexion->MySQLClose();
				$_SESSION['value'] = 'El servicio fue dado de baja.';
				session_write_close();
				echo 'http://'.URL.DS.'database'.DS.'down';
				//exit(header( 'Location: http://'.URL.DS.'servicio'.DS.'delete'));
			}else{
				$_SESSION['value'] = "error";
				session_write_close();
				echo 'http://'.URL.DS.'database'.DS.'down';
				//exit(header( 'Location: http://'.URL.DS.'servicio'.DS.'delete'));
			}
		}
		function display_sa(){
			if ( (isset($_POST["key3"])) and (isset($_POST["key4"])) ){
				$conexion = new MySQL(0);
				$strIngreso = "update cobro_carrier set display_graph = ".$_POST["key4"]." where id_cobro_carrier = '".$_POST["key3"]."';" ;
				$value = $conexion->consulta($strIngreso);
				$conexion->MySQLClose();
				$_SESSION['value'] = 'El servicio fue dado de baja.';
				session_write_close();
				echo 'http://'.URL.DS.'database'.DS.'down';
				//exit(header( 'Location: http://'.URL.DS.'servicio'.DS.'delete'));
			}else{
				$_SESSION['value'] = "error";
				session_write_close();
				echo 'http://'.URL.DS.'database'.DS.'down';
				//exit(header( 'Location: http://'.URL.DS.'servicio'.DS.'delete'));
			}
		}
		function save_g(){
			if( (isset($_POST["carrier"])) and (isset($_POST["host"])) and (isset($_POST["esquema"])) and (isset($_POST["tabla"])) and (isset($_POST["campo"])) and (isset($_POST["cond"]))
				and ($_POST["carrier"] != '') and ($_POST["host"] != '') and ($_POST["esquema"] != '') and ($_POST["tabla"] != '') and ($_POST["campo"] != '') and ($_POST["cond"] != '')){

					$conexion = new MySQL(0);
					$strIngreso = "	insert into billing.cobro_carrier  (id_cobro_carrier,id_carrier,id_base,esquema,tabla,condicion,estatus,field_sum)
									values (null,".$_POST["carrier"].",".$_POST["host"].",'".$_POST["esquema"]."','".$_POST["tabla"]."','".$_POST["cond"]."',1,'".$_POST["campo"]."');";
					$value = $conexion->consulta($strIngreso);
					$conexion->MySQLClose();
					$_SESSION['value'] = "ok";
					session_write_close();
					exit(header( 'Location: http://'.URL.DS.'database'.DS.'generate'));
			}else{
				exit(header( 'Location: http://'.URL.DS.'database'.DS.'generate'));
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