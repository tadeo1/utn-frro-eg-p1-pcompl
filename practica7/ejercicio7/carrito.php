<?php
session_start();

$carrito = [];

$borrar = empty($_POST['borrar-id']) ? false : $_POST['borrar-id'];
$finalizar = empty($_POST['finalizar']) ? false : $_POST['finalizar'];

if ($finalizar) {
  unset($_SESSION['carrito']);
} else {
  if (!empty($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
    $carrito = $_SESSION['carrito'];
  }

  if ($borrar && $carrito) {
    unset($_SESSION['carrito'][$borrar]);
    $carrito = $_SESSION['carrito'];
  }
}

$cantProductosEnCarrito = count($carrito);

if ($cantProductosEnCarrito) {
  $filtro = implode(',', array_keys($carrito));
  echo "<!-- id IN ($filtro) -->";
  include('./helpers.php');
  $link = conectar();
  $resultado = mysqli_query($link, "SELECT id, producto, precio FROM `$nombreTabla` WHERE id IN ($filtro)");
  $filas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
  mysqli_free_result($resultado);
  mysqli_close($link);
  $live = [];
  $total = 0;
  foreach($filas as $fila) {
    $live[$fila['id']] = array_merge($carrito[$fila['id']], $fila);
    $total += $fila['precio'] * $live[$fila['id']]['cantidad'];
  }
}
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
      <?php if ($cantProductosEnCarrito) { ?>
        <a class="carrito" href="./carrito.php" title="Ver <?= $cantProductosEnCarrito ?> productos en el carrito">
          <svg focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg>
          <span><?= $cantProductosEnCarrito ?></span>
        </a>
      <?php } ?>
    </nav>
    <section class="container">
      <div class="d-flex justify-content-center mt-4 mb-4">
        <h2>Carrito</h2>
      </div>
      <div class="row">
        <?php
        if ($cantProductosEnCarrito) {
          foreach ($live as $idProducto => $item) {
          ?>
            <div class="col-12 mb-3">
              <div class="card card-body item">
                <div class="w-100 d-flex justify-content-between">
                  <div>
                    <p class="card-title d-inline-block"><b><?= $item['producto'] ?></b></p>
                    <p class="d-inline-block" style="font-size: 12px">x<?= $item['cantidad'] ?> ($ <?= $item['precio'] ?> c/u)</p>
                  </div>
                  <div>
                    <p class="card-text">$ <?= $item['precio'] * $item['cantidad'] ?></p>
                    <form method="post">
                      <button type="submit" name="borrar-id" value="<?= $idProducto ?>"
                        class="boton-link icono-borrar" title="Borrar" aria-label="Borrar">
                        <svg focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                          <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
          <div class="w-100 d-flex justify-content-end">
            <p><b>Total: $ <?= $total ?></b></p>
          </div>
          <div class="w-100 d-flex justify-content-between">
            <a href="./" class="btn btn-light">Seguir comprando</a>
            <form method="post">
              <button type="submit" name="finalizar" value="true" class="btn btn-primary">Finalizar compra</button>
            </form>
          </div>
          <?php
        } elseif ($finalizar) {
        ?>
          <p>¡Compra finalizada! <a href="./">Volver al catálogo.</a></p>
        <?php
        } else {
        ?>
          <p>¡Tu carrito está vacío! <a href="./">Volver al catálogo.</a></p>
        <?php } ?>
      </div>
    </section>
  </body>
</html>
