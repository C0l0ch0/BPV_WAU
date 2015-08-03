<?php
$account="eperez@waumovil.com";
$password="Wau1234567!";
$to="eperez@waumovil.com";
$from="eperez@waumovil.com";
$from_name="Guardias Noc";
//$msg="<strong>This is a bold text.</strong>"; // HTML message
$subject="HTML message";

$msg = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pase de Guardia</title>

 <style type="text/css">

#psdgraphics-com-table {
 margin:0;
 padding: 4px;
 width: 578px;
 font: 11px Arial, Helvetica, sans-serif;
 color:#747474;
 background-color:#0c2a62;
}


#psdg-header {
 margin:0;
 padding: 14px 0 0 24px;
 width: 554px;
 height: 55px;
 color:#FFF;
 font-size:13px;
 background: #0c2c65 url(images/head-bcg.jpg) no-repeat right top; 
}

.psdg-bold {
 font: bold 22px Arial, Helvetica, sans-serif;
 
}

#psdg-top {
 margin:0;
 padding: 0;
 width: 578px;
 height: 46px;
 border-top: 2px solid #FFF;
 background: #eff4ff url(images/top-light-blue.png) repeat-x left top; 
}

.psdg-top-cell {
 float:left;
 padding: 15px 0 0 0;
 text-align:center;
 width:105px;
 height: 31px;
 border-right: 1px solid #ced9ec;
 color:#1f3d71;
 font: 13px Arial, Helvetica, sans-serif;
}

#psdg-middle {
 margin:0;
 padding: 0;
 width: 578px;
 background: #f6f6f6 url(images/center-bcg.png) repeat-y right top; 
}

.psdg-left {
 float:left;
 margin:0;
 padding: 10px 0 0 24px;
 width: 129px;
 text-align: left;
 height: 25px;
 border-right: 1px solid #ced9ec;
 border-bottom: 1px solid #b3c1db;
 color:#1f3d71;
 font: 13px Arial, Helvetica, sans-serif;
 background: #e4ebf8 url(images/center-blue.png) repeat-y left top;
}



.psdg-right {
 float:left;
 margin:0;
 padding: 11px 0 0 0;
 width: 105px;
 text-align:center;
 height: 24px;
 border-right: 1px solid #ced9ec;
 border-bottom: 1px solid #b3c1db;
}

#psdg-bottom {
 clear:both;
 margin:0;
 padding: 0;
 width: 578px;
 height: 48px;
 border-top: 2px solid #FFF;
 background: #e4e3e3 url(images/bottom-line.png) repeat-x left top; 
}


.psdg-bottom-cell {
 float:left;
 padding: 15px 0 0 0;
 text-align:center;
 width:105px;
 height: 33px;
 border-right: 1px solid #ced9ec;
 color:#070707;
 font: 13px Arial, Helvetica, sans-serif;
}



#psdg-footer {
 font-size: 10px;
 color:#8a8a8a;
 margin:0;
 padding: 8px 0 8px 12px;
 width: 566px;
 background: #f6f6f6 url(images/center-bcg.png) repeat-y right top; 
}


</style>
</head>

<body>
<center>
<div id="psdgraphics-com-table">



<div id="psdg-header">
<span class="psdg-bold">NOC</span><br />
Pase de Guarda Hora:<br>
Usuario Entrega:<br>

</div>

<div id="psdg-top">
<div class="psdg-top-cell" style="width:129px; text-align:left; padding-left: 24px;">Servicios</div>
<div class="psdg-top-cell">Descripcion</div>
<div class="psdg-top-cell">Descripcion</div>
<div class="psdg-top-cell">Descripcion</div>
<div class="psdg-top-cell" style="border:none;">Descripcion</div>
</div>


<div id="psdg-middle">



<div class="psdg-left">Legacy</div>
<div class="psdg-right">Base de datos [Etiqueta OK]</div>
<div class="psdg-right">Beconnected [Etiqueta OK]</div>
<div class="psdg-right">Cobros[Etiqueta OK]</div>
<div class="psdg-right">Conexiones Base de datos [Etiqueta OK]</div>


<div class="psdg-left">David</div>
<div class="psdg-right">300 000</div>
<div class="psdg-right">300 000</div>
<div class="psdg-right">300 000</div>
<div class="psdg-right">300 000</div>


<div class="psdg-left">SAPER</div>
<div class="psdg-right">Firefox</div>
<div class="psdg-right">Firefox</div>
<div class="psdg-right">Firefox</div>
<div class="psdg-right">Firefox</div>


<div class="psdg-left">SAMEX</div>
<div class="psdg-right">Windows 7</div>
<div class="psdg-right">Windows 7</div>
<div class="psdg-right">Windows 7</div>
<div class="psdg-right">Windows 7</div>
<div class="psdg-left">SAECU</div>
<div class="psdg-right">1280x1024</div>
<div class="psdg-right">1280x1024</div>
<div class="psdg-right">1280x1024</div>
<div class="psdg-right">1280x1024</div>
<div class="psdg-left">SANIC</div>
<div class="psdg-right">.com</div>
<div class="psdg-right">.com</div>
<div class="psdg-right">.com</div>
<div class="psdg-right">.com</div>
<div class="psdg-left">Continent</div>
<div class="psdg-right">Europe</div>
<div class="psdg-right">Europe</div>
<div class="psdg-right">Europe</div>
<div class="psdg-right">Europe</div>
<div id="psdg-bottom">
<div class="psdg-bottom-cell" style="width:129px; text-align:left; padding-left: 24px;">Status:</div>
<div class="psdg-bottom-cell">Approved</div>
<div class="psdg-bottom-cell">Approved</div>
<div class="psdg-bottom-cell">Approved</div>
<div class="psdg-bottom-cell" style="border:none;">Approved</div>
</div>
</div>
<div id="psdg-footer">
Powered by: Mongolesforever!!!
</div>
</div>
</center>
</body>
</html>';


include_once(LIB1.DS."PHPMailer/PHPMailerAutoload.php");

//import::load('lib/PHPMailer', 'class.phpmailer');

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth= true;
$mail->Port = 465; // Or 587
$mail->Username= $account;
$mail->Password= $password;
$mail->SMTPSecure = 'ssl';
$mail->From = $from;
$mail->FromName= $from_name;
$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body = $msg;
//$mail->addAddress($to);
//$mail->addCC($to);
$mail->addBCC($to);
//addCC
//addBCC
if(!$mail->send()){
 echo "Mailer Error: " . $mail->ErrorInfo;
}else{
 echo "E-Mail has been sent";
}



?>