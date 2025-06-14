<?php
    include_once '../../session.php';
    include_once '../../config/db.php';
    include_once '../../message.php';

    if (isset($_POST['rol'])) {
        $rol = $_POST['rol'];
        $query = "INSERT INTO rol(name) VALUES ('$rol')";
        $result = $db->query($query);

        if ($result) {
           header('Location: /invoice//roles.php?success=true&message=Rol agregado exitosamente');
        } else {
            $message = 'Error al agregar el rol';
            $status = 'error';
        }   
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
        <div class="card-header">
            <h3>Agregar Rol</h3>
            <p class="card-text">
                Agrega un nuevo rol a la base de datos.
            </p>
        </div>
        <div class="card-body">
            <form class="card-form" action="/invoice/services/roles/add-rol.php" method="post">
                <div class="card-form-group">
                    <div class="form-item">
                        <label for="rol" class="label">Rol</label>
                        <input type="text" class="form-control input" id="rol" name="rol" placeholder="Rol">
                    </div>
                </div>
                <button type="submit" class="btn btn--primary card-btn">Agregar</button>
            </form>
        </div>
    </div>
</body>
</html>
