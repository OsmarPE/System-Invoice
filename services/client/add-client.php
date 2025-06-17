<?php
    include_once '../../session.php';
    include_once '../../config/db.php';
    include_once '../../message.php';

    $mode_edit_id = isset($_GET['editid']) ? $_GET['editid'] : null;
    $names = null;
    $message = '';
    $status = '';
    $result = null;

    $row = [
        'name' => '',
        'direction' => '',
        'phone' => '',
        'email' => ''
    ];
    
    $client = isset($_POST['client']) ? $_POST['client'] : null;

    if ($client){
        if (isset($_POST['client_id'])) {
            $id = $_POST['client_id'];
            $query = "UPDATE client SET name = '$client[name]', direction = '$client[direction]', phone = '$client[phone]', email = '$client[email]' WHERE client.id = $id";
            $result = $db->query($query);
        }else {
            $query = "INSERT INTO client(name, direction, phone, email) VALUES ('$client[name]', '$client[direction]', '$client[phone]', '$client[email]')";
            $result = $db->query($query);
        }
    
        if ($result) {
           header('Location: /invoice/client.php?success=true&message=Cliente agregado exitosamente');
           exit();
        } else {
            $message = 'Error al agregar el cliente';
            $status = 'error';
        }   
    }

    if (isset($mode_edit_id)){
        $query = "SELECT client.id, client.name, client.email, client.direction, client.phone FROM client WHERE client.id = $mode_edit_id LIMIT 1";
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
        <?php if(isset($mode_edit_id)): ?>
            <div class="card-header">
                <h3>Editar Cliente</h3>
                <p class="card-text">
                    Modifica un cliente existente en la base de datos.
                </p>
            </div>
             <?php else: ?>
                    <div class="card-header">

                        <h3>Agregar Cliente</h3>
                        <p class="card-text">
                            Agrega un nuevo cliente a la base de datos.
                        </p>
                    </div>
            <?php endif; ?>
        <div class="card-body">
            <form class="card-form" action="/invoice/services/client/add-client.php" method="post">
                <div class="card-form-group">
                    <div class="form-item">
                        <label for="name" class="label">Nombre</label>
                        <input type="text" class="form-control input" id="name" name="client[name]" placeholder="Nombre" value="<?php echo $row['name']; ?>">
                    </div>
                    <div class="form-item">
                        <label for="direction" class="label">Dirección</label>
                        <input type="text" class="form-control input" id="direction" name="client[direction]" placeholder="Dirección" value="<?php echo $row['direction']; ?>">
                    </div>
                    <div class="form-item">
                        <label for="phone" class="label">Teléfono</label>
                        <input type="text" class="form-control input" id="phone" name="client[phone]" placeholder="Teléfono" value="<?php echo $row['phone']; ?>">
                    </div>
                    <div class="form-item">
                        <label for="email" class="label">Email</label>
                        <input type="email" class="form-control input" id="email" name="client[email]" placeholder="Email" value="<?php echo $row['email']; ?>">
                    </div>
                    <?php if(isset($mode_edit_id)): ?>
                        <input type="hidden" name="client_id" value="<?php echo $mode_edit_id; ?>"> 
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
