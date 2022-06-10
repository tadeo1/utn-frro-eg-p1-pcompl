<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Lista con paginacion de ciudades (Ejercicio 2 - Practica 6 - EG - 2022 (1C))</title>
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
    <h1>ABML de Ciudades - Lectura (lista con paginación)</h1>
  </header>
  <section>
    <?php
    include("../helpers.php");

    // Abrir conexión con la base de datos
    $link = conectar();

    // Obtener datos recibidos por GET o valores por defecto
    $regMostrar = isset($_GET['mostrar']) ? $_GET['mostrar'] : 2;
    $pagActual = isset($_GET['pag']) ? $_GET['pag'] : 1;

    // Hacer la seleccion.
    $sentencia = "SELECT COUNT(id) AS total FROM $nombreTabla";
    $resultadoConsulta = mysqli_query($link, $sentencia);
    $regTotal = mysqli_fetch_assoc($resultadoConsulta)['total'];
    if ($regTotal == 0) {
      // No hay registros: tabla vacia.
      ?>
      <p>¡No hay ciudades registradas! <a href="../alta/form.html">Cargar nueva ciudad.</a></p>
      <?php
    } else {
      // Hay registros: mostrar tabla paginada.
      $pagTotal = ceil($regTotal / $regMostrar);
      $sentencia = "SELECT * FROM $nombreTabla LIMIT " . (($pagActual - 1) * $regMostrar) . ",$regMostrar";
      $resultadoConsulta = mysqli_query($link, $sentencia);
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

      // Liberar memoria asociada al resultado
      mysqli_free_result($resultadoConsulta);
      // Cerrar la conexion
      mysqli_close($link);

      // Mostrar navegacion de paginas
      ?>
      <div>
        <?php
        echo "<a href='?mostrar=$regMostrar&pag=1' title='Ir a primer página'><<</a>";
        $i = 0;
        while ($i < $pagTotal) {
          if (++$i == $pagActual) {
            echo " $i";
          } else {
            echo " <a href='?mostrar=$regMostrar&pag=$i'>$i</a>";
          }
        }
        echo " <a href='?mostrar=$regMostrar&pag=" . $pagTotal . "' title='Ir a última página'>>></a>";
        ?>
      </div>
      <?php
    }
    ?>
    <br><p><a href="../index.html"><button>&leftarrow; Volver al inicio.</button></a></p>
  </section>

</body>

</html>