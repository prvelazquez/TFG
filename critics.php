<?php 

require('connectiondb.php');
//Obtenemos la información del POST recibido
$nresults = $_POST['n_results'];
$iduser = $_POST['iduser'];
//Comprobamos si viene vacío
if($iduser == "") { 
  exit();
 }

//Se realiza una busqueda en los votos del usuario
//$sql = "SELECT critics.id_film, critics.critic, films.spa_title, films.orig_title, votes.vote FROM critics, films, votes WHERE critics.id_film = films.id and films.id = votes.id_film and votes.id_user ='$iduser' and critics.id_user='$iduser' LIMIT 0,$nresults";
$sql = "SELECT critics.id_film, critics.critic, films.spa_title, films.orig_title, votes.vote FROM critics LEFT JOIN films ON (critics.id_film = films.id) LEFT JOIN votes ON (films.id = votes.id_film) where critics.id_user = '$iduser' AND (votes.id_user = '$iduser' OR votes.id_user is null) LIMIT 0,$nresults";
$result = mysqli_query($connection, $sql);
if ($result) {
  if (mysqli_num_rows($result)==0) {
    echo 'Sin criticas del usuario';
  }else{
    echo '<div class="list-group">';
    while($row = mysqli_fetch_array($result)) {
      $id_film = $row['id_film'];
      $spa_title = $row['spa_title'];
			$orig_title = $row['orig_title'];
      $critic = $row['critic'];
      $vote = $row['vote'];
      //Si el valor del voto es vacío se mostrará un guión '-'
      if($vote == ""){
        $vote = '-';
      }
      echo '<a href="/film'.$id_film.'.html" class="list-group-item list-group-item-action flex-column align-items-start">';
      echo '<div class="d-flex w-100 justify-content-between">';
      echo '<div class="pull-right">';
      echo '<img class="float-right" width="60" height="" src="img/film'.$id_film.'.jpg" />';
      echo '</div>';
      echo '<h5 class="mb-1">'.$spa_title.' / '.$orig_title.'</h5>';
      echo '<small>Critica:</small>';
      echo '</div>';
      echo '<p class="mb-1">'.$critic.'</p>';
      echo '<small>Nota: '.$vote.'</small>';
      echo '</a>';

    }
    echo '</div>';
  }
}

?>