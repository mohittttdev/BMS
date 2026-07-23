<?php

include("../connection.php");

if (!isset($_POST['supplier_id'])) {
    header("Location: ../../admin/add-purchase.php");
    exit();
}

$supplier_id   = intval($_POST['supplier_id']);
$invoice_no    = mysqli_real_escape_string($connection, $_POST['invoice_no']);
$purchase_date = $_POST['purchase_date'];
$total_amount  = floatval($_POST['total_amount']);
$paid_amount   = floatval($_POST['paid_amount']);
$due_amount    = floatval($_POST['due_amount']);
$status        = mysqli_real_escape_string($connection, $_POST['status']);

mysqli_begin_transaction($connection);

try {

    /* ==========================
       Insert Purchase
    ========================== */

    $purchase = mysqli_query(
        $connection,
        "INSERT INTO purchases
        (
            supplier_id,
            invoice_no,
            purchase_date,
            total_amount,
            paid_amount,
            due_amount,
            status
        )
        VALUES
        (
            '$supplier_id',
            '$invoice_no',
            '$purchase_date',
            '$total_amount',
            '$paid_amount',
            '$due_amount',
            '$status'
        )"
    );

    if (!$purchase) {
        throw new Exception("Purchase Insert Failed : " . mysqli_error($connection));
    }

    $purchase_id = mysqli_insert_id($connection);

    /* ==========================
       Insert Purchase Items
    ========================== */

    foreach ($_POST['product_id'] as $key => $product_id) {

        $product_id = intval($product_id);
        $quantity   = intval($_POST['quantity'][$key]);
        $price      = floatval($_POST['price'][$key]);
        $total      = floatval($_POST['total'][$key]);

        // Insert Purchase Item
        $item = mysqli_query(
            $connection,
            "INSERT INTO purchase_items
            (
                purchase_id,
                product_id,
                quantity,
                price,
                total
            )
            VALUES
            (
                '$purchase_id',
                '$product_id',
                '$quantity',
                '$price',
                '$total'
            )"
        );

        if (!$item) {
            throw new Exception("Purchase Item Insert Failed : " . mysqli_error($connection));
        }

        // Update Product Stock
        $stock = mysqli_query(
            $connection,
            "UPDATE products
             SET stock_quantity = stock_quantity + $quantity
             WHERE id='$product_id'"
        );

        if (!$stock) {
            throw new Exception("Stock Update Failed : " . mysqli_error($connection));
        }

    } // End foreach

    /* ==========================
       Commit Transaction
    ========================== */

    mysqli_commit($connection);

    header("Location: ../../admin/purchases.php");
    exit();

} catch (Exception $e) {

    mysqli_rollback($connection);

    echo "<h2>Purchase Failed!</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>