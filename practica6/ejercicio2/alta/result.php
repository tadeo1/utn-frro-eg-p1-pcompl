<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Alta de ciudad (Ejercicio 2 - Practica 6 - EG - 2022 (1C))</title>
</head>

<body>
  <header>
    <h1>ABML de Ciudades - Alta</h1>
  </header>
  <section>
    <?php
    include("../helpers.php");

    // Abrir conexión con la base de datos
    $link = conectar();

    // Obtener los datos recibidos por POST
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];
    $habitantes = $_POST['habitantes'];
    $superficie = $_POST['superficie'];
    $tienemetro = $_POST['tienemetro'];
    $tienemetro = isset($tienemetro) && $tienemetro != 'false';

    // Verificar que no existe el registro.
    $sentencia = "SELECT COUNT(ciudad) AS cant_existentes FROM $nombreTabla WHERE ciudad='$ciudad' AND pais='$pais'";
    $resultadoConsulta = mysqli_query($link, $sentencia) or die (mysqli_error($link));
    $filaResultado = mysqli_fetch_assoc($resultadoConsulta);
    if ($filaResultado['cant_existentes'] != 0) {
      // Existe: mostrar resultado.
      ?>
      <p>¡La ciudad (<?php echo $ciudad . ', ' . $pais; ?>) ya estaba registrada!</p>
      <p>Es posible que quieras consultarla en la <a href="../lectura/lista-sin-paginacion.php"
          title="Lista completa sin paginación">lista</a>.</p>
      <?php
    } else {
      // No existe: hacer el registro y mostrar resultado.
      $sentencia = "INSERT INTO $nombreTabla (ciudad, pais, habitantes, superficie, tiene_metro)
        VALUES ('$ciudad','$pais', '$habitantes', '$superficie', '" . ($tienemetro ? '1' : '0') . "')";
      mysqli_query($link, $sentencia) or die (mysqli_error($link));
      ?>
      <p>La ciudad (<?php echo $ciudad . ', ' . $pais; ?>) fue registrada, puedes consultarla en la <a
          href="../lectura/lista-sin-paginacion.php" title="Lista completa sin paginación">lista</a>.</p>
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