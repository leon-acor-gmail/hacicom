<?php
$iC=$_POST['c'];
include ('bsnsInfoSystem.php') ;
$objInfoSystem = new InfoSystem();
switch ($iC) {
  case 1:
    echo $objInfoSystem->getCountries();
    break;
  case 2:
    echo $objInfoSystem->updateCountry($_POST['arg']);
    break;
  case 3:
    echo $objInfoSystem->setField($_POST['arg']);
    break;
  case 4:
    echo $objInfoSystem->getFields();
    break;
  case 5:
    echo $objInfoSystem->updateField($_POST['arg']);
  break;
  case 6:
    echo $objInfoSystem->setSkill($_POST['arg']);
    break;
  case 7:
    echo $objInfoSystem->getSkills();
    break;
  case 8:
    echo $objInfoSystem->updateSkill($_POST['arg']);
    break;
  case 9:
    $fields=$objInfoSystem->getFields();
    $skills=$objInfoSystem->getSkills();
    echo $fields.'|'.$skills;
    break;
  case 10:
    echo $objInfoSystem->setFieldsSkills($_POST['arg1'],$_POST['arg2']);
    break;
  case 11:
    $r1 = $objInfoSystem->getFieldsSkills();
    $r2 = $objInfoSystem->getCountSkillsByField();
     echo $r1.'|'.$r2;
    break;
  default:
    echo 'Error en busines load';
    break;
}
?>
