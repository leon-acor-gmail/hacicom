<?php
session_start();
include ('bsnsInfoSystem.php');
$objInfoSystem = new InfoSystem();
switch ($_POST['c']) {
  case 1:
    $r = $objInfoSystem->getUserStatusForAdmin($_POST['arg']);
    if($r==1){
      $_SESSION['admin'] = true;
      echo '1';

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
