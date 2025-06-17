<?php
    include_once '../../session.php';
    include_once '../../config/db.php';
    include_once '../../message.php';

    $mode_edit_id = isset($_GET['editid']) ? $_GET['editid'] : null;
    $names = null;
    $message = '';
    $status = '';
    $result = null;

    $query_role = "SELECT rol.id, rol.name FROM rol";
    $roles = $db->query($query_role);

    $message = '';
    $status = '';
    $row = [
        'name' => '',
        'email' => '',
        'direction' => '',
        'password' => '',
        'rol' => ''
    ];
    
    $user = isset($_POST['user']) ? $_POST['user'] : null;

    if(isset($user)) {
        if(empty($user['name']) || empty($user['email']) || empty($user['direction']) || empty($user['password'])){
            var_dump($user);
            $message = 'Por favor rellene todos los campos';
            $status = 'error';
        }else{
    
            if (isset($_POST['user_id'])) {
                $id = $_POST['user_id'];
                $query = "UPDATE user SET name = '$user[name]', email = '$user[email]', direction = '$user[direction]', rol_id = '$user[rol]' WHERE user.id = $id";
                $result = $db->query($query);
            }else {
                
                $query = "INSERT INTO user(name, email, direction, rol_id) VALUES ('$user[name]', '$user[email]', '$user[direction]', '$user[rol]')";
                $result = $db->query($query);
        
            }
            if ($result) {
               header('Location: /invoice//users.php?success=true&message=Usuario agregado exitosamente');
               exit();
            } else {
                $message = 'Error al agregar el usuario';
                $status = 'error';
            } 
        }
    }

    if (isset($mode_edit_id)){
        $query = "SELECT user.id, user.name, user.email, user.direction, user.password, rol.id as rol FROM user LEFT JOIN rol ON rol.id = user.rol_id WHERE user.id = $mode_edit_id LIMIT 1";
        $result_edit = $db->query($query);
        $row = $result_edit->fetch_assoc();

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
                        <input type="text" class="form-control input" id="name" name="user[name]" placeholder="Nombre" value="<?php echo $row['name'] ; ?>">
                    </div>
                    <div class="form-item">
                        <label for="email" class="label">Email</label>
                        <input type="email" class="form-control input" id="email" name="user[email]" placeholder="Email" value="<?php echo $row['email']; ?>">
                    </div>
                    <div class="form-item">
                        <label for="direction" class="label">Dirección</label>
                        <input type="text" class="form-control input" id="direction" name="user[direction]" placeholder="Dirección" value="<?php echo $row['direction']; ?>">
                    </div>
                    <div class="form-item">
                        <label for="rol" class="label">Rol</label>
                        <select class="form-control input" id="rol" name="user[rol]">
                           <?php while($row_rol = $roles->fetch_assoc()): ?>
                            <option value="<?php echo $row_rol['id']; ?>"
                                <?php if(isset($mode_edit_id) && $row_rol['id'] == $row['rol']): ?>
                                    selected
                                <?php endif; ?>
                            ><?php echo $row_rol['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-item">
                        <label for="password" class="label">Contraseña</label>
                        <input type="password" class="form-control input" id="password" name="user[password]" placeholder="Contraseña" value="<?php echo $row['password'];?>">
                    </div>
                    <?php if(isset($mode_edit_id)): ?>
                        <input type="hidden" name="user_id" value="<?php echo $mode_edit_id; ?>"> 
                    <?php endif; ?>
                </div>
                <?php if(isset($mode_edit_id)): ?>
                    <button type="submit" class="btn btn--primary card-btn">Editar</button>
                <?php else: ?>
                    <button type="submit" class="btn btn--primary card-btn">Agregar</button>
                <?php endif; ?>

            </form>
        </div>
    </div>
</body>
</html> 
