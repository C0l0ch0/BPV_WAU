<?php 
	class BDCobros{

		var $conectorLocal;
		var $ExternalConector;
		var $ErrorExternalConector;
		var $id_carrier;
		var $BodyText;
		var $carrier_name;
		var $id_db;
		var $schema;
		var $table;
		var $where;
		var $field;
		var $fp;

		function __construct(){
			$this->conectorLocal 			= 	new MySQL(0);
			$this->ErrorExternalConector 	= 	false;
			$this->id_carrier 				= 	"";
			$this->BodyText 				= 	"";
			$this->carrier_name 			= 	"";
			$this->id_db 					= 	"";
			$this->schema 					= 	"";
			$this->table 					= 	"";
			$this->where 					= 	"";
			$this->field 					= 	"";
		}
		function StartLog($log){
			$this->fp = fopen(LOGS.DS.$log.date('Y_m_d').".txt", "a");
		}

		function LoadAllServices(){
			$query = "call LoadCarrierDB;";
			$result = $this->conectorLocal->consulta($query);
			self::AddBodyLog("Servicios a ejecutar: ".$this->conectorLocal->num_rows($result));
			return $result;
		}
		function StartProcess($data,$opt,$SaveAction){
			while ($row = $this->conectorLocal->fetch_row($data)){
				$this->id_carrier 	= 	$row[0];
				$this->carrier_name = 	$row[1];
				$this->id_db 		= 	$row[2];
				$this->schema 		= 	$row[3];
				$this->table 		= 	$row[4];
				$this->where 		= 	$row[5];
				$this->field 		= 	$row[6];
				try {
					$consumer = self::GetQuery($this->schema,$this->table,$this->field,$this->where,$opt);
					self::AddBodyLog( "**************************Realizando llamado a GetCharges para ".$this->carrier_name."**************************");
					self::GetCharges($this->id_db,$consumer,$opt,$SaveAction);
					$this->ErrorExternalConector = false;
					self::AddBodyLog( "**************************finalizacion de generacion de cobro**************************");	
				} catch (Exception $e) {
					self::AddBodyLog("No se logro obtener la informacion de ".$this->carrier_name." Validar conexion a Base de datos!!!!!!!!!!!!!!!");
				}
				self::WriteLog();
				self::clearBodyLog();
			}
		}
		function SaveCharges($DataCharge, $option, $save){
			$conectorLocal1 = new MySQL(0);

			switch ($option) {
				case 1:
					$LoadCant = ($DataCharge[0] != "") ? $DataCharge[0] : 0;
					$query = 	'insert into billing.'.strtolower($this->carrier_name).
								' values(null,'.$this->id_carrier.',date(date_add(now(), interval -6 hour)),hour(date_add(now(), interval -6 hour)),'.$LoadCant.");";
					break;
				case 2:
					$LoadCant = ($DataCharge[2] != "") ? $DataCharge[2] : 0;
					$query = 'insert into billing.'.strtolower($this->carrier_name).'_i values(null,'.$this->id_carrier.','.$DataCharge[0].',"'.$DataCharge[1].'",date(date_add(now(), interval -6 hour)),hour(date_add(now(), interval -6 hour)),'.$LoadCant.");";
					break;
				case 3:
					$LoadCant = ($DataCharge[0] != "") ? $DataCharge[0] : 0;
					$avg = ($DataCharge[1] != "") ? $DataCharge[1] : 0;
					$query = "call SaveMonitorCharges(".$this->id_carrier.",'".$this->carrier_name."',".$LoadCant.",".$avg.",2);";
					break;
				case 4:
					$LoadCant = ($DataCharge[3] != "") ? $DataCharge[3] : 0;
					$query = 'insert into billing.'.strtolower($this->carrier_name).'_i_p values(null,'.$this->id_carrier.','.$DataCharge[0].','.$DataCharge[1].',"'.$DataCharge[2].'",date(date_add(now(), interval -6 hour)),hour(date_add(now(), interval -6 hour)),'.$LoadCant.");";
					break;
			}
			self::AddBodyLog($query);
			if($save)
				$result = $conectorLocal1->consulta($query);
			$conectorLocal1->MySQLClose();
		}
		function GetCharges($db_selection,$query,$opt,$SaveAction){
			if(isset($db_selection) and isset($query)){
				try {
					$conectorLocal1 = new MySQL(0);
					$dbdata = "call GetDBKey(".$db_selection.");";
					$exec = $conectorLocal1->consulta($dbdata);
					$conectorLocal1->prepareNextResult();
					$result = $conectorLocal1->fetch_row($exec);
					self::MySQLExternal($result[1],$result[2],$result[3],$this->schema);
					if (!$this->ErrorExternalConector){
						$execute 	= self::externalQuery($query);
						$i = 0;
						while ($row = self::externalfetch_row($execute)){
							switch ($opt) {
								case 1:
									$LoadCant = 0;
									if($row[0] != "")
										$LoadCant = $row[0];
									self::AddBodyLog( "Cobros generados: ".$LoadCant);
									self::AddBodyLog( "Enviando a guardar informacion...........");
									self::SaveCharges($row,$opt,$SaveAction);
									break;
								case 2:
									self::AddBodyLog( "Cobros generados para ".$row[1].": ".$row[2]);
									self::AddBodyLog( "Enviando a guardar informacion...........");
									self::SaveCharges($row,$opt,$SaveAction);
									$i++;
									break;
								case 3:
									$LoadCant = 0;
									if($row[0] != "")
										$LoadCant = $row[0];
									$dbdata = "call GetAVGChargesPerCarrier(".$this->id_carrier.",2);";
									$exec = $conectorLocal1->consulta($dbdata);
									$result = $conectorLocal1->fetch_row($exec);
									$info[0] = $row[0];
									$info[1] = $result[0];
									self::AddBodyLog( "Obteniendo Promedio de cobros ".$dbdata.": ".$result[0]);
									self::AddBodyLog( "Cobros generados: ".$LoadCant);
									self::AddBodyLog( "Enviando a guardar informacion...........");
									self::SaveCharges($info,$opt,$SaveAction);
									break;
								case 4 :
									self::AddBodyLog( "Cobros generados para ".$row[2].": ".$row[3]);
									self::AddBodyLog( "Enviando a guardar informacion...........");
									self::SaveCharges($row,$opt,$SaveAction);
									$i++;
									break;
								break;

							}
						}
						if($opt == 2 ){self::AddBodyLog( "Integradores Procesados: ".$i);}
						if($opt == 4 ){self::AddBodyLog( "Productos Procesados: ".$i);}
					}
					$conectorLocal1->MySQLClose();	
				} catch (Exception $e) {
					self::AddBodyLog("No se logro obtener la informacion de ".$this->carrier_name." Validar conexion a Base de datos!!!!!!!!!!!!!!!");
					self::AddBodyLog("Trace ".$this->ErrorExternalConector);
				}
			}
		}
		function GetQuery($schema, $table, $field, $where,$opt){
			if(isset($schema) and isset($table) and isset($where)){
				$AddFields = "";
				$GroupBy = ";";
				$MakeJoin = "";
				if($opt == 2){
					$AddFields = "a.integrator_id,b.name,";
					$MakeJoin = "join ".$schema.".integratordetails b on a.integrator_id = b.integrator_id";
					$GroupBy = "group by a.integrator_id";
				}
				if($opt == 4){
                    $AddFields = "a.integrator_id,a.product_id,b.product_name,";
                    $MakeJoin = "join ".$schema.".product_master b on a.product_id = b.product_id";
                    $GroupBy = "group by a.integrator_id,a.product_id,b.product_name";
                }
				$DynamicQuery = "select ".$AddFields ."sum(a.".$field.") Cobros ";
				$DynamicQuery = $DynamicQuery."From ".$schema.".".$table." a ";
				$DynamicQuery = $DynamicQuery.$MakeJoin." ";
				$DynamicQuery = $DynamicQuery."Where ".$where." ";
				$DynamicQuery = $DynamicQuery.$GroupBy;
				return $DynamicQuery;
			}
		}
		function MySQLExternal($h, $u, $p, $s){
      		@$this->ExternalConector = mysqli_connect($h,$u,$p,$s);
      		if (mysqli_connect_errno()){
 			   self::AddBodyLog("Connect failed: ".mysqli_connect_error());
 			   $this->ErrorExternalConector 	= 	true;
      		}
  		}
  		function externalQuery($consulta){
    		$resultado = $this->ExternalConector->query($consulta);
    		if(!$resultado)
      			self::AddBodyLog( 'MySQL Error: '. $this->ExternalConector->error);
    		return $resultado;
  		}
  		function externalfetch_array($consulta){
  			return $consulta->fetch_array();
  		}
		function externalfetch_row($consulta){
			return $consulta->fetch_row();
		}
		function AddBodyLog($comment){
  			$this->BodyText = $this->BodyText."[".date('Y-m-d H:i:s')."] ".$comment."\n";
  		}
  		function clearBodyLog(){
  			$this->BodyText = '';
  		}
  		function WriteLog(){
  			fputs($this->fp,$this->BodyText);
  		}
	}

?>
