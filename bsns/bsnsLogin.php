<?php
include ('bsnsInfoSystem.php');
$objInfoSystem = new InfoSystem();
switch ($_POST['c']) {
  case 1:
    $r = $objInfoSystem->getUserStatus($_POST['arg']);
    if($r==1){
      $r0 = $objInfoSystem->getSkillsByUserForUpdate($_POST['arg']);
      $r1 = $objInfoSystem->getPlacesByUserForUpdate($_POST['arg'],$r0);
      $r2 = $objInfoSystem->getUser($_POST['arg'],$r1);
      echo $r2;
      //echo $res.'|'.$r1;
    }
    else{
      echo '0';
    }
    break;
  default:
    header('Location: ../');
    break;
}

?>
