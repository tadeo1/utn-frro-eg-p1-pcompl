<?php
session_start();
if (isset($_POST['mail'])) {
  $mail = $_POST['mail'];

  require_once('./helpers.php');

  $link = conectar();
  $resultado = mysqli_query($link, "SELECT nombre FROM `$nombreTabla` WHERE mail = '$mail'");
  if (mysqli_num_rows($resultado)) {
    $alumno = mysqli_fetch_assoc($resultado);
    $nombreAlumno = $_SESSION['nombre'] = $alumno['nombre'];
  } elseif (isset($_SESSION['nombre'])) {
    unset($_SESSION['nombre']);
  }
  mysqli_free_result($resultado);
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Validacion de mail (E6 - P7 - EG - 2022 (1C))</title>
  </head>
  <body>
    <header>Alumno - Validación de mail</header>
    <section>
      <?php
      if (isset($nombreAlumno)) {
        ?><p>Se ha ingresado el alumno solicitado (mail: <?= $mail ?>).</p>
      <?php
      } elseif (isset($mail)) {
        ?><p>No existe el alumno solicitado (mail: <?= $mail ?>).</p>
      <?php
      }

      if (isset($_SESSION['nombre'])) {
        ?><p>Ir a la <a href="./bienvenida.php">página de bienvenida</a>.</p>
      <?php
      } else {
        ?><p>No hay alumno ingresado en la sesión. <a href="./">Ingresar</a>.</p>
      <?php
      } ?>
    </section>
  </body>
</html>
