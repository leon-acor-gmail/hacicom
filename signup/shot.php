<?php
session_start();
if(!isset($_SESSION['signup']))
{
    header('Location: https://www.hagamoscine.com');
}
$json = base64_decode($_GET['arg']);
$jsonObj = json_decode($json);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Hagamos Cine</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="../../images/carrete.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../styles/cssShot.css">
  <link rel="stylesheet" href="../../styles/cssBreadcrums.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="../../scripts/jsResources.js" ></script>
</head>
<body class="w3-black">
<script>
  var objResources = null;
  $(document).ready(function(){
    objResources = new jsResources();
    $('#txtDataUploadSmall').val('<?php echo $_GET['arg']; ?>');
    $('#txtDataUploadLarge').val('<?php echo $_GET['arg']; ?>');

    $('#btnSaveDataBio').click(function(a){
        var b = document.getElementsByTagName('form')[2];
        if(b.checkValidity())
        {
          jsonObj = JSON.parse('<?php echo $json; ?>');
          jsonObj.bio = $('#txtBio').val();
          json = JSON.stringify(jsonObj);
          base = objResources.utf8_to_b64(json);
          //alert(base);
          window.location.href = "skills.php?arg="+base;
          a.preventDefault();
        }
    });

    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings("#custom-file-label-large").addClass("selected").html(fileName);
    });

    $('#btnChangeShot').click(function(){
        window.location.href = "shot.php?arg=<?php echo $_GET['arg'] ?>&c=2";
    });

  });
</script>
<div class="container txtLineHKGrotesk">
    <div class="row w3-section w3-center">
      <div class="col align-self-center">
        <img src="../../images/web-brand-logotipo-2.png" class="imgMarginLogo" srcset="../../images/web-brand-logotipo-2@2x.png 2x,../../images/web-brand-logotipo-2@3x.png 3x">
      </div>
    </div>
  <div class="row divMarginBreadcrums w3-medium w3-center">
      <!--<div class="col" <?php if($_GET['c']==="1"){echo 'style="display:none;"';} ?>>-->
    <div class="col" <?php if(isset($_GET['c'])){echo 'style="display:none;"';} ?>>
      <nav aria-label="breadcrumb">
        <ul class="breadcrumbSignup txtLineHKGrotesk txtStepper">
          <li><img class="iconStepper" src="../images/web-iconos-stepers-succes.png" srcset="../images/web-iconos-stepers-succes@2x.png 2x,../images/web-iconos-stepers-succes@3x.png 3x"> Datos generales</li>
          <li><img class="iconStepper" src="../images/web-iconos-stepers-active.png" srcset="../images/web-iconos-stepers-active@2x.png 2x,../images/web-iconos-stepers-active@3x.png 3x"> Tu Headshot - Foto de perfil</li>
          <li><img class="iconStepper" src="../images/web-iconos-stepers-inactive.png" srcset="../images/web-iconos-stepers-inactive@2x.png 2x,../images/web-iconos-stepers-inactive@3x.png 3x"> Tus intereses</li>
        </ul>
      </nav>
    </div>
  </div>
  <div class="row divMarginBreadcrumsBio w3-medium w3-center">
    <!--<div class="col" <?php if(!$_GET['c']==="1"){echo 'style="display:none;"';} ?>>-->
    <div class="col" <?php if(!isset($_GET['c'])){echo 'style="display:none;"';} ?>>
      <nav aria-label="breadcrumb">
        <ul class="breadcrumbSignup txtLineHKGrotesk txtStepper">
          <li><img class="iconStepper" src="../images/web-iconos-stepers-succes.png" srcset="../images/web-iconos-stepers-succes@2x.png 2x,../images/web-iconos-stepers-succes@3x.png 3x"> Datos generales</li>
          <li><img class="iconStepper" src="../images/web-iconos-stepers-active.png" srcset="../images/web-iconos-stepers-active@2x.png 2x,../images/web-iconos-stepers-active@3x.png 3x"> Tu Headshot - Biografía</li>
          <li><img class="iconStepper" src="../images/web-iconos-stepers-inactive.png" srcset="../images/web-iconos-stepers-inactive@2x.png 2x,../images/web-iconos-stepers-inactive@3x.png 3x"> Tus intereses</li>
        </ul>
      </nav>
    </div>
  </div>
  <div class="divLarge">
  <form action="../../bsns/bsnsUpload.php" method="post" enctype="multipart/form-data">
    <div class="row w3-section w3-center" <?php if($_GET['c']==1){echo 'style="display:none;"';} ?>>
    <!--<div class="row w3-section w3-center" <?php if(isset($_GET['c'])){echo 'style="display:none;"';} ?>>-->
      <div class="col">
        <p>En este paso sube una fotografía y una breve biografía</p>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="fileToUpload"  id="inputGroupFile" required>
            <label id="custom-file-label-large" class="custom-file-label" for="inputGroupFile">Elige una foto</label>
            <input id="txtDataUploadLarge" name="txtDataUploadLarge" type="hidden" value="">
            <input name="txtUploadResponsiveLarge" type="hidden" value="2">
          </div>
          <div class="input-group-append">
            <button  type="submit" value="Upload Image" name="submit" class="btn btnColorHaCi">Agregar foto</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="divSmall">
  <form action="../../bsns/bsnsUpload.php" method="post" enctype="multipart/form-data">
    <div class="row w3-section w3-center" <?php if($_GET['c']==1){echo 'style="display:none;"';} ?>>
    <!--<div class="row w3-section w3-center" <?php if(isset($_GET['c'])){echo 'style="display:none;"';} ?>>-->
    <p>En este paso sube una fotografía y una breve biografía</p>
      <div class="col">
        <div class="form-group">
          <input type="file" class="form-control-file" name="fileToUpload" required>
          <input id="txtDataUploadSmall" name="txtDataUploadSmall" type="hidden" value="">
          <input name="txtUploadResponsiveSmall" type="hidden" value="1">
        </div>
      </div>
    </div>
    <div class="row w3-section w3-center">
      <div class="col"></div>
      <!--<div class="col align-self-center"><button type="submit" value="Upload Image" name="submit" class="btn btnColorHaCi btnShot" <?php if(isset($_GET['c'])){echo 'style="display:none;style="width: 200px;""';}else{echo 'style="width: 200px;"';} ?>>Agregar foto</button></div>-->
      <div class="col align-self-center"><button type="submit" value="Upload Image" name="submit" class="btn btnColorHaCi btnShot" <?php if($_GET['c']==1){echo 'style="display:none;style="width: 200px;""';}else{echo 'style="width: 200px;"';} ?>>Agregar foto</button></div>
      <div class="col"></div>
    </div>
  </form>
</div>
<div <?php if($_GET['c']!=1){echo 'style="display:none;"';} ?>>
  <!--<div <?php if(!isset($_GET['c'])){echo 'style="display:none;"';} ?>>-->
    <div class="row w3-section justify-content-center">
      <div class="divLarge">
        <div class="col-3"></div>
        <div class="col-6">
          <img class="img-responsive" src="../uploads/<?php echo $jsonObj->shotSystem ?>" alt="imagen de perfil" width="300px" height="auto">
        </div>
        <div class="col-3"></div>
      </div>
      <div class="divSmall">
        <div class="col">
          <img class="img-responsive" src="../uploads/<?php echo $jsonObj->shotSystem ?>" alt="imagen de perfil" width="300px" height="auto">
        </div>
      </div>
    </div>
    <div class="row w3-section w3-center">
      <div class="col-2"></div>
      <div class="col-8">
        <button id="btnChangeShot" class="btn btnColorHaCi w3-small">Elegir otra foto</button>
      </div>
      <div class="col-2"></div>
    </div>
    <form>
      <div class="row w3-section">
        <div class="col-2"></div>
        <div class="col-8 w3-text-white w3-large">Biografía</div>
        <div class="col-2"></div>
      </div>
      <div class="row w3-section">
        <div class="col"></div>
        <div class="col-10">
          <textarea id="txtBio" class="form-control" rows="10" maxlength="1000" required></textarea>
        </div>
        <div class="col"></div>
      </div>
      <div class="row w3-center divMargin">
        <div class="col"></div>
        <div class="col align-self-center"><button id="btnSaveDataBio" type="submit" class="btn btnColorHaCi btnShot">Continuar</button></div>
        <div class="col"></div>
      </div>
    </form>
  </div>
  <div>
  <!--<div style="background-image: url('../images/web-brand-cintafondo.png');">-->
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
