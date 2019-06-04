<?php 

require('connectiondb.php');

//Obtenemos el id de la pelicula, la crítica y el usuario que la emite
$film_critic = $_POST['film_critic'];
$idfilm = $_POST['idfilm'];
$user = $_POST['user'];


//Busqueda de si existe una critica  de ese usuario para la pelicula
$sql = "SELECT * FROM critics WHERE critics.id_film='$idfilm' AND critics.id_user='$user'";
$result = mysqli_query($connection, $sql);

$existecritica = (mysqli_num_rows($result) != 0);

//Si existe y el contenido de la critica no es vacio, se añade
if(!$existecritica && $film_critic != ""){
  $sql = "INSERT INTO critics (id_film,id_user,critic) VALUES('$idfilm','$user','$film_critic')";
  $result = mysqli_query($connection, $sql);
  //echo 'Si no existe y el contenido de la critica no es vacio, se añade';
}
//Si existe y el nuevo valor es vacio, se borra
if($existecritica){
  if($film_critic == ""){
    $sql = "DELETE FROM critics WHERE critics.id_film='$idfilm' AND critics.id_user='$user'";
    $result = mysqli_query($connection, $sql);
    //echo 'Si existe y el nuevo valor es vacio, se borra';

  }
  //Si no, se actualiza
  else{
  $sql = "UPDATE critics SET critic = '$film_critic' WHERE critics.id_film='$idfilm' AND critics.id_user='$user'";
  $result = mysqli_query($connection, $sql);
  //echo 'Si no, se actualiza';
  }
}


  mysqli_close($connection);
?>