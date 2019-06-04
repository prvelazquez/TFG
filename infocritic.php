<?php

//Gestion de sesiones
session_start();

require('connectiondb.php');

//Obtenemos el id de la pelicula y el id del usuario del POST recibido
$id_user = $_POST['id_user'];
$id_film = $_POST['id_film'];

//Busqueda de si existe una critica de ese usuario para la pelicula
$sql = "SELECT * FROM critics WHERE critics.id_film='$id_film' AND critics.id_user='$id_user'";
$result = mysqli_query($connection, $sql);

//Se obtiene el contenido de la critica
$row = mysqli_fetch_assoc($result);
$critica = $row["critic"];

$existecritica = (mysqli_num_rows($result) != 0);

if($existecritica){
  echo $critica;
  };

  mysqli_close($connection);
?>