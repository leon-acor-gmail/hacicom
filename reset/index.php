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
  <link rel="stylesheet" href="../styles/cssLogin.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../scripts/jsResources.js" ></script>
  <script src="../scripts/jquery.md5.js"></script>
</head>
<body class="bgColor w3-text-white txtFontFamily">
<script>
  var objResources = null;
  $(document).ready(function(){
    objResources = new jsResources();

    $('#btnResetLarge').click(function(a){
        var b = document.getElementsByTagName('form')[1];
        if(b.checkValidity())
        {
          btnSaveData('Large');
          a.preventDefault();
        }
    });

    $('#btnResetSmall').click(function(a){
        var b = document.getElementsByTagName('form')[0];
        if(b.checkValidity())
        {
          btnSaveData('Small');
          a.preventDefault();
        }
    });

  });

  function btnSaveData(strResponsive){
    $('#divLoader').show();
    objJson= {
      strUs:$('#txtEmail'+strResponsive).val(),
      arg2:$.md5($('#txtPwd'+strResponsive).val())
    };
    strJson = JSON.stringify(objJson);
    base64 = objResources.utf8_to_b64(strJson);
    $.post('../bsns/bsnsReset.php',{c:1,arg:base64},function(r){
      if(r==0){
        $('#divLoader').hide();
        setDivAlert('Atención','El usuario no existe');
      }
      else{
        $('#divLoader').hide();
        setDivAlert('Atención','Se actualizó la contraseña correctamente');
      }
    });
  }

  function setDivAlert(strHeaderMsg,strMsg){
    $('#txtMsgHeaderAlert').text(strHeaderMsg);
    $('#txtMsgAlert').text(strMsg);
    $('#divAlert').show();
  }
</script>
<div class="container">
  <div class="row divMarginLogo">
    <div class="col">
      <img src="../images/logo1.svg" alt="Logo Hagamos Cine">
    </div>
  </div>
  <div class="divSmall">
    <form>
      <div class="row">
        <div class="col">
          <label>Correo electrónico <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtEmailSmall" type="text" class="w3-input bgColor w3-text-white txtMargin" maxlength="30" required>
        </div>
      </div>
      <div class="row divMarginInput">
        <div class="col">
          <label>Contraseña <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtPwdSmall" type="password" class="w3-input bgColor w3-text-white txtMargin" minlength="8" maxlength="24" required>
          <span toggle="#txtPwdSmall" class="fa fa-fw fa-eye w3-large icoInput txtColorHaCi"></span>
          <a class="w3-right w3-padding txtHover" href="../login/">Iniciar sesión</a>
        </div>
      </div>
      <div class="row divMarginButton">
        <div class="col w3-center"><button id="btnResetSmall" type="submit" class="w3-button btnColorHaCi">Guardar contraseña</button></div>
      </div>
    </form>
  </div>
  <div class="divLarge">
    <form>
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
          <label>Correo electrónico <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtEmailLarge" type="text" class="form-control" maxlength="30" required>
        </div>
        <div class="col-4"></div>
      </div>
      <div class="row divMarginInput">
        <div class="col-4"></div>
        <div class="col-4">
          <label>Contraseña <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtPwdLarge" type="password" class="form-control" minlength="8" maxlength="24" required>
          <span toggle="#txtPwdLarge" class="fa fa-fw fa-eye w3-large icoInput txtColorHaCi"></span>
          <a class="w3-right w3-padding txtHover" href="../login/">Iniciar sesión</a>
        </div>
        <div class="col-4"></div>
      </div>
      <div class="row w3-center divMarginButton">
        <div class="col"></div>
        <div class="col align-self-center"><button id="btnResetLarge" type="submit" class="w3-button btnColorHaCi">Guardar contraseña</button></div>
        <div class="col"></div>
      </div>
    </form>
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
<div id="divAlert" class="w3-modal">
 <div class="w3-modal-content">
   <div class="w3-container w3-indigo w3-text-white w3-padding">
     <span onclick="document.getElementById('divAlert').style.display='none'" class="w3-button w3-display-topright"><i class="fa fa-times w3-large"></i></span>
     <p id="txtMsgHeaderAlert" class="w3-xlarge"></p>
     <p id="txtMsgAlert"></p>
     <button onclick="$('#divAlert').hide();" class="w3-button w3-teal w3-block w3-left" style="margin-top:5px;width:50%;">Continuar</button>
   </div>
 </div>
</div>
</body>
</html>
