<?php

	class Session {
	
		public static function start(){
			//ini_set("session.use_trans_sid","0"); 
			//ini_set("session.use_only_cookies","1"); 
			//session_start();
			if (session_status() === PHP_SESSION_NONE){
				ini_set("session.use_trans_sid","0"); 
				ini_set("session.use_cookies","1");
				ini_set("session.use_cookies",900);
				//session.cookie_lifetime
				//ini_set("session.use_only_cookies","1");
				
				session_start();
				$_SESSION['sid'] = session_id();


			}
		}
		
		public static function close(){
			session_destroy();
		}
		
		public static function load($name,$value,$value2){
			$arr = Session::__loadVars($name);
			$_SESSION['login'] = $arr[1];
			$_SESSION['access'] = $value;
			$_SESSION['pais'] = $value2;
			$_SESSION['start'] = "OK";
			$_SESSION['ultimoAcceso'] = date("Y-n-j H:i:s");
			if(! isset($_COOKIE['billing'])){
				setcookie("billing", $_SESSION['sid']."_".$arr[1], time()+180000,'/');
			}
			session_write_close();
		}
		
		public static function get($var){
			if(isset($_SESSION[$var])){
				return $_SESSION[$var];
			}else{
				return false;
			}
		}
		
		public static function destroy(){
			unset($_SESSION);
			if(isset($_COOKIE['billing'])){
				unset($_COOKIE['billing']);
				setcookie('billing', null, -1, '/');
			}
			if(isset($_COOKIE['PHPSESSID'])){
				unset($_COOKIE['PHPSESSID']);
				setcookie('PHPSESSID', null, -1, '/');
			}
			self::close();
		}
		
		public static function __loadVars($name){
			return explode(".", $name);
		}
	}
?>
