<?php

include("../connection.php");

if (!isset($_POST['customer_id'])) {
    header("Location: ../../admin/add-sale.php");
    exit();
}

$customer_id = intval($_POST['customer_id']);
$invoice_no  = mysqli_real_escape_string($connection, $_POST['invoice_no']);
$sale_date   = $_POST['sale_date'];
$total_amount = floatval($_POST['total_amount']);
$paid_amount  = floatval($_POST['paid_amount']);
$due_amount   = floatval($_POST['due_amount']);
$status       = mysqli_real_escape_string($connection, $_POST['status']);

mysqli_begin_transaction($connection);

try {

    /* ==========================
       Insert Sale
    ========================== */

    $sale = mysqli_query(
        $connection,
        "INSERT INTO sales
        (
            customer_id,
            invoice_no,
            sale_date,
            total_amount,
            paid_amount,
            due_amount,
            status
        )
        VALUES
        (
            '$customer_id',
            '$invoice_no',
            '$sale_date',
            '$total_amount',
            '$paid_amount',
            '$due_amount',
            '$status'
        )"
    );

    if (!$sale) {
        throw new Exception("Sale Insert Failed : " . mysqli_error($connection));
    }

    $sale_id = mysqli_insert_id($connection);

    /* ==========================
       Sale Items
    ========================== */

    foreach ($_POST['product_id'] as $key => $product_id) {

        $product_id = intval($product_id);
        $quantity   = intval($_POST['quantity'][$key]);
        $price      = floatval($_POST['price'][$key]);
        $total      = floatval($_POST['total'][$key]);

        /* ==========================
           Check Available Stock
        ========================== */

        $stockQuery = mysqli_query(
            $connection,
            "SELECT stock_quantity
             FROM products
             WHERE id='$product_id'"
        );

        if (!$stockQuery) {
            throw new Exception(mysqli_error($connection));
        }

        $product = mysqli_fetch_assoc($stockQuery);

        if (!$product) {
            throw new Exception("Product Not Found");
        }

        if ($product['stock_quantity'] < $quantity) {
            throw new Exception("Not Enough Stock Available");
        }

        /* ==========================
           Insert Sale Item
        ========================== */

        $item = mysqli_query(
            $connection,
            "INSERT INTO sale_items
            (
                sale_id,
                product_id,
                quantity,
                price,
                total
            )
            VALUES
            (
                '$sale_id',
                '$product_id',
                '$quantity',
                '$price',
                '$total'
            )"
        );

        if (!$item) {
            throw new Exception("Sale Item Insert Failed : " . mysqli_error($connection));
        }

        /* ==========================
           Reduce Product Stock
        ========================== */

        $stockUpdate = mysqli_query(
            $connection,
            "UPDATE products
             SET stock_quantity = stock_quantity - $quantity
             WHERE id='$product_id'"
        );

        if (!$stockUpdate) {
            throw new Exception("Stock Update Failed : " . mysqli_error($connection));
        }

    } // End foreach

    /* ==========================
       Commit Transaction
    ========================== */

    mysqli_commit($connection);

    header("Location: ../../admin/sales.php");
    exit();

} catch (Exception $e) {

    mysqli_rollback($connection);

    echo "<h2>Sale Failed!</h2>";
    echo "<p>" . $e->getMessage() . "</p>";

}

?>