<?php
$json='';
if($_POST['txtUploadResponsiveSmall']==1){
  $json = json_decode(base64_decode($_POST['txtDataUploadSmall']));
}
elseif($_POST['txtUploadResponsiveLarge']==2){
  $json = json_decode(base64_decode($_POST['txtDataUploadLarge']));
}
else {
  echo 'Lo sentimos, ocurrio un error intenta de nuevo, gracias';
}
$target_dir = "../uploads/";
$target_file_user = basename($_FILES["fileToUpload"]["name"]);
$h = hash('ripemd160',$target_file_user);
$dat = date("Ymd_His");
$fileType = pathinfo($target_file_user,PATHINFO_EXTENSION);
$target_name = $json->email.'_'.$dat.'_'.$h.'.'.$fileType;
$target_file = $target_dir.$target_name;
//echo $json->email;
//$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    //echo "El archivo es una imagen - " . $check["mime"] . ". --- ";
    $uploadOk = 1;
  } else {
    echo "La foto no es una imagen. --- ";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Lo sientimos, ya existe el archivo con el mismo nombre. --- ";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Lo sentimos, tu foto es demasiado grande [max 5MB]. --- ";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  echo "Lo sentimos, solo imagenes en formato jpg y png son permitidas. --- ";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Lo sentimos, ocurrió un error, intentalo más tarde. --- ";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $json->shotUser=htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
    $json->shotSystem=$target_name;
    header('Location: ../../signup/shot.php?arg='.base64_encode(json_encode($json)).'&c=1');
    //echo "La foto ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " se envió con éxito. --- ";
  } else {
    echo "Lo sentimos, ocurrió un error, intentalo más tarde. --- ";
  }
}
?>
