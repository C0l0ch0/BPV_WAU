<?php

class View{
     var $template;
     function __construct($template){
		$this->template=$template;
     }
     
     function render($params){
     extract($params,EXTR_SKIP);
     ob_start();
          include(TEMPLATE.DS.$this->template);
     $out = ob_get_clean();
          echo $out;
     }  
}

?>
