<?php
session_start();
if(!isset($_SESSION['admin']))
{
    header('Location: https://www.hagamoscine.com');
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
  <link rel="stylesheet" href="../styles/cssSkills.css">
  <link rel="stylesheet" href="../styles/cssLoad.css">
  <link rel="stylesheet" href="../styles/cssCheckbox.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="../scripts/jsResources.js"></script>
</head>
<body class="bgColor w3-text-white txtFontFamily">
<script>
  var objResources = null;
  $(document).ready(function(){
    objResources = new jsResources();

    getCountries();
    getFields();
    getSkills();
    getSelectFieldsSkills();
    getFieldsSkills();

    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings("#custom-file-label-large").addClass("selected").html(fileName);
    });

    $('#btnField').click(function(a){
      var b = document.getElementsByTagName('form')[1];
      if(b.checkValidity())
      {
        setField($('#txtField').val());
        a.preventDefault();
      }
    });

    $('#btnSkill').click(function(a){
      var b = document.getElementsByTagName('form')[2];
      if(b.checkValidity())
      {
        setSkill($('#txtSkill').val());
        a.preventDefault();
      }
    });

    $('#btnFieldsSkills').click(function(a){
      var b = document.getElementsByTagName('form')[3];
      if(b.checkValidity())
      {
        strField=$('#selectField').val();
        strSkill=$('#selectSkill').val();
        $.post('../bsns/bsnsLoad.php',{c:10,arg1:strField,arg2:strSkill},function(r){
          getFieldsSkills();
        });
        a.preventDefault();
      }
    });

  });

  function deleteCountry(strCode, strName){
      if(confirm('Estas seguro que quieres borrar el registro de '+strName)){
      $.post('../bsns/bsnsLoad.php',{c:2,arg:strCode},function(r){
        if(r==1){
          getCountries();
        }
        else {
          alert('intenta de nuevo');
        }
      });
    }
  }

  function deleteField(strCode, strName){
    if(confirm('Estas seguro que quieres borrar el registro de '+strName)){
    $.post('../bsns/bsnsLoad.php',{c:5,arg:strCode},function(r){
      if(r==1){
        getFields();
        getSelectFieldsSkills();
        getFieldsSkills();
      }
      else {
        alert('intenta de nuevo');
      }
    });
  }

  }

  function deleteSkill(strCode, strName){
    if(confirm('Estas seguro que quieres borrar el registro de '+strName)){
    $.post('../bsns/bsnsLoad.php',{c:8,arg:strCode},function(r){
      if(r==1){
        getSkills();
        getSelectFieldsSkills();
        getFieldsSkills();
      }
      else {
        alert('intenta de nuevo');
      }
    });
  }

  }

  function getCountries(){
    $.post('../bsns/bsnsLoad.php',{c:1},function(r){
      objResources.populateCountries($('#divCountries'),r);
    });
  }

  function setField(strName){
    $.post('../bsns/bsnsLoad.php',{c:3,arg:strName},function(r){
      if(r==1){
        getFields();
        getSelectFieldsSkills();
        getFieldsSkills();
      }
      else {
        alert('intenta de nuevo')
      }
    });
  }

  function getFields(){
    $.post('../bsns/bsnsLoad.php',{c:4},function(r){
      objResources.populateFileds($('#divFields'),r);
    });
  }

  function setSkill(strName){
    $.post('../bsns/bsnsLoad.php',{c:6,arg:strName},function(r){
      if(r==1){
        getSkills();
        getSelectFieldsSkills();
        getFieldsSkills();
      }
      else {
        alert('intenta de nuevo')
      }
    });
  }

  function getSkills(){
    $.post('../bsns/bsnsLoad.php',{c:7},function(r){
      objResources.populateSkills($('#divSkills'),r);
    });
  }

  function getSelectFieldsSkills(){
    $.post('../bsns/bsnsLoad.php',{c:9},function(r){
      objResources.populateSelectFieldsSkills($('#divPopulateFields'),$('#divPopulateSkills'),r);
    });
  }

  function getFieldsSkills(){
    $.post('../bsns/bsnsLoad.php',{c:11},function(r){
      objResources.populateFieldsSkills($('#divFieldsSkills'),r,'Small');
    });
  }

  function setColorField(element){
    $('.collapseColorHaCiSelected').each(function(i, obj) {
        $(this).removeClass('collapseColorHaCiSelected').addClass('collapseColorHaCi');
    });
    $(element).removeClass('collapseColorHaCi').addClass('collapseColorHaCiSelected');
  }

</script>
<div class="container">
  <div class="row">
    <div class="col w3-center">
      <img src="../images/logo2.svg" class="imgMarginLogo" alt="Logo hagamoscine">
    </div>
  </div>
  <div class="row w3-section">
    <div class="col w3-large">
      Módulo de administración
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card w3-margin">
        <form method="post" action="../bsns/bsnsUploadCountry.php" enctype="multipart/form-data">
          <div class="card-body w3-text-gray">
            <h5 class="card-title">Nuevo país</h5>
            <p class="card-text">Ingresa el nombre de un país y su bandera</p>
            <div class="input-group w3-section">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="Nombre del país" name="name" maxlength="20" required>
            </div>
            <div class="input-group w3-section">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-code"></i></span>
              </div>
              <input type="file" class="custom-file-input" name="fileToUpload"  id="inputGroupFile" required>
              <label id="custom-file-label-large" class="custom-file-label" for="inputGroupFile">Elige la bandera del país</label>
              <a class="aCountry" href="https://www.countryflags.com/image-overview/" target="_blank" >Descarga la bandera en formato png y de tamaño medio</a>
            </div>
            <button class="w3-button w3-text-white btnColorHaCi">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card w3-margin">
        <div class="card-body w3-text-gray">
          <h5 class="card-title">Lista de países</h5>
          <p class="card-text">Estos son los países disponibles</p>
          <div id="divCountries" class="divOverflow"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card w3-margin">
        <div class="card-body w3-text-gray">
          <form>
            <h5 class="card-title">Nueva area</h5>
            <p class="card-text">Ingresa el nombre del area</p>
            <div class="input-group w3-section">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa fa-th"></i></span>
              </div>
              <input id="txtField" type="text" class="form-control" placeholder="Nombre del area" name="name" maxlength="20" required>
            </div>
            <button id="btnField" class="w3-button w3-text-white btnColorHaCi">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card w3-margin">
        <div class="card-body w3-text-gray">
          <h5 class="card-title">Lista de areas</h5>
          <p class="card-text">Estas son las areas disponibles</p>
          <div id="divFields" class="divOverflow"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card w3-margin">
        <div class="card-body w3-text-gray">
          <form>
            <h5 class="card-title">Nuevo interés</h5>
            <p class="card-text">Ingresa el nombre del interés</p>
            <div class="input-group w3-section">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa fa-th"></i></span>
              </div>
              <input id="txtSkill" type="text" class="form-control" placeholder="Nombre del interes" name="name" maxlength="30" required>
            </div>
            <button id="btnSkill" class="w3-button w3-text-white btnColorHaCi">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card w3-margin">
        <div class="card-body w3-text-gray">
          <h5 class="card-title">Lista de intereses</h5>
          <p class="card-text">Estos son los intereses disponibles</p>
          <div id="divSkills" class="divOverflow"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card w3-margin">
        <div class="card-body w3-text-gray">
          <form>
            <h5 class="card-title">Areas e intereses</h5>
            <p class="card-text">Relaciona las areas con sus intereses</p>
            <div id="divPopulateFields"></div>
            <div id="divPopulateSkills"></div>
            <button id="btnFieldsSkills" class="w3-button w3-text-white btnColorHaCi">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card w3-margin">
        <div class="card-body w3-text-gray">
          <h5 class="card-title">Lista de areas e intereses</h5>
          <p class="card-text">Estos son las areas e intereses disponibles</p>
          <div id="divFieldsSkills"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card w3-margin">
        <div class="card-body w3-text-gray">
          <h5 class="card-title">Enviar mensaje a usuario</h5>
          <p class="card-text">Ingresa los datos requeridos</p>
          <form method="post" action="email.php">
            <div class="input-group mb-3">
              <span class="input-group-text"><i class="fa fa-chevron-right"></i></span>
              <input type="text" class="form-control" placeholder="nombre del destinatario" name="toName" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text"><i class="fa fa-chevron-right"></i></span>
              <input type="text" class="form-control" placeholder="correo destino" name="to" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text"><i class="fa fa-chevron-right"></i></span>
              <input type="text" class="form-control" placeholder="asunto" name="sub" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text"><i class="fa fa-chevron-right"></i></span>
              <input type="text" class="form-control" placeholder="mensaje" name="msg" required>
            </div>
            <button type="submit" class="w3-button w3-text-white btnColorHaCi">Enviar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row w3-margin w3-padding txtFooter">
    <div class="col w3-margin w3-padding">
      <label>Todos los derechos reservados 2021 - hagamoscine.com</label>
    </div>
  </div>
</div>
</body>
</html>
