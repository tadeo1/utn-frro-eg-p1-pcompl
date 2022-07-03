<?php
session_start();

$carrito = empty($_SESSION['carrito']) || !is_array($_SESSION['carrito']) ? [] : $_SESSION['carrito'];

$borrar = empty($_POST['borrar-id']) ? false : $_POST['borrar-id'];
$agregar = empty($_POST['agregar-id']) ? false : $_POST['agregar-id'];
$cantidad = empty($_POST['agregar-cantidad']) || !is_numeric($_POST['agregar-cantidad']) || $_POST['agregar-cantidad'] < 1 ? false : $_POST['agregar-cantidad'];

if ($agregar && $cantidad) {
  if (!$carrito) {
    $_SESSION['carrito'] = [];
  }
  if (isset($_SESSION['carrito'][$agregar])) {
    if ($_SESSION['carrito'][$agregar]['cantidad'] + $cantidad < 100) {
      $_SESSION['carrito'][$agregar]['cantidad'] += $cantidad;
    } else {
      $_SESSION['carrito'][$agregar]['cantidad'] = 99;
    }
  } else {
    $_SESSION['carrito'][$agregar] = ['cantidad' => $cantidad];
  }
  $carrito = $_SESSION['carrito'];
} elseif ($borrar && $carrito) {
  unset($_SESSION['carrito'][$borrar]);
  $carrito = $_SESSION['carrito'];
}

$cantProductosEnCarrito = count($carrito);

include('./helpers.php');
$link = conectar();
$resultado = mysqli_query($link, "SELECT id, producto, precio FROM catalogo");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tienda (E7 - P7 - EG - 2022 (1C))</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilos.css">
  </head>
  <body>
    <nav class="navbar navbar-light sticky-top bg-light">
      <h1>Tienda</h1>
      <?php if ($cantProductosEnCarrito >= 0) { ?>
        <a class="carrito" href="./carrito.php" title="<?= ($cantProductosEnCarrito > 0 ? "Ver $cantProductosEnCarrito" : 'No hay') . ' items en el carrito' ?>">
          <svg focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg>
          <span><?= $cantProductosEnCarrito ?></span>
        </a>
      <?php } ?>
    </nav>
    <section class="container">
      <div class="d-flex justify-content-center mt-4 mb-4">
        <h2>Catálogo</h2>
      </div>
      <div class="row">
        <?php
        if (mysqli_num_rows($resultado)) {
          while ($filaResultado = mysqli_fetch_assoc($resultado)) {
            $productoEnCarrito = empty($_SESSION['carrito']) || empty($_SESSION['carrito'][$filaResultado['id']]) ? false : $_SESSION['carrito'][$filaResultado['id']];
          ?>
            <form id="form-borrar-<?= $filaResultado['id'] ?>" action="./" method="post"></form>
            <form id="form-agregar-<?= $filaResultado['id'] ?>" action="./" method="post"></form>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
              <div class="card producto">
                <div class="card-body">
                  <p class="card-title"><b><?= $filaResultado['producto'] ?></b></p>
                  <p class="card-text">$ <?= $filaResultado['precio'] ?></p>
                  <input type="number" form="form-agregar-<?= $filaResultado['id'] ?>" name="agregar-cantidad" min="1" max="99" value="0">
                  <?php if ($productoEnCarrito) { ?>
                    <p style="font-size: 12px">(Tiene <?= $productoEnCarrito['cantidad'] ?> en el carrito.
                      <button type="submit" form="form-borrar-<?= $filaResultado['id'] ?>" name="borrar-id" value="<?= $filaResultado['id'] ?>" class="boton-link">Borrar</button>
                      )
                    </p>
                  <?php } ?>
                  <div class="mt-2"><button type="submit" form="form-agregar-<?= $filaResultado['id'] ?>" name="agregar-id" value="<?= $filaResultado['id'] ?>" class="btn btn-primary">Agregar</button></div>
                </div>
              </div>
            </div>
          <?php } ?>
        <?php } else { ?>
          No quedan productos en el catálogo en este momento.
        <?php
        }
        mysqli_close($link);
        ?>
      </div>
    </section>
  </body>
</html>
