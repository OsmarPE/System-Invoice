<?php
    include_once '../../session.php';
    include_once '../../config/db.php';
    include_once '../../message.php';

    if (isset($_POST['client'])) {
        $client = $_POST['client'];
        $query = "INSERT INTO client(name, direction, phone, email) VALUES ('$client[name]', '$client[direction]', '$client[phone]', '$client[email]')";
        $result = $db->query($query);

        if ($result) {
           header('Location: /invoice/client.php?success=true&message=Cliente agregado exitosamente');
           exit();
        } else {
            $message = 'Error al agregar el cliente';
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
            <h3>Agregar Cliente</h3>
            <p class="card-text">
                Agrega un nuevo cliente a la base de datos.
            </p>
        </div>
        <div class="card-body">
            <form class="card-form" action="/invoice/services/client/add-client.php" method="post">
                <div class="card-form-group">
                    <div class="form-item">
                        <label for="name" class="label">Nombre</label>
                        <input type="text" class="form-control input" id="name" name="client[name]" placeholder="Nombre">
                    </div>
                    <div class="form-item">
                        <label for="direction" class="label">Dirección</label>
                        <input type="text" class="form-control input" id="direction" name="client[direction]" placeholder="Dirección">
                    </div>
                    <div class="form-item">
                        <label for="phone" class="label">Teléfono</label>
                        <input type="text" class="form-control input" id="phone" name="client[phone]" placeholder="Teléfono">
                    </div>
                    <div class="form-item">
                        <label for="email" class="label">Email</label>
                        <input type="email" class="form-control input" id="email" name="client[email]" placeholder="Email">
                    </div>
                </div>
                <button type="submit" class="btn btn--primary card-btn">Agregar</button>
            </form>
        </div>
    </div>
</body>        
</html> 
