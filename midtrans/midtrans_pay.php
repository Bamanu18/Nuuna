<?php

session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../koneksi/koneksi.php';

\Midtrans\Config::$serverKey = 'Mid-server-qKLTXr6V6_hc7N_-f4rj9BCe';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

$clientkey = "Mid-client-hFe4Xrp8yVS8Zddk";

//ambil order id
if (!isset($_GET['order_id'])) {
    echo "Order ID tidak ditemukan!";
    exit();
}
$order_id = $_GET['order_id'];

//ambil data pesanan dari database
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE order_id='$order_id'");
$pesanan = $ambil->fetch_assoc();

//ambil item yang dibeli
$items = [];

$ambil_produk = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian = '{$pesanan['id_pembelian']}'");

while ($pr = $ambil_produk->fetch_assoc()) {
    $items[] = [
        'id' => $pr['id_produk'],
        'price' => intval($pr['harga']),
        'quantity' => intval($pr['jumlah']),
        'name' => $pr['nama'],
    ];
}

// if (!$pesanan) {
//     echo "Data Pesanan tidak ditemukan!";
//     exit();
// }

//detail transaksi
$transaction_details = [
    'order_id' => $pesanan['order_id'],
    'gross_amount' => intval($pesanan['total_pembelian']),
];

//data pelanggan
$customer_details = [
    'first_name' => $_SESSION['pelanggan']['nama_pelanggan'],
    'email' => $_SESSION['pelanggan']['email_pelanggan'],
    'phone' => $_SESSION['pelanggan']['notlp_pelanggan'],
    'alamat' => $_SESSION['pelanggan']['alamat_pelanggan']
];

//parameter snap
$params = [
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $items,
];

//generate snap token
try {
    $snap_token = \Midtrans\Snap::getSnapToken($params);
} catch (Exception $e) {
    echo "Terjadi Kesalahan: " . $e->getMessage();
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Midtrans</title>

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="<?php echo $clientkey; ?>"></script>
</head>

<body>
    <h3>Memproses Pembayaran...</h3>
    <script type="text/javascript">
        snap.pay('<?php echo $snap_token; ?>', {
            onSuccess: function (result) {
                //pembayaran berhasil
                window.location.href = "../pelanggan/index.php?page=pesanan";
            },

            onPending: function (result) {
                //menunggu pembayaran
                window.location.href = "../pelanggan/index.php?page=pesanan";
            },

            onError: function (result) {
                alert("Terjadi kesalahan saat pembayaran");
                console.log(result);
            },

            onClose: function (result) {
                alert('Anda menutup popup pembayaran!');
            }
        });
    </script>
</body>

</html>