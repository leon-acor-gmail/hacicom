<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$strTo = $_POST['to'];
$strSubject= $_POST['sub'];
$strMessage = $_POST['msg'];
$strToName=$_POST['name'];
$mail = new PHPMailer(true);
try
{
  $mail->CharSet = 'UTF-8';
  //$mail->SMTPDebug=4;
  $mail->isSMTP();
  $mail->Host='p3plzcpnl447270.prod.phx3.secureserver.net';
  $mail->SMTPAuth=true;
  $mail->Username='noreplay@hagamoscine.com';
  $mail->Password='P2+6vg(rMuAB';
  $mail->SMTPSecure=PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port=465;
  $mail->setFrom('noreplay@hagamoscine.com','Hagamos Cine');
  $mail->addAddress($strTo,$strToName);
  $mail->addBCC('leon@hagamoscine.com');
  $mail->Subject=$strSubject;
  $mail->Body='<!DOCTYPE html><html lang="es"><head><title>Hagamos Cine</title><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head><body><p>Apreciable '.$strToName.',</p><p>'.$strMessage.'</p><p style="font-size:12px;">Nota: En cumplimiento a lo dispuesto por la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, Hagamos Cine pone a su disposición su <a href="https://www.hagamoscine.com/aviso.html">politica de privacidad</a>, cualquier duda, consulta o requerimiento relacionado con dicha politica podrá ser dirigido a la siguiente dirección: hagamoscine.com@gmail.com</p></body></html>';
  $mail->isHTML(true);
  $mail->send();
  echo 1;
  //echo 'hagamoscine: envío de correo OK';
}
catch (Exception $e)
{
  echo 0;
  //echo "hagamoscine: envío de correo NOK. Traza: {$mail->ErrorInfo}";
}

?>
