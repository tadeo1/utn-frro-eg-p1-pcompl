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
  <title>Contador (Ejercicio 4 - Practica 5 - EG - 2022 (1C))</title>
</head>

<body>
  <section>
    <h1>Home</h1>
    <p>Sesión abierta automáticamente.</p>
    <p><?php echo "Hola usuario, has paseado por " . $_SESSION["contador"] . " páginas de nuestro sitio."; ?></p>
    <p><a href="./contador-no-mostrado.php">Ir a otra página, que no muestra el contador.</a></p>
    <p><a href="./contador-mostrado.php">Ir a otra página, que muestra el contador.</a></p>
    <p><a href="./cerrar-sesion.php">Cerrar sesión, reiniciando el contador.</a></p>
  </section>
</body>
</html>
