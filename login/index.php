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
  <link rel="stylesheet" href="../styles/cssLogin.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="../scripts/jsResources.js" ></script>
  <script src="../scripts/jquery.md5.js"></script>
</head>
<body class="w3-black">
<script>
  var objResources = null;
  $(document).ready(function(){
    objResources = new jsResources();

    $('#btnLargeLogin').click(function(a){
        var b = document.getElementsByTagName('form')[1];
        if(b.checkValidity())
        {
          jsonObj= {
            arg1:$('#txtLargeEmail').val(),
            arg2:$.md5($('#txtLargePwd').val())
          };
          json = JSON.stringify(jsonObj);
          base64 = objResources.utf8_to_b64(json);
          $.post('../bsns/bsnsLogin.php',{c:1,arg:base64},function(r){
            if(r==0){
              alert('El usuario y la contraseña no coincide');
            }
            else{
              window.location.href = "../home/?arg="+r+"&result=1";
            }
          });
          a.preventDefault();
        }
    });

    $('#btnSmallLogin').click(function(a){
        var b = document.getElementsByTagName('form')[0];
        if(b.checkValidity())
        {
          jsonObj= {
            arg1:$('#txtSmallEmail').val(),
            arg2:$.md5($('#txtSmallPwd').val())
          };
          json = JSON.stringify(jsonObj);
          base64 = objResources.utf8_to_b64(json);

          $.post('../bsns/bsnsLogin.php',{c:1,arg:base64},function(r){
            if(r==0){
              alert('El usuario y la contraseña no coincide');
            }
            else{
              window.location.href = "../home/?arg="+r+"&result=1";
            }
          });
          a.preventDefault();
        }
    });

  })
</script>
<div class="container txtLineHKGrotesk">
  <div class="row w3-section">
    <div class="col align-self-left">
      <img src="../images/web-brand-logotipo-1.png" class="imgMarginLogo" srcset="../images/web-brand-logotipo-2@2x.png 2x,../images/web-brand-logotipo-2@3x.png 3x">
    </div>
  </div>
  <div class="divSmall">
    <form>
      <div class="row justify-content-center w3-section">
        <div class="col">
          <label>Correo electrónico <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtSmallEmail" type="text" class="form-control" maxlength="30" required>
        </div>
      </div>
      <div class="row justify-content-center w3-section">
        <div class="col">
          <label>Contraseña <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtSmallPwd" type="password" class="form-control" minlength="8" maxlength="24" required>
          <a class="w3-right w3-padding" href="../reset/">Olvide mi contraseña</a>
        </div>
      </div>
      <div class="row w3-center divMargin">
        <div class="col"></div>
        <div class="col align-self-center"><button id="btnSmallLogin" type="submit" class="btn btnColorHaCi btnLogin">Iniciar sesión</button></div>
        <div class="col"></div>
      </div>
    </form>
  </div>
  <div class="divLarge">
    <form>
      <div class="row justify-content-center w3-section">
        <div class="col-4"></div>
        <div class="col-4">
          <label>Correo electrónico <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtLargeEmail" type="text" class="form-control" maxlength="30" required>
        </div>
        <div class="col-4"></div>
      </div>
      <div class="row justify-content-center w3-section">
        <div class="col-4"></div>
        <div class="col-4">
          <label>Contraseña <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
          <input id="txtLargePwd" type="password" class="form-control" minlength="8" maxlength="24" required>
          <a class="w3-right w3-padding" href="../reset/">Olvide mi contraseña</a>
        </div>
        <div class="col-4"></div>
      </div>
      <div class="row w3-center divMargin">
        <div class="col"></div>
        <div class="col align-self-center"><button id="btnLargeLogin" type="submit" class="btn btnColorHaCi btnLogin">Iniciar sesión</button></div>
        <div class="col"></div>
      </div>
    </form>
  </div>
  <!--<form method="post" action="../signup/">
    <div class="row w3-center w3-section">
      <div class="col"></div>
      <div class="col align-self-center"><button id="btnSignUp" type="submit" class="w3-button w3-gray btnLogin">Registro</button></div>
      <input name="arg" value="hcine" type="hidden">
      <div class="col"></div>
    </div>
  </form>-->
  <!--<div style="background-image: url('../images/web-brand-cintafondo.png');">-->
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
