<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenida (E6 - P7 - EG - 2022 (1C))</title>
</head>
<body>
  <header>Alumno - Página de bienvenida</header>
    <section>
      <?php
      if (isset($_SESSION['nombre'])) {
        $nombre = $_SESSION['nombre'];
        ?><p>Te damos la bienvenida a nuestro sitio!</p>
        <p>Alumno ingresado: <b><?= $nombre ?></b>.</p>
        <br><br><p><a href="./">Volver al inicio</a>.</p>
      <?php
      } else {
        ?><p>No puedes visitar esta página porque no has ingresado. <a href="./">Ingresar</a>.</p>
      <?php
      } ?>
    </section>
</body>
</html>