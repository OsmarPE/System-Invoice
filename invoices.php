<?php
    require_once 'session.php';
    require_once 'config/db.php';
    include_once 'helper/util.php';

    $query = "SELECT invoice.id, invoice.date, invoice.subtotal, invoice.iva, invoice.total, client.name as name, client.direction, client.phone, user.name as user_name
        FROM invoice
        LEFT JOIN client ON invoice.client_id = client.id
        LEFT JOIN user ON invoice.user_id = user.id
    ";
    $result = $db->query($query);

    $result_invoice = [];

    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            $id = $row['id'];
            
            $query_products = "SELECT invoice_details.amount, invoice_details.total, product.name, product.price 
                   FROM invoice_details
                   LEFT JOIN product ON product.id = invoice_details.product_id
                   WHERE invoice_id = {$id}";
            $result_products = $db->query($query_products);


            if ($result_products->num_rows > 0) {
                // output data of each row
                while($row_products = $result_products->fetch_assoc()) {
                    $row['products'][] = [
                        'name' => $row_products['name'],
                        'price' => $row_products['price'],
                        'amount' => $row_products['amount'],
                        'total' => $row_products['total']
                    ];
                }
            }
            $result_invoice[] = $row;
        }
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

<body>
    <?php include 'layout/header.php'; ?>
    <?php include 'layout/navegation.php'; ?>
    <div class="container">
        <main class="main">
            <div class="main-header">
                <h1 class="main-header-title">
                    <i data-lucide="file-text"></i>
                    Facturas
                </h1>
                <a href="/invoice/services/invoices/create-invoice.php" class="main-header-btn btn btn--primary">
                    <i data-lucide="plus"></i>
                    <span>Agregar</span>
                </a>
            </div>
            <div class="main-body main-body--invoices">
                <?php foreach($result_invoice as $invoice): ?>
                <article class="invoice">
                    <div class="invoice-header">
                        <span class="invoice-number">#<?php echo $invoice['id']; ?></span>
                        <p class="invoice-date">
                            <?php echo dateToSpanish($invoice['date']); ?>
                        </p>
                    </div>
                    <div class="invoice-body">
                        <h3 class="invoice-subtitle">
                            Información General
                        </h3>
                        <p class="invoice-text invoice-name">
                            <?php echo $invoice['name']; ?>
                        </p>
                        <p class="invoice-text invoice-direction">
                            <?php echo $invoice['direction']; ?>
                        </p>
                        <p class="invoice-text invoice-phone">
                            <?php echo $invoice['phone']; ?>
                        </p>
                        <p class="invoice-text invoice-user" style="display: none;">
                            <?php echo $invoice['user_name']; ?>
                        </p>
                    </div>
                    <div class="invoice-products">
                        <h3 class="invoice-subtitle">
                            Productos
                        </h3>
                        <?php if(isset($invoice['products'])): ?>
                        <ul class="invoice-products-list-items">
                            
                            <?php foreach($invoice['products'] as $product): ?>
                            <li class="invoice-products-item">
                                <p class="invoice-products-name">
                                    <?php echo $product['name']; ?>
                                </p>
                                <p class="invoice-products-price">
                                    $<?php echo $product['price']; ?>
                                    <span class="invoice-products-amount">x<?php echo $product['amount']; ?></span>
                                </p>
                                <p class="invoice-products-total " style="display: none;">
                                    $<?php echo $product['total']; ?>
                                </p>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                        <div class="invoice-footer">
                            <div class="invoice-footer-row">
                                <p>Subtotal</p>
                                <span class="total">$<?php echo $invoice['subtotal']; ?></span>
                            </div>
                            <div class="invoice-footer-row">
                                <p>IVA</p>
                                <span class="total">$<?php echo $invoice['iva']; ?></span>
                            </div>
                            <div class="invoice-footer-row invoice-footer-total">
                                <p>Total</p>
                                <span class="total">$<?php echo $invoice['total']; ?></span>
                            </div>
                        </div>
                        <button class="invoice-products-btn btn btn--primary">
                            <i data-lucide="cloud-download"></i>
                            Generar factura
                        </button>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </main>

    </div>
</body>

</html>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
    const buttons = document.querySelectorAll('.invoice-products-btn');
    const invoices = document.querySelectorAll('.invoice');
    
    buttons.forEach((button,index) => {
        button.addEventListener('click', async() => {
            
            const id = invoices[index].querySelector('.invoice-number').textContent;
            const date = invoices[index].querySelector('.invoice-date').textContent.trim();

            const name = invoices[index].querySelector('.invoice-name').textContent.trim();
            const direction = invoices[index].querySelector('.invoice-direction').textContent.trim();
            const phone = invoices[index].querySelector('.invoice-phone').textContent.trim();

            const productNames = invoices[index].querySelectorAll('.invoice-products-name');
            const productPrices = invoices[index].querySelectorAll('.invoice-products-price');
            const productAmounts = invoices[index].querySelectorAll('.invoice-products-amount');
            const productTotals = invoices[index].querySelectorAll('.invoice-products-total');
            const user = invoices[index].querySelector('.invoice-user').textContent.trim();

            const total = document.querySelector('.total').textContent.trim();
            
            const products = [];
            for(let i = 0; i < productNames.length; i++) {
                const amount =  productAmounts[i].textContent.trim()
                const product = {
                    name: productNames[i].textContent.trim(),
                    price: productPrices[i].textContent.replace(amount, '').trim(),
                    amount: amount[1],
                    total: productTotals[i].textContent.trim()
                };
                products.push([product.name, product.price,product.amount, product.total]);
            }
            console.log(products);
            
             await generarFactura(id, user, date, name, direction, phone, products,total);
            
        });
    });
    async function generarFactura(id,user, date, name, direction, phone, products,total) {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();
    
      
      const fecha = new Date().toLocaleDateString();
      
      doc.setFont("helvetica", "bold");
      doc.setFontSize(18);
      doc.text("Invoice", 20, 10, { align: "left" });
      doc.setFontSize(10);
      doc.setFont("helvetica", "normal");
      doc.setTextColor('#C621A6')
      doc.text("#123456789", 20, 16, { align: "left" });
      
      doc.setDrawColor('#D9D9D9'); // gris medio (RGB)
      doc.line(20, 24, 180, 24); 

      doc.setTextColor(`#${id}`);
      doc.setFontSize(10);
      doc.text(`Realizado por:`, 20, 34, { align: "left" });
      
      doc.setTextColor('#000000');
      doc.setFontSize(14);
      doc.text(user, 20, 40, { align: "left" });

      const texto = "Fecha de emisión";
      const pageWidth = doc.internal.pageSize.getWidth();  // ancho página
      const marginRight = 20;  // margen derecho

        // Medir ancho del texto en el font actual
      const textWidth = doc.getTextWidth(texto);

        // Calcular posición X para alinear a la derecha con margen
      const x = pageWidth - marginRight;

      doc.setTextColor('#99A1AF');
      doc.setFontSize(10);
      doc.text(texto, x, 34, { align: "right" });

      doc.setTextColor('#000000');
      doc.setFontSize(14);
      doc.text(date, x, 40, { align: "right" });

      doc.setDrawColor('#D9D9D9'); // gris medio (RGB)
      doc.line(20, 50, 180, 50); 

      doc.setTextColor('#99A1AF');
      doc.setFontSize(10);
      doc.text("De:", 20, 60, { align: "left" });

      doc.setTextColor('#000000');
      doc.setFontSize(14);
      doc.text(name, 20, 66, { align: "left" });

      doc.setTextColor('#99A1AF');
      doc.setFontSize(10);
      doc.text(direction, 20, 72, { align: "left" });

      doc.setTextColor('#99A1AF');
      doc.setFontSize(10);
      doc.text("osmar@gmail.com", 20, 78, { align: "left" });

      doc.setTextColor('#99A1AF');
      doc.setFontSize(10);
      doc.text(phone, 20, 84, { align: "left" });
      
      doc.setDrawColor('#D9D9D9'); // gris medio (RGB)
      doc.line(20, 94, 180, 94); 
        console.log(products);
        
        doc.autoTable({
        startY: 100,
        margin: { left: 20, right: 20 },
        head: [['Producto', 'Cantidad', 'Precio Unitario', 'Total']],
        body: products,
        theme: 'plain', 
        styles: {
        fontSize: 10,
        textColor: [0, 0, 0],
        cellPadding: 3,
        lineColor: [255, 255, 255], 
        lineWidth: 0 
        },
        headStyles: {
        fillColor: [255, 255, 255], // Fondo blanco
        textColor: [153, 161, 175], // Color gris como tus etiquetas
        fontStyle: 'normal',
        fontSize: 10
        },
        bodyStyles: {
        fillColor: [255, 255, 255], // Fondo blanco
        textColor: [0, 0, 0] // Texto negro
        },
        alternateRowStyles: {
        fillColor: [255, 255, 255] // Sin filas alternadas
        },
           columnStyles: {
      0: { cellWidth: 60 }, // Producto
      1: { cellWidth: 25, halign: 'center' }, // Cantidad
      2: { cellWidth: 40, halign: 'center' }, // Precio Unitario
      3: { cellWidth: 35, halign: 'right' }   // Total
    },
    });
    
    const tablaFinalY = doc.lastAutoTable.finalY;

    doc.line(20, tablaFinalY + 6, 180, tablaFinalY + 6); 
    
    doc.setTextColor('#000000');
    doc.setFontSize(10);
    doc.text("Total:", 22, tablaFinalY + 16, { align: "left" });

    doc.setFontSize(14);
    doc.setTextColor('#C621A6');
    doc.text(total, pageWidth - 32, tablaFinalY + 16, { align: "right" });
    
    
    doc.save('factura.pdf');
    }
  </script>
</script>