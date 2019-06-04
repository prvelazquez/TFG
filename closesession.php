<?php 

//Gestion de sesiones
session_start();

//Desasignacion de variables de sesion
unset($_SESSION["idusuario"]); 
unset($_SESSION["nusuario"]);

//Destruccion de la session
session_destroy();

?>

