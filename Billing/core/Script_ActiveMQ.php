<?php
	/*---------------------------------Script de cobros por Hora-------------------------------*/
    define('PATH',str_replace("\\","/",dirname(__FILE__)));
    define('DS',"/");
    define('LIB',PATH.DS.'lib');
    define('LOGS',PATH.DS.'logs');

	$logFile = "ActiveMQService";
    $fp = fopen(LOGS.DS.$logFile.date('Y_m_d').".txt", "a");

    fputs($fp, "[".date('Y-m-d H:i:s')."] Inicio de servicio de actualizacion de BD\n");
    fputs($fp, "[".date('Y-m-d H:i:s')."] Parametrizacion de rutas y valores....\n\n");
    fputs($fp, "[".date('Y-m-d H:i:s')."] Librerias a cargar: \n");
    fputs($fp, "[".date('Y-m-d H:i:s')."] ".LIB.DS."MySQL.php \n");
    fputs($fp, "[".date('Y-m-d H:i:s')."] ".LIB.DS."ActiveMQ.php \n");
    fputs($fp, "[".date('Y-m-d H:i:s')."] Parametrizacion de rutas y valores....\n\n");
    $step = 1;

    fputs($fp, "[".date('Y-m-d H:i:s')."]Requerimiento de librerias....\n");

    try{
        if ((! @include_once( LIB.DS."MySQL.php" )) and (! @include_once( LIB.DS."ActiveMQ.php" ))){
            $pass = false;
            throw new Exception ('No se encontro la clase: MySql');
        }
        else{
            require_once LIB.DS."MySQL.php";
            require_once LIB.DS."ActiveMQ.php";
            $pass = true;
        }
    }catch(Exception $e){
        fputs($fp, "[".date('Y-m-d H:i:s').'] Excepcion capturada: '.$e->getMessage()."\n");
        $step = 0;
    }

    if($step){
        $coreBD = new ActiveMQ();
		$coreBD->StartLog($logFile);
        fputs($fp, "[".date('Y-m-d H:i:s')."] Cargando procesos...........\n");
        $execute = $coreBD->LoadActiveMQ();
        fputs($fp, "[".date('Y-m-d H:i:s')."] Iniciando Procesos..........\n");
        $coreBD->StartProcess($execute,false);
        fputs($fp, "[".date('Y-m-d H:i:s')."] Procesos Finalizado..........\n");
        fclose($fp);
    }

?>