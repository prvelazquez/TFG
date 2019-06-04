<?php 

//Gestion de sesiones
session_start();

$userinfo=array('','');
//Comprobacion de valores de sesion rellenos
if (! empty($_SESSION["idusuario"]) && ! empty($_SESSION["nusuario"])) {

  //Se devuelven valores de sesion
  $userinfo=array($_SESSION["idusuario"],$_SESSION["nusuario"]);

  //echo $_SESSION["idusuario"];
}

echo json_encode($userinfo);

?>