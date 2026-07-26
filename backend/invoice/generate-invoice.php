<?php
include("../connection.php");

require_once(__DIR__ . '/../../tcpdf/tcpdf.php');

if (!isset($_GET['id'])) {
    die("Invoice ID Missing");
}

$id = intval($_GET['id']);

/* ===============================
   Sale + Customer Details
================================ */

$query = mysqli_query($connection, "
SELECT
    s.*,
    c.customer_name,
    c.company_name,
    c.phone,
    c.email,
    c.address,
    c.city,
    c.state,
    c.country,
    c.pincode,
    c.gst_number
FROM sales s
LEFT JOIN customer c
ON s.customer_id = c.id
WHERE s.id='$id'
");

if (mysqli_num_rows($query) == 0) {
    die("Invoice Not Found");
}

$sale = mysqli_fetch_assoc($query);

/* ===============================
   Product Details
================================ */

$items = mysqli_query($connection, "
SELECT
    si.quantity,
    si.price,
    si.total,
    p.product_code,
    p.product_name,
    p.brand,
    p.unit
FROM sale_items si
LEFT JOIN products p
ON si.product_id = p.id
WHERE si.sale_id='$id'
");

/* ===============================
   Create PDF
================================ */

$pdf = new TCPDF(
    PDF_PAGE_ORIENTATION,
    PDF_UNIT,
    PDF_PAGE_FORMAT,
    true,
    'UTF-8',
    false
);

$pdf->SetCreator("Business Management System");
$pdf->SetAuthor("BMS");
$pdf->SetTitle("Sales Invoice");

$pdf->SetMargins(15, 15, 15);
$pdf->AddPage();

/* Rupee Symbol Support */
$pdf->SetFont('dejavusans', '', 11);

/* ===============================
   Invoice Header
================================ */

$html='

<h1 align="center">
BUSINESS MANAGEMENT SYSTEM
</h1>

<p align="center">
<b>Sales Invoice</b>
</p>

<hr>

<table cellpadding="5">

<tr>

<td width="50%">

<b>Invoice No :</b><br>

'.$sale["invoice_no"].'

<br><br>

<b>Date :</b><br>

'.$sale["sale_date"].'

<br><br>

<b>Status :</b><br>

'.$sale["status"].'

</td>

<td width="50%">

<b>Customer :</b><br>

'.$sale["customer_name"].'

<br><br>

<b>Company :</b><br>

'.$sale["company_name"].'

<br><br>

<b>Phone :</b><br>

'.$sale["phone"].'

<br><br>

<b>Email :</b><br>

'.$sale["email"].'

</td>

</tr>

</table>

<br>

<b>Billing Address</b>

<br>

'.$sale["address"].'

<br>

'.$sale["city"].',

'.$sale["state"].',

'.$sale["country"].'

-

'.$sale["pincode"].'

<br><br>

';
/* ===============================
   Product Table
================================ */

$html .= '

<h3>Product Details</h3>

<table border="1" cellpadding="6">

<tr style="background-color:#f2f2f2;">

<th width="8%"><b>#</b></th>

<th width="22%"><b>Code</b></th>

<th width="30%"><b>Product</b></th>

<th width="10%"><b>Qty</b></th>

<th width="10%"><b>Unit</b></th>

<th width="10%"><b>Price</b></th>

<th width="10%"><b>Total</b></th>

</tr>

';

$sr = 1;

while($item = mysqli_fetch_assoc($items)){

$html .= '

<tr>

<td>'.$sr++.'</td>

<td>'.$item["product_code"].'</td>

<td>

'.$item["product_name"].'

<br>

<small>'.$item["brand"].'</small>

</td>

<td align="center">

'.$item["quantity"].'

</td>

<td align="center">

'.$item["unit"].'

</td>

<td align="right">

₹ '.number_format($item["price"],2).'

</td>

<td align="right">

₹ '.number_format($item["total"],2).'

</td>

</tr>

';

}

$html .= '

</table>

<br><br>

';
/* ===============================
   Payment Summary
================================ */

$html .= '

<br>

<table border="1" cellpadding="6">

<tr>

<td width="70%"><b>Total Amount</b></td>

<td width="30%" align="right">

₹ '.number_format($sale["total_amount"],2).'

</td>

</tr>

<tr>

<td><b>Paid Amount</b></td>

<td align="right">

₹ '.number_format($sale["paid_amount"],2).'

</td>

</tr>

<tr>

<td><b>Due Amount</b></td>

<td align="right">

₹ '.number_format($sale["due_amount"],2).'

</td>

</tr>

<tr>

<td><b>Status</b></td>

<td align="center">

'.$sale["status"].'

</td>

</tr>

</table>

<br><br>

<table cellpadding="6">

<tr>

<td width="50%">

<b>GST No :</b>

'.$sale["gst_number"].'

</td>

<td width="50%" align="right">

_____________________

<br>

Authorized Signature

</td>

</tr>

</table>

<br><br>

<hr>

<p align="center">

<b>Thank You For Your Business!</b>

<br>

Business Management System

</p>

';

/* ===============================
   Generate PDF
================================ */

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output(
"Invoice_".$sale["invoice_no"].".pdf",
"I"
);

exit;

?>