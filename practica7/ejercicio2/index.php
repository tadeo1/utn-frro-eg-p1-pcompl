<?php
$visitas = 1;
if (isset($_POST['borrarvisitas'])) {
  // El usuario pide borrar la cookie
  setcookie('visitas', $visitas, 1);
} else {
  if (isset($_COOKIE['visitas'])) {
    $visitas = $_COOKIE['visitas'] + 1;
  }
  setcookie('visitas', $visitas, time() + 60 * 60 * 24 * 365); // 1 año
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contador con cookies (Ejercicio 2 - Practica 7 - EG - 2022 (1C))</title>
  <link rel="stylesheet" type="text/css" href="css/base.css">
</head>

<body>
  <section>
    <h1>Home</h1>
    <h2>Subtitulo 1</h2>
    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum.</p>
    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum.</p>
    <p>Lorem ipsum Lorem ipsum referencia a <a href="./pagina.php">otra página del sitio</a> Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum.</p>
  </section>
  <aside>
    <?php
    if ($visitas > 1) {
      echo "<p>¡Hola de nuevo!<br>Visitaste este sitio $visitas veces.</p>";
      ?>
      <form action="./index.php" method="post">
        <input type="submit" name="borrarvisitas" value="Borrar cookie de visitas.">
      </form>
      <?php
    } else {
      echo '<p>¡Bienvenido!</p>';
      if (isset($_POST['borrarvisitas'])) echo '<p>(Visitas borradas con éxito)</p>';
    }
    ?>
  </aside>
</body>
</html>
