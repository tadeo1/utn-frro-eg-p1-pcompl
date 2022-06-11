<?php
$ARTICULOS_MOCK = [
  [
    'titular' => 'Hoy: nuevas medidas tomadas por el oficialismo',
    'tipo' => 'politica',
    'url' => '#hoy-medidas',
    'hora' => '12:24'
  ],
  [
    'titular' => 'Las criptomonedas vuelven a la escena',
    'tipo' => 'economica',
    'url' => '#criptomonedas-vuelven',
    'hora' => '8:15'
  ],
  [
    'titular' => 'La selección tomará un descanso antes del Mundial',
    'tipo' => 'deportiva',
    'url' => '#seleccion-descanso',
    'hora' => '00:24'
  ],
];

$tipopreferido = 'sin_preferencia';
if (isset($_POST['borrarpreferencia'])) {
  // El usuario pide borrar la cookie
  setcookie('tipopreferido', $tipopreferido, 1);
} elseif (isset($_POST['tipopreferido'])) {
  $tipopreferido = $_POST['tipopreferido'];
  setcookie('tipopreferido', $tipopreferido, time() + 60 * 60 * 24 * 90); // 90 días / 3 meses
} elseif (isset($_COOKIE['tipopreferido'])) {
  $tipopreferido = $_COOKIE['tipopreferido'];
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Periodico (E4 - P7 - EG - 2022 (1C))</title>
    <link rel="stylesheet" type="text/css" href="css/base.css">
  </head>
  <body>
    <header>
      <h1>Periódico - Inicio</h1>
    </header>
    <section>
      <h2>Los titulares de hoy</h2>
      <?php
      foreach ($ARTICULOS_MOCK as $articulo) {
        if ($tipopreferido == 'sin_preferencia' || $articulo['tipo'] == $tipopreferido) {
          echo '<a title="Leer artículo" href="'.$articulo['url'].'">';
          ?>
        <div class="titular">
          <?php
          echo '<p class="small">&laquo;Noticia '.$articulo['tipo'].'&raquo;</p>';
          echo "<h3>$articulo[titular]</h3>";
          echo "<p>Publicado: hoy a las $articulo[hora]</p>"
          ?>
        </div>
        <?php
        echo "</a>";
        }
      }
      ?>
    </section>
    <aside>
      <p>Perfil</p>
      <form method="post">
        <fieldset>
          <legend>Tipo de noticias preferido</legend>
          <input type="radio" name="tipopreferido" id="politica" value="politica"<?php if ($tipopreferido == 'politica') echo ' checked'; ?> required>
          <label for="politica">Política</label>
          <br>
          <input type="radio" name="tipopreferido" id="economica" value="economica"<?php if ($tipopreferido == 'economica') echo ' checked'; ?>>
          <label for="economica">Económica</label>
          <br>
          <input type="radio" name="tipopreferido" id="deportiva" value="deportiva"<?php if ($tipopreferido == 'deportiva') echo ' checked'; ?>>
          <label for="deportiva">Deportiva</label>
          <br>
          <button type="submit">Confirmar</button>
        </fieldset>
      </form>
      <?php
      if ($tipopreferido !== 'sin_preferencia') {
        ?>
        <form method="post">
          <input type="submit" name="borrarpreferencia" value="Borrar cookie de preferencia.">
        </form>
        <?php
      } elseif (isset($_POST['borrarpreferencia'])) echo '<p>(Preferencia borrada con éxito)</p>';
    ?>
    </aside>
  </body>
</html>
