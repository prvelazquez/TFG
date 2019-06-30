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
    
  /*echo '<div class="form-group" id="seccion_critica">';
  echo '<dt class="titulo-search" id="seccion_critica_titulo">Tu crítica</dt>';
  echo '<textarea class="form-control" id="film_critic" rows="3"></textarea>';
  echo '</div>';
  echo '<button type="button" class="btn btn-default" id="boton_guardar_critica">GUARDAR</button>';
  echo '<button type="button" class="btn btn-default" id="boton_borrar_critica">BORRAR</button>';*/



  mysqli_close($connection);
?>