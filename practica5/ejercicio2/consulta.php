<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Contacto (Ejercicio 2 - Practica 5 - EG - 2022 (1C))</title>
</head>

<body>
  <section>
    <?php
      if (!isset($_POST['name'])) {
      ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <fieldset>
        <legend>Formulario de contacto</legend>
        <div>
          <label for="name">Nombre</label>
          <input type="text" id="name" name="name" placeholder="Ingrese un nombre" required />
        </div>
        <div>
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="mail@example.com" required />
        </div>
        <div>
          <label for="phone">Teléfono</label>
          <input type="tel" id="phone" name="phone" placeholder="Ingrese su número de teléfono" />
        </div>
        <div>
          <label for="subject">Asunto</label>
          <input type="text" id="subject" name="subject" required />
        </div>
        <div>
          <label for="body">Cuerpo del mensaje</label>
          <textarea id="body" name="body" rows="3" required></textarea>
        </div>
      </fieldset>
      <button type="submit">Enviar</button>
    </form>
    <?php
    } else {
      $nombre = $_POST['name'];
      $desde = $_POST['email'];
      $telefono = $_POST['phone'];
      $asunto = $_POST['subject'];
      $mensajeHtml = <<<MENSAJE_HTML
        <!DOCTYPE html>
        <html lang="es">
          <head>
            <meta charset="utf-8">
            <title>[Webform] $asunto</title>
          </head>
          <body>
            <p><b>Nombre</b>: $nombre</p>
            <p><b>Email</b>: $desde</p>
            <p><b>Teléfono</b>: $telefono</p>
            <p><b>Asunto</b>: $asunto</p>
            <p><b>Mensaje</b>:</p>
            <div>{$_POST['body']}</div>
          </body>
        </html>
        MENSAJE_HTML;
      $headers = "MIME-Version: 1.0\r\n"
        . "Content-type: text/html; charset=utf-8\r\n"
        . "From: $nombre <$desde>\r\n";
      $para = "webmaster@example.com";

      if (@mail($para, $asunto, $mensajeHtml, $headers)) {
      ?>

    <div style="display: block; background-color: green; color: white;">¡Mensaje enviado!</div>
    <?php
      } else {
      ?>

    <div style="display: block; background-color: red; color: white;">No se envió el mensaje...</div>
    <?php
      }
      ?>

    <button onclick="javascript:history.back()">Volver atrás</button>
    <?php
    }
    ?>

  </section>
</body>

</html>
