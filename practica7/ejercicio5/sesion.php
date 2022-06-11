<?php
session_start();
// Tomar valores de ingreso si hay
$nombreusuario = isset($_POST['nombreusuario']) ? $_POST['nombreusuario'] : null;
$clavehash = isset($_POST['clave']) ? password_hash($_POST['clave'], PASSWORD_DEFAULT) : null;
if (isset($nombreusuario) && isset($clavehash)) {
  // Hubo ingreso: guardar nombre anterior si hay y registrar sesion
  if (isset($_SESSION['logueado_time']) && isset($_SESSION['nombreusuario']) && $_SESSION['logueado_time'] > 0) {
    $reemplazo = true;
    $anterior = $_SESSION['nombreusuario'];
  }
  $_SESSION['nombreusuario'] = $nombreusuario;
  $_SESSION['clavehash'] = $clavehash;
  $_SESSION['logueado_time'] = time();
} elseif (isset($_SESSION['logueado_time']) && $_SESSION['logueado_time'] > 0) {
  // Hay ingreso registrado: guardar nombre actual
  $nombreusuario = $_SESSION['nombreusuario'];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Sesion (E5 - P7 - EG - 2022 (1C))</title>
</head>

<body>
  <header>
    <h1>Sesion</h1>
  </header>
  <section>
    <?php
      if (isset($_SESSION['nombreusuario'])) {
        echo "<p>Hola $_SESSION[nombreusuario]";
        if ($reemplazo) echo ", reemplazaste a $anterior";
        echo ".</p>";
    ?>
    <p>Te recomendamos seguir a esta <a href="./recuperar.php">página</a>.</p>
    <?php
      } else {
        ?><p>Hola usuario, debes <a href="./index.php">ingresar</a> para poder ver más contenido del sitio.</p><?php
      }
      ?>
  </section>
</body>
</html>
