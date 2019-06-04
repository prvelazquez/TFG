<?php 
$connection = mysqli_connect($host= '127.0.0.1',$user='root',$password='Sia12345',$database='tfg',$port='3306');

if($connection === false) { 
    echo 'Ha habido un error <br>';
    exit(); 
   } else {
    //echo 'Conectado a la base de datos<br>';
   }
?>