<?php
    include_once '../../session.php';
    include_once '../../config/db.php';
    include_once '../../message.php';

    

    header('Content-Type: application/json');

    $user = $_POST['id'];
    $date = $_POST['date'];
    $client = $_POST['client'];
    $products = $_POST['products'];
    $total = $_POST['total'];
    $subtotal = $_POST['subtotal'];
    $iva = $_POST['iva'];
    
    try {
    $db->begin_transaction();

    // Insertar factura
    $stmt = $db->prepare("INSERT INTO invoice(user_id, date, client_id, total, subtotal, iva) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issddd", $user, $date, $client, $total, $subtotal, $iva);
    $stmt->execute();
    $invoice_id = $stmt->insert_id ?? $db->insert_id;
    $stmt->close();

    // Insertar detalles
    $products = json_decode($products);
    $stmt_details = $db->prepare("INSERT INTO invoice_details(invoice_id, product_id, amount,total) VALUES (?, ?, ?, ?)");
    
    foreach ($products as $product) {
        $total = $product->amount * $product->price;
        $stmt_details->bind_param("iiid", $invoice_id, $product->id, $product->amount, $total);
        $stmt_details->execute();
    }
    $stmt_details->close();

    $db->commit();
    echo json_encode(['status' => 'success', 'message' => 'Factura enviada exitosamente']);
} catch (Exception $e) {
    $db->rollback();
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

 
    
