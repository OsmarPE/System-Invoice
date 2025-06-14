<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Document</title>
</head>

<body>
    <header class="header">
        <div class="header-left"></div>
        <a href="#" class="header-logo">
            Invoice System
        </a>
        <button class="header-profile">
            <div class="profile">
                <span class="profile-name">A</span>
            </div>
            <p class="header-profile-text">Vanesa</p>
        </button>
    </header>
    <nav class="main-nav">
        <a href="#" class="main-nav-item active">
            <i data-lucide="home"></i>
            <span>Facturas</span>
        </a>
        <a href="#" class="main-nav-item">
            <i data-lucide="user"></i>
            <span>Usuarios</span>
        </a>
        <a href="#" class="main-nav-item">
            <i data-lucide="file-text"></i>
            <span>Roles</span>
        </a>
        <a href="#" class="main-nav-item">
            <i data-lucide="settings"></i>
            <span>Clientes</span>
        </a>
        <a href="#" class="main-nav-item">
            <i data-lucide="settings"></i>
            <span>Productos</span>
        </a>
    </nav>
    <div class="container">
        <main class="main">
            <div class="main-header">
                <h1 class="main-header-title">
                    <i data-lucide="file-text"></i>
                    Detalles Facturas
                </h1>
                <button class="main-header-btn btn btn--primary">
                    <i data-lucide="plus"></i>
                    <span>Agregar</span>
                </button>
            </div>
            <div class="main-body main-body--invoices">
                <article class="invoice">
                    <div class="invoice-header">
                        <span class="invoice-number">#1020</span>
                        <p class="invoice-date">
                            10 de Agosto de 2022
                        </p>
                    </div>
                    <div class="invoice-body">
                        <h3 class="invoice-subtitle">
                            Información General
                        </h3>
                        <p class="invoice-text">
                            Osmar Uriel Perera Balam
                        </p>
                        <p class="invoice-text">
                            Calle 77 #39 192 x 183D Casa
                        </p>
                        <p class="invoice-text">
                            9993949493
                        </p>
                    </div>
                    <div class="invoice-products">
                        <h3 class="invoice-subtitle">
                            Productos
                        </h3>
                        <ul class="invoice-products-list">
                            <li class="invoice-products-item">
                                <p class="invoice-products-name">
                                    Nike Air Max 97
                                </p>
                                <p class="invoice-products-price">
                                    $1,000.00 <span>x2</span>
                                </p>
                            </li>
                            <li class="invoice-products-item">
                                <p class="invoice-products-name">
                                    Nike Air Max 97
                                </p>
                                <p class="invoice-products-price">
                                    $1,000.00 <span>x2</span>
                                </p>
                            </li>
                        </ul>
                        <div class="invoice-products-total">
                            <p>Total</p>
                            <span>$2,000.00</span>
                        </div>
                        <button class="invoice-products-btn btn btn--primary">
                            <i data-lucide="cloud-download"></i>
                            Generar factura
                        </button>
                    </div>
                </article>
                <article class="preview">
                    <div class="preview-header">
                        <div>
                            <p class="preview-title">Factura</p>
                            <span class="preview-number">#1020</span>
                        </div>
                        <div class="preview-logo">
                            <div class="preview-icon">
                                <i data-lucide="eye"></i>
                            </div>
                            <span>Preview</span>
                        </div>
                    </div>
                    <div class="preview-information">
                        <div>
                            <p class="preview-text preview-text-gray">
                                Realizado por
                            </p>
                            <span class="preview-text preview-text-strong">Osmar Uriel Perera Balam</span>
                        </div>
                        <div>
                            <p class="preview-text preview-text-gray">
                                Factura de emisión
                            </p>
                            <span class="preview-text preview-text-strong">20 de Junio de 2022</span>
                        </div>
                    </div>
                    <div class="preview-client">
                        <p class="preview-text preview-text-gray">
                            De
                        </p>
                        <span class="preview-text-strong">Osmar Uriel Perera Balam</span>
                        <p class="preview-text preview-text-gray">Calle 77 #103 x 192 y 29</p>
                        <p class="preview-text preview-text-gray">osmar@perera.com</p>
                        <p class="preview-text preview-text-gray">9993949493</p>
                    </div>
                    <table class="preview-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Nike Air Max 97</td>
                                <td>2</td>
                                <td>$1,000.00</td>
                                <td>$2,000.00</td>
                            </tr>
                            <tr>
                                <td>Nike Air Max 97</td>
                                <td>2</td>
                                <td>$1,000.00</td>
                                <td>$2,000.00</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="preview-total">
                        <p class="preview-total-title">Total</p>
                        <span class="preview-total-text">$2,000.00</span>                    
                    </div>
                </article>
            </div>
        </main>

    </div>
</body>

</html>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>