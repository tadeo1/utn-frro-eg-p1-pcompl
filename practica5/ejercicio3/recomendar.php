<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Recomendar (Ejercicio 3 - Practica 5 - EG - 2022 (1C))</title>
</head>

<body>
  <section>
    <?php
      if (!isset($_POST['name'])) {
      ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <fieldset>
        <legend>¿Desea recomendar el sitio a un amigo o familiar?</legend>
        <div>
          <label for="name">Tu nombre:</label>
          <input type="text" id="name" name="name" required />
        </div>
        <div>
          <label for="email">Email para enviar recomendación:</label>
          <input type="email" id="email" name="email" placeholder="mail@example.com" required />
        </div>
        <div>
          <label for="note">Nota personalizada (opcional):</label>
          <textarea id="note" name="note" rows="3"></textarea>
        </div>
      </fieldset>
      <button type="submit">Enviar</button>
    </form>
    <?php
    } else {
      $websiteName = "Este Sitio";
      $websiteURL = "example.com";
      $desde = "este-sitio@$websiteURL";

      $nombre = $_POST['name'];
      $nota = $_POST['note'];
      $para = $_POST['email'];
      $asunto = "$nombre te recomienda visitar $websiteName!";
      $mensajeHtml = <<<MENSAJE_HTML
        <!DOCTYPE html>
        <html lang="es">
          <head>
            <meta charset="utf-8">
            <title>$asunto</title>
          </head>
          <body>
        MENSAJE_HTML;
        $mensajeHtml .= "<p><b>$nombre</b> te ha enviado su recomendación para visitar nuestro sitio, <a href=\"$websiteURL\">$websiteName</a>";
        $mensajeHtml .= empty($nota) ? "." : ", y ha agregado esta nota:";
        $mensajeHtml .= "</p>";
        $mensajeHtml .= empty($nota) ? "" : ("<div>" . htmlentities($nota) . "</div>");
        $mensajeHtml .= "
          </body>
        </html>";
      $headers = "MIME-Version: 1.0\r\n"
        . "Content-type: text/html; charset=utf-8\r\n"
        . "From: $websiteName <$desde>\r\n";

      if (@mail($para, $asunto, $mensajeHtml, $headers)) {
      ?>

    <div style="display: block; background-color: green; color: white;">
      ¡Mensaje enviado!
    </div>
    <div style="display: block; border: black solid 3px; margin: 5px;">
      Vista previa del mensaje enviado:
      <?php
      } else {
      ?>

    <div style="display: block; background-color: red; color: white;">
      No se envió el mensaje...
    </div>
    <div style="display: block; border: black solid 3px; margin: 5px;">
      Vista previa del mensaje que no se envió:
      <?php
      }
      ?>

      <p><b>Para: </b><?php echo $para ?></p>
      <p><b>Asunto: </b><?php echo $asunto ?></p>
      <iframe srcdoc="<?php echo htmlentities($mensajeHtml); ?>"></iframe>
    </div>
    <button onclick="javascript:history.back()">Volver atrás</button>
      <?php
    }
    ?>

  </section>
</body>

</html>
