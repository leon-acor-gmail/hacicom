<?php
if(isset($_GET['arg']))
{
  echo '<div id="divAlert" class="w3-container w3-padding w3-pink"><span onclick="document.getElementById(\'divAlert\').style.display=\'none\'"class="w3-button w3-display-topright"><i class="fa fa-times w3-large"></i></span><p class="w3-large">Atención</p><p class="w3-medium">El correo '.$_GET['arg'].' ya existe</p></div>';
}
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Hagamos Cine</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/svg" href="images/favicon.svg">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="styles/cssTemplate.css">
  <link rel="stylesheet" href="styles/cssIndex.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="scripts/jsResources.js" ></script>
</head>
<body class="bgColor w3-text-white txtFontFamily">
<script>
var objResources = null;
$(document).ready(function(){
    objResources = new jsResources();
    objResources.btnCatchBackRefresh();
  });

  function btnLogin(){
      window.location.href = "login/";
  }
</script>
  <div class="container">
    <div class="row">
      <div class="col w3-margin">
        <img src="images/logo1.svg" alt="Logo Hagamos Cine">
      </div>
    </div>
    <div class="row">
      <div class="col w3-center">
        <p class="w3-xlarge txtMargin">¿Quieres pertenecer al mundo del cine?</p>
        <p class="w3-xlarge txtMargin">Registrate y “Hagamos Cine”</p>
      </div>
    </div>
    <div class="divLarge">
      <form method="post" action="signup/" onsubmit="document.getElementById('divLoader').style.display='block';">
        <div class="row">
          <div class="col"></div>
          <div class="col">
            <input id="txtSignUp" name="arg" type="email" maxlength="50" class="form-control txtMargin" placeholder="Ingresa tu e-mail para registrarte" required>
          </div>
          <div class="col"></div>
        </div>
        <div class="row">
          <div class="col"></div>
          <div class="col">
            <button id="btnSignUp" type="submit" class="w3-button btnColorHaCi btnMargin">Registrate</button>
          </div>
          <div class="col"></div>
        </div>
      </form>
      <div class="row">
        <div class="col"></div>
        <div class="col">
          <button onclick="btnLogin();" class="w3-button w3-border w3-border-red btnMargin btnStyle w3-hover-red">Iniciar sesión</button>
        </div>
        <div class="col"></div>
      </div>
    </div>
    <div class="divSmall">
      <form method="post" action="signup/" onsubmit="document.getElementById('divLoader').style.display='block';">
        <div class="row">
          <div class="col">
            <input id="txtSignUp" name="arg" type="email" maxlength="50" class="w3-input bgColor w3-text-white txtMargin" placeholder="Ingresa tu e-mail para registrarte" required>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <button id="btnSignUp" type="submit" class="w3-button btnColorHaCi btnMargin">Registrate</button>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col">
          <button onclick="btnLogin();" class="w3-button w3-border w3-border-red btnMargin btnStyle w3-hover-red">Iniciar sesión</button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col"></div>
      <div class="col txtMargin w3-center"><img class="imgSize" src="images/cinta.svg" alt="Carrete"></div>
      <div class="col"></div>
    </div>
    <div class="w3-center txtMargin w3-xlarge">Miles de empleos en todos los departamentos involucrados en la creación y distribución del cine en México y Latino-América</div>
    <div class="row">
      <div class="col"></div>
      <div class="col txtMargin w3-center"><img class="imgSize" src="images/claqueta.svg" alt="Claqueta"></div>
      <div class="col"></div>
    </div>
    <div class="w3-row txtMargin">
      <div class="w3-container w3-half w3-center w3-padding">
        <img src="images/facebook1.svg" alt="facebook"><br>
        <a class="w3-large txtHover" href="https://www.facebook.com/Hagamoscinemx">@Hagamoscinemx</a>
      </div>
      <div class="w3-container w3-half w3-center w3-padding">
        <img src="images/instagram1.svg" alt="instagram"><br>
        <a class="w3-large txtHover" href="https://www.instagram.com/hagamos.cine">@Hagamos.cine</a>
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
