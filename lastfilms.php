<?php 

require('connectiondb.php');
//Obtenemos la información del POST recibido
$nresults = $_POST['n_results'];

//Se realiza una busqueda en las ultimas peliculas añadidas
$sql = "SELECT * FROM films ORDER BY id DESC LIMIT 0,$nresults";
$result = mysqli_query($connection, $sql);
if ($result) {
  if (mysqli_num_rows($result)==0) {
    echo 'Sin peliculas en la BD';
  }else{
    echo '<div class="list-group">';
    while($row = mysqli_fetch_array($result)) {
      $id_film = $row['id'];
      $spa_title = $row['spa_title'];
			$orig_title = $row['orig_title'];
      $country = $row['country'];
      $year = $row['year'];
      $director = $row['director'];
      $duration = $row['duration_min'];
      //Se buscan los actores que han particiado en la pelicula
      $lista_actores = '';
      $sqlcast = "SELECT actors.name, actors.lastname FROM cast LEFT JOIN actors ON (cast.id_actor = actors.id) WHERE cast.id_film = '$id_film' LIMIT 0,6";
      $resultcast = mysqli_query($connection, $sqlcast);
      if ($resultcast) {
        if (mysqli_num_rows($resultcast)!=0) {
          while($rowcast = mysqli_fetch_array($resultcast)) {
          $name = $rowcast['name'];
          $lastname = $rowcast['lastname'];

          $lista_actores = $lista_actores.$name.' '.$lastname.', ';
          }
          $lista_actores = $lista_actores.'...';
      }
    }
      echo '<a href="/film'.$id_film.'.html" class="list-group-item list-group-item-action flex-column">';
      echo '<div class="d-flex w-200">';
      echo '<div class="pull-right">';
      echo '<img class="float-right" width="60" height="" src="img/film'.$id_film.'.jpg" />';
      echo '</div>';
      echo '<div class="info-film">';
      echo '<h5 class="mb-1">'.$spa_title.' / '.$orig_title.'</h5>';
      echo '<p class="mb-1">Año: '.$year.'</p>';
      echo '<small>Director: '.$director.'</small>';
      echo '</div>';
      echo '<small>Actores: '.$lista_actores.'</small>';
      echo '</div>';
      echo '</a>';

    }
    echo '</div>';
  }
}

?>