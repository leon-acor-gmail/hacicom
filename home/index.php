<?php
session_start();
if(isset($_GET['result']))
{
  $_SESSION['login'] = true;
  $objJson = json_decode(base64_decode($_GET['arg']));
}
else
{
  //new user
  if(isset($_SESSION['signup']))
  {
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    $iC=2;
    $json = base64_decode($_GET['arg']);
    header('Location: ../bsns/bsnsSignup.php?arg='.$json.'&c='.$iC);
  }
  else{
    header('Location: https://www.hagamoscine.com');
  }
}
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
  <link rel="stylesheet" href="../styles/cssHome.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="../scripts/jsResources.js" ></script>
  <script src="../scripts/jquery.md5.js"></script>
</head>
<body class="bgColor w3-text-white txtFontFamily">
<script>
  var objResources = null;
  $(document).ready(function(){
    objResources = new jsResources();
    getFieldsSkills();

    window.setInterval(function(){
      getUserRequest();
      //getChat();
    }, 10000);

    $('#btnSaveDataMsgLarge').click(function(a){
        var b = document.getElementsByTagName('form')[0];
        if(b.checkValidity())
        {
          strToMsg=$('#lblToMsgEmail').text();
          if(strToMsg.length>0)
          {
            objJson = {
              arg1:'<?php echo $objJson->email ?>',
              arg2:strToMsg,
              arg3:$('#txtSaveDataMsgLarge').val()
            };
            strJson=JSON.stringify(objJson);
            base=objResources.utf8_to_b64(strJson);
            $.post('../bsns/bsnsHome.php',{c:10,arg:base},function(r){
              alert(r);
            });
          }
          else{
            setDivAlert('Atención','Debes elegir a alguien de tu crew para enviar mensaje',false);
          }
          a.preventDefault();
        }
    });

    $('.navbar-nav>li>a').on('click', function(){
      $('.navbar-collapse').collapse('hide');
    });

    $('#btnUpdateProfileLarge').click(function(){
      window.location.href = "../profile/?arg="+'<?php echo $_GET['arg']; ?>';
    });

    $('#btnUpdateProfileSmall').click(function(){
      window.location.href = "../profile/?arg="+'<?php echo $_GET['arg']; ?>';
    });

    $('#btnLookupLarge').click(function(){
      getDropboxFieldsSkills('Large');
    });

    $('#btnLookupSmall').click(function(){
      getDropboxFieldsSkills('Small');
    });

    $('#icoMainLarge').click(function(){
      $("#icoMainLarge").removeClass("w3-text-gray w3-hover-text-light-grey").addClass( "w3-text-light-grey w3-hover-text-grey" );
      $("#icoMyCrewLarge").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );
      $("#icoNotificationsLarge").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );
      $("#icoMessagesLarge").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );

      $("#divChildMainLarge").removeClass("divHide").addClass( "divShow" );
      $("#divChildMyCrewLarge").removeClass("divShow").addClass( "divHide" );
      $("#divChildNotificationsLarge").removeClass("divShow").addClass( "divHide" );
      $("#divChildMessagesLarge").removeClass("divShow").addClass( "divHide" );

    });

    $('#icoMainSmall').click(function(){
      $("#icoMainSmall").removeClass("w3-text-gray w3-hover-text-light-grey").addClass( "w3-text-light-grey w3-hover-text-grey" );
      $("#icoMyCrewSmall").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );
      $("#icoNotificationsSmall").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );
      $("#icoMessagesSmall").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );

      $("#divChildMainSmall").removeClass("divHide").addClass( "divShow" );
      $("#divChildMyCrewSmall").removeClass("divShow").addClass( "divHide" );
      $("#divChildNotificationsSmall").removeClass("divShow").addClass( "divHide" );
      $("#divChildMessagesSmall").removeClass("divShow").addClass( "divHide" );
    });

    $('#icoMyCrewLarge').click(function(){
      $("#icoMyCrewLarge").removeClass("w3-text-gray w3-hover-text-light-grey").addClass( "w3-text-light-grey w3-hover-text-grey" );
      $("#icoMainLarge").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );
      $("#icoNotificationsLarge").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );
      $("#icoMessagesLarge").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );

      $("#divChildMyCrewLarge").removeClass("divHide").addClass( "divShow" );
      $("#divChildMainLarge").removeClass("divShow").addClass( "divHide" );
      $("#divChildNotificationsLarge").removeClass("divShow").addClass( "divHide" );
      $("#divChildMessagesLarge").removeClass("divShow").addClass( "divHide" );
    });

    $('#icoMyCrewSmall').click(function(){
      $("#icoMyCrewSmall").removeClass("w3-text-gray w3-hover-text-light-grey").addClass( "w3-text-light-grey w3-hover-text-grey" );
      $("#icoMainSmall").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );
      $("#icoNotificationsSmall").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );
      $("#icoMessagesSmall").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );

      $("#divChildMyCrewSmall").removeClass("divHide").addClass( "divShow" );
      $("#divChildMainSmall").removeClass("divShow").addClass( "divHide" );
      $("#divChildNotificationsSmall").removeClass("divShow").addClass( "divHide" );
      $("#divChildMessagesSmall").removeClass("divShow").addClass( "divHide" );
    });

    $('#icoNotificationsLarge').click(function(){
      $("#icoNotificationsLarge").removeClass("w3-text-gray w3-hover-text-light-grey").addClass( "w3-text-light-grey w3-hover-text-grey" );
      $("#icoMyCrewLarge").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );
      $("#icoMainLarge").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );
      $("#icoMessagesLarge").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );

      $("#divChildNotificationsLarge").removeClass("divHide").addClass( "divShow" );
      $("#divChildMyCrewLarge").removeClass("divShow").addClass( "divHide" );
      $("#divChildMainLarge").removeClass("divShow").addClass( "divHide" );
      $("#divChildMessagesLarge").removeClass("divShow").addClass( "divHide" );
    });

    $('#icoNotificationsSmall').click(function(){
      $("#icoNotificationsSmall").removeClass("w3-text-gray w3-hover-text-light-grey").addClass( "w3-text-light-grey w3-hover-text-grey" );
      $("#icoMyCrewSmall").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );
      $("#icoMainSmall").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );
      $("#icoMessagesSmall").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );

      $("#divChildNotificationsSmall").removeClass("divHide").addClass( "divShow" );
      $("#divChildMyCrewSmall").removeClass("divShow").addClass( "divHide" );
      $("#divChildMainSmall").removeClass("divShow").addClass( "divHide" );
      $("#divChildMessagesSmall").removeClass("divShow").addClass( "divHide" );
    });

    $('#icoMessagesLarge').click(function(){
      $("#icoMessagesLarge").removeClass("w3-text-gray w3-hover-text-light-grey").addClass( "w3-text-light-grey w3-hover-text-grey" );
      $("#icoMyCrewLarge").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );
      $("#icoNotificationsLarge").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );
      $("#icoMainLarge").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );

      $("#divChildMessagesLarge").removeClass("divHide").addClass( "divShow" );
      $("#divChildMyCrewLarge").removeClass("divShow").addClass( "divHide" );
      $("#divChildNotificationsLarge").removeClass("divShow").addClass( "divHide" );
      $("#divChildMainLarge").removeClass("divShow").addClass( "divHide" );
    });

    $('#icoMessagesSmall').click(function(){
      $("#icoMessagesSmall").removeClass("w3-text-gray w3-hover-text-light-grey").addClass( "w3-text-light-grey w3-hover-text-grey" );
      $("#icoMyCrewSmall").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );
      $("#icoNotificationsSmall").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );
      $("#icoMainSmall").removeClass("w3-text-light-grey w3-hover-text-grey").addClass( "w3-text-gray w3-hover-text-light-grey" );

      $("#divChildMessagesSmall").removeClass("divHide").addClass( "divShow" );
      $("#divChildMyCrewSmall").removeClass("divShow").addClass( "divHide" );
      $("#divChildNotificationsSmall").removeClass("divShow").addClass( "divHide" );
      $("#divChildMainSmall").removeClass("divShow").addClass( "divHide" );
    });

    $('#btnCallLarge').click(function(){
      $("#divCallLarge").removeClass("divHide").addClass( "divShow" );
      $("#divCrewLookforLarge").removeClass("divShow").addClass( "divHide" );

      $('#btnCallLarge').addClass( "active" );
      $('#btnLookforCrewLarge').removeClass("active");
    });

    $('#btnLookforCrewLarge').click(function(){
      $("#divCallLarge").removeClass("divShow").addClass( "divHide" );
      $("#divCrewLookforLarge").removeClass("divHide").addClass( "divShow" );

      $('#btnCallLarge').removeClass( "active" );
      $('#btnLookforCrewLarge').addClass("active");
    });

    $('#btnCallSmall').click(function(){
      $("#divCallSmall").removeClass("divHide").addClass( "divShow" );
      $("#divCrewLookforSmall").removeClass("divShow").addClass( "divHide" );

      $('#btnCallSmall').addClass( "active" );
      $('#btnLookforCrewSmall').removeClass("active");
    });

    $('#btnLookforCrewSmall').click(function(){
      $("#divCallSmall").removeClass("divShow").addClass( "divHide" );
      $("#divCrewLookforSmall").removeClass("divHide").addClass( "divShow" );

      $('#btnCallSmall').removeClass( "active" );
      $('#btnLookforCrewSmall').addClass("active");
    });

    var strShotSystem = '../uploads/<?php echo $objJson->shotSystem ?>';
    var strName = '<?php echo $objJson->name ?>';
    objResources.getShotOrientation(strShotSystem,'Icon',$('#divShotSystemIcon'),$('#divLoader'),strName);
  });

  function setToMsg(strToName,strToEmail){
    $('#lblToMsgEmail').text(strToEmail);
    $('#lblToMsgName').text('Enviar mensaje a '+strToName);
  }

  function getChat(){
    objJson = {email:'<?php echo $objJson->email ?>'};
    strJson=JSON.stringify(objJson);
    base=objResources.utf8_to_b64(strJson);
    $.post('../bsns/bsnsHome.php',{c:5,arg:base},function(r){
      respContacts = objResources.b64_to_utf8(r);
      objResources.populateListChatContacts($('#divGetChatLargeContacts'),respContacts);
    });
  }

  function setLookupSkillSpan(strElement,strCode,idElement){
    objResources.populateLookupSkillSpan($('#divDropboxFieldsSkillsLargeSpan'),strElement,strCode,idElement,'Large');
    objResources.populateLookupSkillSpan($('#divDropboxFieldsSkillsSmallSpan'),strElement,strCode,idElement,'Small');
  }

  function setLookupPlaceSpan(strElement,strCode,idElement){
    objResources.populateLookupPlaceSpan($('#divDropboxCountriesLargeSpan'),strElement,strCode,idElement,'Large');
    objResources.populateLookupPlaceSpan($('#divDropboxCountriesSmallSpan'),strElement,strCode,idElement,'Small');
  }

  function getFieldsSkills(){
    $('#divLoader').show();
    $.post('../bsns/bsnsLoad.php',{c:11},function(r){
      objResources.populateDropboxFieldsSkils($('#divDropboxFieldsSkillsLarge'),r,'Large');
      objResources.populateDropboxFieldsSkils($('#divDropboxFieldsSkillsSmall'),r,'Small');
      getCountries();
    });
  }

  function getCountries(){
    $.post('../bsns/bsnsLoad.php',{c:1},function(r){
      objResources.populateDropboxCountries($('#divDropboxCountriesLarge'),r,'Large');
      objResources.populateDropboxCountries($('#divDropboxCountriesSmall'),r,'Small');
      getUsersLinked();
    });
  }

  function getUsersLinked(){
    objJson = {email:'<?php echo $objJson->email ?>'};
    strJson=JSON.stringify(objJson);
    base=objResources.utf8_to_b64(strJson);
    $.post('../bsns/bsnsHome.php',{c:5,arg:base},function(r){
      resp = objResources.b64_to_utf8(r);
      objResources.populateCardsLookupResults($('#divGetUsersLinkedLarge'),resp,'<?php echo $objJson->email ?>',0,1,'<?php echo $objJson->nickname ?>');
      objResources.populateCardsLookupResults($('#divGetUsersLinkedSmall'),resp,'<?php echo $objJson->email ?>',1,1,'<?php echo $objJson->nickname ?>');
    });
  }

  function getUserRequest(){
    objJson = {email:'<?php echo $objJson->email ?>'};
    strJson=JSON.stringify(objJson);
    base=objResources.utf8_to_b64(strJson);
    $.post('../bsns/bsnsHome.php',{c:7,arg:base},function(r){
        arrR=r.split('|');
        r0 = objResources.b64_to_utf8(arrR[0]);
        r1 = objResources.b64_to_utf8(arrR[1]);
        r2=arrR[2];
        r3=arrR[3];
        totalAlertNotification=parseInt(r2)+parseInt(r3);
      if(totalAlertNotification>0){
        $('#badgeNotificationLarge').html(totalAlertNotification);
        $('#badgeNotificationLarge').css('display','block');
        $('#badgeNotificationSmall').css('display','block');
        objResources.populateUserRequest($('#divGetNotificationsLarge'),r0,r1,0);
        objResources.populateUserRequest($('#divGetNotificationsSmall'),r0,r1,1);
        //getChat();
      }
      else {
        $('#divGetNotificationsLarge').html('No tienes notificaciones');
        $('#divGetNotificationsSmall').html('No tienes notificaciones');
        $('#badgeNotificationLarge').css('display','none');
        $('#badgeNotificationSmall').css('display','none');
        //getChat();
      }
      $('#divLoader').hide();
    });
  }

  function setDivAlert(strHeaderMsg,strMsg,bPremium){
    if(bPremium){
      $('#btnGetPremium').css("display", "block");
    }
    else {
      $('#btnGetPremium').css("display", "none");
    }
    $('#txtMsgHeaderAlert').text(strHeaderMsg);
    $('#txtMsgAlert').text(strMsg);
    $('#divAlert').show();
  }

  function getDropboxFieldsSkills(strResponsive){
    $('#divLoader').show();
    objJson = {};
    objJson.email = '<?php echo $objJson->email ?>';
    $.post('../bsns/bsnsIndex.php',{c:2},function(r){
      iIndex = 1;
      for(i=1;i<=r;i++){
        if($('#cbValSkill'+strResponsive+i).prop('checked')){
          objJson['cbValSkill'+i]=$('#cbValSkill'+strResponsive+i).val();
        }
        else {
          iIndex++;
        }
      }
      var z = Number(r)+1;
      if(iIndex==z)
      {
        $('#divLoader').hide();
        setDivAlert('Atención','Necesitas seleccionar al menos una habilidad',false);
      }
      else
      {
        iIndex = 1;
        $.post('../bsns/bsnsHome.php',{c:2},function(s){
          for(j=1;j<=s;j++){
            if($('#cbValPlace'+strResponsive+j).prop('checked')){
              objJson['cbValPlace'+j]=$('#cbValPlace'+strResponsive+j).val();
            }
            else {
              iIndex++;
            }
          }
          z = Number(s)+1;
         if(iIndex==z)
         {
           $('#divLoader').hide();
           setDivAlert('Atención','Necesitas seleccionar al menos una hubicación',false);
         }
         else
         {
            strJson = JSON.stringify(objJson);
            base = objResources.utf8_to_b64(strJson);
            $.post('../bsns/bsnsHome.php',{c:3,arg:base},function(t){
              resp = objResources.b64_to_utf8(t);
              objResources.populateCardsLookupResults($('#divCardsLookupResultsLarge'),resp,'<?php echo $objJson->email ?>',0,0,'<?php echo $objJson->nickname ?>');
              objResources.populateCardsLookupResults($('#divCardsLookupResultsSmall'),resp,'<?php echo $objJson->email ?>',1,0,'<?php echo $objJson->nickname ?>');
              $('#divLoader').hide();
            });
          }
        });
      }
  });
}
</script>
<div class="container">
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:rgba(255, 255, 255, 0.23);box-shadow: 1px 1px 2px grey;" >
    <a class="navbar-brand w3-margin divSmall" href="#"><img style="width:190px;height:auto;" src="../images/logo2.svg" alt="Logo Hagamos Cine"></a>
    <a class="navbar-brand w3-margin divLarge" href="#"><img src="../images/logo2.svg" alt="Logo Hagamos Cine"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a title="Página de Inicio" class="nav-link divLarge" href="#"><i id="icoMainLarge" class="fa fa-home w3-xxlarge w3-text-light-grey w3-hover-text-grey txtMarginIcon"></i></a>
            <a title="Página de Inicio" id="icoMainSmall" class="nav-link divSmall w3-large w3-text-light-grey w3-hover-text-grey" href="#">Principal</a>
          </li>
          <li class="nav-item">
            <a title="Página de Mi Crew" class="nav-link divLarge" href="#"><i id="icoMyCrewLarge" class="fa fa-users w3-xxlarge w3-text-gray w3-hover-text-light-grey txtMarginIcon"></i></a>
            <a title="Página de Mi Crew" id="icoMyCrewSmall" class="nav-link divSmall w3-large w3-text-gray w3-hover-text-light-grey" href="#">Mi Crew</a>
          </li>
          <li class="nav-item">
            <a title="Página de Notificaciones" class="nav-link divLarge notificationAlert" href="#"><i id="icoNotificationsLarge" class="fa fa-bell w3-xxlarge w3-text-gray w3-hover-text-light-grey txtMarginIcon"></i><span id="badgeNotificationLarge" style="display:none;" class="badgeAlert w3-small"></span></a>
            <a title="Página de Notificaciones" id="icoNotificationsSmall" class="nav-link divSmall w3-large w3-text-gray w3-hover-text-light-grey" href="#">Notificaciones <span id="badgeNotificationSmall" style="display:none;" class="badge badge-danger">Tienes notificaciones</span></a>
          </li>
          <li class="nav-item">
            <a title="Página de Centro de Mensajes" class="nav-link divLarge" href="#"><i id="icoMessagesLarge" class="fa fa-comments w3-xxlarge w3-text-gray w3-hover-text-light-grey txtMarginIcon"></i></a>
            <a title="Página de Centro de Mensajes" id="icoMessagesSmall" class="nav-link divSmall w3-large w3-text-gray w3-hover-text-light-grey" href="#">Centro de mensajes</a>
          </li>
          <li class="nav-item w3-margin divSmall">
            <a class="w3-large"><?php echo $objJson->nickname ?></a><br>
            <a id="btnUpdateProfileSmall" class="w3-button w3-block w3-purple" style="margin-top:15px;text-decoration: none;">Actualizar perfil</a>
            <a href="../bsns/bsnsLogout.php" class="w3-button w3-block w3-pink" style="margin-top:5px;text-decoration: none;">Cerrar sesión</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item dropdown txtMarginNameProfile divLarge">
            <a class="nav-link dropdown-toggle w3-medium" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $objJson->nickname ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a id="btnUpdateProfileLarge" class="dropdown-item" href="#">Actualizar perfil</a>
              <a class="dropdown-item" href="../bsns/bsnsLogout.php">Cerrar sesión</a>
            </div>
          </li>
          <li class="nav-item divLarge">
            <a class="nav-link" href="#">
              <div id="divShotSystemIcon"></div>
            </a>
          </li>
        </ul>
      </div>
  </nav>
  <div id="divMainLarge" class="divLarge">
    <div id="divChildMainLarge" class="divShow">
      <div class="topnav">
        <a class="active aNavElement txtHover" id="btnCallLarge">Buscar convocatorias</a>
        <a class="aNavElement txtHover" id="btnLookforCrewLarge">Buscar crew</a>
      </div>
      <div id="divCallLarge" class="row w3-margin divShow">
        <div class="col">
          <label>En construcción</label>
        </div>
      </div>
      <div id="divCrewLookforLarge" class="row w3-margin divHide">
        <div class="row w3-margin">
          <div class="col">Encuentra los mejores perfiles segmentando tu busqueda</div>
        </div>
        <div class="row w3-margin">
          <div class="col">
            <div id="divDropboxFieldsSkillsLarge"></div>
            <div id="divDropboxFieldsSkillsLargeSpan"></div>
          </div>
          <div class="col">
            <div id="divDropboxCountriesLarge"></div>
            <div id="divDropboxCountriesLargeSpan"></div>
          </div>
          <div class="col">
            <button id="btnLookupLarge" class="w3-button btnColorHaCi" style="width:auto;"><i class="fa fa-search"></i></button>
          </div>
          <div class="col"></div>
          <div class="col"></div>
        </div>
        <div class="row">
          <div class="col-1"></div>
          <div class="col-10">
            <div id="divCardsLookupResultsLarge"></div>
          </div>
          <div class="col-1"></div>
        </div>
      </div>
    </div>
  </div>
  <div id="divMainSmall" class="divSmall">
    <div id="divChildMainSmall" class="divShow">
      <div class="topnav">
        <a class="active aNavElement txtHover" id="btnCallSmall">Buscar convocatorias</a>
        <a class="aNavElement txtHover" id="btnLookforCrewSmall">Buscar crew</a>
      </div>
      <div id="divCallSmall" class="row w3-margin divShow">
        <div class="col">
          <label>En construcción</label>
        </div>
      </div>
      <div id="divCrewLookforSmall" class="row w3-margin divHide">
          <div class="row">
            <div class="col">Encuentra los mejores perfiles segmentando tu busqueda</div>
          </div>
          <div class="row">
            <div class="col" style="margin-top:20px;margin-bottom:10px;">
              <div id="divDropboxFieldsSkillsSmall"></div>
              <div id="divDropboxFieldsSkillsSmallSpan"></div>
            </div>
          </div>
          <div class="row">
            <div class="col" style="margin-top:10px;margin-bottom:10px;">
              <div id="divDropboxCountriesSmall"></div>
              <div id="divDropboxCountriesSmallSpan"></div>
            </div>
          </div>
          <div class="row">
            <div class="col" style="margin-top:10px;margin-bottom:10px;">
              <button id="btnLookupSmall" class="w3-button btnColorHaCi" style="width:100%;"><i class="fa fa-search"></i></button>
            </div>
          </div>
        <div id="divCardsLookupResultsSmall"></div>
      </div>
    </div>
  </div>
  <div id="divMyCrewLarge" class="divLarge">
    <div id="divChildMyCrewLarge" class="divHide">
      <div class="topnav">
        <!--<a class="active aNavElement" id="btnMyCallLarge">Mis convocatorias</a>-->
        <a class="active aNavElement txtHover" id="btnLookforMyCrewLarge">Mi crew</a>
      </div>
      <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
          <div id="divGetUsersLinkedLarge"></div>
        </div>
        <div class="col-1"></div>
      </div>
    </div>
  </div>
  <div id="divMyCrewSmall" class="divSmall">
    <div id="divChildMyCrewSmall" class="divHide">
      <div class="topnav">
        <!--<a class="active aNavElement" id="btnMyCallSmall">Mis convocatorias</a>-->
        <a class="active aNavElement txtHover" id="btnLookforMyCrewSmall">Mi crew</a>
      </div>
      <div id="divGetUsersLinkedSmall"></div>
    </div>
  </div>
  <div id="divNotificationsLarge" class="divLarge">
    <div id="divChildNotificationsLarge" class="divHide">
      <div class="row w3-margin">
        <div class="col-1"></div>
        <div class="col-10">
          <div id="divGetNotificationsLarge">No tienes notificaciones</div>
        </div>
        <div class="col-1"></div>
      </div>
    </div>
  </div>
  <div id="divNotificationsSmall" class="divSmall">
    <div id="divChildNotificationsSmall" class="divHide">
      <div id="divGetNotificationsSmall">No tienes notificaciones</div>
    </div>
  </div>
  <div id="divMessagesLarge" class="divLarge">
    <div id="divChildMessagesLarge" class="divHide">
      <label>En construcción</label>
      <!--<div id="divGetChatLarge">
        <div class="row">
          <div class="col-3">
            <div id="divGetChatLargeContacts" class="w3-round w3-bar-block" style="background-color:rgba(255,255,255,0.55);margin-top:10px;"></div>
          </div>
          <div class="col-9">
            <div id="divGetChatLargeMessages">
              <div id="divGetChatLargeMessagesTop" style="margin-top:10px;">
                <form>
                  <div class="input-group">
                    <input id="txtSaveDataMsgLarge" type="text" class="form-control" placeholder="Escribe tu mensaje" maxlength="280" required>
                    <div class="input-group-append">
                      <button id="btnSaveDataMsgLarge" class="btn btn-success" type="button"><i class="fa fa-paper-plane"></i></button>
                    </div>
                  </div>
                </form>
                <p class="w3-medium w3-margin" id="lblToMsgName"></p>
                <p style="display:none;" id="lblToMsgEmail"></p>
              </div>
              <div id="divGetChatLargeMessagesBottom">


                <div class="containerChat w3-text-dark-grey">
                  <img src="../uploads/leon@oulook.com_20210407_042148_5dd3c1bb665723899339a7dde1f1f1c1ad9560bf.jpg" alt="shot" style="width:65%;" class="imgChat">
                  <p>Hola!</p>
                  <span class="time-right">11:00</span>
                </div>

                <div class="containerChat darker w3-text-dark-grey">
                  <img src="../uploads/leon@oulook.com_20210407_042148_5dd3c1bb665723899339a7dde1f1f1c1ad9560bf.jpg" alt="shot" class="imgChat right" style="width:65%;">
                  <p>Hola de regreso</p>
                  <span class="time-left">11:01</span>
                </div>


              </div>

            </div>
          </div>
        </div>
      </div>-->
    </div>
  </div>
  <div id="divMessagesSmall" class="divSmall">
    <div id="divChildMessagesSmall" class="divHide">
      <label>En construcción</label>
    </div>
  </div>
  <div class="divFooter txtFooter">
    <label>Todos los derechos reservados 2021 - hagamoscine.com</label>
  </div>
</div>
<div id="divModalUserSeeProfile" class="w3-modal w3-animate-opacity"></div>
<div id="divLoader" class="w3-modal">
  <div class="w3-modal-content">
    <div class="imgLoader"></div>
  </div>
</div>
<div id="divAlert" class="w3-modal">
 <div class="w3-modal-content">
   <div class="w3-container w3-indigo w3-text-white w3-padding">
     <span onclick="document.getElementById('divAlert').style.display='none'" class="w3-button w3-display-topright"><i class="fa fa-times w3-large"></i></span>
     <p id="txtMsgHeaderAlert" class="w3-xlarge"></p>
     <p id="txtMsgAlert"></p>
     <div class="w3-row">
      <div class="w3-container w3-half">
    	   <button onclick="$('#divAlert').hide();" class="w3-button w3-teal w3-block" style="margin-top:5px;">Continuar</button>
      </div>
      <div class="w3-container w3-half">
        <button id="btnGetPremium" onclick="$('#divAlert').hide();alert('Comprar Premium: En construcción');" class="w3-button w3-purple w3-block" style="display:none;margin-top:5px;"><i class="fa fa-star w3-text-yellow w3-large"></i> Get Premium</button>
      </div>
    </div>
   </div>
 </div>
</div>
<div id="divAlertUserLink" class="w3-modal">
 <div class="w3-modal-content">
   <div class="w3-container w3-indigo w3-text-white w3-padding">
     <span onclick="document.getElementById('divAlertUserLink').style.display='none'" class="w3-button w3-display-topright"><i class="fa fa-times w3-large"></i></span>
     <p class="w3-xlarge">Atención</p>
     <p id="txtMsgAlertUserLink"></p>
     <label id="btnHashIdAlert" style="display:none;"></label>
     <label id="strEmailOwnAlert" style="display:none;"></label>
     <label id="strEmailLinkedAlert" style="display:none;"></label>
     <label id="strNicknameLinkedAlert" style="display:none;"></label>
     <label id="strNicknameOwnAlert" style="display:none;"></label>
     <div class="w3-row">
      <div class="w3-container w3-half">
    	 <button onclick="objResources.setUsersLink($('#btnHashIdAlert').text(),$('#strEmailOwnAlert').text(),$('#strEmailLinkedAlert').text(),$('#strNicknameLinkedAlert').text(),$('#strNicknameOwnAlert').text(),true);$('#divAlertUserLink').hide();" class="w3-button w3-teal w3-block" style="margin-top:5px;">Aceptar</button>
      </div>
      <div class="w3-container w3-half">
       <button onclick="$('#divAlertUserLink').hide();" class="w3-button w3-pink w3-block" style="margin-top:5px;">Cancelar</button>
      </div>
    </div>
   </div>
 </div>
</div>
</body>
</html>
