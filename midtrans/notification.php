<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../koneksi/koneksi.php';

\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$serverKey = 'Mid-server-qKLTXr6V6_hc7N_-f4rj9BCe';

//ambil raw
$rawNotification = file_get_contents('php://input');
$data = json_decode($rawNotification, true);

//jika gagal
if (!$data) {
    http_response_code(400);
    error_log("Invalid notification payload");
    exit("Invalid notification");
}

//ambil data 
$order_id = $data['order_id'];
$status_code = $data['status_code'];
$transaction_status = $data['transaction_status'];
$payment_type = $data['payment_type'];
$transaction_id = $data['transaction_id'];
$gross_amount = $data['gross_amount'];
$payment_time = $data['transaction_time'];
$signature_key = $data['signature_key'];

//verifikasi signature key
$serverKey = \Midtrans\Config::$serverKey;
$excepted_signature = hash("sha512", $order_id . $status_code . $gross_amount . $serverKey);

if ($signature_key !== $excepted_signature) {
    http_response_code(403);
    exit("Invalid signature key");
}

//ambil pembelian
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE order_id='$order_id'");
$pembelian = $ambil->fetch_assoc();

if (!$pembelian) {
    http_response_code(404);
    exit("Order ID not found");
}

$id_pembelian = $pembelian['id_pembelian'];

//cek pembayaran
$cekBayar = $koneksi->query("SELECT * FROM pembayaran WHERE order_id='$order_id'");

$rawEscaped = $koneksi->real_escape_string($rawNotification);

//update
if ($cekBayar->num_rows > 0) {
    $koneksi->query("UPDATE pembayaran SET transaction_id='$transaction_id',
    via_pembayaran='$payment_type',
    midtrans_status='$transaction_status',
    tanggal='$payment_time',
    jumlah='$gross_amount',
    raw_response='$rawEscaped' WHERE order_id='$order_id'");
} else {
    $koneksi->query("INSERT INTO pembayaran (id_pembelian, order_id, transaction_id, via_pembayaran, midtrans_status, tanggal, jumlah, raw_response) VALUES 
    ('$id_pembelian', '$order_id', '$transaction_id', '$payment_type', '$transaction_status', '$payment_time', '$gross_amount', '" . $koneksi->real_escape_string($rawNotification) . "')
    ");
}

//update status pesanan
switch ($transaction_status) {
    case 'settlement':
    case 'capture':
        $status = 'sudah dibayar';
        break;
    case 'pending':
        $status = 'pending';
        break;
    case 'cancel':
    case 'deny':
        $status = 'dibatalkan';
        break;
    case 'expire':
        $status = 'Sudah lewat waktu pembayaran';
        break;
    default:
        $status = $transaction_status;
}

$koneksi->query("UPDATE pembelian SET status='$status' WHERE id_pembelian='$id_pembelian'");

http_response_code(200);
echo "OK";

?>