<?php 

require('connectiondb.php');

//Obtenemos los datos del usuario
$nick = $_POST['nick'];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$rptpwd = $_POST['rptpwd'];

//Busqueda de campos vacios
if ($nick == "" || $name == "" || $lastname == "" || $email == "" || $pwd == "" || $rptpwd == "") {
    echo 'Rellene todos los campos por favor';
    exit();
  }
//Comprobacion de contraseña y nueva contraseña iguales
if ($pwd != $rptpwd) {
    echo 'Introduzca la misma contraseña en ambas ocasiones';
    exit();
  }
//Busqueda de email existente
$sql = "SELECT * FROM users WHERE users.email='$email'";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result)!=0) {
    echo 'El email ya se encuentra en nuestra base de datos. Elija un email diferente';
    exit();
  }

//Busqueda de nick existente
$sql = "SELECT * FROM users WHERE users.alias='$nick'";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result)!=0) {
    echo 'El usuario ya existe. Elija un nick diferente';
    exit();
  }

//Escritura de usuario en base de datos
$sql = "INSERT INTO tfg.users (name,lastname,alias,email,password) VALUES('$name','$lastname','$nick','$email',MD5('$pwd'));";
if(mysqli_query($connection, $sql)){
    echo 'Usuario registrado';
  }

  mysqli_close($connection);
?>