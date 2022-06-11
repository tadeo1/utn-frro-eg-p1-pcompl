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
  <title>Otra página (Ejercicio 1 - Practica 7 - EG - 2022 (1C))</title>
  <link rel="stylesheet" type="text/css" href="css/base.css">
  <link rel="stylesheet" type="text/css" href="css/<?php echo $tema; ?>.css">
</head>
<body>
  <header>
    <h1>Otra página</h1>
  </header>
  <section>
    <h2>Como se puede comprobar, se toma el valor de la cookie</h2>
    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum.</p>
    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum.</p>
    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum.</p>
    <br><a href="./index.php"><button>&leftarrow; Volver al inicio</button></a>
  </section>
  <aside>
    <form action="./pagina.php" method="post">
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

