<?php
    require_once '../../helper/util.php';
    require_once '../../config/db.php';
    require_once '../../session.php';

    $id = $_SESSION['id'];

    $data_client = [];
    $query_client = "SELECT client.id, client.name, client.direction, client.phone, client.email FROM client";
    $clients = $db->query($query_client);
    while ($row = $clients->fetch_assoc()) {
        $data_client[] = $row;
   }

    $data = [];
    $query_user = "SELECT user.id, user.name FROM user";
    $users = $db->query($query_user);
    while ($row = $users->fetch_assoc()) {
        $data[] = $row;
   }
    
    $query_product = "SELECT product.id, product.name, product.price, product.stock FROM product";
    $products = $db->query($query_product);

    $products_arraY = [];   

    while($row = $products->fetch_assoc()){
        $products_arraY[] = $row;
    }

    $user = '';
   
   foreach($data as $user_item){
       if($user_item['id'] == $id){
           $user = $user_item['name'];
           break;
        }
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
    <?php include '../../layout/navegation.php'; ?>
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
                                   <?php foreach($data as $row): ?>
                                   <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>                                   
                                   <?php endforeach; ?>
                               </select>
                           </div>
                           <div class="invoice-row">
                               <div class="invoice-item">
                                  <label for="user" class="label">Cliente</label>
                                  <select name="user" id="client" class="input">
                                      <option value="">Seleccione un cliente</option>
                                      <?php foreach($data_client as $row): ?>
                                      <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                      <?php endforeach; ?>
                                  </select>
                              </div>
                              <div class="invoice-item">
                                  <label for="date" class="label">Fecha</label>
                                  <input type="date" name="date" id="date" class="input">
                              </div>
                           </div>
                           <div >
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
                            <span class="preview-text preview-text-strong"> <?php echo $user; ?></span>
                        </div>
                        <div>
                            <p class="preview-text preview-text-gray">
                                Factura de emisión
                            </p>
                            <span id="preview-date" class="preview-text preview-text-strong">20 de Junio de 2022</span>
                        </div>
                    </div>
                    <div class="preview-client">
                        <p class="preview-text preview-text-gray">
                            De
                        </p>
                        <div id="preview-client-receptor">
                            <span class="preview-text-strong">Osmar Uriel Perera Balam</span>
                            <p class="preview-text preview-text-gray">Calle 77 #103 x 192 y 29</p>
                            <p class="preview-text preview-text-gray">osmar@perera.com</p>
                            <p class="preview-text preview-text-gray">9993949493</p>
                        </div>
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
                        <tbody id="preview-table-body">
                            <tr>
                                <td>Nike Air Max 97</td>
                                <td>2</td>
                                <td>$1,000.00</td>
                                <td>$2,000.00</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="invoice-footer">
                        <div class="invoice-footer-row">
                            <p  >IVA</p>
                            <span id="preview-iva">$0</span>                    
                        </div>
                        <div class="invoice-footer-row">
                            <p  >Subtotal</p>
                            <span id="invoice-subtotal">$0</span>                    
                        </div>
                        <div class="invoice-footer-row invoice-footer-total">
                            <p  >Total</p>
                            <span class="preview-total-text" id="preview-total">$0</span>                    
                        </div>
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
        this.previewDateElement = document.querySelector('#preview-date');
        this.previewClientReceptor = document.querySelector('#preview-client-receptor');
        this.previewTableBody = document.querySelector('#preview-table-body');
        this.previewTotalElement = document.querySelector('#preview-total');
        this.previewIvaElement = document.querySelector('#preview-iva');
        this.previewSubtotalElement = document.querySelector('#invoice-subtotal');
        this.clients = <?php echo json_encode($data_client); ?>;

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
        this.dateElement.addEventListener('change', (e) => this.handleChangeInputToElement(this.formatDate(e.target.value), this.previewDateElement));
        this.clientElement.addEventListener('change', (e) => this.handleChangeClient(e));
    
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

    handleChangeInputToElement(value, element) {
        element.textContent = value;
    }

    handleChangeClient(e) {
        const client = this.clients.find(client => client.id == e.target.value);
        this.previewClientReceptor.innerHTML = `
            <span class="preview-text-strong">${client.name}</span>
            <p class="preview-text preview-text-gray">${client.direction}</p>
            <p class="preview-text preview-text-gray">${client.phone}</p>
            <p class="preview-text preview-text-gray">${client.email}</p>
        `;
        
    }

    handleInputAmount(e) {
       const value = e.target.value;
       const parent = e.target.closest('.invoice-products-item-add');
       const idInput = parent.querySelector('input[name="id"]').value;

       const productNew = this.products.find(product => product.id === idInput);
       this.cart = this.cart.map(product => product.id == idInput ? {...productNew, amount: +value, total: product.price * +value} : product);
       this.handleShowTotal();
       this.printCartToTable();
    }

    handleShowTotal(e) {
        const total = this.getSubtotal()
        this.productsFooter.classList.remove('hidden');
        this.ivaElement.textContent = `${this.getIVA().toFixed(2)}$`;
        this.subtotalElement.textContent = `${total.toFixed(2)}$`;
        this.totalElement.textContent = `${this.getTotal().toFixed(2)}$`;
    }

    formatDate(date) {
        const dateValue = new Date(date);
        const options = { day: 'numeric', month: 'long', year: 'numeric' };
        return new Intl.DateTimeFormat('es-MX', options).format(dateValue);

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

    printCartToTable() {
        
        this.previewTableBody.innerHTML = '';
        
        this.cart.forEach(product => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${product.name}</td>
                <td>${product.amount}</td>
                <td>${product.price}</td>
                <td>${product.total}</td>
            `;
            this.previewTableBody.appendChild(row);
        });
        
        this.previewSubtotalElement.textContent = `${this.formatPesos(this.getSubtotal())}`;
        this.previewIvaElement.textContent = `${this.formatPesos(this.getIVA())}`;
        this.previewTotalElement.textContent = `${ this.formatPesos(this.getTotal())}`;
        
        

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
    formatPesos(amount, withDecimals = true) {
        return new Intl.NumberFormat('es-MX', {
            style: 'currency',
            currency: 'MXN',
            minimumFractionDigits: withDecimals ? 2 : 0,
            maximumFractionDigits: 2
        }).format(amount);
}

}

new InvoiceManager();


                                                    

</script>