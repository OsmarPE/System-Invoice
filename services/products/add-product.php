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
        'description' => '',
        'price' => '',
        'stock' => ''
    ];

    $product = isset($_POST['product']) ? $_POST['product'] : null;

    if ($product) {

        if (isset($_POST['product_id'])) {

            $id = $_POST['product_id'];
            $query = "UPDATE product SET name = '$product[name]', description = '$product[description]', price = '$product[price]', stock = '$product[stock]' WHERE product.id = $id";
            $result = $db->query($query);

        } else {
            $query = "INSERT INTO product(name, description, price, stock) VALUES ('$product[name]', '$product[description]', '$product[price]', '$product[stock]')";
            $result = $db->query($query);
    
        }
        if ($result) {
           header('Location: /invoice/products.php?success=true&message=Producto agregado exitosamente');
           exit();
        } else {
            $message = 'Error al agregar el producto';
            $status = 'error';
        }   
    }
    if (isset($mode_edit_id)){
        $query = "SELECT product.id, product.name, product.description, product.price, product.stock FROM product WHERE product.id = $mode_edit_id LIMIT 1";
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
                <h3>Editar Producto</h3>
                <p class="card-text">
                    Modifica un producto existente en la base de datos.
                </p>
            </div>
             <?php else: ?>
                    <div class="card-header">

                        <h3>Agregar Producto</h3>
                        <p class="card-text">
                            Agrega un nuevo producto a la base de datos.
                        </p>
                    </div>
            <?php endif; ?>
        <div class="card-body">
            <form class="card-form" action="/invoice/services/products/add-product.php" method="post">
                <div class="card-form-group">
                    <div class="form-item">
                        <label for="name" class="label">Nombre</label>
                        <input type="text" class="form-control input" id="name" name="product[name]" placeholder="Nombre" value="<?php echo $row['name']; ?>">
                    </div>
                    <div class="form-item">
                        <label for="description" class="label">Descripción</label>
                        <input type="text" class="form-control input" id="description" name="product[description]" placeholder="Descripción" value="<?php echo $row['description']; ?>">
                    </div>
                    <div class="form-item">
                        <label for="price" class="label">Precio</label>
                        <input type="text" class="form-control input" id="price" name="product[price]" placeholder="Precio" value="<?php echo $row['price']; ?>">
                    </div>
                    <div class="form-item">
                        <label for="stock" class="label">Stock</label>
                        <input type="text" class="form-control input" id="stock" name="product[stock]" placeholder="Stock" value="<?php echo $row['stock']; ?>">
                    </div>
                    <?php if(isset($mode_edit_id)): ?>
                        <input type="hidden" name="product_id" value="<?php echo $mode_edit_id; ?>"> 
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