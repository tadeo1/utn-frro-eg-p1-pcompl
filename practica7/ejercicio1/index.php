<?php
$tema = 'clasico';
if (isset($_POST['tema'])) {
  $tema = $_POST['tema'];
  setcookie('tema', $tema, time() + (60 * 60 * 24 * 90)); // 3 meses
} elseif (isset($_COOKIE['tema'])) {
  $tema = $_COOKIE['tema'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio (Ejercicio 1 - Practica 7 - EG - 2022 (1C))</title>
  <link rel="stylesheet" type="text/css" href="css/base.css">
  <link rel="stylesheet" type="text/css" href="css/<?php echo $tema; ?>.css">
</head>
<body>
  <header>
    <h1>Inicio</h1>
  </header>
  <section>
    <h2>Subtitulo 1</h2>
    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum.</p>
    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum.</p>
    <p>Lorem ipsum Lorem ipsum referencia a <a href="./pagina.php">otra página del sitio</a> Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum.</p>
  </section>
  <aside>
    <form action="./index.php" method="post">
      <fieldset>
        <legend>Tema del sitio web</legend>
        <select name="tema">
          <option value="clasico"<?php if ($tema == 'clasico') echo ' selected'; ?>>Clásico</option>
          <option value="moderno"<?php if ($tema == 'moderno') echo ' selected'; ?>>Moderno</option>
          <option value="oscuro"<?php if ($tema == 'oscuro') echo ' selected'; ?>>Oscuro</option>
        </select>
        <button type="submit">Aplicar</button>
      </fieldset>
    </form>
  </aside>
</body>
</html>

