<?php 

//Gestion de sesiones
session_start();

require('connectiondb.php');

//Obtenemos el nick y la contraseña del POST recibido
$nick = $_POST['nick'];
$pwd = $_POST['pwd'];


//Busqueda de campos vacios
if ($nick == "" || $pwd == "") {
    echo 'Rellene todos los campos por favor';
    exit();
  }

//Busqueda de nick existente
$sql = "SELECT * FROM users WHERE users.alias='$nick'";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result)==0) {
    echo 'El usuario no existe';
    exit();
  }

//Validación de la contraseña del usuario en base de datos
$sql = "SELECT * FROM users WHERE alias = '$nick' AND password = MD5('$pwd')";
$result = mysqli_query($connection, $sql);
if(mysqli_query($connection, $sql)){
    if (mysqli_num_rows($result)==0) {
        echo "Contraseña incorrecta";
        exit();
      }else{
        //Obtenemos el registro del usuario
        $row = mysqli_fetch_assoc($result);
        //Asignamos id de sesion
        $_SESSION["idusuario"] = $row["id"];
        //Asignamos nombre de sesion
        $_SESSION["nusuario"] = $row["name"];
        echo "Usuario correcto<br>";
        echo "ID del usuario en la sesion: ".$_SESSION["idusuario"];
      }
  }
  mysqli_close($connection);
?>