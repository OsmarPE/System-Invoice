<?php
    include_once '../../session.php';
    include_once '../../config/db.php';
    $id = $_GET['id'];

    $query_invoice = "SELECT invoice.id FROM invoice WHERE user_id = $id";

    $result_invoice = $db->query($query_invoice);

    if ($result_invoice->num_rows > 0) {
        $message = 'Error al eliminar el usuario';
        $status = 'error';
        header('Location: /invoice/users.php?success=false&message=' . $message);
    }

    $query = "DELETE FROM user WHERE id = $id";
    $result = $db->query($query);

    if ($result) {
        header('Location: /invoice/users.php?success=true&message=Usuario eliminado exitosamente');
    }else{
        $message = 'Error al eliminar el usuario';
        $status = 'error';
        header('Location: /invoice/users.php?success=false&message=' . $message);
    }