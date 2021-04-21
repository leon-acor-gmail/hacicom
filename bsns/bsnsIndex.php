<?php
$iC=$_POST['c'];
//$base=$_GET['arg'];
include ('bsnsInfoSystem.php');
$objInfoSystem = new InfoSystem();
switch ($iC) {
  case 1:
    echo $objInfoSystem->getCountries();
    break;
  case 2:
    echo $objInfoSystem->getCountFieldsSkills();
    break;
  default:
    header('https://www.hagamoscine.com');
    break;
}

?>
