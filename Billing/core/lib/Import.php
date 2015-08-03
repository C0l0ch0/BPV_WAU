<?php
	//require('lib/config/Paths.php');
	class Import{
		var $dir;
		public static function load($section, $module){
			$dir = "";
			switch ($section) {
				case 'core':
					$dir = COREPATH.DS;
					break;
				case 'app':
					$dir = APP.DS;
					break;
				case 'lib':
					$dir = LIB.DS;
					break;
				case 'module':
					$dir = MODULES.DS;
					break;
			}
			if(file_exists($dir.$module.'.php')){
				if(!class_exists($dir.$module)){
					if (self::check($dir.$module.'.php')){
						require_once $dir.$module.'.php';
						return true;
					}else{
						return false;
					}
				}else{
					return true;
				}
			}else{
				echo "Error al cargar el archivo: ".$dir.$module.'.php';
			}
		}

		public static function loadModule($section, $module){
			$dir = MODULES.DS.$module.DS;
			if(!class_exists($dir.$module)){
				if (self::check($dir.$module.'.php')){
					require_once $dir.$module.'.php';
					return true;
				}else{
					return false;
				}
			}else{
				return true;
			}
		}

		public static function check($root){
			if(file_exists($root)){
				return true;
			}else{
				return false;
			}
		}

	}

?>

