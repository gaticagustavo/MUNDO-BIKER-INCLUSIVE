<?php
// Validar y limpiar los datos del formulario
$nombre = htmlspecialchars(trim($_POST['nombre'] ?? ''));
$correo = htmlspecialchars(trim($_POST['correo'] ?? ''));
$telefono = htmlspecialchars(trim($_POST['telefono'] ?? ''));
$mensaje = htmlspecialchars(trim($_POST['mensaje'] ?? ''));

// Validaciones básicas en el servidor (adicional a la validación JS)
if (empty($nombre) || empty($correo) || empty($mensaje)) {
    die("Error: Todos los campos obligatorios deben ser llenados.");
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("Error: El formato del correo electrónico no es válido.");
}

// Opcional: Validar el teléfono si es necesario
if (!empty($telefono) && !preg_match('/^[0-9]{10}$/', $telefono)) {
    die("Error: El formato del teléfono no es válido (debe ser de 10 dígitos).");
}

// Configuración del correo electrónico
$destino = "gustavo.gil664@gmail.com"; // Cambia esto a tu dirección de correo real
$asunto = "Nuevo mensaje de contacto desde el sitio web";
$contenido = "Nombre: " . $nombre . "\n";
$contenido .= "Correo: " . $correo . "\n";
$contenido .= "Teléfono: " . ($telefono ?: "No proporcionado") . "\n";
$contenido .= "Mensaje:\n" . $mensaje . "\n";

// Cabeceras para el correo
$headers = "From: " . $correo . "\r\n";
$headers .= "Reply-To: " . $correo . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Enviar el correo
if (mail($destino, $asunto, $contenido, $headers)) {
    echo "<script>alert('¡Mensaje enviado exitosamente! Nos pondremos en contacto contigo pronto.'); window.location.href='../index.html';</script>";
} else {
    echo "<script>alert('Hubo un error al enviar tu mensaje. Por favor, inténtalo de nuevo más tarde.'); window.location.href='Contacto.html';</script>";
}
?>
