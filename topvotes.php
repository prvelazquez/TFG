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
$sql = "SELECT votes.id_film, votes.vote, films.spa_title, films.orig_title FROM votes, films WHERE votes.id_film = films.id and votes.id_user='$iduser' ORDER BY votes.vote DESC LIMIT 0,$nresults";
$result = mysqli_query($connection, $sql);
if ($result) {
  if (mysqli_num_rows($result)==0) {
    echo 'Sin votaciones del usuario';
  }else{
    while($row = mysqli_fetch_array($result)) {
      $id_film = $row['id_film'];
      $spa_title = $row['spa_title'];
			$orig_title = $row['orig_title'];
      $vote = $row['vote'];
      //echo '<a href="./film' .$id_film. '.html" class="list-group-item">'.$vote. ' | '.$spa_title.' / '.$orig_title.'</a>';
      echo '<a href="./film' .$id_film. '.html" class="list-group-item">'.$spa_title.' / '.$orig_title.'';
      echo '<span class="badge badge-primary badge-pill">'.$vote.'</span>';
      echo '</a>';
    }
  }
}

?>