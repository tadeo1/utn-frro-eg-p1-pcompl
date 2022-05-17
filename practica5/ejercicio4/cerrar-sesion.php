<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Cerrar sesión - Contador (Ejercicio 4 - Practica 5 - EG - 2022 (1C))</title>
</head>

<body>
  <section>
    <h1>Cerrar sesión</h1>
    <p>Sesión cerrada.</p>
    <p>Si visitas otra página de este sitio se abrirá una nueva sesión.</p>
    <p><a href="./">Ir al Home.</a></p>
    <p><a href="./contador-no-mostrado.php">Ir a otra página, que no muestra el contador.</a></p>
    <p><a href="./contador-mostrado.php">Ir a otra página, que muestra el contador.</a></p>
  </section>
</body>
</html>
