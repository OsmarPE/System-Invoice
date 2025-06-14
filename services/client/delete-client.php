<?php

require_once '../../config/db.php';

$client = $_GET['client'];

$query_invoices = "SELECT id FROM invoice WHERE client_id = $client LIMIT 1";

$result_invoices = $db->query($query_invoices);

if ($result_invoices->num_rows > 0) {
    header("Location: ../../client.php?success=false&message=Error al eliminar el cliente, existen facturas asociadas");
    exit();
}

$query = "DELETE FROM client WHERE id = $client";
$result = $db->query($query);

if ($result) {
    header("Location: ../../client.php?success=true&message=Cliente eliminado exitosamente");
}else{
    header("Location: ../../client.php?success=false&message=Error al eliminar el cliente");
}
