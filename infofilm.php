<?php 

require('connectiondb.php');

//Obtenemos el id de la pelicula del POST recibido
$id = $_POST['id_film'];
//Busqueda del ID en la BBDD
$sql = "SELECT id, spa_title, orig_title, country, year, director, duration_min FROM films WHERE id='$id'";
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