<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Baja de ciudad (Ejercicio 2 - Practica 6 - EG - 2022 (1C))</title>
</head>

<body>
  <header>
    <h1>ABML de Ciudades - Baja</h1>
  </header>
  <section>
    <?php
    include("../helpers.php");

    // Abrir conexión con la base de datos
    $link = conectar();

    // Obtener los datos recibidos por POST
    $ciudad = isset($_POST['nombreciudad']) ? $_POST['nombreciudad'] : null;
    $pais = isset($_POST['pais']) ? $_POST['pais'] : null;
    $id = isset($_POST['idciudad']) ? $_POST['idciudad'] : null;

    // Verificar que existe el registro.
    $sentencia = "SELECT COUNT(ciudad) AS cant_existentes FROM $nombreTabla WHERE " . (isset($id) ? "id='$id'" : "ciudad='$ciudad' AND pais='$pais'");
    $resultadoConsulta = mysqli_query($link, $sentencia) or die (mysqli_error($link));
    $filaResultado = mysqli_fetch_assoc($resultadoConsulta);
    if ($filaResultado['cant_existentes'] == 0) {
      // No existe: mostrar resultado.
      ?>
      <p>¡La ciudad (<?php echo isset($id) ? "ID $id" : ($ciudad . ', ' . $pais); ?>) no existe!</p>
      <?php
    } else {
      // Existe: eliminar el registro y mostrar resultado.
      $sentencia = "DELETE FROM $nombreTabla WHERE " . (isset($id) ? "id='$id'" : "ciudad='$ciudad' AND pais='$pais'");
      mysqli_query($link, $sentencia) or die (mysqli_error($link));
      ?>
      <p>La ciudad (<?php echo isset($id) ? "ID $id" : ($ciudad . ', ' . $pais); ?>) fue <b>eliminada<b>.</p>
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