<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Lista sin paginacion de ciudades (Ejercicio 2 - Practica 6 - EG - 2022 (1C))</title>
  <style>
    table th,
    table td {
      border: solid black 1px;
      text-align: center;
    }
  </style>
</head>

<body>
  <header>
    <h1>ABML de Ciudades - Lectura (lista sin paginación)</h1>
  </header>
  <section>
    <?php
    include("../helpers.php");

    // Abrir conexión con la base de datos
    $link = conectar();

    // Hacer la seleccion.
    $sentencia = "SELECT * FROM $nombreTabla";
    $resultadoConsulta = mysqli_query($link, $sentencia) or die (mysqli_error($link));
    if (mysqli_num_rows($resultadoConsulta) == 0) {
      // No hay registros: tabla vacia.
      ?>
      <p>¡No hay ciudades registradas! <a href="../alta/form.html">Cargar nueva ciudad.</a></p>
      <?php
    } else {
      // Hay registros: mostrar tabla.
      echo "<table>";
      $i = 0;
      while ($filaResultado = mysqli_fetch_assoc($resultadoConsulta)) {
        $i++;
        if ($i == 1) {
          echo "<tr>";
          foreach ($filaResultado as $campo => $valor) {
            echo "<th>$campo</th>";
          }
          echo "</tr>";
        }
        echo "<tr>";
        foreach ($filaResultado as $valor) {
          echo "<td>$valor</td>";
        }
        echo "</tr>";
      }
      echo "</table>";
    }
    // Liberar memoria asociada al resultado
    mysqli_free_result($resultadoConsulta);
    // Cerrar la conexion
    mysqli_close($link);
    ?>
    <p><a href="../index.html"><button>&leftarrow; Volver al inicio.</button></a></p>
  </section>

</body>

</html>