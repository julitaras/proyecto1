<?php
session_start();
//Abrir conexion aca solo para usarla una vez global $db;(pegar en 3 funciones)
function usuarioLogueado() {
  if (estaLogueado()) {
    return traerPorEmail($_SESSION["usuarioLogueado"]);
  }
  else {
    return NULL;
  }
}
function loguear($email) {
  $_SESSION["usuarioLogueado"] = $email;
}

function estaLogueado() {
  if (isset($_SESSION["usuarioLogueado"])) {
    return true;
  }
  else {
    return false;
  }
}
function recordarUsuario($email) {
  setcookie("usuarioLogueado", $email, time() + 360*24*7);
}
function traerTodos(){
global $db;
$sql = "Select * from usuarios";
$query = $db->prepare($sql);
$query->execute();
$final = $query->fetchAll(PDO::FETCH_ASSOC);
}
function traerPorEmail($email)
{
  global $db;
  $sql = "Select * from usuarios where e-mail = :e-mail";

  $query = $db->prepare($sql);

  $query->bindValue(":e-mail", $email);

  $query->execute();

  $usuario = $query->fetch(PDO::FETCH_ASSOC);

  return $usuario;
}
function validarLogin($info){
  $errores = [];

  if (strlen($info["e-mail"]) == 0) {
    $errores["e-mail"] = "No hay mail";
  }
  else if(filter_var($info["e-mail"], FILTER_VALIDATE_EMAIL) == false) {
    $errores["e-mail"] = "Pusiste un mail que no era valido";
  }
  else if (traerPorEmail($info["e-mail"]) == NULL) {
    $errores["e-mail"] = "El usuario no existe";
  } else {
    //Validar la contraseña
    $usuario = traerPorEmail($info["e-mail"]);
    if (password_verify($info["password"], $usuario["password"]) == false) {
      $errores["password"] = "La contraseña no verifica";
    }
  }

  return $errores;
}
function cerrarSesion(){
  if(isset($_SESSION['usuarioLogueado'])){
      session_destroy();

  }
}
 ?>
