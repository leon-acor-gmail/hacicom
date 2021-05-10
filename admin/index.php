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

    $('#btnLargeLogin').click(function(a){
        var b = document.getElementsByTagName('form')[1];
        if(b.checkValidity())
        {
          $('#divLoader').show();
          jsonObj= {
            arg1:$('#txtLargeEmail').val(),
            arg2:$.md5($('#txtLargePwd').val())
          };
          json = JSON.stringify(jsonObj);
          base64 = objResources.utf8_to_b64(json);
          $.post('../bsns/bsnsAdmin.php',{c:1,arg:base64},function(r){
            if(r==0){
              $('#divLoader').hide();
              setDivAlert('Atención','El usuario y la contraseña no coincide');
            }
            else{
              window.location.href = "../admin/admin.php";
            }
          });
          a.preventDefault();
        }
    });

    $('#btnSmallLogin').click(function(a){
        var b = document.getElementsByTagName('form')[0];
        if(b.checkValidity())
        {
          $('#divLoader').show();
          jsonObj= {
            arg1:$('#txtSmallEmail').val(),
            arg2:$.md5($('#txtSmallPwd').val())
          };
          json = JSON.stringify(jsonObj);
          base64 = objResources.utf8_to_b64(json);

          $.post('../bsns/bsnsAdmin.php',{c:1,arg:base64},function(r){
            if(r==0){
              $('#divLoader').hide();
              setDivAlert('Atención','El usuario y la contraseña no coincide');
            }
            else{
              window.location.href = "../admin/admin.php";
            }
          });
          a.preventDefault();
        }
    });

    $(".icoInput").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password")
      {
        input.attr("type", "text");
      }
      else
      {
        input.attr("type", "password");
      }
    });

  });

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
          <input id="txtSmallEmail" type="text" class="w3-input bgColor w3-text-white txtMargin" maxlength="30" required>
        </div>
      </div>
      <div class="row divMarginInput">
        <div class="col">
          <label>Contraseña <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtSmallPwd" type="password" class="w3-input bgColor w3-text-white txtMargin" minlength="8" maxlength="24" required>
          <span toggle="#txtSmallPwd" class="fa fa-fw fa-eye w3-large icoInput txtColorHaCi"></span>
        </div>
      </div>
      <div class="row divMarginButton">
        <div class="col w3-center"><button id="btnSmallLogin" type="submit" class="w3-button btnColorHaCi">Iniciar sesión</button></div>
      </div>
    </form>
  </div>
  <div class="divLarge">
    <form>
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
          <label>Correo electrónico <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtLargeEmail" type="text" class="form-control" maxlength="30" required>
        </div>
        <div class="col-4"></div>
      </div>
      <div class="row divMarginInput">
        <div class="col-4"></div>
        <div class="col-4">
          <label>Contraseña <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtLargePwd" type="password" class="form-control" minlength="8" maxlength="24" required>
          <span toggle="#txtLargePwd" class="fa fa-fw fa-eye w3-large icoInput txtColorHaCi"></span>
        </div>
        <div class="col-4"></div>
      </div>
      <div class="row w3-center divMarginButton">
        <div class="col"></div>
        <div class="col align-self-center"><button id="btnLargeLogin" type="submit" class="w3-button btnColorHaCi">Iniciar sesión</button></div>
        <div class="col"></div>
      </div>
    </form>
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
