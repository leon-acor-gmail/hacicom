<?php
session_start();
if(!isset($_SESSION['signup']))
{
    header('Location: https://www.hagamoscine.com');
}
$json = base64_decode($_GET['arg']);
//echo 'json: '.$json;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Hagamos Cine</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="icon" type="image/png" href="../../images/carrete.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../styles/cssSkills.css">
  <link rel="stylesheet" href="../../styles/cssBreadcrums.css">
  <link rel="stylesheet" href="../../styles/cssCheckbox.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="../scripts/jsResources.js" ></script>
</head>
<body class="w3-black txtLineHKGrotesk">
<script>
  var objResources = null;
  $(document).ready(function(){
    objResources = new jsResources();
    getFieldsSkills();
    $('#btnSaveData').click(function(){
      jsonStr = JSON.stringify(<?php echo $json; ?>);
      jsonObj = JSON.parse(jsonStr);
      $.post('../bsns/bsnsIndex.php',{c:2},function(r){
        for(i=0;i<r;i++){
          if($('#cbValSkillLarge'+i).prop('checked')){
            jsonObj['cbValSkill'+i]=$('#cbValSkillLarge'+i).val();
          }
        }
        jsonStr = JSON.stringify(jsonObj);
        base = objResources.utf8_to_b64(jsonStr);
        $.post('../bsns/bsnsHome.php',{c:1,arg:base},function(s){
          $.post('../bsns/bsnsSendEmail.php',{to:jsonObj.email,sub:'Registro exitoso',msg:'Su cuenta ha sido creada con éxito'},function(t){
            window.location.href = '../home/?arg='+base;
          });
        });
      });
    });
  });

  function getFieldsSkills(){
    $.post('../bsns/bsnsLoad.php',{c:11},function(r){
      //alert(r);
      objResources.populateFieldsSkills($('#divFieldsSkills'),r,'Large');
    });
  }

  function setColorField(element){}
</script>
<div class="container txtLineHKGrotesk">
  <div class="row w3-section w3-center">
    <div class="col align-self-center">
      <img src="../../images/web-brand-logotipo-2.png" class="imgMarginLogo" srcset="../../images/web-brand-logotipo-2@2x.png 2x,../../images/web-brand-logotipo-2@3x.png 3x">
    </div>
  </div>
  <div class="row divMarginBreadcrums w3-medium w3-center">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ul class="breadcrumbSignup txtLineHKGrotesk txtStepper">
          <li><img class="iconStepper" src="../images/web-iconos-stepers-succes.png" srcset="../images/web-iconos-stepers-succes@2x.png 2x,../images/web-iconos-stepers-succes@3x.png 3x"> Datos generales</li>
          <li><img class="iconStepper" src="../images/web-iconos-stepers-succes.png" srcset="../images/web-iconos-stepers-succes@2x.png 2x,../images/web-iconos-stepers-succes@3x.png 3x"> Tu Headshot</li>
          <li><img class="iconStepper" src="../images/web-iconos-stepers-inactive.png" srcset="../images/web-iconos-stepers-inactive@2x.png 2x,../images/web-iconos-stepers-inactive@3x.png 3x"> Tus intereses</li>
        </ul>
      </nav>
    </div>
  </div>
  <div id="divFieldsSkills"></div>
  <div class="row w3-center divMargin">
    <div class="col"></div>
    <div class="col align-self-center"><button id="btnSaveData" type="button" class="btn btnColorHaCi btnSkills">Finalizar</button></div>
    <div class="col"></div>
  </div>
  <div>
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
