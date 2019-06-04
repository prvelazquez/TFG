<?php 

require('connectiondb.php');

//Obtenemos el id de la pelicula y el id de usuario
$id_user = $_POST['id_user'];
$id_film = $_POST['id_film'];

//Busqueda de si existe un voto de ese usuario para la pelicula
$sql = "SELECT * FROM votes WHERE votes.id_film='$id_film' AND votes.id_user='$id_user'";
$result = mysqli_query($connection, $sql);

//Se obtiene el valor del voto
$row = mysqli_fetch_assoc($result);
$vote = $row["vote"];

$existevoto = (mysqli_num_rows($result) != 0);

if(!$existevoto){
  echo '<label id="esta_votado">Sin votar</label>';
  }else{
    echo '<label id="esta_votado">Tu voto</label>';
  }
//Escribir inicio definicion del combobox para el voto
echo '<select class="form-control" id="film_vote">';

//Iterar
if(!$existevoto){
  echo '<option value="0" selected>-</option>';
  echo '<option value="1">1</option>';
  echo '<option value="2">2</option>';
  echo '<option value="3">3</option>';
  echo '<option value="4">4</option>';
  echo '<option value="5">5</option>';
  echo '<option value="6">6</option>';
  echo '<option value="7">7</option>';
  echo '<option value="8">8</option>';
  echo '<option value="9">9</option>';
  echo '<option value="10">10</option>';
  }else{
    echo '<option value="0">-</option>';
    for ($i = 1; $i <= 10; $i++) {
      if($i==$vote){
        echo '<option value="'.$i.'" selected>'.$i.'</option>';
      }else{
        echo '<option value="'.$i.'">'.$i.'</option>';
      }
  }
  }

//Escribir fin definicion del combobox para el voto
echo '</select>';

  mysqli_close($connection);
?>