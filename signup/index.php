<?php
session_start();
$_SESSION = array();
$arg=$_POST['arg'];
if(isset($_GET['result'])){
  $objJson = json_decode(base64_decode($_GET['arg']));
  if($_GET['result']==0)
  {
    $_SESSION['signup'] = true;
  }
  else
  {
    header('Location: ../?arg='.$objJson->strUs);
  }
}
else
  {
    if($arg!='hcine'){
      $iC=1;
      $objJson->strUs=$arg;
      $json=base64_encode(json_encode($objJson));
      header('Location: ../bsns/bsnsSignup.php?arg='.$json.'&c='.$iC);
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
  <link rel="stylesheet" href="../styles/cssSignup.css">
  <link rel="stylesheet" href="../styles/cssBreadcrums.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../scripts/jsResources.js"></script>
  <script src="../scripts/jquery.md5.js"></script>
</head>
<body class="bgColor w3-text-white txtFontFamily">
<script>
  var objResources = null;
  $(document).ready(function(){
    objResources = new jsResources();
    objResources.btnCatchBackRefresh();
    getCountries();

    $('#btnSaveDataSmall').click(function(a){
        var b = document.getElementsByTagName('form')[0];
        if(b.checkValidity())
        {
          btnSaveData('Small');
          a.preventDefault();
        }
    });

    $('#btnSaveDataLarge').click(function(a){
        var b = document.getElementsByTagName('form')[1];
        if(b.checkValidity())
        {
          btnSaveData('Large');
          a.preventDefault();
        }
    });

  });

  function btnSaveData(strResponsive){
    $('#divLoader').show();
    if($('#txtEmail'+strResponsive).val() === $('#txtEmailR'+strResponsive).val())
    {
      if($('#txtPwd'+strResponsive).val() === $('#txtPwdR'+strResponsive).val())
      {
        base64 = setDataJson(strResponsive);
        window.location.href = "places.php?arg="+base64;
      }
      else
      {
        $('#divLoader').hide();
        setDivAlert('Atención','Las contraseñas deben ser iguales');
      }
    }
    else
    {
      $('#divLoader').hide();
      setDivAlert('Atención','Los correos deben ser iguales');
    }
  }

    function setDataJson(strResponsive){
      objJson = {
        name:$('#txtName'+strResponsive).val(),
        lastname:$('#txtLastname'+strResponsive).val(),
        nickname:$('#txtNickname'+strResponsive).val(),
        country:$('#selectCountry'+strResponsive).val(),
        countryFlag:$('#selectCountry'+strResponsive).find(':selected').data('flag'),
        email:$('#txtEmail'+strResponsive).val(),
        yt:$('#txtYT'+strResponsive).val(),
        ig:$('#txtIG'+strResponsive).val(),
        vi:$('#txtVI'+strResponsive).val(),
        pwd:$.md5($('#txtPwd'+strResponsive).val())
      }
      strJson = JSON.stringify(objJson);
      base64 = objResources.utf8_to_b64(strJson);
      return base64;
    }

    function isTextMatch(strElement,strResponsive){
      var element = $("#txt"+strElement+strResponsive).val();
      var confirmElement = $("#txt"+strElement+"R"+strResponsive).val();
      if (element != confirmElement) $("#divCheck"+strElement+strResponsive).removeClass("w3-text-green").addClass( "w3-text-red" ).html("No son iguales");
      else $("#divCheck"+strElement+strResponsive).removeClass("w3-text-red").addClass("w3-text-green").html("Son iguales");
    }

    function getCountries(){
      $('#divLoader').show();
      $.post('../bsns/bsnsIndex.php',{c:1},function(r){
        objResources.populateSelectCountries($('#selectCountryLarge'),r);
        objResources.populateSelectCountries($('#selectCountrySmall'),r);
        $('#divLoader').hide();
      });
    }

    function setDivAlert(strHeaderMsg,strMsg){
      $('#txtMsgHeaderAlert').text(strHeaderMsg);
      $('#txtMsgAlert').text(strMsg);
      $('#divAlert').show();
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
  <div class="divSmall">
    <form>
      <div class="row w3-section">
        <div class="col">
          <label>Nombre <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtNameSmall" type="text" class="form-control" maxlength="40" required>
        </div>
      </div>
      <div class="row w3-section">
        <div class="col">
          <label>Apellidos <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtLastnameSmall" type="text" class="form-control" maxlength="40" required>
        </div>
      </div>
      <div class="row w3-section">
        <div class="col">
          <label>Nombre artístico <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtNicknameSmall" type="text" class="form-control" maxlength="20" required>
        </div>
      </div>
      <div class="row w3-section">
        <div class="col">
          <label>País de residencia <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <select id="selectCountrySmall" class="form-select" style="width:100%;height:40px;" required></select>
        </div>
      </div>
      <div class="row w3-section">
        <div class="col">
          <label>E-mail <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtEmailSmall" name="NEmail" type="email" class="form-control" value="<?php echo $objJson->strUs; ?>" maxlength="50" disabled>
        </div>
      </div>
      <div class="row w3-section">
        <div class="col">
          <label>Confirmar E-mail <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtEmailRSmall" type="email" name="RNEmail" class="form-control" onkeyup="isTextMatch('Email','Small');" maxlength="50" onChange="isEmailMatchSmall();" required>
          <div id="divCheckEmailSmall" class="w3-text-red w3-padding"></div>
        </div>
      </div>
      <div class="row w3-section">
        <div class="col">
          <label>Contraseña <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtPwdSmall" name="NPassword" type="password" class="form-control" minlength="8" maxlength="24" required>
          <label><i class="fa fa-question-circle w3-small"></i> La contraseña debe tener minimo 8 letras o números y hasta máximo 24</label>
        </div>
      </div>
      <div class="row w3-section">
        <div class="col">
          <label>Confirmar contraseña <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtPwdRSmall" name="RNPassword" type="password" class="form-control" onkeyup="isTextMatch('Pwd','Small');" minlength="8" maxlength="24" required onChange="isPasswordMatchSmall();">
          <div id="divCheckPwdSmall" class="w3-text-red w3-padding"></div>
        </div>
      </div>
      <div class="row">
        <div class="col"><label>Conecta tus redes sociales</label></div>
      </div>
      <div class="row w3-section">
        <div class="col">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-youtube-play"></i></span>
            </div>
            <input id="txtYTSmall" type="text" class="form-control" maxlength="60" placeholder="Agregar URL">
          </div>
        </div>
      </div>
      <div class="row w3-section">
        <div class="col">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-instagram"></i></span>
            </div>
            <input id="txtIGSmall" type="text" class="form-control" maxlength="60" placeholder="Agregar URL">
          </div>
        </div>
      </div>
      <div class="row w3-section">
        <div class="col">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-vimeo"></i></span>
            </div>
            <input id="txtVISmall" type="text" class="form-control" maxlength="60" placeholder="Agregar URL">
          </div>
        </div>
    </div>
      <div class="row w3-section">
        <div class="col-2"></div>
        <div class="col-10">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" required>
            <label class="form-check-label"><a class="txtHover" href="../aviso.html" target="_blank"> Acepto política de privacidad</a></label>
          </div>
        </div>
      </div>
      <div class="row w3-section">
        <div class="col-2"></div>
        <div class="col-10">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" required>
            <label class="form-check-label"><a class="txtHover" href="../terminos.html" target="_blank"> Acepto condiciones de uso</a></label>
          </div>
        </div>
      </div>
      <div class="row w3-section">
        <div class="col w3-center"><button id="btnSaveDataSmall" type="submit" class="w3-button btnColorHaCi">Continuar</button></div>
      </div>
    </form>
  </div>
  <div class="divLarge">
    <form>
      <div class="row justify-content-around w3-section">
        <div class="col-5">
          <label>Nombre <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtNameLarge" type="text" class="form-control" maxlength="40" required>
        </div>
        <div class="col-5">
          <label>Apellidos <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtLastnameLarge" type="text" class="form-control" maxlength="40" required>
        </div>
      </div>
      <div class="row justify-content-around w3-section">
        <div class="col-5">
          <label>Nombre artístico <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtNicknameLarge" type="text" class="form-control" maxlength="20" required>
        </div>
        <div class="col-5">
          <label>País de residencia <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <select id="selectCountryLarge" class="form-select" style="width:100%;height:40px;" required></select>
        </div>
      </div>
      <div class="row justify-content-around w3-section">
        <div class="col-5">
          <label>E-mail <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtEmailLarge" name="NEmail" type="email" class="form-control" value="<?php echo $objJson->strUs; ?>" maxlength="50" disabled>
        </div>
        <div class="col-5">
          <label>Confirmar E-mail <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtEmailRLarge" name="RNEmail" type="email" class="form-control" onkeyup="isTextMatch('Email','Large');" maxlength="50" required onChange="isEmailMatchLarge();">
          <div id="divCheckEmailLarge" class="w3-text-red w3-padding"></div>
        </div>
      </div>
      <div class="row justify-content-around w3-section">
        <div class="col-5">
          <label>Contraseña <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i> <i class="fa fa-question-circle w3-tiny" title="La contraseña debe tener minimo 8 letras o números y hasta máximo 24"></i></label>
          <input id="txtPwdLarge" type="password" name="NPassword" class="form-control" minlength="8" maxlength="24" required>
        </div>
        <div class="col-5">
          <label>Confirmar contraseña <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtPwdRLarge" type="password" name="RNPassword" class="form-control" onkeyup="isTextMatch('Pwd','Large');" minlength="8" maxlength="24" required onChange="isPasswordMatchLarge();">
          <div id="divCheckPwdLarge" class="w3-text-red w3-padding"></div>
        </div>
      </div>
      <div class="row justify-content-around w3-section">
        <div class="col-5">
          <label>Conecta tus redes sociales</label>
        </div>
        <div class="col-5"></div>
      </div>
      <div class="row justify-content-around w3-section">
        <div class="col-5">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-youtube-play"></i></span>
              <!--<span class="input-group-text">youtube.com/</span>-->
            </div>
            <input id="txtYTLarge" type="text" class="form-control" maxlength="60" placeholder="Agregar URL">
          </div>
        </div>
        <div class="col-5">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-instagram"></i></span>
              <!--<span class="input-group-text">instagram.com/</span>-->
            </div>
            <input id="txtIGLarge" type="text" class="form-control" maxlength="60" placeholder="Agregar URL">
          </div>
        </div>
      </div>
      <div class="row justify-content-around w3-section">
        <div class="col-5">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-vimeo"></i></span>
              <!--<span class="input-group-text">vimeo.com/</span>-->
            </div>
            <input id="txtVILarge" type="text" class="form-control" maxlength="60" placeholder="Agregar URL">
          </div>
        </div>
        <div class="col-5"></div>
      </div>
      <div class="row w3-center w3-section">
        <div class="col">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" required>
            <label class="form-check-label"><a class="txtHover" href="../aviso.html" target="_blank"> Acepto política de privacidad</a></label>
          </div>
        </div>
        <div class="col">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" required>
            <label class="form-check-label"><a class="txtHover" href="../terminos.html" target="_blank"> Acepto condiciones de uso</a></label>
          </div>
        </div>
      </div>
      <div class="row w3-section">
        <div class="col"></div>
        <div class="col w3-center"><button id="btnSaveDataLarge" type="submit" class="w3-button btnColorHaCi">Continuar</button></div>
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
