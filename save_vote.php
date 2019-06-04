<?php 

require('connectiondb.php');

//Obtenemos el id de la pelicula y el voto y el usuario que lo emite
$inputvote = $_POST['inputvote'];
$idfilm = $_POST['idfilm'];
$user = $_POST['user'];

//Busqueda de si existe un voto de ese usuario para la pelicula
$sql = "SELECT * FROM votes WHERE votes.id_film='$idfilm' AND votes.id_user='$user'";
$result = mysqli_query($connection, $sql);

$existevoto = (mysqli_num_rows($result) != 0);

//Si no existe, se añade
if(!$existevoto){
  $sql = "INSERT INTO votes (id_film,id_user,vote) VALUES('$idfilm','$user','$inputvote')";
  $result = mysqli_query($connection, $sql);
  echo 'Tu voto';
}
//Si existe y el nuevo valor es 0, se borra
if($existevoto){
  if($inputvote == "0"){
    $sql = "DELETE FROM votes WHERE votes.id_film='$idfilm' AND votes.id_user='$user'";
    $result = mysqli_query($connection, $sql);
    echo 'Sin votar';
  }
  //Si no, se actualiza
  else{
  $sql = "UPDATE votes SET vote = '$inputvote' WHERE votes.id_film='$idfilm' AND votes.id_user='$user'";
  $result = mysqli_query($connection, $sql);
  echo 'Tu voto';
  }
}

  mysqli_close($connection);
?>