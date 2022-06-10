<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Formulario para modificación de ciudad (Ejercicio 2 - Practica 6 - EG - 2022 (1C))</title>
  <style>
    .aligned-form .group {
      margin-bottom: 0.5em;
    }
    .aligned-form .group label {
      text-align: right;
      display: inline-block;
      vertical-align: middle;
      width: 13em;
      margin-right: 1em;
    }
    .aligned-form .group input,
    .aligned-form .group select {
      display: inline-block;
      vertical-align: middle;
      width: 13em;
    }
    .aligned-form .group-center {
      margin-top: 1.5em;
      margin-left: 13em;
    }
  </style>
</head>

<body>
  <header>
    <h1>ABML de Ciudades - Modificación</h1>
  </header>
  <section>
    <?php
    include("../helpers.php");

    // Abrir conexión con la base de datos
    $link = conectar();

    // Obtener los datos recibidos por GET
    $ciudad = isset($_GET['nombreciudad']) ? $_GET['nombreciudad'] : null;
    $pais = isset($_GET['pais']) ? $_GET['pais'] : null;
    $id = isset($_GET['idciudad']) ? $_GET['idciudad'] : null;

    // Verificar que existe el registro.
    $sentencia = "SELECT * FROM $nombreTabla WHERE " . (isset($id) ? "id='$id'" : "ciudad='$ciudad' AND pais='$pais'");
    $resultadoConsulta = mysqli_query($link, $sentencia) or die (mysqli_error($link));
    if (mysqli_num_rows($resultadoConsulta) == 0) {
      // No existe: mostrar resultado.
      ?>
      <p>¡La ciudad (<?php echo isset($id) ? "ID $id" : ($ciudad . ', ' . $pais); ?>) no existe!</p>
      <?php
    } else {
      // Existe: mostrar formulario de modificación.
      $filaResultado = mysqli_fetch_assoc($resultadoConsulta);
      ?>
      <form class="aligned-form" action="./result.php" method="post">
        <fieldset>
          <legend>Formulario de modificación de Ciudad (ID <?php echo $filaResultado['id'] ?>)</legend>
          <input type="hidden" name="id" required readonly value="<?php echo $filaResultado['id'] ?>">
          <div class="group">
            <label for="ciudad">Nombre</label>
            <input type="text" id="ciudad" name="ciudad" required value="<?php echo $filaResultado['ciudad'] ?>">
          </div>
          <div class="group">
            <label for="pais">País</label>
            <input type="text" id="pais" name="pais" required value="<?php echo $filaResultado['pais'] ?>">
          </div>
          <div class="group">
            <label for="habitantes">Cant. de habitantes</label>
            <input type="number" id="habitantes" name="habitantes" required value="<?php echo $filaResultado['habitantes'] ?>">
          </div>
          <div class="group">
            <label for="superficie">Superficie (km<sup>2</sup>)</label>
            <input type="number" id="superficie" name="superficie" required value="<?php echo $filaResultado['superficie'] ?>">
          </div>
          <div class="group">
            <label for="tienemetro">¿Tiene metro?</label>
            <select id="tienemetro" name="tienemetro">
              <option value="false" <?php if (!$filaResultado['tiene_metro']) echo "selected"; ?>>No</option>
              <option value="true" <?php if ($filaResultado['tiene_metro']) echo "selected"; ?>>Sí</option>
            </select>
          </div>

          <div class="group-center">
            <button type="submit">Modificar ciudad</button>
          </div>
        </fieldset>
      </form>
      <?php
    }
    // Liberar memoria asociada al resultado
    mysqli_free_result($resultadoConsulta);
    // Cerrar la conexion
    mysqli_close($link);
    ?>
    <br><p><a href="../index.html"><button>&leftarrow; Volver al inicio.</button></a></p>
  </section>
</body>

</html>
