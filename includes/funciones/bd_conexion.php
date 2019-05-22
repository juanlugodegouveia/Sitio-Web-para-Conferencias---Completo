<?php
$conn = new mysqli('localhost', 'root', '123456', 'gdlwebcamp');

if($conn->connect_error) {
  echo $error -> $conn->connect_error;
}

$conn->set_charset("utf8"); //Lo copie del codigo del proyecto php descargado, investigar lo que hace.
?>
