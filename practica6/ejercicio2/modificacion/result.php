<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Modificación de ciudad (Ejercicio 2 - Practica 6 - EG - 2022 (1C))</title>
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

    // Obtener los datos recibidos por POST
    $id = $_POST['id'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];
    $habitantes = $_POST['habitantes'];
    $superficie = $_POST['superficie'];
    $tienemetro = $_POST['tienemetro'];
    $tienemetro = isset($tienemetro) && $tienemetro != 'false';

    // Verificar que existe el registro.
    $sentencia = "SELECT * FROM $nombreTabla WHERE id='$id'";
    $resultadoConsulta = mysqli_query($link, $sentencia) or die (mysqli_error($link));
    if (mysqli_num_rows($resultadoConsulta) == 0) {
      // No existe: mostrar resultado.
      ?>
      <p>¡La ciudad (<?php echo "ID $id"; ?>) no existe!</p>
      <?php
    } else {
      // Existe: hacer modificación y mostrar resultado.
      $sentencia = "UPDATE $nombreTabla SET
        ciudad='$ciudad',
        pais='$pais',
        habitantes='$habitantes',
        superficie='$superficie',
        tiene_metro='" . ($tienemetro ? '1' : '0') . "'
        WHERE id='$id'";
      mysqli_query($link, $sentencia) or die (mysqli_error($link));
      ?>
      <p>La ciudad (<?php echo isset($id) ? "ID $id" : ($ciudad . ', ' . $pais); ?>) fue <b>modificada<b> con éxito.</p>
      <?php
    }
    // Liberar memoria asociada al resultado anterior
    mysqli_free_result($resultadoConsulta);
    // Cerrar la conexion
    mysqli_close($link);
    ?>
    <br><p><a href="../index.html"><button>&leftarrow; Volver al inicio.</button></a></p>
  </section>
</body>

</html>
