<?php class MySQL{

  private $conexion; private $total_consultas;

  public function MySQL($opcion){ 
    if(!isset($this->conexion)){
      $keyAccess = self::getKeyAccess($opcion);
      $this->conexion = mysqli_connect($keyAccess[2],$keyAccess[0],$keyAccess[1],$keyAccess[3]) or die("Error " . mysqli_error($link)); 
    }
  }
  public function start($u){
	$resultado = $this->conexion->query("select pass,status from usuario where usuario = '$u'");
	if(!$resultado){ 
		echo 'MySQL Error: '. $this->conexion->error;
		exit;
	}
	return $resultado->fetch_row();
  }
  public function consulta($consulta){ 
    $this->total_consultas++; 
    $resultado = $this->conexion->query($consulta);
    if(!$resultado){ 
      echo 'MySQL Error: '. $this->conexion->error;
      exit;
    } 
    return $resultado;
  }

  public function fetch_array($consulta){
   return $consulta->fetch_array();
  }

  public function fetch_row($consulta){
   return $consulta->fetch_row();
  }

  public function num_rows($consulta){
   return $consulta->num_rows;
  }

  public function getTotalConsultas(){
   return $this->total_consultas; 
  }
  public function prepareNextResult(){
    mysqli_next_result($this->conexion);
  }
  public function MySQLClose(){
    $this->conexion->close();
  }
  private function getKeyAccess($option){
    switch ($option) {
      case 0:
      case 6:
        //$keyAccess = array("UserPweb","123456","localhost","billing");
        //$keyAccess = array("fox","123456","192.168.2.122","billing");
        $keyAccess = array("fox","123456","172.31.1.14","billing");
        break;
      default:
        $ConexionLocal = new MySQL(0);
        $ExecBD= $ConexionLocal->consulta("call GetDBKey(".$option.");");
        $returnKey = $ConexionLocal->fetch_row($ExecBD);
        $keyAccess = array($returnKey[2],$returnKey[3],$returnKey[1],"");
    }      
      return $keyAccess;
  }

}?>
