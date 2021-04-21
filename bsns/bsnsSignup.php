<?php
$iC=$_GET['c'];
//$base=$_GET['arg'];
include ('bsnsInfoSystem.php');
$objInfoSystem = new InfoSystem();
switch ($iC) {
  case 1:
    $iUs = $objInfoSystem->getUserStatusByEmail($_GET['arg']);
    //echo $iUs;
    header('Location: ../signup/?arg='.$_GET['arg'].'&result='.$iUs);
    break;
  case 2:
    $r = $objInfoSystem->setProdLoadJSON($_GET['arg']);
    header('Location: ../home/?arg='.base64_encode($_GET['arg']).'&result=0');
    break;
  default:
    header('Location: ../');
    break;
}

?>
