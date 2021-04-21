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
  <link rel="icon" type="image/png" href="../images/carrete.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../styles/cssPlaces.css">
  <link rel="stylesheet" href="../styles/cssCheckbox.css">
  <link rel="stylesheet" href="../styles/cssBreadcrums.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="../scripts/jsResources.js" ></script>
</head>
<body class="w3-black">
<script>
  var objResources = null;
  $(document).ready(function(){
    objResources = new jsResources();
    getCountries();

    $('#btnSaveData').click(function(){
      $.post('../bsns/bsnsHome.php',{c:2},function(s){
        jsonObj = JSON.parse('<?php echo $json; ?>');
        for(i=0;i<s;i++){
          if($('#cbValPlace'+i).prop('checked')){
            jsonObj['cbValPlace'+i]=$('#cbValPlace'+i).val();
          }
        }
        json = JSON.stringify(jsonObj);
        base = objResources.utf8_to_b64(json);
        window.location.href = "shot.php?arg="+base;
        //alert(JSON.stringify(jsonObj));
      });
    });
  });

  function getCountries(){
    $.post('../bsns/bsnsLoad.php',{c:1},function(r){
      objResources.populateListPlaces($('#divPlaces'),r);
    });
  }
</script>
<div class="container txtLineHKGrotesk">
  <div class="row w3-section w3-center">
    <div class="col align-self-center">
      <img src="../../images/web-brand-logotipo-2.png" class="imgMarginLogo" srcset="../../images/web-brand-logotipo-2@2x.png 2x,../../images/web-brand-logotipo-2@3x.png 3x">
    </div>
  </div>
  <div class="row divMarginBreadcrums w3-center">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ul class="breadcrumbSignup txtLineHKGrotesk txtStepper">
          <li><img class="iconStepper" src="../images/web-iconos-stepers-active.png" srcset="../images/web-iconos-stepers-active@2x.png 2x,../images/web-iconos-stepers-active@3x.png 3x"> Datos generales</li>
          <li><img class="iconStepper" src="../images/web-iconos-stepers-inactive.png" srcset="../images/web-iconos-stepers-inactive@2x.png 2x,../images/web-iconos-stepers-inactive@3x.png 3x"> Tu headshot</li>
          <li><img class="iconStepper" src="../images/web-iconos-stepers-inactive.png" srcset="../images/web-iconos-stepers-inactive@2x.png 2x,../images/web-iconos-stepers-inactive@3x.png 3x"> Tus intereses</li>
        </ul>
      </nav>
    </div>
  </div>

<div class="row">
  <div class="col-2"></div>
  <div class="col-8">

    <div class="card w3-margin">
      <div class="card-body w3-text-gray">
        <p class="card-title w3-large">Países disponibles para trabajar</p>
        <div id="divPlaces" class="divOverflow"></div>
      </div>
    </div>
    <div class="row w3-center divMargin">
      <div class="col"></div>
      <div class="col align-self-center"><button id="btnSaveData" type="submit" class="btn btnColorHaCi btnSignUp">Continuar</button></div>
      <div class="col"></div>
    </div>

  </div>
  <div class="col-2"></div>
</div>
<div>
<!--<div style="background-image: url('../images/web-brand-cintafondo.png');">-->
  <div class="divLarge">
    <div class="row w3-margin w3-padding">
      <div class="col w3-margin w3-padding">
        <label>Todos los derechos reservados 2021 - hagamoscine.com</label>
      </div>
    </div>
  </div>
  <div class="divSmall">
    <div class="row w3-margin w3-padding w3-center">
      <div class="col w3-margin w3-padding">
        <label>Todos los derechos reservados 2021 - hagamoscine.com</label>
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>
