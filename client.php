<?php
    include_once 'session.php';
    include_once 'config/db.php';
    require_once 'message.php';

    $query = "SELECT client.id, client.name, client.email, client.direction, client.phone FROM client";
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
                    <i data-lucide="users-round"></i>
                    Clientes
                </h1>
                <a href="/invoice/services/client/add-client.php" class="main-header-btn btn btn--primary">
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
                            <div class="user-copy">
                                <span class="user-text user-text-copy">
                                    <?php echo $row['email']; ?>
                                </span>
                                <button id="user-copy-btn" class="user-copy-btn ">
                                    <i data-lucide="copy"></i>
                                </button>
                            </div>
                            <p class="user-text"><?php echo $row['direction']; ?></p>
                            <p class="user-text"><?php echo $row['phone']; ?></p>
                        </div>
                        <div class="user-actions">
                        <a href="/invoice/services/client/add-client.php?editid=<?php echo $row['id']; ?>" class="btn-icon">
                            <i data-lucide="pencil"></i>
                        </a>
                        <a href="/invoice/services/client/delete-client.php?client=<?php echo $row['id']; ?>" class="btn-icon">
                            <i data-lucide="trash"></i>
                        </a>
                        </div>
                    </div>
                    <div class="user-footer">
                        <a href="/" class="user-footer-link">
                            <i data-lucide="sticky-note"></i>
                            Ver facturas
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

  const userTextCopy = document.querySelector('.user-text-copy');
  const userCopyBtn = document.getElementById('user-copy-btn');
  userCopyBtn.addEventListener('click', () => {
    const text = userTextCopy.textContent.trim();
    navigator.clipboard.writeText(text);
  });

</script>
