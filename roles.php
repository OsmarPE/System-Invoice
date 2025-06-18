<?php
    include_once 'session.php';
    include_once 'config/db.php';
    include_once 'message.php';

    $query = "SELECT rol.id, rol.name FROM rol";
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
                    <i data-lucide="circle-dot"></i>
                    Roles
                </h1>
                <a href="/invoice/services/roles/add-rol.php" class="main-header-btn btn btn--primary">
                    <i data-lucide="plus"></i>  
                    <span>Agregar</span>
                </a>
            </div>
            <div class="main-body">
                <?php while($row = $result->fetch_assoc()): ?>
                <article class="rol">
                    <p class="rol-name"><?php echo $row['name']; ?></p>
                    <div class="rol-actions">
                        <a href="/invoice/services/roles/add-rol.php?editid=<?php echo $row['id']; ?>" class="rol-btn btn-icon">
                            <i data-lucide="pencil"></i>
                        </a>
                        <a href="/invoice/services/roles/delete-rol.php?rol=<?php echo $row['id']; ?>" class="rol-btn btn-icon">
                            <i data-lucide="trash"></i>
                        </a>
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
