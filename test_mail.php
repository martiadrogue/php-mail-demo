<?php

if ($nombre!=null && $email!=null && $texto!=null){
	$contenido="<div style='padding:10 10 10 10; border:1px solid black;width:500px; text-align:left;'>".
		"<b>NOMBRE:</b><br />".$nombre."<br />".
		"<br /><b>E-MAIL:</b><br />".$email."<br />".
		"<br /><b>TELÉFONO:</b><br />".$telefono."<br />".
		"<br /><b>MENSAJE:</b><br />".$texto.
		"</div>";
	$html="<html><body><font style='font-weight:bold; font-size:16px;'><br />Bloc Reinventa informa:</font><br /><br/>".
		"Un nuevo mensaje desde el formulario de contacto:<br /><br />".$contenido."<br /><br />".
		"</body></html>";
	$text="BLOC REINVENTA - Nuevo Mensaje de ".$nombre.", Email:".$email.", Mensaje: ".$texto;
	
	//preparamos el mail
	include('Mail.php');
	include('Mail/mime.php');
	$crlf = "\n";
	$hdrs = array(
				  'From'    => $email ,
				  'Subject' => 'NUEVO MENSAJE'
				  );
	$mime = new Mail_mime($crlf);
	$mime->setTXTBody($text);
	$mime->setHTMLBody($html);
	$param["text_charset"]='UTF-8';
	$param["html_charset"]='UTF-8';
	$body = $mime->get($param);
	$hdrs = $mime->headers($hdrs);
	
	
	
	$host = "smtp.gmail.com";
	$username = "webmaster@blocreinventa.com";
	$password = "Kdua2353";	
	
	$to="info@blocreinventa.com";
	//Enviamos el mail
	$mail =& Mail::factory('smtp', array ('host' => $host,'auth' => true,'username' => $username,'password' => $password, 'port' => 587));
	$mail->send($to, $hdrs, $body);
	$ok=true;
	if ($ok){
		$contenido='Mensaje Enviado Correctamente, te contestaremos lo antes posible.<br /><br />'.$contenido;
	}
}

