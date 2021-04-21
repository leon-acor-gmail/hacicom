<?php
$strTo = $_POST['to'];
$strSubject= $_POST['sub'];
$strMessage = $_POST['msg'];

$message = '
<html>
<head>
  <title>Hagamos Cine</title>
</head>
<body>
  <p>'.$strMessage.'</p>
  <p style="font-size:8px;">Nota: En cumplimiento a lo dispuesto por la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, Hagamos Cine pone a su disposición su <a href="https://www.hagamoscine.com/aviso.html">Politica de Privacidad</a>. Cualquier duda, consulta o requerimiento relacionado con dicha politica podrá ser dirigido a la siguiente dirección: hagamoscine.com@gmail.com</p>
</body>
</html>
';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html;  charset=iso-8859-1' . "\r\n";
$headers .= 'From: no-replay@hagamoscine.com'."\r\n";
//$headers .= 'Cc: leon.acor@gmail.com'."\r\n";
$headers .= 'Bcc: leon@hagamoscine.com' . "\r\n";

if(mail($strTo, utf8_decode($strSubject), utf8_decode($message), utf8_decode($headers))){
  echo '1';
}
else{
  echo '0';
}
//mail($strTo, utf8_decode($strSubject), utf8_decode($message), utf8_decode($headers));
//echo('1');

?>
