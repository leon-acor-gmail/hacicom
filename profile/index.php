<?php
session_start();
if(!isset($_SESSION['login']))
{
    header('Location: https://www.hagamoscine.com');
}
$objJson = json_decode(base64_decode($_GET['arg']));
$json = base64_decode($_GET['arg']);
$json = str_replace('\n',' ',$json);
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
  <link rel="stylesheet" href="../styles/cssProfile.css">
  <link rel="stylesheet" href="../styles/cssHome.css">
  <link rel="stylesheet" href="../styles/cssSkills.css">
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
    getCountries();
    getCountriesToWork();
    getFieldsSkills('<?php echo $json; ?>');

    $('.navbar-nav>li>a').on('click', function(){
      $('.navbar-collapse').collapse('hide');
    });

    $('#btnSaveDataSmall').click(function(a){
        var b = document.getElementsByTagName('form')[1];
        if(b.checkValidity())
        {
          setDataJson('Small');
          a.preventDefault();
        }
    });

    $('#btnSaveDataLarge').click(function(a){
        var b = document.getElementsByTagName('form')[2];
        if(b.checkValidity())
        {
          setDataJson('Large');
          a.preventDefault();
        }
    });

    var strShotSystem = '../uploads/<?php echo $objJson->shotSystem ?>';
    var strName = '<?php echo $objJson->name ?>';
    objResources.getShotOrientation(strShotSystem,'Icon',$('#divShotSystemIcon'),$('#divLoader'),strName);
    objResources.getShotOrientation(strShotSystem,'', $('#divShotSystem'),$('#divLoader'),strName);

  });

  function setDataJson(strResponsive){
    $('#divLoader').show();
    $.post('../bsns/bsnsHome.php',{c:2},function(s){
      $.post('../bsns/bsnsIndex.php',{c:2},function(r){
        objJson = {
          name:$('#txtName'+strResponsive).val(),
          lastname:$('#txtLastname'+strResponsive).val(),
          nickname:$('#txtNickname'+strResponsive).val(),
          country:$('#selectCountry'+strResponsive).val(),
          countryFlag:$('#selectCountry'+strResponsive).find(':selected').data('flag'),
          bio:$('#txtBio'+strResponsive).val(),
          yt:$('#txtYT'+strResponsive).val(),
          ig:$('#txtIG'+strResponsive).val(),
          vi:$('#txtVI'+strResponsive).val(),
          email:'<?php echo $objJson->email ?>'
        };
        for(i=0;i<s;i++){
          if($('#cbValPlace'+strResponsive+i).prop('checked')){
            objJson['cbValPlace'+i]=$('#cbValPlace'+strResponsive+i).val();
          }
        }
        for(i=0;i<r;i++){
          if($('#cbValSkill'+strResponsive+i).prop('checked')){
            objJson['cbValSkill'+i]=$('#cbValSkill'+strResponsive+i).val();
          }
        }
        strJson = JSON.stringify(objJson);
        base64 = objResources.utf8_to_b64(strJson);
        $.post('../bsns/bsnsProfile.php',{c:1,arg:base64},function(t){
          objJsonLogin= {arg1:'<?php echo $objJson->email; ?>'};
          strJsonLogin = JSON.stringify(objJsonLogin);
          base64Login = objResources.utf8_to_b64(strJsonLogin);
          $.post('../bsns/bsnsHome.php',{c:11,arg:base64Login},function(u){
            strJsonURL = objResources.b64_to_utf8(u);
            $('#divLoader').hide();
            getFieldsSkills(strJsonURL);
            setDivAlert('Atenci??n','Actualizaci??n exitosa');
          });
        });
      });
    });
  }

  function getCountries(){
    $('#divLoader').show();
    $.post('../bsns/bsnsIndex.php',{c:1},function(r){
      objResources.populateSelectCountries($('#selectCountryLarge'),r);
      objResources.populateSelectCountries($('#selectCountrySmall'),r);
      $('#selectCountryLarge').val('<?php echo $objJson->country; ?>');
      $('#selectCountrySmall').val('<?php echo $objJson->country; ?>');
      $('#divLoader').hide();
    });
  }

    function getCountriesToWork(){
      $('#divLoader').show();
      $.post('../bsns/bsnsLoad.php',{c:1},function(r){
        $.post('../bsns/bsnsHome.php',{c:2},function(s){
          objResources.populateListPlaces($('#divPlacesSmall'),r,'Small');
          objResources.populateListPlaces($('#divPlacesLarge'),r,'Large');
          objJson = JSON.parse('<?php echo $json; ?>');
          for(i=0;i<s;i++){
            for(j=0;j<s;j++){
              if($('#cbValPlaceSmall'+j).val()==objJson['cbValPlace'+i]){
                $('#cbValPlaceSmall'+j).prop('checked',true);
              }
              if($('#cbValPlaceLarge'+j).val()==objJson['cbValPlace'+i]){
                $('#cbValPlaceLarge'+j).prop('checked',true);
              }
            }
          }
          $('#divLoader').hide();
        });
      });
  }

  function getFieldsSkills(strJsonURL){
    $('#divLoader').show();
    $.post('../bsns/bsnsLoad.php',{c:11},function(r){
      objResources.populateFieldsSkills($('#divFieldsSkillsLarge'),r,'Large');
      objResources.populateFieldsSkills($('#divFieldsSkillsSmall'),r,'Small');
      objResources.populateFieldsSkillsSpan($('#divFieldsSkillsSpanSmall'),strJsonURL);
      objResources.populateFieldsSkillsSpan($('#divFieldsSkillsSpanLarge'),strJsonURL);
      $.post('../bsns/bsnsIndex.php',{c:2},function(s){
        objJson = JSON.parse(strJsonURL);
        for(i=0;i<s;i++){
          for(j=0;j<s;j++){
            if($('#cbValSkillLarge'+j).val()==objJson['cbValSkill'+i]){
              $('#cbValSkillLarge'+j).prop('checked',true);
            }
            if($('#cbValSkillSmall'+j).val()==objJson['cbValSkill'+i]){
              $('#cbValSkillSmall'+j).prop('checked',true);
            }
          }
        }
        $('#divLoader').hide();
      });
    });
  }

  function goHome(icoMenu){
    $('#divLoader').show();
    objJson = {arg1:'<?php echo $objJson->email; ?>'};
    strJson = JSON.stringify(objJson);
    base = objResources.utf8_to_b64(strJson);
    $.post('../bsns/bsnsProfile.php',{c:2,arg:base},function(r){
      $('#divLoader').hide();
      window.location.href = "../home/?arg="+r+"&result=1";
    });
  }

  function setColorField(element){
    $('.collapseColorHaCiSelected').each(function(i, obj) {
        $(this).removeClass('collapseColorHaCiSelected').addClass('collapseColorHaCi');
    });
    $(element).removeClass('collapseColorHaCi').addClass('collapseColorHaCiSelected');
  }

  function setDivAlert(strHeaderMsg,strMsg){
    $('#txtMsgHeaderAlert').text(strHeaderMsg);
    $('#txtMsgAlert').text(strMsg);
    $('#divAlert').show();
  }
</script>
<div class="container">
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:rgba(255, 255, 255, 0.23);box-shadow: 1px 1px 2px grey;">
    <a class="navbar-brand w3-margin divSmall" href="#"><img style="width:190px;height:auto;" src="../images/logo2.svg" alt="Logo Hagamos Cine"></a>
    <a class="navbar-brand w3-margin divLarge" href="#"><img src="../images/logo2.svg" alt="Logo Hagamos Cine"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a title="Ir a P??gina de Inicio" onclick="goHome(1);" class="nav-link divLarge" href="#"><i id="icoBackMainLarge" class="fa fa-home w3-xxlarge w3-text-gray w3-hover-text-light-grey txtMarginIcon"></i></a>
            <a title="Ir a P??gina de Inicio" onclick="goHome(1);" id="icoBackMainSmall" class="nav-link divSmall w3-large w3-text-gray w3-hover-text-light-grey" href="#">Ir a inicio</a>
          </li>
          <li class="nav-item w3-margin divSmall">
            <a class="w3-large"><?php echo $objJson->nickname; ?></a><br>
            <a onclick="goHome(1);" class="w3-button w3-block w3-indigo" style="margin-top:15px;text-decoration: none;">Ir a inicio</a>
            <a href="../bsns/bsnsLogout.php" class="w3-button w3-block w3-pink" style="margin-top:5px;text-decoration: none;">Cerrar sesi??n</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item dropdown divLarge txtMarginNameProfile">
            <a class="nav-link dropdown-toggle w3-medium" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $objJson->nickname; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#" onclick="goHome(1);">Ir a inicio</a>
              <a class="dropdown-item" href="../bsns/bsnsLogout.php">Cerrar sesi??n</a>
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
<div id="divUpdateProfile">
  <div class="card">
    <div class="card-header" id="divUpdateProfileShot">
      <div class="w3-container collapsed" data-toggle="collapse" data-target="#divUpdateProfileShotData" aria-expanded="true" aria-controls="divUpdateProfileShotData">
        <button class="btn btn-link txtColorHaCi txtHoverProfile">
          Actualizar Headshot
        </button>
        <i class="fa fa-angle-down txtColorHaCi w3-right w3-xlarge" style="cursor:pointer;"></i>
      </div>
    </div>
    <div id="divUpdateProfileShotData" class="collapse bgColor" aria-labelledby="divUpdateProfileShot" data-parent="#divUpdateProfile">
      <div class="card-body">
        <div class="row">
          <div class="col w3-center">
            <p>Actualiza tu headshot</p>
          </div>
        </div>
        <div class="row">
          <div class="col w3-center">
            <div id="divShotSystem"></div>
            <form action="../bsns/bsnsUploadProfile.php" method="post" enctype="multipart/form-data" onsubmit="document.getElementById('divLoader').style.display='block';">
              <div class="form-group w3-margin">
                <input type="file" class="form-control-file" name="fileToUpload" required>
                <input type="hidden" name="arg" value="<?php echo $objJson->email; ?>">
              </div>
              <div class="divSmall">
                <div class="row w3-section">
                  <div class="col">
                    <button type="submit" name="submit" class="w3-button btnColorHaCi">Actualizar</button>
                  </div>
                </div>
              </div>
              <div class="divLarge">
                <div class="row w3-section">
                  <div class="col"></div>
                  <div class="col">
                    <button type="submit" name="submit" class="w3-button btnColorHaCi">Actualizar</button>
                  </div>
                  <div class="col"></div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="divUpdateProfileInfo">
      <div class="w3-container collapsed" data-toggle="collapse" data-target="#divUpdateProfileInfoData" aria-expanded="false" aria-controls="divUpdateProfileInfoData">
        <button class="btn btn-link txtColorHaCi txtHoverProfile">
          Actualizar Datos Generales
        </button>
        <i class="fa fa-angle-down txtColorHaCi w3-right w3-xlarge" style="cursor:pointer;"></i>
      </div>
    </div>
    <div id="divUpdateProfileInfoData" class="collapse bgColor" aria-labelledby="divUpdateProfileInfo" data-parent="#divUpdateProfile">
      <div class="card-body">
        <div class="divSmall">
          <div class="row">
            <div class="col w3-center">
              <p>Actualiza tus datos generales</p>
            </div>
          </div>
          <form>
            <div class="row w3-section">
              <div class="col">
                <label>Nombre <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                <input id="txtNameSmall" type="text" class="form-control" maxlength="40" value="<?php echo $objJson->name ?>" required>
              </div>
            </div>
            <div class="row w3-section">
              <div class="col">
                <label>Apellidos <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                <input id="txtLastnameSmall" type="text" class="form-control" maxlength="40" value="<?php echo $objJson->lastname ?>" required>
              </div>
            </div>
            <div class="row w3-section">
              <div class="col">
                <label>Nombre art??stico <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                <input id="txtNicknameSmall" type="text" class="form-control" maxlength="20" value="<?php echo $objJson->nickname ?>" required>
              </div>
            </div>
            <div class="row w3-section">
              <div class="col">
                <label>Pa??s de residencia <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                <select id="selectCountrySmall" class="form-select" style="width:100%;height:40px;" required></select>
              </div>
            </div>
            <div class="row w3-section">
              <div class="col"><label>Conecta tus redes sociales</label></div>
            </div>
            <div class="row w3-section">
              <div class="col">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-youtube-play"></i></span>
                  </div>
                  <input id="txtYTSmall" type="text" class="form-control" maxlength="60" value="<?php echo $objJson->yt ?>" placeholder="Agregar URL">
                </div>
              </div>
            </div>
            <div class="row w3-section">
              <div class="col">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-instagram"></i></span>
                  </div>
                  <input id="txtIGSmall" type="text" class="form-control" maxlength="60" value="<?php echo $objJson->ig ?>" placeholder="Agregar URL">
                </div>
              </div>
            </div>
            <div class="row w3-section">
              <div class="col">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-vimeo"></i></span>
                  </div>
                  <input id="txtVISmall" type="text" class="form-control" maxlength="60" value="<?php echo $objJson->vi ?>" placeholder="Agregar URL">
                </div>
              </div>
            </div>
            <div class="row w3-section">
              <div class="col">
                <div class="card w3">
                  <div class="card-body w3-text-gray">
                    <p class="card-title w3-large">Pa??ses disponibles para trabajar</p>
                    <div id="divPlacesSmall" class="divOverflow"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row w3-section">
              <div  class="col">
                <label>Biograf??a <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                <textarea id="txtBioSmall" class="form-control" rows="10" maxlength="1000" required><?php echo $objJson->bio ?></textarea>
              </div>
            </div>
            <div class="row w3-section">
              <div class="col">
                <label>Habilidades <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                <div id="divFieldsSkillsSpanSmall"></div>
                <div id="divFieldsSkillsSmall"></div>
              </div>
            </div>
            <div class="row w3-section">
              <div class="col">
                <button id="btnSaveDataSmall" type="submit" class="w3-button btnColorHaCi">Actualizar</button>
              </div>
            </div>
          </form>
        </div>
        <div class="divLarge">
            <div class="row">
              <div class="col w3-center">
                <p>Actualiza tus datos generales</p>
              </div>
            </div>
            <form>
              <div class="row justify-content-around w3-section">
                <div class="col-5">
                  <label>Nombre <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                  <input id="txtNameLarge" type="text" class="form-control" maxlength="40" value="<?php echo $objJson->name ?>" required>
                </div>
                <div class="col-5">
                  <label>Apellidos <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                  <input id="txtLastnameLarge" type="text" class="form-control" maxlength="40" value="<?php echo $objJson->lastname ?>" required>
                </div>
              </div>
              <div class="row justify-content-around w3-section">
                <div class="col-5">
                  <label>Nombre art??stico <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                  <input id="txtNicknameLarge" type="text" class="form-control" maxlength="20" value="<?php echo $objJson->nickname ?>" required>
                </div>
                <div class="col-5">
                  <label>Pa??s de residencia <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                  <select id="selectCountryLarge" class="form-select" style="width:100%;height:40px;" required></select>
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
                    </div>
                    <input id="txtYTLarge" type="text" class="form-control" maxlength="60" value="<?php echo $objJson->yt ?>" placeholder="Agregar URL">
                  </div>
                </div>
                <div class="col-5">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-instagram"></i></span>
                    </div>
                    <input id="txtIGLarge" type="text" class="form-control" maxlength="60" value="<?php echo $objJson->ig ?>" placeholder="Agregar URL">
                  </div>
                </div>
              </div>
              <div class="row justify-content-around w3-section">
                <div class="col-5">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-vimeo"></i></span>
                    </div>
                    <input id="txtVILarge" type="text" class="form-control" maxlength="60" value="<?php echo $objJson->vi ?>" placeholder="Agregar URL">
                  </div>
                  <br>
                  <label>Biograf??a <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                  <textarea id="txtBioLarge" class="form-control" rows="10" maxlength="1000" required><?php echo $objJson->bio ?></textarea>
                </div>
                <div class="col-5">
                  <div class="card w3">
                    <div class="card-body w3-text-gray">
                      <p class="card-title w3-large">Pa??ses disponibles para trabajar</p>
                      <div id="divPlacesLarge" class="divOverflow"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row justify-content-around w3-section">
                <div class="col"></div>
                <div class="col-11">
                  <label>Habilidades <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                  <div id="divFieldsSkillsSpanLarge"></div>
                  <div id="divFieldsSkillsLarge"></div>
                </div>
                <div class="col"></div>
              </div>
              <div class="row w3-section">
                <div class="col"></div>
                <div class="col">
                  <button id="btnSaveDataLarge" type="submit" class="w3-button btnColorHaCi">Actualizar</button>
                </div>
                <div class="col"></div>
              </div>
            </form>
          </div>
      </div>
    </div>
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
