<?php
    include_once 'session.php';
    include_once 'config/db.php';
    include_once 'message.php';

    $query = "SELECT product.id, product.name, product.description, product.price, product.stock FROM product";
    $result = $db->query($query);

    $message = '';
    $status = '';
    if (isset($_GET['success']) && isset($_GET['message'])) {
        if ($_GET['success'] == 'true') {
            $message = $_GET['message'];
            $status = 'success';
        } else {
            $message = $_GET['message'];
            $status = 'error';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

<body>
    <?php include 'layout/header.php'; ?>
    <?php include 'layout/navegation.php'; ?>
    <div class="container">
        <main class="main">
            <?php if(isset($message) && isset($status)): ?>
                <?php echo message($message, $status); ?>
            <?php endif; ?>
            <div class="main-header">
                <h1 class="main-header-title">
                    <i data-lucide="scan-barcode"></i>
                    Productos
                </h1>
                <a href="/invoice/services/products/add-product.php" class="main-header-btn btn btn--primary">
                    <i data-lucide="plus"></i>
                    <span>Agregar</span>
                </a>
            </div>
            <div class="main-body ">
                <?php while($row = $result->fetch_assoc()): ?>
                <article class="product">
                    <div class="product-header">
                        <div class="product-icon">
                            <i data-lucide="barcode"></i>
                        </div>
                        <div class="product-actions">
                            <a href="/invoice/services/products/add-product.php?editid=<?php echo $row['id']; ?>" class="btn-icon">
                                <i data-lucide="pencil"></i>
                            </a>
                            <a href="/invoice/services/products/delete-products.php?id=<?php echo $row['id']; ?>" class="btn-icon">
                                <i data-lucide="trash"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-body">
                        <h3 class="product-name">
                            <?php echo $row['name']; ?>
                        </h3>
                        <p class="product-text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Voluptatem, voluptates, quisquam.
                        </p>
                        <div class="product-actions">
                            <p class="product-price">$<?php echo $row['price']; ?></p>
                            <p class="product-stock badge badge-base"> <?php echo $row['stock']; ?> items</p>
                        </div>
                    </div>
                </article>
                <?php endwhile; ?>
            </div>
        </main>

    </div>
</body>

</html>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>