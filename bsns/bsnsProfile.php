<?php
include ('bsnsInfoSystem.php');
$objInfoSystem = new InfoSystem();
switch ($_POST['c']) {
  case 1:
    $r0 = $objInfoSystem->updateUserProfile($_POST['arg']);
    $r1 = $objInfoSystem->setUsersCountries($_POST['arg']);
    $r2 = $objInfoSystem->setUsersFieldsSkills($_POST['arg']);
    echo $r0.$r1.$r2;
    break;
  case 2:
    $r0 = $objInfoSystem->getSkillsByUserForUpdate($_POST['arg']);
    $r1 = $objInfoSystem->getPlacesByUserForUpdate($_POST['arg'],$r0);
    $r2 = $objInfoSystem->getUser($_POST['arg'],$r1);
    echo $r2;
    break;
  default:
    header('Location: ../');
    break;
}

?>
