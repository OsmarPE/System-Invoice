<?php

require_once 'config/db.php';
require_once 'message.php';
session_start(); 

if(isset($_SESSION['id'])) {
    header("Location: invoices.php");
    exit();
}

if (isset($_POST['email']) && isset($_POST['password'])) {
   $email = $_POST['email'];
   $password = $_POST['password'];
   
    $alert = '' ;
  $query = "SELECT user.id, user.name, rol.name AS rol 
          FROM user 
          LEFT JOIN rol ON rol.id = user.rol_id 
          WHERE user.email = '$email' AND user.password = '$password'
          LIMIT 1;
          ";
   $result = $db->query($query);
   
   if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
         $_SESSION['id'] = $row['id'];
         $_SESSION['name'] = $row['name'];
         $_SESSION['rol'] = $row['rol'];
         header("Location: invoices.php");
      }
   } else{
        $alert = message('Correo o contraseña son incorrectos', 'error');
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
<body class="login-container">
    <div class="login">
        <div class="login-icon">
            <i data-lucide="key-round"></i>
        </div>
        <h1 class="login-title">Iniciar Sesión</h1>
        <p class="login-subtitle ">Llene el formulario para acceder al sistema</p>
         <?php if(isset($alert)): ?>
            <?php echo $alert; ?>
        <?php endif; ?>
        <form class="form-login" method="post" action="index.php">
            <div class="form-login-body">
                <div class="form-login-item">
                    <label class="label" for="email">Email</label>
                    <input class="input" type="email" id="email" name="email" placeholder="exemple@gmail.com">
                </div>
                <div class="form-login-item">
                    <label class="label" for="password">Password</label>
                    <input class="input" type="password" id="password" name="password" placeholder="••••••••••••">
                </div>
            </div>
            <button class="form-login-submit btn btn--primary" type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
  lucide.createIcons();
</script>
