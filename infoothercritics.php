<?php

//Gestion de sesiones
session_start();

require('connectiondb.php');

//Obtenemos el id de la pelicula y el id del usuario del POST recibido
$id_user = $_POST['id_user'];
$id_film = $_POST['id_film'];

//Busqueda de si existe otras criticas para la pelicula
$sql = "SELECT critic, alias, users.id FROM critics, users WHERE critics.id_user = users.id and critics.id_film='$id_film'";
$result = mysqli_query($connection, $sql);

if ($result) {
  if (mysqli_num_rows($result)!=0) {
    echo '<dt class="titulo-search" id="seccion_critica_titulo">Críticas de los usuarios</dt>';
    //echo '<dt class="titulo-search">Criticas</dt>';
    while($row = mysqli_fetch_array($result)) {
      $critica = $row["critic"];
      $useralias = $row["alias"];
      echo '<dt class="titulo-atrib">Critica de '.$useralias.'</dt>';
      echo '<dd>'.$critica.'</dd>';
    }
  }
}
  mysqli_close($connection);
?>