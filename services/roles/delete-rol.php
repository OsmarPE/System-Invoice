<?php

require_once '../../config/db.php';

$rol = $_GET['rol'];

try {
    //code...
    $query = "DELETE FROM rol WHERE id = $rol";
    $result = $db->query($query);
    
    if ($result) {
        header("Location: ../../roles.php?success=true&message=Rol eliminado exitosamente");
        exit();
    }

    header("Location: ../../roles.php?success=false&message=Error al eliminar el rol");

} catch (\Throwable $th) {
    header("Location: ../../roles.php?success=false&message=Error al eliminar el rol");
}