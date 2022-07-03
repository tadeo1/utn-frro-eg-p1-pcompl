<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de canciones (E7 - P7 - EG - 2022 (1C))</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-light sticky-top bg-light">
      <h1>Canciones</h1>
    </nav>
    <section class="container">
      <div class="d-flex justify-content-center mt-4 mb-4">
        <h2>Buscador</h2>
      </div>
      <form method="get" class="form col my-3">
        <div class="input-group">
          <input type="search" name="busqueda" class="form-control rounded"
            placeholder="Ingrese una palabra para buscar canciones" aria-label="Buscar"
          >
          <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
      </form>
      <?php
        include('./helpers.php');
        $link = conectar();
        // Obtener datos recibidos por GET o valores por defecto
        $busqueda = empty($_GET['busqueda']) ? '' : $_GET['busqueda'];
        $regMostrar = isset($_GET['mostrar']) ? intval($_GET['mostrar']) : 5;
        $pagActual = isset($_GET['pag']) ? intval($_GET['pag']) : 1;

        // Contar los resultados
        $sentencia = "SELECT COUNT(*) FROM $nombreTabla";
        if ($busqueda) {
          $sentencia .= " WHERE cancion LIKE '%$busqueda%'";
        }
        $resultados = mysqli_query($link, $sentencia) or die (mysqli_error($link));
        $regTotal = mysqli_fetch_array($resultados, MYSQLI_NUM)[0];
        mysqli_free_result($resultados);
        if ($regTotal == 0) {
          // No hay resultados
          ?>
            <p>Lo sentimos, no se encontraron resultados...</p>
          <?php
        } else {
          // Hay resultados

          // Obtener resultados
          $sentencia = "SELECT * FROM $nombreTabla";
          if ($busqueda) {
            $sentencia .= " WHERE cancion LIKE '%$busqueda%'";
          }
          $sentencia .= " LIMIT " . (($pagActual - 1) * $regMostrar) . ",$regMostrar";
          $resultados = mysqli_query($link, $sentencia);

          // Cerrar la conexion:
          mysqli_close($link);

          // Mostrar tabla paginada
          ?>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col" aria-label="Número de canción">#</th>
                <th scope="col">Canciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($cancion = mysqli_fetch_assoc($resultados)) {
                ?>
                <tr>
                  <th scope="row"><?= $cancion['id'] ?></th>
                  <td><?= $cancion['cancion'] ?></td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
          <?php

          // Liberar memoria asociada al resultado
          mysqli_free_result($resultados);
          ?>
          <nav aria-label="Páginas de resultados">
            <ul class="pagination justify-content-center">
              <?php
              $pagTotal = ceil($regTotal / $regMostrar);
              ?>
              <li class="page-item<?= $pagActual == 1 ? ' disabled' : '' ?>">
                <a class="page-link" href="?mostrar=<?= $regMostrar ?>&pag=1" title="Ir a primer página">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <?php
              $i = 0;
              while ($i < $pagTotal) {
                if (++$i == $pagActual) {
                  ?>
                  <li class="page-item active" aria-current="page" style="cursor: default;">
                    <span class="page-link">
                      <?= $i ?>
                    </span>
                  </li>
                  <?php
                } else {
                  ?>
                  <li class="page-item">
                    <a class="page-link" href="<?= "?mostrar=$regMostrar&pag=$i" ?>"><?= $i ?></a>
                  </li>
                  <?php
                }
              }
              ?>
              <li class="page-item<?= $pagActual == $pagTotal ? ' disabled' : '' ?>">
                <a class="page-link" href="<?= "?mostrar=$regMostrar&pag=$pagTotal" ?>" title="Ir a última página">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
          <?php
        }
        ?>
    </section>
  </body>
</html>