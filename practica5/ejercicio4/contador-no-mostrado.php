<?php
session_start();
if (isset($_SESSION['contador'])) {
  $_SESSION['contador']++;
} else {
  $_SESSION['contador'] = 1;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>No mostrado - Contador (Ejercicio 4 - Practica 5 - EG - 2022 (1C))</title>
</head>

<body>
  <section>
    <h1>No mostrado</h1>
    <p>Hola, esta es una página que no dice si la sesión está abierta o cerrada ni muestra el contador...</p>
    <p><a href="./">Ir al Home.</a></p>
    <p><a href="./contador-mostrado.php">Ir a otra página, que muestra el contador.</a></p>
    <p><a href="./cerrar-sesion.php">Cerrar sesión, reiniciando el contador.</a></p>
  </section>
</body>
</html>
