<?php
session_start();
if(!isset($_SESSION['signup']))
{
    header('Location: https://www.hagamoscine.com');
}
$json = base64_decode($_GET['arg']);
$jsonObj = json_decode($json);
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

    $('#btnLargeSaveData').click(function(){
      $('#divLoader').show();
      $.post('../bsns/bsnsHome.php',{c:2},function(s){
        jsonObj = JSON.parse('<?php echo $json; ?>');
        for(i=0;i<s;i++){
          if($('#cbValPlaceLarge'+i).prop('checked')){
            jsonObj['cbValPlace'+i]=$('#cbValPlaceLarge'+i).val();
          }
        }
        json = JSON.stringify(jsonObj);
        base = objResources.utf8_to_b64(json);
        window.location.href = "shot.php?arg="+base;
      });
    });

    $('#btnSmallSaveData').click(function(){
      $('#divLoader').show();
      $.post('../bsns/bsnsHome.php',{c:2},function(s){
        jsonObj = JSON.parse('<?php echo $json; ?>');
        for(i=0;i<s;i++){
          if($('#cbValPlaceSmall'+i).prop('checked')){
            jsonObj['cbValPlace'+i]=$('#cbValPlaceSmall'+i).val();
          }
        }
        json = JSON.stringify(jsonObj);
        base = objResources.utf8_to_b64(json);
        window.location.href = "shot.php?arg="+base;
      });
    });

  });

  function getCountries(){
    $('#divLoader').show();
    $.post('../bsns/bsnsLoad.php',{c:1},function(r){
      objResources.populateListPlaces($('#divLargePlaces'),r,'Large');
      objResources.populateListPlaces($('#divSmallPlaces'),r,'Small');
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
            <li><img class="iconStepper" src="../images/active.svg"> Datos generales</li>
            <li><img class="iconStepper" src="../images/inactive.svg" > Tu headshot</li>
            <li><img class="iconStepper" src="../images/inactive.svg"> Tus habilidades</li>
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
          <div id="divLargePlaces" class="divOverflow"></div>
        </div>
      </div>
      <div class="row  w3-section">
        <div class="col"></div>
        <div class="col w3-center">
          <button id="btnLargeSaveData" type="submit" class="w3-button btnColorHaCi">Continuar</button>
        </div>
        <div class="col"></div>
      </div>
    </div>
    <div class="col-2"></div>
  </div>
</div>
<div class="divSmall">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body w3-text-gray">
          <p class="card-title w3-large">Países disponibles para trabajar</p>
          <div id="divSmallPlaces" class="divOverflow"></div>
        </div>
      </div>
    </div>
  </div>
    <div class="row w3-section">
      <div class="col w3-center">
        <button id="btnSmallSaveData" type="submit" class="w3-button btnColorHaCi">Continuar</button>
      </div>
    </div>
</div>
<div class="row w3-margin w3-padding txtFooter">
  <div class="col w3-margin w3-padding">
    <label>Todos los derechos reservados 2021 - hagamoscine.com</label>
  </div>
</div>
</div>
<div id="divLoader" class="w3-modal">
  <div class="w3-modal-content">
    <div class="imgLoader"></div>
  </div>
</div>
</body>
</html>
