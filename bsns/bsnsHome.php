<?php
include ('bsnsInfoSystem.php');
$objInfoSystem = new InfoSystem();
switch ($_POST['c']) {
  case 1:
    //echo 'Leo:'.$_POST['arg'];
    $r1=$objInfoSystem->setUser($_POST['arg']);
    $r2=$objInfoSystem->setUsersFieldsSkills($_POST['arg']);
    $r3=$objInfoSystem->setUsersCountries($_POST['arg']);
    $r4=$objInfoSystem->getUserShotSystemByEmail($_POST['arg']);
    echo $r1.$r2.$r3.$r4;
    //header('Location: ../home/?arg='.$r.'&result=1');
    break;
  case 2:
    echo $objInfoSystem->getCountCountries();
    break;
  case 3:
    echo $objInfoSystem->setLookup($_POST['arg']);
    break;
  case 4:
    echo $objInfoSystem->setUsersLinked($_POST['arg']);
    break;
  case 5:
    echo $objInfoSystem->getUsersLinked($_POST['arg']);
    break;
  case 6:
    $r1=$objInfoSystem->updateUsersLinkedOwn($_POST['arg']);
    $r2=$objInfoSystem->updateUsersLinkedLinked($_POST['arg']);
    echo $r1.'|'.$r2;
    break;
  case 7:
    $r1=$objInfoSystem->getUserRequestOwn($_POST['arg']);
    $r2=$objInfoSystem->getUserRequestLink($_POST['arg']);
    $r3=$objInfoSystem->getCountUserRequestOwn($_POST['arg']);
    $r4=$objInfoSystem->getCountUserRequestLink($_POST['arg']);
    echo $r1.'|'.$r2.'|'.$r3.'|'.$r4;
    break;
  case 8:
    $r1 = $objInfoSystem->updateRequestStatus($_POST['arg']);
    $r2 = $objInfoSystem->setUsersLinkedAccept($_POST['arg']);
    echo $r1.'|'.$r2;
    break;
  case 9:
    echo $objInfoSystem->getUserCountLinked($_POST['arg']);
  break;
  case 10:
    echo $objInfoSystem->setUsersMsg($_POST['arg']);
  break;
  case 11:
    $r0 = $objInfoSystem->getSkillsByUserForUpdate($_POST['arg']);
    $r1 = $objInfoSystem->getPlacesByUserForUpdate($_POST['arg'],$r0);
    $r2 = $objInfoSystem->getUser($_POST['arg'],$r1);
    echo $r2;
  break;
  case 12:
  echo $objInfoSystem->getUserFields($_POST['arg']);
  break;
  default:
    header('Location: ../');
    break;
}

?>
