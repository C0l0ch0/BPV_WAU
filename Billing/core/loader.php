<?php

	//echo COREPATH.DS."config/paths.php";
	if(file_exists(COREPATH.DS."config/paths.php")){
		require_once COREPATH.DS."config/paths.php";
		//write to web server log.
	}else{
		echo "Archivo paths.php no se encuentra disponible en la ruta: ".COREPATH.DS."config/";
		return false;
		//write error to web server log.
	}
	if(file_exists(COREPATH.DS."lib/Import.php")){
        require_once COREPATH.DS."lib/Import.php";
        //write to web server log.
                return true;
    }else{
        echo "Archivo paths.php no se encuentra disponible en la ruta: ".COREPATH.DS."config/";
        //write error to web server log.
        return false;
    }
?>
