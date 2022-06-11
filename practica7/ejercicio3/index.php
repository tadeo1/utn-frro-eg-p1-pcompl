<?php
if (isset($_POST['nombreusuario'])) {
  $nombreusuario = $_POST['nombreusuario'];
  setcookie('nombreusuario', $nombreusuario, time() + 60 * 60 * 24 * 5); // 5 dias
} else {
  if (isset($_COOKIE['nombreusuario'])) {
    $nombreusuario = $_COOKIE['nombreusuario'];
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sitio (E3 - P7 - EG - 2022 (1C)</title>
</head>
<body>
  <header>
    <h1>Sitio</h1>
  </header>
  <section>
    <p>Hola.</p>
    <?php
    if (isset($nombreusuario)) {
      echo "<p>El último nombre de usuario que cargaste fue <b>{$nombreusuario}</b></p>";
    } else {
      ?><p>En estos momentos no hay cargada una cookie con nombre de usuario.</p>
    <?php
    }
    ?><p>A continuación podrás cargar el nombre de usuario.</p>
    <form method="post">
      <fieldset>
        <legend>Formulario de carga</legend>
        <div>
          <label for="nombreusuario">Nombre de usuario</label>
          <input type="text" id="nombreusuario" name="nombreusuario" maxlength="20" required />
        </div>
        <button type="submit">Cargar</button>
      </fieldset>
    </form>
  </section>
</body>
</html>