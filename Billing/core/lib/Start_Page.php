<?php
	//require_once('import.php');
	class Start_Page{

		var $url;
		var $body;
		var $dir;
		var $web_start;
		
		function __construct(){
			$this->getURL();
			$this->dir = CMSPATH.$this->url;
		}

		function getURL(){
			$this->url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		}

		function checkURL(){
			return $this->url;	
		}

		function isValid(){

			if($this->url == '/')
				return true;
		}

		function start(){
			$link = true;
			self::getURL();
			$options = $this->separate();
			if ($options[0] == 1){
				echo "menu";
			}else{
				$this->controler = $options[1];
				if(isset($options[2])){
					$pos = strrpos($options[2], "=");
					if ($pos === false){
						$this->method = $options[2];
					}else{
						$pos1 = strrpos($options[1], "Vista");
						if ($pos1 === false){
							$this->method = substr($options[2], 0, (-1 * $pos+1));
							exit(header( 'Location: http://'.URL.DS.$options[1].DS.$this->method));
						}else{
							$this->value = substr($options[2], ($pos - strlen($options[2]) +1));
							$this->method = substr($options[2], 0, ($pos - strlen($options[2])));
						}
					}
				}else{
					exit(header( 'Location: http://'.URL.DS.$options[1].DS.'start'));
				}
				if(!import::loadModule("module",$this->controler)){
					//exit(header( 'Location: http://'.URL.DS.'login'.DS.'404'));
					echo "error, no se encontro el controlador ".$this->controler."\n";
				}
				$class = $this->controler;
				if (method_exists($class,$this->method)){
					$getType = new ReflectionMethod($class,$this->method);
					if (!$getType->isPublic()){
						exit(header( 'Location: http://'.URL.DS.$options[1].DS.'start'));
					}else{
						$method = $this->method;
						$class = new $class();
						$class->$method('none');
					}
				}else{
					echo "error, no se encontro el metodo ".$this->method."\n";	
				}
			}
		}

		function  separate(){
			$temp = explode($_SERVER['HTTP_HOST'].DS,$this->url);
			$temp = explode("/",$temp[1]);
			$lenght = 1;
			$return=array();
			$return[] = count($temp);
			for ($i=1;$i<count($temp);$i++){
				if ($temp[$i]!=""){
					$return[]=$temp[$i];
					$lenght++;
				}
			}
			$return[0] = $lenght;
			return $return;
		}

	}

?>
