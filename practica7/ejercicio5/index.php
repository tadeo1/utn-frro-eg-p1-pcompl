<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro/Ingreso (E5 - P7 - EG - 2022 (1C))</title>
</head>
<body>
  <header>
    <h1>Registro/Ingreso</h1>
  </header>
  <section>
    <p>Ingrese nombre de usuario y clave.</p>
    <form action="./sesion.php" method="post">
      <fieldset>
        <legend>Formulario de ingreso</legend>
        <div>
          <label for="nombreusuario">Nombre de usuario:</label>
          <input type="text" id="nombreusuario" name="nombreusuario" maxlength="20" required>
          <br>
          <label for="clave">Clave:</label>
          <input type="password" id="clave" name="clave" maxlength="20" required>
          <br>
          <button type="submit">Cargar</button>
        </div>
      </fieldset>
    </form>
  </section>
</body>
</html>
