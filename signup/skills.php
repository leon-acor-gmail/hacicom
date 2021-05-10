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
    $('#btnSaveDataLarge').click(function(){
      $('#divLoader').show();
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
          $.post('../bsns/bsnsSendEmail.php',{to:jsonObj.email,sub:'Registro exitoso',msg:'Su cuenta ha sido creada con éxito',name:jsonObj.nickname},function(t){
            objJsonLogin= {arg1:jsonObj.email};
            strJsonLogin = JSON.stringify(objJsonLogin);
            base64Login = objResources.utf8_to_b64(strJsonLogin);
            $.post('../bsns/bsnsHome.php',{c:11,arg:base64Login},function(u){
              window.location.href = '../home/?arg='+u;
            });
          });
        });
      });
    });

    $('#btnSaveDataSmall').click(function(){
      $('#divLoader').show();
      jsonStr = JSON.stringify(<?php echo $json; ?>);
      jsonObj = JSON.parse(jsonStr);
      $.post('../bsns/bsnsIndex.php',{c:2},function(r){
        for(i=0;i<r;i++){
          if($('#cbValSkillSmall'+i).prop('checked')){
            jsonObj['cbValSkill'+i]=$('#cbValSkillSmall'+i).val();
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
          <li><img class="iconStepper" src="../images/succes.svg"> Datos generales</li>
          <li><img class="iconStepper" src="../images/succes.svg"> Tu headshot</li>
          <li><img class="iconStepper" src="../images/active.svg"> Tus habilidades</li>
        </ul>
      </nav>
    </div>
  </div>
  <div class="divLarge">
    <div id="divFieldsSkillsLarge"></div>
    <div class="row w3-section">
      <div class="col"></div>
      <div class="col w3-center">
        <button id="btnSaveDataLarge" type="button" class="w3-button btnColorHaCi">Finalizar</button>
      </div>
      <div class="col"></div>
    </div>
  </div>
  <div class="divSmall">
    <div id="divFieldsSkillsSmall"></div>
    <div class="row w3-section">
      <div class="col">
        <button id="btnSaveDataSmall" type="button" class="w3-button btnColorHaCi">Finalizar</button>
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
