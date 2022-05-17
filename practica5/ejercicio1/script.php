<?php

$mensajeHtml = <<<'MENSAJE_HTML'
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Mensaje.html</title>
  </head>
  <body>
    <h2>Mensaje de prueba</h2>
    <p>Lorem ipsum.</p>
    <footer>Ejercicio 1 - Practica 5 - EG - 2022 (1C)</footer>
  </body>
</html>
MENSAJE_HTML;

// Se puede cargar el mensaje deseado desde un archivo HTML especificando su nombre en la siguiente variable.
$mensajeHtmlFileName = "mensaje.html";
if (is_readable($mensajeHtmlFileName) && !is_dir($mensajeHtmlFileName)) {
  $mensajeHtml = file_get_contents($mensajeHtmlFileName);
}

$desde = "quien-envia@example.com";
$para = "quien-recibe@example.com";
$asunto = "Prueba - Script de ejercicio 1";
$headers = "MIME-Version: 1.0\r\n"
  . "Content-type: text/html; charset=utf-8\r\n"
  . "From: Quien Envia <$desde>\r\n";

mail($para, $asunto, $mensajeHtml, $headers);

echo "El mail fue enviado.";
