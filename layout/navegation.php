 <?php
    $currentPage = basename($_SERVER['PHP_SELF']);
 ?>

 <nav class="main-nav">
        <a href="/invoice/index.php" class="main-nav-item <?php if($currentPage == 'invoices.php') echo 'active'; ?>">
            <i data-lucide="home"></i>
        </a>
        <a href="/invoice/users.php" class="main-nav-item <?php if($currentPage == 'users.php') echo 'active'; ?>">
            <i data-lucide="user"></i>
        </a>
        <a href="/invoice/roles.php" class="main-nav-item <?php if($currentPage == 'roles.php') echo 'active'; ?>">
            <i data-lucide="circle-dot"></i>
        </a>
        <a href="/invoice/client.php" class="main-nav-item <?php if($currentPage == 'client.php') echo 'active'; ?>">
            <i data-lucide="users-round"></i>
        </a>
        <a href="/invoice/products.php" class="main-nav-item <?php if($currentPage == 'products.php') echo 'active'; ?>">
            <i data-lucide="scan-barcode"></i>
        </a>
        <div class="main-nav-separator"></div>
        <a href="/invoice/logout.php" class="main-nav-item">
            <i data-lucide="log-out"></i>
        </a>
</nav>