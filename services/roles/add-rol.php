<?php
    include_once '../../session.php';
    include_once '../../config/db.php';
    include_once '../../message.php';

     $mode_edit_id = isset($_GET['editid']) ? $_GET['editid'] : null;
     $names = null;
     $message = '';
     $status = '';
     $result = null;

    if (isset($_POST['rol_id']) and isset($_POST['rol'])) {
        $rol = $_POST['rol'];
        $id = $_POST['rol_id'];
        $query = "UPDATE rol SET name = '$rol' WHERE rol.id = $id";
        $result = $db->query($query);
    }else if (isset($_POST['rol'])) {
        $rol = $_POST['rol'];
        $query = "INSERT INTO rol(name) VALUES ('$rol')";
        $result = $db->query($query);
    }
    
    if ($result) {
       header('Location: /invoice//roles.php?success=true&message=Rol agregado exitosamente');
    } else {
        $message = 'Error al agregar el rol';
        $status = 'error';
    }   

    if (isset($mode_edit_id)){
        $query = "SELECT rol.id, rol.name FROM rol WHERE rol.id = $mode_edit_id LIMIT 1";
        $result_edit = $db->query($query);
        $row = $result_edit->fetch_assoc();
        $names = $row['name'];
     
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/styles.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    <?php include '../../layout/header.php'; ?>
    <div class="card">
        <?php if(isset($mode_edit_id)): ?>
            <div class="card-header">
                <h3>Editar Rol</h3>
                <p class="card-text">
                    Modifica un rol existente en la base de datos.
                </p>
            </div>
             <?php else: ?>
                    <div class="card-header">

                        <h3>Agregar Rol</h3>
                        <p class="card-text">
                            Agrega un nuevo rol a la base de datos.
                        </p>
                    </div>
            <?php endif; ?>
        <div class="card-body">
            <form class="card-form" action="/invoice/services/roles/add-rol.php" method="post">
                <div class="card-form-group">
                    <div class="form-item">
                        <label for="rol" class="label">Rol</label>
                        <input type="text" class="form-control input" id="rol" name="rol" placeholder="Rol" value="<?php echo $names; ?>">   
                        <?php if(isset($mode_edit_id)): ?>
                            <input type="hidden" name="rol_id" value="<?php echo $mode_edit_id; ?>"> 
                        <?php endif; ?>
                    </div>
                </div>
                <button type="submit" class="btn btn--primary card-btn">
                    <?php if(isset($mode_edit_id)): ?>
                        Editar
                    <?php else: ?>
                        Agregar
                    <?php endif; ?>
                
                </button>
            </form>
        </div>
    </div>
</body>
</html>
