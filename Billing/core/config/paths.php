<?php

	if(!defined('CMSPATH'))
		define('CMSPATH', dirname(dirname(dirname(dirname(__FILE__)))));

	if(!defined('ROOT'))
		define('ROOT', (dirname(dirname(dirname(dirname(__FILE__))))));

	if(!defined('DS'))
		define('DS',"/");

	if(!defined('COREPATH'))
		define('COREPATH',CMSPATH.DS.'core');

	if(!defined('LIB'))
		define('LIB',COREPATH.DS.'lib');

	if(!defined('APP'))
		define('APP',CMSPATH.DS.'app');

	if(!defined('WWWROOT'))
		define('WWWROOT',APP.DS.'webroot');

	if(!defined('WEBROOT'))
		define('WEBROOT',str_replace(ROOT, "",WWWROOT));

	if(!defined('TEMPLATE'))
		define('TEMPLATE',APP.DS.'templates');
	
	if(!defined('MODULES'))
		define('MODULES',APP.DS.'modules');	

	if(!defined('MINMODULES'))
		define('MINMODULES',MODULES.DS.'minimodules');

	if(!defined('LOCAL'))
		define('LOCAL',"Billing");

	if(!defined('URL'))
		define('URL',$_SERVER['SERVER_NAME'].DS.LOCAL);

	if(!defined('HOURDB'))
		define('HOURDB',6);
?>
