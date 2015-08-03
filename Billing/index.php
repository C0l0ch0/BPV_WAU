<?php

	define('CMSPATH',str_replace("\\","/",dirname(__FILE__)));
	define('DS',"/");
	define('COREPATH',CMSPATH.DS.'core');

	require_once COREPATH.DS."loader.php";
	$access = Import::load("lib","Start_Page");
	$access = $access and import::load('lib', 'view');
	$access = $access and import::load('lib', 'Validate_Auth');

	validate_auth::start();

	$LestStart = new Start_Page();
	if ($access){
		if ($LestStart->checkURL() == URL.DS){
			header( 'Location: http://'.URL.DS.'login'.DS."start" );
		}else{
			$LestStart->start();
		}
	}else{
		echo "No se logro realizar la carga de los archivos.";
	}
?>
