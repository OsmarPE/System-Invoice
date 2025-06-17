<?php
    include_once 'session.php';
    include_once 'config/db.php';
    include_once 'message.php';

    $query = "SELECT user.id,user.name, user.email, user.direction, rol.name as rol FROM user
        LEFT JOIN rol ON rol.id = user.rol_id
    ";

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
    <link rel="stylesheet" href="css/styles.css">
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
                    <i data-lucide="user-round"></i>
                    Usuarios
                </h1>
                <a href="/invoice/services/users/add-user.php" class="main-header-btn btn btn--primary">
                    <i data-lucide="plus"></i>  
                    <span>Agregar</span>
                </a>
            </div>
            <div class="main-body main-body--users">
                <?php while($row = $result->fetch_assoc()): ?>
                <article class="user">
                    <div class="user-body">
                        <div class="user-information">
                            <h3 class="user-name"><?php echo $row['name']; ?></h3>
                            <p class="user-text"><?php echo $row['email']; ?></p>
                            <p class="user-text"><?php echo $row['direction']; ?></p>
                        </div>
                        <div class="user-badge">
                            <span><?php echo $row['rol']; ?></span>
                        </div>
                    </div>
                    <div class="user-footer">
                        <a href="/invoice/services/users/add-user.php?editid=<?php echo $row['id']; ?>" class="btn-icon">
                            <i data-lucide="pencil"></i>
                        </a>
                        <a href="/invoice/services/users/delete-user.php?id=<?php echo $row['id']; ?>" class="btn-icon">
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
