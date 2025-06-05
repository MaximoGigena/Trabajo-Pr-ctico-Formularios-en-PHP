<?php
// Validación del formulario 
$errores = [];

function limpiar($dato) {
  return htmlspecialchars(stripslashes(trim($dato)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = limpiar($_POST["nombre"] ?? "");
  $email = limpiar($_POST["email"] ?? "");
  $asunto = limpiar($_POST["asunto"] ?? "");
  $mensaje = limpiar($_POST["mensaje"] ?? "");

  // Validaciones basicas que me acuerdo
  if (empty($nombre)) {
    $errores[] = "El nombre es obligatorio.";
  }

  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "El correo electrónico no es válido.";
  }

  if (empty($asunto)) {
    $errores[] = "Debe seleccionar un asunto.";
  }

  if (empty($mensaje)) {
    $errores[] = "El mensaje no puede estar vacío.";
  }

  if (count($errores) === 0) {
    echo "<h1>Gracias por contactarte, $nombre</h1>";
    echo "<p>Recibimos tu mensaje sobre <strong>$asunto</strong> y te responderemos a la brevedad al correo <strong>$email</strong>.</p>";
    echo "<p>Mensaje recibido:</p><blockquote>$mensaje</blockquote>";
  } else {
    echo "<h2>Se encontraron errores en el formulario:</h2><ul>";
    foreach ($errores as $error) {
      echo "<li>$error</li>";
    }
    echo "</ul><a href='javascript:history.back()'>Volver al formulario</a>";
  }
} else {
  echo "Acceso no permitido.";
}
?>
