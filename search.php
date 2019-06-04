<?php 

require('connectiondb.php');

//Obtenemos el texto de la busqueda del POST recibido
$texto_busq = $_POST['texto_busqueda'];
$texto_busqueda = str_replace('+', '%', $texto_busq);
//Comprobamos si viene vacío
if($texto_busqueda == "") { 
  exit();
 }


//Se realiza una busqueda en los titulos de las peliculas
$sql = "SELECT * FROM films WHERE UPPER(films.spa_title) like UPPER('%$texto_busqueda%') OR UPPER(films.orig_title) like UPPER('%$texto_busqueda%')";
$result = mysqli_query($connection, $sql);
if ($result) {
  echo '<dt class="titulo-search">Busqueda por titulo</dt>';
  if (mysqli_num_rows($result)==0) {
    echo 'Búsqueda sin resultados';
  }else{
    while($row = mysqli_fetch_array($result)) {
      $id_film = $row['id'];
      $spa_title = $row['spa_title'];
			$orig_title = $row['orig_title'];
      $country = $row['country'];
      $year = $row['year'];
      $director = $row['director'];
      $duration_min = $row['duration_min'];
      echo '<a href="./film' .$id_film. '.html" class="list-group-item">'.$spa_title. ' / '.$orig_title.'</a>';
    }
  }
}

//Se realiza una busqueda en los directores de las peliculas
$sql = "SELECT * FROM films WHERE UPPER(films.director) like UPPER('%$texto_busqueda%')";
$result = mysqli_query($connection, $sql);
if ($result) {
  echo '<dt class="titulo-search">Busqueda por director</dt>';
  if (mysqli_num_rows($result)==0) {
    echo 'Búsqueda sin resultados';
  }else{
    while($row = mysqli_fetch_array($result)) {
      $id_film = $row['id'];
      $spa_title = $row['spa_title'];
			$orig_title = $row['orig_title'];
      $country = $row['country'];
      $year = $row['year'];
      $director = $row['director'];
      $duration_min = $row['duration_min'];
      echo '<a href="./film' .$id_film. '.html" class="list-group-item">'.$spa_title. ' / '.$orig_title.'</a>';
    }
  }
}

//Se realiza una busqueda en los actores por los atributos nombre, apellidos y la concatenacion de ambos
$sql = "SELECT films.id,films.spa_title,films.orig_title FROM actors, cast, films WHERE films.id = cast.id_film AND cast.id_actor = actors.id AND (UPPER(actors.name) like UPPER('%$texto_busqueda%') OR UPPER(actors.lastname) like UPPER('%$texto_busqueda%') OR UPPER(CONCAT( actors.name, \" \", actors.lastname )) like UPPER('%$texto_busqueda%')) GROUP BY films.id";
$result = mysqli_query($connection, $sql);
if ($result) {
  echo '<dt class="titulo-search">Busqueda por actor</dt>';
  if (mysqli_num_rows($result)==0) {
    echo 'Búsqueda sin resultados';
    exit();
  }else{
    while($row = mysqli_fetch_array($result)) {
      $id_film = $row['id'];
      $spa_title = $row['spa_title'];
			$orig_title = $row['orig_title'];
      echo '<a href="./film' .$id_film. '.html" class="list-group-item">'.$spa_title. ' / '.$orig_title.'</a>';
    }
  }
}
?>