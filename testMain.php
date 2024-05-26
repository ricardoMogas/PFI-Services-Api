<?php
ini_set("SMTP", "your_smtp_server");
ini_set("smtp_port", "your_smtp_port");
$destinatario = "richyisusmoov@gmail.com";
$asunto = "Prueba de correo electrónico";
$mensaje = "Hola, esto es un correo de prueba.";

// Configurar los encabezados del correo
$headers = "From: remitente@example.com" . "\r\n" .
    "Reply-To: remitente@example.com" . "\r\n" .
    "X-Mailer: PHP/" . phpversion();

// Enviar el correo
if (mail($destinatario, $asunto, $mensaje, $headers)) {
    echo "Correo enviado correctamente.";
} else {
    echo "Error al enviar el correo.";
}
?>