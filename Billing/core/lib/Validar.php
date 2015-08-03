<?php

	$loginP = new Login();

	if(isset($_POST['login']) && isset($_POST['password']) && ($_POST['login'] != '') && ($_POST['password'] != '')){
		$loggedstatus = $loginP->islogged($_POST['login']);
		if($loggedstatus === "not.found"){
			//$loginP->start("null");
			$loggedstatus = "notexist";
			$check_L = false;
		}else{
			if($loggedstatus === "notlogged"){
				$check_L = $loginP->login($_POST['login'],$_POST['password']);
				echo $check_L;
			}else{
				$check_L = false;
			}
		}

		
		if ($check_L){
			$t_login = $loginP->check();
			if ($t_login){
				$conexion = new MySQL(0);
				$query = 'call GetHomeURL('.$_SESSION['pais'].');';
				$result1 = $conexion->consulta($query);
				$row = $conexion->fetch_row($result1);
				$conexion->MySQLClose();

				switch ($_SESSION['access']) {
					case 1:
					case 2:
					case 3:
						if(! isset($_SESSION['home']))
							$_SESSION['home'] = 'http://'.URL.DS.'dashboard'.DS.'metricas';
						break;
					default:
						if(! isset($_SESSION['home']))
							$_SESSION['home'] = 'http://'.URL.DS.$row[0];
						break;
				}

				session_write_close();
				//echo $_SESSION['home'];
				exit(header( 'Location: '.$_SESSION['home']));
				//echo $row[0];
			}else{
				//entra a esta parte en caso sean incorrectos los datos.
				//$loginP->start('error');
				echo "9";
			}
		}else {
			if($loggedstatus === "islogged"){
				$loginP->start("logged");
			}else{
				if($loggedstatus === "notexist"){
					$loginP->start("notexist");
				}else{
					$loginP->start("error");
				}
			}
		}
	}else{
		// En caso no se ingresen los campos.
		$loginP->start("null");
	}
?>
