<?php

class ActiveMQ{
    var $fp;
    var $Q_Name;
    var $Q_Zize;
    var $AMQ_name;
    var $AMQ_url;
    var $Q_ConsumerCount;
    var $Q_EnqueueCount;
    var $Q_DequeueCount;
    var $conectorLocal;

    function __construct(){
    $this->Q_Name 	        = "";
  	$this->Q_Size 	        = "";
    $this->AMQ_name         = "";
    $this->AMQ_url          = "";
  	$this->Q_ConsumerCount 	= "";
  	$this->Q_EnqueueCount 	= "";
    $this->Q_DequeueCount 	= "";
    $this->conectorLocal 	  = new MySQL(0);
    }
    function StartProcess($data,$SaveAction){
      while ($row = $this->conectorLocal->fetch_row($data)){
        try {
          $this->AMQ_name     = $row[0];
          $this->AMQ_url      = $row[1];
          self::WriteLog( "**************************Realizando llamado a GetActiveMQData para ".$this->AMQ_name."**************************");
          self::GivemeSomeSpace();
          self::ParseJsonData(self::GetActiveMQData());
          self::WriteLog( "**************************finalizacion de generacion de Info**************************"); 
        } catch (Exception $e) {
          self::WriteLog("No se logro obtener la informacion de ".$this->AMQ_name." Validar conexion a Base de datos!!!!!!!!!!!!!!!");
        }
      }
    }
    function ParseJsonData($resp){
      $servers = json_decode($resp,true);
      for($i=0;$i<count($servers['queue']);$i++){
        $this->Q_Name = '';
        $this->Q_Size = '';
        $this->Q_ConsumerCount = '';
        $this->Q_EnqueueCount = '';
        $this->Q_DequeueCount = '';
        $cont = 0;
        if (($servers["queue"][$i]["stats"]["@attributes"]["size"] > 1) or ($servers["queue"][$i]["stats"]["@attributes"]["consumerCount"] < 1)){
          try {
            $this->Q_Name = (isset($servers["queue"][$i]["@attributes"]["name"])) ? $servers["queue"][$i]["@attributes"]["name"] : "No Data"; 
            $this->Q_Size = (isset($servers["queue"][$i]["stats"]["@attributes"]["size"])) ? $servers["queue"][$i]["stats"]["@attributes"]["size"] : "No Data"; 
            $this->Q_ConsumerCount = (isset($servers["queue"][$i]["stats"]["@attributes"]["consumerCount"])) ? $servers["queue"][$i]["stats"]["@attributes"]["consumerCount"] : "No Data"; 
            $this->Q_EnqueueCount = (isset($servers["queue"][$i]["stats"]["@attributes"]["enqueueCount"])) ? $servers["queue"][$i]["stats"]["@attributes"]["enqueueCount"] : "No Data"; 
            $this->Q_DequeueCount = (isset($servers["queue1"][$i]["stats"]["@attributes"]["dequeueCount"])) ? $servers["queue"][$i]["stats"]["@attributes"]["dequeueCount"] : "No Data"; 
            self::WriteLog("name: ".          $this->Q_Name);
            self::WriteLog("size: ".          $this->Q_Size);
            self::WriteLog("consumerCount: ". $this->Q_ConsumerCount);
            self::WriteLog("enqueueCount: ".  $this->Q_EnqueueCount);
            self::WriteLog("dequeueCount: ".  $this->Q_DequeueCount);
            self::SaveData();
          } catch (Exception $e) {
            self::WriteLog("error ->".$e);
          }
        }
      }
    }
    function SaveData(){
      $query = 'CALL SaveMonitorQueue("'.$this->AMQ_name.'","'.$this->Q_Name.'",'.$this->Q_Size.','.$this->Q_ConsumerCount.');';
      $result = $this->conectorLocal->consulta($query);
      $this->conectorLocal->prepareNextResult();
    }
    function GivemeSomeSpace(){
      $query = 'truncate table monitor_queue;';
      $result = $this->conectorLocal->consulta($query);
      $this->conectorLocal->prepareNextResult();
      self::WriteLog("Realizando limpieza.......");
    }
    function GetActiveMQData(){
      $resp = '';
      if ((@$response_xml_data = file_get_contents($this->AMQ_url))===false){
        self::WriteLog("Error fetching XML\n");
      } else {
        libxml_use_internal_errors(true);
        $data = simplexml_load_string($response_xml_data);
      if (!$data) {
        self::WriteLog("Error loading XML\n");
        foreach(libxml_get_errors() as $error) {
          self::WriteLog("\t", $error->message);
        }
      }else{
        $resp = json_encode($data);
      }
      return $resp;
      }
    }
  	function LoadActiveMQ(){
    	$query = "call GetActiveMQInfo;";
			$result = $this->conectorLocal->consulta($query);
      $this->conectorLocal->prepareNextResult();
			self::WriteLog("Servicios a ejecutar: ".$this->conectorLocal->num_rows($result));
			return $result;
    }
    function StartLog($log){
			$this->fp = fopen(LOGS.DS.$log.date('Y_m_d').".txt", "a");
		}
		function WriteLog($comment){
  		fputs($this->fp, "[".date('Y-m-d H:i:s')."] ".$comment."\n");
  	}
	}
?>
