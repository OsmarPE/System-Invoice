<?php

require_once '../../config/db.php';

$id = $_GET['id'];

$query_invoices = "SELECT id FROM invoice_details WHERE product_id = $id LIMIT 1";

$result_invoices = $db->query($query_invoices);

if ($result_invoices->num_rows > 0) {
    header("Location: ../../products.php?success=false&message=Error al eliminar el producto, existen facturas asociadas");
    exit();
}

$query = "DELETE FROM product WHERE id = $id";
$result = $db->query($query);


if ($result) {
    header("Location: ../../products.php?success=true&message=Producto eliminado exitosamente");
}else{
    header("Location: ../../products.php?success=false&message=Error al eliminar el producto");
}
