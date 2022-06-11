<?php
session_start();
if (isset($_POST['cerrarsesion'])) {
  // El usuario pide cerrar sesion
  session_destroy();
  unset($_SESSION['logueado_time']);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Datos (E5 - P7 - EG - 2022 (1C))</title>
</head>

<body>
  <header>
    <h1>Datos encontrados</h1>
  </header>
  <section>
    <?php
      if (isset($_SESSION['logueado_time'])) {
        $fechahora = strftime('el %d/%m/%Y a las %H:%M:%S', $_SESSION['logueado_time']);
        echo "<p>Hola $_SESSION[nombreusuario], ingresaste al sitio $fechahora.</p>";
        echo "<p>Tu clave fue hasheada así: $_SESSION[clavehash]</p>";
    ?>
    <p><a href="./sesion.php">Volver.</a></p>
    <form method="post"><input type="submit" name="cerrarsesion" value="Cerrar sesion"></form>
    <?php
      } else {
        ?><p>No hay nada que mostrar. <a href="./index.php">Ir al inicio</a></p><?php
      }
      ?>
  </section>
</body>
</html>
