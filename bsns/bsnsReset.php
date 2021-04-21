<?php
include ('bsnsInfoSystem.php');
$objInfoSystem = new InfoSystem();
switch ($_POST['c']) {
  case 1:
    $r = $objInfoSystem->getUserStatusByEmail($_POST['arg']);
    if($r==1){
      $r = $objInfoSystem->updatePwdByEmail($_POST['arg']);
      echo $r;
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
