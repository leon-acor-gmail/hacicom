<?php
session_start();
if(!isset($_SESSION['signup']))
{
    header('Location: https://www.hagamoscine.com');
}
$json = base64_decode($_GET['arg']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Hagamos Cine</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="icon" type="image/svg" href="../images/favicon.svg">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../styles/cssTemplate.css">
  <link rel="stylesheet" href="../styles/cssSkills.css">
  <link rel="stylesheet" href="../styles/cssBreadcrums.css">
  <link rel="stylesheet" href="../styles/cssCheckbox.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="../scripts/jsResources.js" ></script>
</head>
<body class="bgColor w3-text-white txtFontFamily">
<script>
  var objResources = null;
  $(document).ready(function(){
    objResources = new jsResources();
    objResources.btnCatchBackRefresh();
    getFieldsSkills();
  });

  function btnSaveData(strResponsive){
    $('#divLoader').show();
    strJson = JSON.stringify(<?php echo $json; ?>);
    objJson = JSON.parse(strJson);
    $.post('../bsns/bsnsIndex.php',{c:2},function(r){
      for(i=0;i<r;i++){
        if($('#cbValSkill'+strResponsive+i).prop('checked')){
          objJson['cbValSkill'+i]=$('#cbValSkill'+strResponsive+i).val();
        }
      }
      strJson = JSON.stringify(objJson);
      base = objResources.utf8_to_b64(strJson);
      $.post('../bsns/bsnsHome.php',{c:1,arg:base},function(s){
        $.post('../bsns/bsnsSendEmail.php',{to:objJson.email,sub:'Registro exitoso',msg:'Su cuenta ha sido creada con éxito',name:objJson.nickname},function(t){
          objJsonLogin= {arg1:objJson.email};
          strJsonLogin = JSON.stringify(objJsonLogin);
          base64Login = objResources.utf8_to_b64(strJsonLogin);
          $.post('../bsns/bsnsHome.php',{c:11,arg:base64Login},function(u){
            window.location.href = '../home/?arg='+u;
          });
        });
      });
    });
  }

  function getFieldsSkills(){
    $('#divLoader').show();
    $.post('../bsns/bsnsLoad.php',{c:11},function(r){
      objResources.populateFieldsSkills($('#divFieldsSkillsLarge'),r,'Large');
      objResources.populateFieldsSkills($('#divFieldsSkillsSmall'),r,'Small');
      $('#divLoader').hide();
    });
  }

  function setColorField(element){
    $('.collapseColorHaCiSelected').each(function(i, obj) {
        $(this).removeClass('collapseColorHaCiSelected').addClass('collapseColorHaCi');
    });
    $(element).removeClass('collapseColorHaCi').addClass('collapseColorHaCiSelected');
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
          <li><img class="iconStepper" src="../images/succes.svg" alt="hecho"> Datos generales</li>
          <li><img class="iconStepper" src="../images/succes.svg" alt="hecho"> Tu headshot</li>
          <li><img class="iconStepper" src="../images/active.svg" alt="activo"> Tus habilidades</li>
        </ul>
      </nav>
    </div>
  </div>
  <div class="divLarge">
    <div id="divFieldsSkillsLarge"></div>
    <div class="row w3-section">
      <div class="col"></div>
      <div class="col w3-center">
        <button onclick="btnSaveData('Large');" type="button" class="w3-button btnColorHaCi">Finalizar</button>
      </div>
      <div class="col"></div>
    </div>
  </div>
  <div class="divSmall">
    <div id="divFieldsSkillsSmall"></div>
    <div class="row w3-section">
      <div class="col">
        <button onclick="btnSaveData('Small');" type="button" class="w3-button btnColorHaCi">Finalizar</button>
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
