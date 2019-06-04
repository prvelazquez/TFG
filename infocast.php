<?php 

require('connectiondb.php');

//Obtenemos el id de la pelicula y el numero de actores del POST recibido
$id = $_POST['id_film'];
$nactors = $_POST['n_actors'];
//Busqueda de los actores que pertenecen al id de pelicula en la BBDD
$sql = "SELECT actors.id, actors.name, actors.lastname FROM cast,actors WHERE cast.id_film='$id' AND cast.id_actor = actors.id LIMIT 0,$nactors";
$result = mysqli_query($connection, $sql);

if ($result) {
    $queryresult = array();
    while($row = mysqli_fetch_assoc($result)) {
        $queryresult[] = $row;
    }
  }
  //Codificamos como JSON el resultado de la query
  echo json_encode($queryresult);

  mysqli_close($connection);
?>