<?php

$nombreTabla = "Ciudades";

function conectar($nombreTabla = "Ciudades") {
  $link = mysqli_connect("localhost", "root", "root") or die ("No se pudo conectar con la base de datos.");
  $output = false;
  if (!mysqli_select_db($link, "Capitales")) {
    $output = true;
    mysqli_query($link, "CREATE DATABASE Capitales");
    mysqli_select_db($link, "Capitales");
    print "(Base de datos creada y seleccionada)<br>";
  }
  if (mysqli_num_rows(mysqli_query($link, "SHOW TABLES LIKE '$nombreTabla'")) !== 1) {
    $output = true;
    mysqli_query($link, "CREATE TABLE $nombreTabla (
        id INT AUTO_INCREMENT,
        ciudad VARCHAR(50) NOT NULL,
        pais VARCHAR(50) NOT NULL,
        habitantes BIGINT NOT NULL,
        superficie BIGINT NOT NULL,
        tiene_metro TINYINT NOT NULL,
        PRIMARY KEY (ID),
        UNIQUE KEY (ciudad, pais)
      )");
    print mysqli_error($link) . "(Tabla creada?)<br>";
  }
  if ($output) print "<hr>";
  return $link;
}

?>
