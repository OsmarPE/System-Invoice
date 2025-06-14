<?php
$host = "localhost:3307";
$user = "root";
$password = "";
$db = "invoice_system";

// Crear conexión (orientado a objetos)
$db = new mysqli($host, $user, $password, $db);

// Verificar conexión
if ($db->connect_error) {
    die("Conexión fallida: " . $db->connect_error);
}

// Opcional: puedes definir la codificación
$db->set_charset("utf8");
?>
