<?php
    require_once 'session.php';
    require_once 'helper/util.php';
    require_once 'config/db.php';

    $id = $_SESSION['id'];

    $query_client = "SELECT client.id, client.name FROM client";
    $clients = $db->query($query_client);

    $query_user = "SELECT user.id, user.name FROM user";
    $users = $db->query($query_user);
    
    $query_product = "SELECT product.id, product.name, product.price, product.stock FROM product";
    $products = $db->query($query_product);

    $products_arraY = [];   

    while($row = $products->fetch_assoc()){
        $products_arraY[] = $row;
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
        <main class="main main--invoices">
            <div class="main-body main-body--invoices">
                <article class="invoices">
                    <div class="invoices-add-header">
                        <div class="invoice-add-icon">
                            <i data-lucide="file"></i>
                        </div>
                        <h2 class="invoice-add-title">
                            Detalles de la Factura
                        </h2>
                    </div>
                   <form class="invoice-form">
                       <div class="invoice-items">
                           <div class="invoice-item">
                               <label for="user" class="label">Emitido por</label>
                               <select name="user" id="user" class="input"  disabled>
                                   <option value="">Seleccione un usuario</option>
                                   <?php while($row = $users->fetch_assoc()): ?>
                                   <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>                                   
                                   <?php endwhile; ?>
                               </select>
                           </div>
                           <div class="invoice-row">
                               <div class="invoice-item">
                                  <label for="user" class="label">Cliente</label>
                                  <select name="user" id="client" class="input">
                                      <option value="">Seleccione un cliente</option>
                                      <?php while($row = $clients->fetch_assoc()): ?>
                                      <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                      <?php endwhile; ?>
                                  </select>
                              </div>
                              <div class="invoice-item">
                                  <label for="date" class="label">Fecha</label>
                                  <input type="date" name="date" id="date" class="input">
                              </div>
                           </div>
                           <div class="">
                               <h3 class="invoice-subtitle">
                                   Productos
                                </h3>
                                <div class="invoice-products-list">
                                    <div class="invoice-products-item-add">
                                        <div class="invoice-products-name">
                                            <label for="name" class="label">Producto</label>
                                            <select name="name" id="name" class="input  product-select">
                                                <option value="">Seleccione un producto</option>
                                                <?php foreach($products_arraY as $product): ?>
                                                <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>                                   
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="invoice-products-amount">
                                            <label for="amount" class="label">Cantidad</label>
                                            <input type="text" name="amount" placeholder="4" id="amount" class="input product-amount-input">
                                        </div>
                                        <div class="invoice-products-price">
                                            <label for="price" class="label">Precio</label>
                                            <input type="text" name="price" placeholder="0" id="price" class="input product-price-input" disabled>
                                        </div>
                                        <input type="hidden" name="id" value="" >
                                    </div>
                                </div>
                                <button type="button" class="invoice-products-add " id="add-product">
                                    Agregar
                                </button>
                                <footer class="invoice-products-footer hidden">
                                    <div class="invoice-products-iva">  
                                        <p>IVA</p>
                                        <span id="iva">0$</span>
                                    </div>
                                    <div class="invoice-products-subtotal"> 
                                        <p>Subtotal</p>
                                        <span id="subtotal">0$</span>
                                    </div>
                                    <div class="invoice-products-total">
                                        <p>Total</p>
                                        <span id="total">0$</span>
                                    </div>
                                    <button class="invoice-products-submit btn btn--primary">
                                        Generar factura
                                    </button>
                                </footer>
                           </div>
                            
                       </div>
                        

                   </form>
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
                        <p class="preview-total-title" >Total</p>
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
    
    
    class InvoiceManager {
        constructor() {
        this.user = document.querySelector('#user');
        this.products = <?php echo json_encode($products_arraY); ?> // Array de productos desde PHP
        this.addProductBtn = document.getElementById('add-product');
        this.listProducts = document.querySelector('.invoice-products-list');
        this.submitBtn = document.querySelector('.invoice-products-submit');
        this.subtotalElement = document.querySelector('#subtotal');
        this.ivaElement = document.querySelector('#iva');
        this.totalElement = document.querySelector('#total');
        this.productsFooter = document.querySelector('.invoice-products-footer');
        this.dateElement = document.querySelector('#date');
        this.clientElement = document.querySelector('#client');

        this.id = <?php echo $id; ?>;
        this.cart = [];
    

        this.init();
    }

    init() {        
        this.user.value = this.id; 

        this.addProductBtn.addEventListener('click', (e) => this.handleAddProduct(e));
        this.bindProductSelectEvents();
        this.bindProductAmountEvents();
        this.submitBtn.addEventListener('click', (e) => this.handleSubmit(e));
    }

    async handleSubmit(e) {
        e.preventDefault();

        const form = new FormData();
        form.append('id', this.id);
        form.append('date', this.dateElement.value);
        form.append('client', this.clientElement.value);
        form.append('products', JSON.stringify(this.cart));
        form.append('total', this.getTotal());
        form.append('subtotal', this.getSubtotal());
        form.append('iva', this.getIVA());


        const response = await fetch('/invoice/services/invoices/send-invoice.php', {
            method: 'POST',
            body: form
        });
        
        const data = await response.json();
        console.log(data);
        if(date.status === 'error'){
            
            alert('Error al enviar la factura');
            return
        }

        window.location.href = '/invoice/invoices.php';
        
    }

    bindProductSelectEvents() {
        
        document.querySelectorAll('.product-select').forEach(item => {
            item.addEventListener('change', (e) => this.handleChangeSelect(e));
        });
    }
    bindProductAmountEvents() {

        document.querySelectorAll('.product-amount-input').forEach(item => {
            item.addEventListener('change', (e) => this.handleInputAmount(e));
        });
    }

    handleInputAmount(e) {
       const value = e.target.value;
       const parent = e.target.closest('.invoice-products-item-add');
       const idInput = parent.querySelector('input[name="id"]').value;

       const productNew = this.products.find(product => product.id === idInput);
       console.log(productNew);
       this.cart = this.cart.map(product => product.id == idInput ? {...productNew, amount: +value} : product);
       this.handleShowTotal();
    }

    handleShowTotal(e) {
        const total = this.getSubtotal()
        this.productsFooter.classList.remove('hidden');
        this.ivaElement.textContent = `${this.getIVA().toFixed(2)}$`;
        this.subtotalElement.textContent = `${total.toFixed(2)}$`;
        this.totalElement.textContent = `${this.getTotal().toFixed(2)}$`;
    }

    handleAddProduct(e) {
        e.preventDefault();

        this.listProducts.insertAdjacentHTML('beforeend', `
            <div class="invoice-products-item-add">
                <div class="invoice-products-name">
                    <select name="name" class="input product-select">
                        <option value="">Seleccione un producto</option>
                        ${this.products.map(product => `<option value="${product.id}">${product.name}</option>`).join('')}
                    </select>
                </div>
                <div class="invoice-products-amount">
                    <input type="text" name="amount" placeholder="4" class="input product-amount-input">
                </div>
                <div class="invoice-products-price">
                    <input type="text" name="price" placeholder="0" class="input product-price-input" disabled>
                </div>
                <input type="hidden" name="id" value="" >
            </div>
        `);

        this.bindProductSelectEvents();
        this.bindProductAmountEvents();
    }
    

    getSubtotal() {
        return this.cart.reduce((total, product) => total + (product.price * product.amount), 0);
    }

    getIVA(){
        return this.getSubtotal() * 0.16;
    }

    getTotal(){
        return this.getSubtotal() + this.getIVA();
    }

    handleChangeSelect(e) {
        const productId = e.target.value;
        const parent = e.target.closest('.invoice-products-item-add');
        const input = parent.querySelector('.product-price-input');
        const idInput = parent.querySelector('input[name="id"]');

        if (this.cart.find(product => product.id === productId.toString())) {
            e.target.value = '';
            input.value = '';
            return;
        }

        const product = this.products.find(product => product.id === productId);

        if (product) {
            this.cart = [...this.cart, product];
            input.value = product.price;
            idInput.value = product.id;
        }
    }
}

new InvoiceManager();


                                                    

</script>