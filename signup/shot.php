<?php
session_start();
if(!isset($_SESSION['signup']))
{
    header('Location: https://www.hagamoscine.com');
}
$json = base64_decode($_GET['arg']);
$objJson = json_decode($json);
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
  <link rel="stylesheet" href="../styles/cssShot.css">
  <link rel="stylesheet" href="../styles/cssBreadcrums.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../scripts/jsResources.js" ></script>
</head>
<body class="bgColor w3-text-white txtFontFamily">
<script>
  var objResources = null;
  $(document).ready(function(){
    objResources = new jsResources();
    objResources.btnCatchBackRefresh();
    $('#txtDataUploadSmall').val('<?php echo $_GET['arg']; ?>');
    $('#txtDataUploadLarge').val('<?php echo $_GET['arg']; ?>');
    $('#btnSaveDataBioLarge').click(function(a){
        var b = document.getElementsByTagName('form')[2];
        if(b.checkValidity())
        {
          $('#divLoader').show();
          //document.getElementById('divLoader').style.display='block';
          objJson = JSON.parse('<?php echo $json; ?>');
          objJson.bio = $('#txtBioLarge').val();
          json = JSON.stringify(objJson);
          base = objResources.utf8_to_b64(json);
          window.location.href = "skills.php?arg="+base;
          a.preventDefault();
        }
    });

    $('#btnSaveDataBioSmall').click(function(a){
        var b = document.getElementsByTagName('form')[2];
        if(b.checkValidity())
        {
          $('#divLoader').show();
          //document.getElementById('divLoader').style.display='block';
          objJson = JSON.parse('<?php echo $json; ?>');
          objJson.bio = $('#txtBioSmall').val();
          json = JSON.stringify(objJson);
          base = objResources.utf8_to_b64(json);
          window.location.href = "skills.php?arg="+base;
          a.preventDefault();
        }
    });

    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings("#custom-file-label-large").addClass("selected").html(fileName);
    });

    $('#btnChangeShot').click(function(){
      $('#divLoader').show();
      objJson = JSON.parse('<?php echo $json; ?>');
      $.post('../bsns/bsnsLoad.php',{c:12,arg:objJson.shotSystem},function(r){
        window.location.href = "shot.php?arg=<?php echo $_GET['arg'] ?>";
      });

    });

    if('<?php echo $_GET['c'];?>'==1){
      var strShotSystem = '../uploads/<?php echo $objJson->shotSystem ?>';
      var strName = '<?php echo $objJson->name ?>';
      objResources.getShotOrientation(strShotSystem,'', $('#divShotSystemLarge'),$('#divLoader'),strName);
      objResources.getShotOrientation(strShotSystem,'', $('#divShotSystemSmall'),$('#divLoader'),strName);
    }

  });

  function setNoShot(){
    window.location.href = "shot.php?arg=<?php echo $_GET['arg'] ?>&c=1";
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
          <li><img class="iconStepper" src="../images/active.svg"> Tu headshot</li>
          <li><img class="iconStepper" src="../images/inactive.svg"> Tus habilidades</li>
        </ul>
      </nav>
    </div>
  </div>
  <div class="divLarge">
  <form action="../bsns/bsnsUpload.php" method="post" enctype="multipart/form-data" onsubmit="document.getElementById('divLoader').style.display='block';">
    <div class="row" <?php if($_GET['c']==1){echo 'style="display:none;"';} ?>>
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
            <button  type="submit" value="Upload Image" name="submit" class="btn btnColorHaCi w3-text-white">Agregar foto</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="divSmall">
  <form action="../bsns/bsnsUpload.php" method="post" enctype="multipart/form-data" onsubmit="document.getElementById('divLoader').style.display='block';">
    <div <?php if($_GET['c']==1){echo 'style="display:none;"';} ?>>
      <div class="row">
        <div class="col w3-center">
          <p>En este paso sube una fotografía y una breve biografía</p>
        </div>
      </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <input type="file" class="form-control-file" name="fileToUpload" required>
          <input id="txtDataUploadSmall" name="txtDataUploadSmall" type="hidden" value="">
          <input name="txtUploadResponsiveSmall" type="hidden" value="1">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col w3-center"><button type="submit" value="Upload Image" name="submit" class="w3-button btnColorHaCi" <?php if($_GET['c']==1){echo 'style="display:none;width:100%;"';}else{echo 'style="width:100%;"';} ?>>Agregar foto</button></div>
    </div>
  </div>
  </form>
</div>
<div class="divMargin" <?php if($_GET['c']==1){echo 'style="display:none;"';} ?>><a class="txtHover" onclick="setNoShot();" style="cursor:pointer;">Saltar este paso <i class="fa fa-arrow-right w3-large"></i></a></div>
<div <?php if($_GET['c']!=1){echo 'style="display:none;"';} ?>>
    <div class="row w3-section justify-content-center">
      <div class="divLarge">
        <div class="col-3"></div>
        <div class="col-6">
          <div id="divShotSystemLarge"></div>
        </div>
        <div class="col-3"></div>
      </div>
      <div class="divSmall">
        <div class="col">
          <div id="divShotSystemSmall"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8 w3-center">
        <button id="btnChangeShot" class="btn btn-secondary btnAddShot w3-small w3-margin"><i class="fa fa-chevron-left w3-medium"></i> Elegir otra foto</button>
      </div>
      <div class="col-2"></div>
    </div>
    <div class="divLarge">
      <form>
      <div class="row">
        <div class="col"></div>
        <div class="col-10 w3-large">Tu biografía <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></div>
        <div class="col"></div>
      </div>
      <div class="row">
        <div class="col"></div>
        <div class="col-10">
          <textarea id="txtBioLarge" oninput="objResources.txtCharCount(this.value.length,1000,$('#txtBioLengthLarge'));" class="form-control" rows="10" maxlength="1000" required></textarea>
          <p class="w3-right" id="txtBioLengthLarge">1000</p>
        </div>
        <div class="col"></div>
      </div>
      <div class="row w3-section">
        <div class="col"></div>
        <div class="col w3-center"><button id="btnSaveDataBioLarge" type="submit" class="w3-button btnColorHaCi">Continuar</button></div>
        <div class="col"></div>
      </div>
    </form>
  </div>
  <div class="divSmall">
    <form>
    <div class="row">
      <div class="col w3-large">Tu biografía <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></div>
    </div>
    <div class="row">
      <div class="col">
        <textarea id="txtBioSmall" oninput="objResources.txtCharCount(this.value.length,1000,$('#txtBioLengthSmall'));" class="form-control" rows="10" maxlength="1000" required></textarea>
        <p class="w3-right" id="txtBioLengthSmall">1000</p>
      </div>
    </div>
    <div class="row w3-section">
      <div class="col w3-center"><button id="btnSaveDataBioSmall" type="submit" class="w3-button btnColorHaCi">Continuar</button></div>
    </div>
  </form>
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
