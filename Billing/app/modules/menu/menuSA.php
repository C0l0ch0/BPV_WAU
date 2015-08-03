<?php

	$conexion                 =   new MySQL(0);
	if (($_SESSION['access'] == 4) or ($_SESSION['access'] == 5))  
	{
		$query = 'CALL GetMenuListLimit('.$_SESSION['pais'].');';
	}else{
		$query = 'CALL GetMenuList();';
	}
	
	$result                   =   $conexion->consulta($query);
	$HtmlMenuCode             =   '';
	$conexion->prepareNextResult();

	if(! $result){
  		throw new Exception ("No se logro obtener informacion de cobros....\n");
  	}else{
		while ($carrier = $conexion->fetch_row($result)){
			$optionActive = (strpos(strtolower($actual_link),strtolower($carrier[1]))) ? 'class="has-sub active"' : 'class="has-sub "';
			$HtmlMenuCode = $HtmlMenuCode."\n\t\t\t\t\t"."<li ".$optionActive.">"."\n";
			$HtmlMenuCode = $HtmlMenuCode."\t\t\t\t\t\t".'<a href="javascript:;">'."\n";
			$HtmlMenuCode = $HtmlMenuCode."\t\t\t\t\t\t\t".'<b class="caret pull-right"></b>'."\n";
			$HtmlMenuCode = $HtmlMenuCode."\t\t\t\t\t\t\t".'<i class="fa fa-line-chart"></i>'."\n";
			$HtmlMenuCode = $HtmlMenuCode."\t\t\t\t\t\t\t".'<span>'.$carrier[1].'</span>'."\n";
			$HtmlMenuCode = $HtmlMenuCode."\t\t\t\t\t\t".'</a>'."\n";
			$HtmlMenuCode = $HtmlMenuCode."\t\t\t\t\t\t".'<ul class="sub-menu">'."\n";
			$Level = GetSecondLevel($carrier[0],$actual_link);
			$HtmlMenuCode = $HtmlMenuCode.$Level;
			$HtmlMenuCode = $HtmlMenuCode."\t\t\t\t\t\t".'</ul>'."\n";
			$HtmlMenuCode = $HtmlMenuCode."\t\t\t\t\t"."</li>"."\n";
		}
  	}
	$conexion->MySQLClose();

	echo $HtmlMenuCode;

	function GetSecondLevel($carrier,$al){
		$conexion1 = new MySQL(0);
		if ($_SESSION['access'] == 5)  
		{
			$query = 'call GetSubMenuLimits('.$carrier.');';
		}else{
			$query = 'call GetSubMenu('.$carrier.');';
		}
		$result = $conexion1->consulta($query);
		$miniBody = '';
		while ($link = $conexion1->fetch_row($result)){
			$urlC = ($link[2] == 1) ? 'http://'.URL.DS.$link[0] : $link[0];
			$IamHere = ($al == $urlC) ? 'class="active""': '';
			if ($link[2] == 1){
				$miniBody = $miniBody."\t\t\t\t\t\t\t".'<li '.$IamHere.'><a href="'.$urlC.'">'.$link[1].'</a></li>'."\n";
			}else{
				$miniBody = $miniBody."\t\t\t\t\t\t\t".'<li ><a href="'.$urlC.'" target="_blank">'.$link[1].'</a></li>'."\n";
			}
		}
		$conexion1->MySQLClose();
		return $miniBody;
	}
?>