<?php
session_start();
if(!isset($_SESSION['login']))
{
    header('Location: https://www.hagamoscine.com');
}
$objJson = json_decode(base64_decode($_GET['arg']));
//$strJson = base64_decode($_GET['arg']);
$json = base64_decode($_GET['arg']);
/*$objJson = json_decode($json);*/
//echo $objJson->email;
$json = str_replace('\n',' ',$json);
//echo $json;
?>
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
  <link rel="stylesheet" href="../styles/cssProfile.css">
  <link rel="stylesheet" href="../styles/cssCheckbox.css">
  <link rel="stylesheet" href="../styles/cssBreadcrums.css">
  <link rel="stylesheet" href="../styles/cssSkills.css">
  <link rel="stylesheet" href="../styles/cssHome.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="../scripts/jsResources.js" ></script>
</head>
<body class="w3-black">
<script>
  var objResources = null;
  $(document).ready(function(){
    objResources = new jsResources();
    getCountries();
    getCountriesToWork();
    getFieldsSkills();
    //alert('<?php echo $objJson->email; ?>');

    $('.navbar-nav>li>a').on('click', function(){
      $('.navbar-collapse').collapse('hide');
    });


    $('#btnSaveDataSmall').click(function(a){
        var b = document.getElementsByTagName('form')[1];
        if(b.checkValidity())
        {
          setDataSmallJson();
          a.preventDefault();
        }
    });


    $('#btnSaveDataLarge').click(function(a){
        var b = document.getElementsByTagName('form')[2];
        if(b.checkValidity())
        {
          setDataLargeJson();
          a.preventDefault();
        }
    });

    /*$('#btnHomeDataSmall').click(function(){
      objJson = {arg1:'<?php echo $objJson->email; ?>'};
      strJson = JSON.stringify(objJson);
      base = objResources.utf8_to_b64(strJson);
      $.post('../bsns/bsnsProfile.php',{c:2,arg:base},function(r){
        window.location.href = "../home/?arg="+r+"&result=1";
      });
    });*/

    /*$('#btnHomeData').click(function(){
      objJson = {arg1:'<?php echo $objJson->email; ?>'};
      strJson = JSON.stringify(objJson);
      base = objResources.utf8_to_b64(strJson);
      $.post('../bsns/bsnsProfile.php',{c:2,arg:base},function(r){
        window.location.href = "../home/?arg="+r+"&result=1";
      });
    });*/

  });

  function setDataSmallJson(){
    $.post('../bsns/bsnsHome.php',{c:2},function(s){
      $.post('../bsns/bsnsIndex.php',{c:2},function(r){
        objJson = {
          name:$('#txtSmallName').val(),
          lastname:$('#txtSmallLastname').val(),
          nickname:$('#txtSmallNickname').val(),
          country:$('#selectSmallCountry').val(),
          countryFlag:$('#selectSmallCountry').find(':selected').data('flag'),
          bio:$('#txtSmallBio').val(),
          yt:$('#txtSmallYT').val(),
          ig:$('#txtSmallIG').val(),
          vi:$('#txtSmallVI').val(),
          email:'<?php echo $objJson->email ?>'
        };
        for(i=0;i<s;i++){
          if($('#cbValPlaceSmall'+i).prop('checked')){
            objJson['cbValPlace'+i]=$('#cbValPlaceSmall'+i).val();
          }
        }
        for(i=0;i<r;i++){
          if($('#cbValSkillSmall'+i).prop('checked')){
            objJson['cbValSkill'+i]=$('#cbValSkillSmall'+i).val();
          }
        }
        strJson = JSON.stringify(objJson);
        base64 = objResources.utf8_to_b64(strJson);
        $.post('../bsns/bsnsProfile.php',{c:1,arg:base64},function(t){
          alert('Perfil actualizado');
        });
      });
    });
  }

  function setDataLargeJson(){
    $.post('../bsns/bsnsHome.php',{c:2},function(s){
      $.post('../bsns/bsnsIndex.php',{c:2},function(r){
        objJson = {
          name:$('#txtLargeName').val(),
          lastname:$('#txtLargeLastname').val(),
          nickname:$('#txtLargeNickname').val(),
          country:$('#selectLargeCountry').val(),
          countryFlag:$('#selectLargeCountry').find(':selected').data('flag'),
          bio:$('#txtLargeBio').val(),
          yt:$('#txtLargeYT').val(),
          ig:$('#txtLargeIG').val(),
          vi:$('#txtLargeVI').val(),
          email:'<?php echo $objJson->email ?>'
        };
        for(i=0;i<s;i++){
          if($('#cbValPlaceLarge'+i).prop('checked')){
            objJson['cbValPlace'+i]=$('#cbValPlaceLarge'+i).val();
          }
        }
        for(i=0;i<r;i++){
          if($('#cbValSkillLarge'+i).prop('checked')){
            objJson['cbValSkill'+i]=$('#cbValSkillLarge'+i).val();
          }
        }
        strJson = JSON.stringify(objJson);
        base64 = objResources.utf8_to_b64(strJson);
        $.post('../bsns/bsnsProfile.php',{c:1,arg:base64},function(t){
          alert('Perfil actualizado');
        });
      });
    });
  }

  function getCountries(){
    $.post('../bsns/bsnsIndex.php',{c:1},function(r){
      objResources.populateSelectCountries($('#selectLargeCountry'),r);
      objResources.populateSelectCountries($('#selectSmallCountry'),r);
      $('#selectLargeCountry').val('<?php echo $objJson->country; ?>');
      $('#selectSmallCountry').val('<?php echo $objJson->country; ?>');
    });
  }

    function getCountriesToWork(){
      $.post('../bsns/bsnsLoad.php',{c:1},function(r){
        $.post('../bsns/bsnsHome.php',{c:2},function(s){
          objResources.populateListPlaces($('#divSmallPlaces'),r,'Small');
          objResources.populateListPlaces($('#divLargePlaces'),r,'Large');
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
        });
      });

  }

  function getFieldsSkills(){
    $.post('../bsns/bsnsLoad.php',{c:11},function(r){
      objResources.populateFieldsSkills($('#divLargeFieldsSkills'),r,'Large');
      objResources.populateFieldsSkills($('#divSmallFieldsSkills'),r,'Small');
      objResources.populateFieldsSkillsSpan($('#divSmallFieldsSkillsSpan'),'<?php echo $json; ?>');
      objResources.populateFieldsSkillsSpan($('#divLargeFieldsSkillsSpan'),'<?php echo $json; ?>');
      $.post('../bsns/bsnsIndex.php',{c:2},function(s){
        objJson = JSON.parse('<?php echo $json; ?>');
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
      });
    });
  }


  function goHome(icoMenu){
    //alert(icoMenu);
    objJson = {arg1:'<?php echo $objJson->email; ?>'};
    strJson = JSON.stringify(objJson);
    base = objResources.utf8_to_b64(strJson);
    $.post('../bsns/bsnsProfile.php',{c:2,arg:base},function(r){
      window.location.href = "../home/?arg="+r+"&result=1";
    });
  }
</script>
<div class="container txtLineHKGrotesk">
  <!--<div class="row w3-section w3-center">
    <div class="col align-self-center">
      <img src="../images/web-brand-logotipo-2.png" class="imgMarginLogo" srcset="../images/web-brand-logotipo-2@2x.png 2x,../images/web-brand-logotipo-2@3x.png 3x">
    </div>
  </div>-->
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:rgba(255, 255, 255, 0.23);">
    <a class="navbar-brand w3-margin divSmall" href="#"><img style="width:190px;height:auto;" src="../images/web-brand-logotipo-2.png" alt="logo hagamos cine"></a>
    <a class="navbar-brand w3-margin divLarge" href="#"><img src="../images/web-brand-logotipo-2.png" alt="logo hagamos cine"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a title="Ir a Página de Inicio" onclick="goHome(1);" class="nav-link divLarge" href="#"><i id="icoBackMainLarge" class="fa fa-home w3-xxlarge w3-text-gray w3-hover-text-light-grey txtMarginIcon"></i></a>
            <a title="Ir a Página de Inicio" onclick="goHome(1);" id="icoBackMainSmall" class="nav-link divSmall w3-large w3-text-gray w3-hover-text-light-grey" href="#">Ir a inicio</a>
          </li>
          <li class="nav-item divLarge">
            <a class="nav-link" href="#"><img src="../uploads/<?php echo $objJson->shotSystem ?>" class="txtMarginImageProfile" alt="shot"></a>
          </li>
          <li class="nav-item dropdown txtMarginNameProfile divLarge">
            <a class="nav-link dropdown-toggle w3-medium" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $objJson->name ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <!--<a id="btnUpdateProfileLarge" class="dropdown-item" href="#">Actualizar perfil</a>-->
              <a class="dropdown-item" href="../bsns/bsnsLogout.php">Cerrar sesión</a>
            </div>
          </li>
          <li class="nav-item w3-margin divSmall">
            <a class="w3-large"><?php echo $objJson->name ?></a><br>
            <!--<a id="btnUpdateProfileSmall" class="btn btn-success">Actualizar perfil</a>-->
            <a href="../bsns/bsnsLogout.php" class="btn btnColorHaCi">Cerrar sesión</a>
          </li>
        </ul>
      </div>
  </nav>
  <div class="w3-margin">
    <!--<button id="btnHomeData" type="button" class="btn btnColorHaCi btnProfile w3-margin">Ir a Inicio</button>-->
<div id="divUpdateProfile">
  <div class="card">
    <div class="card-header" id="divUpdateProfileShot">
      <h5 class="w3-large">
        <button class="btn btn-link collapsed txtColorHaCi" data-toggle="collapse" data-target="#divUpdateProfileShotData" aria-expanded="true" aria-controls="divUpdateProfileShotData">
          Actualizar Headshot
        </button><i class="fa fa-angle-down w3-right w3-xlarge"></i>
      </h5>
    </div>
    <div id="divUpdateProfileShotData" class="collapse w3-black" aria-labelledby="divUpdateProfileShot" data-parent="#divUpdateProfile">
      <div class="card-body">
        <div class="row w3-center w3-section">
          <div class="col">
            <div class="row w3-center w3-section">
              <div class="col">
                <p>Actualiza tu headshot</p>
              </div>
            </div>
            <img class="rounded mx-auto d-block" src="../uploads/<?php echo $objJson->shotSystem ?>" alt="imagen de perfil" width="200px" height="auto">
            <form action="../bsns/bsnsUploadProfile.php" method="post" enctype="multipart/form-data">
              <div class="form-group w3-margin">
                <input type="file" class="form-control-file" name="fileToUpload" required>
                <input type="hidden" name="arg" value="<?php echo $objJson->email; ?>">
              </div>
              <button type="submit" name="submit" class="btn btnColorHaCi">Actualizar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="divUpdateProfileInfo">
      <h5 class="w3-large">
        <button class="btn btn-link collapsed txtColorHaCi" data-toggle="collapse" data-target="#divUpdateProfileInfoData" aria-expanded="false" aria-controls="divUpdateProfileInfoData">
          Actualizar Datos Generales<i class="fa fa-angle-down w3-right w3-xlarge"></i>
        </button>
      </h5>
    </div>
    <div id="divUpdateProfileInfoData" class="collapse w3-black" aria-labelledby="divUpdateProfileInfo" data-parent="#divUpdateProfile">
      <div class="card-body">
        <div class="divSmall">
          <div class="row w3-center w3-section">
            <div class="col">
              <p>Actualiza tus datos generales</p>
            </div>
          </div>
          <form>
            <div class="row justify-content-center w3-section">
              <div class="col">
                <label>Nombre <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                <input id="txtSmallName" type="text" class="form-control" maxlength="40" value="<?php echo $objJson->name ?>" required>
              </div>
            </div>
            <div class="row justify-content-center w3-section">
              <div class="col">
                <label>Apellidos <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                <input id="txtSmallLastname" type="text" class="form-control" maxlength="40" value="<?php echo $objJson->lastname ?>" required>
              </div>
            </div>
            <div class="row justify-content-center w3-section">
              <div class="col">
                <label>Nombre artístico <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                <input id="txtSmallNickname" type="text" class="form-control" maxlength="20" value="<?php echo $objJson->nickname ?>" required>
              </div>
            </div>
            <div class="row justify-content-center w3-section">
              <div class="col">
                <label>País de residencia <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                <select id="selectSmallCountry" class="form-select" style="width:100%;height:40px;" required></select>
              </div>
            </div>
            <div class="row justify-content-center w3-section">
              <div class="col"><label>Conecta tus redes sociales</label></div>
            </div>
            <div class="row justify-content-center w3-section">
              <div class="col">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-youtube-play"></i></span>
                  </div>
                  <input id="txtSmallYT" type="text" class="form-control" maxlength="60" value="<?php echo $objJson->yt ?>" placeholder="Agregar URL">
                </div>
              </div>
            </div>
            <div class="row justify-content-center w3-section">
              <div class="col">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-instagram"></i></span>
                  </div>
                  <input id="txtSmallIG" type="text" class="form-control" maxlength="60" value="<?php echo $objJson->ig ?>" placeholder="Agregar URL">
                </div>
              </div>
            </div>
            <div class="row justify-content-center w3-section">
              <div class="col">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-vimeo"></i></span>
                  </div>
                  <input id="txtSmallVI" type="text" class="form-control" maxlength="60" value="<?php echo $objJson->vi ?>" placeholder="Agregar URL">
                </div>
              </div>
          </div>
          <div class="row justify-content-center w3-section">
            <div class="col">
              <div class="card w3">
                <div class="card-body w3-text-gray">
                  <p class="card-title w3-large">Países disponibles para trabajar</p>
                  <div id="divSmallPlaces" class="divOverflow"></div>
                </div>
              </div>
            </div>
        </div>
        <div class="row justify-content-center w3-section">
          <div  class="col">
            <label>Biografía <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
            <textarea id="txtSmallBio" class="form-control" rows="10" maxlength="1000" required><?php echo $objJson->bio ?></textarea>
          </div>
        </div>
        <div class="row justify-content-center w3-section">
          <div  class="col">
            <label>Habilidades <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
            <div id="divSmallFieldsSkillsSpan"></div>
            <div id="divSmallFieldsSkills"></div>
          </div>
        </div>
            <div class="row w3-center divMargin">
              <div class="col"></div>
              <div class="col align-self-center">
                <button id="btnSaveDataSmall" type="submit" class="btn btnColorHaCi w3-margin">Actualizar</button>
                <!--<button id="btnHomeDataSmall" type="button" class="w3-button w3-grey btnProfile w3-margin">Ir a Inicio</button>-->
              </div>
              <div class="col"></div>
            </div>
          </form>
        </div>
        <div class="divLarge">
          <div class="row w3-center w3-section">
            <div class="col">
              <p>Actualiza tus datos generales</p>
            </div>
          </div>
          <form>
            <div class="row justify-content-around w3-section">
              <div class="col-5">
                <label>Nombre <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                <input id="txtLargeName" type="text" class="form-control" maxlength="40" value="<?php echo $objJson->name ?>" required>
              </div>
              <div class="col-5">
                <label>Apellidos <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                <input id="txtLargeLastname" type="text" class="form-control" maxlength="40" value="<?php echo $objJson->lastname ?>" required>
              </div>
            </div>
            <div class="row justify-content-around w3-section">
              <div class="col-5">
                <label>Nombre artístico <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                <input id="txtLargeNickname" type="text" class="form-control" maxlength="20" value="<?php echo $objJson->nickname ?>" required>
              </div>
              <div class="col-5">
                <label>País de residencia <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                <select id="selectLargeCountry" class="form-select" style="width:100%;height:40px;" required></select>
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
                  <input id="txtLargeYT" type="text" class="form-control" maxlength="60" value="<?php echo $objJson->yt ?>" placeholder="Agregar URL">
                </div>
              </div>
              <div class="col-5">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-instagram"></i></span>
                  </div>
                  <input id="txtLargeIG" type="text" class="form-control" maxlength="60" value="<?php echo $objJson->ig ?>" placeholder="Agregar URL">
                </div>
              </div>
            </div>
            <div class="row justify-content-around w3-section">
              <div class="col-5">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-vimeo"></i></span>
                  </div>
                  <input id="txtLargeVI" type="text" class="form-control" maxlength="60" value="<?php echo $objJson->vi ?>" placeholder="Agregar URL">
                </div>
                <br>
                <label>Biografía <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                <textarea id="txtLargeBio" class="form-control" rows="10" maxlength="1000" required><?php echo $objJson->bio ?></textarea>
              </div>
              <div class="col-5">
                <div class="card w3">
                  <div class="card-body w3-text-gray">
                    <p class="card-title w3-large">Países disponibles para trabajar</p>
                    <div id="divLargePlaces" class="divOverflow"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row justify-content-around w3-section">
              <div class="col"></div>
              <div class="col-11">
                <label>Habilidades <i class="fa fa-asterisk txtColorHaCi w3-tiny"></i></label>
                <div id="divLargeFieldsSkillsSpan"></div>
                <div id="divLargeFieldsSkills"></div>
              </div>
              <div class="col"></div>
            </div>
            <div class="row w3-center divMargin">
              <div class="col"></div>
              <div class="col align-self-center">
                <button id="btnSaveDataLarge" type="submit" class="btn btnColorHaCi w3-margin">Actualizar</button>
                <!--<button id="btnHomeDataLarge" type="button" class="w3-button w3-grey btnProfile w3-margin">Ir a Inicio</button>-->
              </div>
              <div class="col"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
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
