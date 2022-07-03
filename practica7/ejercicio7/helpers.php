<?php

$nombreTabla = 'catalogo';

function conectar($nombreTabla = 'catalogo', $nombreBD = 'compras') {
  $link = mysqli_connect("localhost", "root", "root") or die ("No se pudo conectar con la base de datos.");
  $output = false;
  if (!mysqli_select_db($link, "$nombreBD")) {
    $output = true;
    mysqli_query($link, "CREATE DATABASE $nombreBD");
    mysqli_select_db($link, "$nombreBD");
    print "(Base de datos creada y seleccionada)<br>";
  }
  if (mysqli_num_rows(mysqli_query($link, "SHOW TABLES LIKE '$nombreTabla'")) !== 1) {
    $output = true;
    mysqli_query($link, "CREATE TABLE $nombreTabla (
        id INT AUTO_INCREMENT,
        producto VARCHAR(100) NOT NULL,
        precio DECIMAL(11,2) NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY (producto)
      )");
    print mysqli_error($link) . "(Tabla creada?)<br>";
  }
  if ($output) print "<hr>";
  return $link;
}
