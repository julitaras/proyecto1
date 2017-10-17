<?php
session_start();

function validarInformacion($informacion){
  $arrayErrores = [];

  foreach ($informacion as $key => $value) {
    $informacion[$key] = trim($value);
  }

  if(strlen($informacion["nombre"])< 3 || strlen($informacion["nombre"]) > 20){
    $arrayErrores["nombre"] = "Nombre requiere + de 3 caracteres y - de 20";
  }

  if(strlen($informacion["apellido"]) < 0){
    $arrayErrores["apellido"] = "Campo vacío";
  }

  if(strlen($informacion["e-mail"]) == 0){
    $arrayErrores["e-mail"] = "Campo email vacío";
  }else if (filter_var($informacion["e-mail"], FILTER_VALIDATE_EMAIL) == false) {
    $arrayErrores["e-mail"] = "email no valido";
  }

  if($informacion["e-mail"] != $informacion["re-mail"]){
    $arrayErrores["e-mail"] = "El e-mail no verifica";

}
  if(strlen($informacion["password"]) < 6){
    $arrayErrores["password"] = "La contraseña debe tener al menos 6 caracteres";
  }else if ($informacion["password"] != $informacion["cpassword"]) {
    $arrayErrores["password"] = "La contraseña no verifica";
  }


$errorDeLaFoto = $_FILES["avatar"]["error"];
$nombreDeLaFoto = $_FILES["avatar"]["name"];
$extension = pathinfo($nombreDeLaFoto, PATHINFO_EXTENSION);

if ($errorDeLaFoto != UPLOAD_ERR_OK) {
  $arrayErrores["avatar"] = "Error al cargar la imagen";
}
else if ($extension != "jpg" && $extension != "jpeg" && $extension != "png" && $extension != "gif") {
  $arrayErrores["avatar"] = "Formato de imagen incorrecta";
}
else if($_FILES["avatar"]["error"] == UPLOAD_ERR_OK){
  $origen = $_FILES["avatar"]["tmp_name"];

  $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
  $nombreDeLaImagen = $_POST["e-mail"] . "." . $ext;
  $destino = __DIR__ . "/imagenes/" . $nombreDeLaImagen;
  move_uploaded_file($origen, $destino);
}
  return $arrayErrores;
}
function armarUsuario($informacion) {
  $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
  $nombreDeLaImagen = $_POST["e-mail"] . "." . $ext;
    return [
    "nombre" => $informacion["nombre"],
    "apellido" => $informacion["apellido"],
    "e-mail" => $informacion["e-mail"],
    "re-mail" => $informacion["re-mail"],
    "password" => password_hash($informacion["password"], PASSWORD_DEFAULT),
    "genero" => $informacion["genero"],
    "avatar" => $nombreDeLaImagen
  ];
}

function guardarUsuario($usuario) {
global $db;
$sql = "Insert into usuarios values (default, :e-mail, :password, :genero, :nombre)"
$query = $db->prepare($sql);

$query->bindValue(":e-mail",$usuario["e-mail"]);
$query->bindValue(":password",$usuario["password"]);
$query->bindValue(":genero",$usuario["genero"]);
$query->bindValue(":nombre",$usuario["nombre"]);

$query->execute();

$usuario["id"] = $db->lastInsertId();

return $usuario;
}

 ?>
