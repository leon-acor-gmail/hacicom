<?php
session_start();
if(!isset($_SESSION['signup']))
{
    header('Location: https://www.hagamoscine.com');
}
$json = base64_decode($_GET['arg']);
//$jsonObj = json_decode($json);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Hagamos Cine</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/svg" href="../images/favicon.svg">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../styles/cssTemplate.css">
  <link rel="stylesheet" href="../styles/cssPlaces.css">
  <link rel="stylesheet" href="../styles/cssCheckbox.css">
  <link rel="stylesheet" href="../styles/cssBreadcrums.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../scripts/jsResources.js" ></script>
</head>
<body class="bgColor w3-text-white txtFontFamily">
<script>
  var objResources = null;
  $(document).ready(function(){
    objResources = new jsResources();
    objResources.btnCatchBackRefresh();
    getCountries();
  });

  function btnSaveData(strResponsive){
    $('#divLoader').show();
    $.post('../bsns/bsnsHome.php',{c:2},function(s){
      objJson = JSON.parse('<?php echo $json; ?>');
      for(i=0;i<s;i++){
        if($('#cbValPlace'+strResponsive+i).prop('checked')){
          objJson['cbValPlace'+i]=$('#cbValPlace'+strResponsive+i).val();
        }
      }
      strJson = JSON.stringify(objJson);
      base64 = objResources.utf8_to_b64(strJson);
      window.location.href = "shot.php?arg="+base64;
    });
  }

  function getCountries(){
    $('#divLoader').show();
    $.post('../bsns/bsnsLoad.php',{c:1},function(r){
      objResources.populateListPlaces($('#divPlacesLarge'),r,'Large');
      objResources.populateListPlaces($('#divPlacesSmall'),r,'Small');
      $('#divLoader').hide();
    });
  }
</script>
<div class="container">
  <div class="row">
    <div class="col w3-center">
      <img src="../images/logo2.svg" class="imgMarginLogo" alt="Logo hagamoscine">
    </div>
  </div>
    <div class="row divMarginBreadcrums w3-center">
      <div class="col">
        <nav aria-label="breadcrumb">
          <ul class="breadcrumbSignup txtStepper w3-medium">
            <li><img class="iconStepper" src="../images/active.svg" alt="activo"> Datos generales</li>
            <li><img class="iconStepper" src="../images/inactive.svg" alt="inactivo"> Tu headshot</li>
            <li><img class="iconStepper" src="../images/inactive.svg" alt="inactivo"> Tus habilidades</li>
          </ul>
        </nav>
      </div>
    </div>
<div class="divLarge">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <div class="card w3-margin">
        <div class="card-body w3-text-gray">
          <p class="card-title w3-large">Países disponibles para trabajar</p>
          <div id="divPlacesLarge" class="divOverflow"></div>
        </div>
      </div>
    </div>
    <div class="col-2"></div>
  </div>
  <div class="row w3-section">
    <div class="col"></div>
    <div class="col w3-center">
      <button onclick="btnSaveData('Large');" class="w3-button btnColorHaCi">Continuar</button>
    </div>
    <div class="col"></div>
  </div>
</div>
<div class="divSmall">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body w3-text-gray">
          <p class="card-title w3-large">Países disponibles para trabajar</p>
          <div id="divPlacesSmall" class="divOverflow"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row w3-section">
    <div class="col w3-center">
      <button onclick="btnSaveData('Small');" class="w3-button btnColorHaCi">Continuar</button>
    </div>
  </div>
</div>
<div class="divFooter txtFooter">
  <label>Todos los derechos reservados 2021 - hagamoscine.com</label>
</div>
</div>
<div id="divLoader" class="w3-modal">
  <div class="w3-modal-content">
    <div class="imgLoader"></div>
  </div>
</div>
</body>
</html>
