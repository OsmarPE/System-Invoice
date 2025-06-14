<?php
    include_once '../../session.php';
    include_once '../../config/db.php';
    include_once '../../message.php';

    $query_role = "SELECT rol.id, rol.name FROM rol";
    $roles = $db->query($query_role);

    $message = '';
    $status = '';

    if (isset($_POST['user'])) {
        $user = $_POST['user'];
        
        if (empty($user['name']) || empty($user['email']) || empty($user['direction']) || empty($user['password'])) {
            $message = 'Por favor rellene todos los campos';
            $status = 'error';
        }else{
            $query = "INSERT INTO user(name, email, direction, rol_id) VALUES ('$user[name]', '$user[email]', '$user[direction]', '$user[rol]')";
            $result = $db->query($query);
    
            if ($result) {
               header('Location: /invoice//users.php?success=true&message=Usuario agregado exitosamente');
               exit();
            } else {
                $message = 'Error al agregar el usuario';
                $status = 'error';
            }   
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
        <?php if(isset($message) && isset($status)): ?>
            <?php echo message($message, $status); ?>
        <?php endif; ?>
        <div class="card-header">
            <h3>Agregar Usuario</h3>
            <p class="card-text">
                Agrega un nuevo usuario a la base de datos.
            </p>
        </div>
        <div class="card-body">
            <form class="card-form" action="/invoice/services/users/add-user.php" method="post">
                <div class="card-form-group">
                    <div class="form-item">
                        <label for="name" class="label">Nombre</label>
                        <input type="text" class="form-control input" id="name" name="user[name]" placeholder="Nombre">
                    </div>
                    <div class="form-item">
                        <label for="email" class="label">Email</label>
                        <input type="email" class="form-control input" id="email" name="user[email]" placeholder="Email">
                    </div>
                    <div class="form-item">
                        <label for="direction" class="label">Dirección</label>
                        <input type="text" class="form-control input" id="direction" name="user[direction]" placeholder="Dirección">
                    </div>
                    <div class="form-item">
                        <label for="rol" class="label">Rol</label>
                        <select class="form-control input" id="rol" name="user[rol]">
                           <?php while($row = $roles->fetch_assoc()): ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="password" class="label">Contraseña</label>
                        <input type="password" class="form-control input" id="password" name="user[password" placeholder="Contraseña">
                    </div>
                </div>
                <button type="submit" class="btn btn--primary card-btn">Agregar</button>
            </form>
        </div>
    </div>
</body>
</html> 
