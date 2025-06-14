<?php
    include_once '../../session.php';
    include_once '../../config/db.php';
    include_once '../../message.php';

    if (isset($_POST['product'])) {
        $product = $_POST['product'];
        $query = "INSERT INTO product(name, description, price, stock) VALUES ('$product[name]', '$product[description]', '$product[price]', '$product[stock]')";
        $result = $db->query($query);

        if ($result) {
           header('Location: /invoice/products.php?success=true&message=Producto agregado exitosamente');
           exit();
        } else {
            $message = 'Error al agregar el producto';
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
            <h3>Agregar Producto</h3>
            <p class="card-text">
                Agrega un nuevo producto a la base de datos.
            </p>
        </div>
        <div class="card-body">
            <form class="card-form" action="/invoice/services/products/add-product.php" method="post">
                <div class="card-form-group">
                    <div class="form-item">
                        <label for="name" class="label">Nombre</label>
                        <input type="text" class="form-control input" id="name" name="product[name]" placeholder="Nombre">
                    </div>
                    <div class="form-item">
                        <label for="description" class="label">Descripción</label>
                        <input type="text" class="form-control input" id="description" name="product[description]" placeholder="Descripción">
                    </div>
                    <div class="form-item">
                        <label for="price" class="label">Precio</label>
                        <input type="text" class="form-control input" id="price" name="product[price]" placeholder="Precio">
                    </div>
                    <div class="form-item">
                        <label for="stock" class="label">Stock</label>
                        <input type="text" class="form-control input" id="stock" name="product[stock]" placeholder="Stock">
                    </div>
                </div>
                <button type="submit" class="btn btn--primary card-btn">Agregar</button>
            </form>
        </div>
    </div>
</body>
</html> 