<?php
if(isset($_GET['arg']))
{
  echo 'El correo que vas a usar ya existe: '.$_GET['arg'];
}
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Hagamos Cine</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="images/carrete.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="styles/cssIndex.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body class="w3-black">
<script>
  $(document).ready(function(){
      $('#btnLoginSmall').click(function(){
        //alert('En construcciónIngresa tus credenciales en pantalla chica!!!');
        //alert('En construcción');
        window.location.href = "login/";
      });
      $('#btnLoginLarge').click(function(){
        window.location.href = "login/";
        //alert('Ingresa tus credenciales en pantalla grande!!!');
        //alert('En construcción');
      });
  });
</script>
  <div class="container bgImage0">
    <div class="divSmall">
      <div class="row w3-section">
        <div class="col align-self-left">
          <img src="images/web-brand-logotipo-1.png" class="imgLogo" srcset="images/web-brand-logotipo-1@2x.png 2x,images/web-brand-logotipo-1@3x.png 3x">
        </div>
      </div>
      <div class="row w3-section">
        <div class="col w3-padding"></div>
      </div>
      <div class="row w3-section w3-center">
        <div class="col">
          <button id="btnLoginSmall" class="btn btnColorHaCi btnIndex">Iniciar sesión</button>
        </div>
      </div>
    </div>
    <div class="divLarge">
      <div class="row w3-section w3-center">
        <div class="col align-self-center">
          <img src="images/web-brand-logotipo-1.png" srcset="images/web-brand-logotipo-1@2x.png 2x,images/web-brand-logotipo-1@3x.png 3x">
        </div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col align-self-center">
          <button id="btnLoginLarge" class="btn btnColorHaCi btnIndex">Iniciar sesión</button>
        </div>
      </div>
    </div>
    <div class="divSmall">
      <div class="w3-center txtLineHKGrotesk w3-text-white w3-large txtMargin">¿Quieres pertenecer al mundo del cine?</div>
      <div class="w3-center txtLineDJBChalkItUp w3-text-white w3-medium txtMargin">La Plataforma online para encontrar, mostrar tu trabajo y tú pasión por el séptimo arte</div>
      <div class="w3-center txtLineHKGrotesk w3-text-white w3-medium txtMargin">Registrate y “Hagamos Cine”</div>
    </div>
    <div class="divLarge">
      <div class="w3-center txtLineHKGrotesk w3-text-white w3-xxxlarge txtMargin">¿Quieres pertenecer al mundo del cine?</div>
      <div class="w3-center txtLineDJBChalkItUp w3-text-white w3-xxlarge txtMargin">La Plataforma online para encontrar, mostrar tu trabajo y tú pasión por el séptimo arte</div>
      <div class="w3-center txtLineHKGrotesk w3-text-white w3-xxlarge txtMargin">Registrate y “Hagamos Cine”</div>
    </div>
      <form method="post" action="signup/">
          <div class="row txtMarginInput w3-center">
            <div class="col"></div>
            <div class="col"><input id="txtSignUp" name="arg" type="email" maxlength="50" class="form-control txtSignUpLength" placeholder="Ingresa tu correo electrónico" required></div>
            <div class="col"></div>
          </div>
          <div class="row txtMarginInput w3-center">
            <div class="col"></div>
            <div class="col align-self-center"><button id="btnSignUp" type="submit" class="btn btnColorHaCi btnIndex">Registrate</button></div>
            <div class="col"></div>
          </div>
      </form>
      <div class="divSmall">
        <div class="w3-center txtLineDJBChalkItUp w3-text-white w3-medium txtMargin">La red para creativos, directores, productores y todos los involucrados en el mundo audio visual</div>
        <div class="row txtMarginInput w3-center">
          <div class="col"></div>
          <div class="col"><img src="images/web-iconos-cinta.png" srcset="images/web-iconos-cinta@2x.png 2x, images/web-iconos-cinta@3x.png 3x"></div>
          <div class="col"></div>
        </div>
        <div class="w3-center txtLineDJBChalkItUp w3-text-white w3-medium txtMargin">Miles de empleos en todos los departamentos involucrados en la creación y distribución del cine en México y Latino-América</div>
        <div class="row txtMarginInput w3-center">
          <div class="col"></div>
          <div class="col"><img src="images/web-iconos-claqueta.png" srcset="images/web-iconos-claqueta@2x.png 2x, images/web-iconos-claqueta@3x.png 3x"></div>
          <div class="col"></div>
        </div>
      </div>
      <div class="divLarge">
        <div class="w3-center txtLineDJBChalkItUp w3-text-white w3-xxlarge txtMargin">La red para creativos, directores, productores y todos los involucrados en el mundo audio visual</div>
        <div class="row txtMarginInput w3-center">
          <div class="col"></div>
          <div class="col"><img src="images/web-iconos-cinta.png" srcset="images/web-iconos-cinta@2x.png 2x, images/web-iconos-cinta@3x.png 3x"></div>
          <div class="col"></div>
        </div>
        <div class="w3-center txtLineDJBChalkItUp w3-text-white w3-xxlarge txtMargin">Miles de empleos en todos los departamentos involucrados en la creación y distribución del cine en México y Latino-América</div>
        <div class="row txtMarginInput w3-center">
          <div class="col"></div>
          <div class="col"><img src="images/web-iconos-claqueta.png" srcset="images/web-iconos-claqueta@2x.png 2x, images/web-iconos-claqueta@3x.png 3x"></div>
          <div class="col"></div>
        </div>
      </div>
    <div class="divLarge txtLineHKGrotesk txtMargin w3-center txtMarginBottom">
      <div class="row w3-padding">
        <div class="col"></div>
        <div class="col"><img src="images/web-iconos-redessociales-facebook.png" srcset="images/web-iconos-redessociales-facebook@2x.png 2x, images/web-iconos-redessociales-facebook@3x.png 3x"></div>
        <div class="col align-self-center w3-xlarge"><a href="https://www.facebook.com/Hagamoscinemx">@Hagamoscinemx</a></div>
        <div class="col"></div>
        <div class="col"><img src="images/web-iconos-redessociales-instagram.png" srcset="images/web-iconos-redessociales-instagram@2x.png 2x, images/web-iconos-redessociales-instagram@3x.png 3x"></div>
        <div class="col align-self-center w3-xlarge"><a href="https://www.instagram.com/hagamos.cine">@Hagamos.cine</a></div>
        <div class="col"></div>
      </div>
    </div>
    <div class="divSmall txtLineHKGrotesk txtMargin w3-center txtMarginBottom">
      <div class="row">
        <div class="col w3-section"><img src="images/web-iconos-redessociales-facebook.png" srcset="images/web-iconos-redessociales-facebook@2x.png 2x, images/web-iconos-redessociales-facebook@3x.png 3x"></div>
      </div>
      <div class="row">
        <div class="col w3-section w3-large"><a href="https://www.facebook.com/Hagamoscinemx">@Hagamoscinemx</a></div>
      </div>
      <div class="row">
        <div class="col w3-padding"></div>
      </div>
      <div class="row">
        <div class="col w3-section"><img src="images/web-iconos-redessociales-instagram.png" srcset="images/web-iconos-redessociales-instagram@2x.png 2x, images/web-iconos-redessociales-instagram@3x.png 3x"></div>
      </div>
      <div class="row">
        <div class="col w3-section w3-medium"><a href="https://www.instagram.com/hagamos.cine">@Hagamos.cine</a></div>
      </div>
    </div>
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
</body>
</html>
