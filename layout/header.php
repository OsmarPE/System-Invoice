
<?php
    $name = $_SESSION['name'];
?>

<header class="header">
        <div class="header-left">
        
        </div>
        <a href="#" class="header-logo">
            Invoice System
        </a>
        <button class="header-profile">
            <div class="profile">
                <span class="profile-name">
                    <?php echo $name[0]; ?>
                </span>
            </div>
            <p class="header-profile-text">
                <?php echo $name; ?>
            </p>
        </button>
</header>