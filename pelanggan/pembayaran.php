<div class="shadow bg-white p-3 rounded">
    <h5><strong>Pembayaran</strong></h5>
</div>

<?php
include '../koneksi/koneksi.php';


$id_pembelian = $_GET['id'];
//ambil data pesanan
$ambil = $koneksi->query("SELECT * FROM pembelian
        WHERE id_pembelian='$id_pembelian'");
$pecah = $ambil->fetch_assoc();

if ($pecah['id_pelanggan'] != $_SESSION['pelanggan']['id_pelanggan']) {
    echo "<script>alert('Anda tidak memiliki akses ke pesanan ini');<script>";
    echo "<script>location='index.php?page=pesanan';</script>";
}

//ambil order_id dari pembelian
$order_id = $pecah['order_id'];

//ambil data pembayaran berdasarkan order_id
$ambil_pembayaran = $koneksi->query("SELECT * FROM pembayaran WHERE order_id ='$order_id'");
$databayar = $ambil_pembayaran->fetch_assoc();

?>

<div class="alert alert-primary shadow text-dark">
    Total tagihan anda: <b>Rp. <?php echo number_format($pecah['total_pembelian']); ?></b>
</div>

<div class="shadow bg-white p-3 rounded">
    <h5>Status Pembayaran</h5>
    <table class="table">
        <tr>
            <th>Status</th>
            <td>
                <?php
                if (isset($databayar)) {
                    echo "<span class='badge badge-info'>{$databayar['midtrans_status']}</span>";
                } else {
                    echo "<span class='badge badge-warning'>Belum Melakukan Pembayaran</span>";
                }
                ?>
            </td>
        </tr>

        <th>Metode</th>
        <td><?php echo $databayar['payment_type'] ?? '-'; ?></td>
        <tr>
            <th>Dibayar Pada</th>
            <td><?php echo $databayar['payment_time'] ?? '-'; ?></td>
        </tr>
    </table>

    <!-- Tombol Bayar -->
    <a href="../midtrans/midtrans_pay.php?order_id=<?php echo $order_id; ?>" class="btn btn-primary btn-block"> Bayar
        dengan Midtrans
    </a>



</div>

<!-- <form method="post" enctype="multipart/form-data">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Nama :</label>
        <div class="col-sm-9">
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Anda" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Pembayaran :</label>
        <div class="col-sm-9">
            <select name="via_pembayaran" class="form-control">
                <option selected disabled>Pilih Metode Pembayaran</option>
                <option value="cash">Bayar di tempat</option>
                <option value="spay">ShopeePay</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Jumlah :</label>
        <div class="col-sm-9">
            <input type="text" name="jumlah" class="form-control" value="<?php echo $pecah['total_pembelian']; ?>"
                readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Bukti :</label>
        <div class="col-sm-9">
            <input type="file" name="bukti" class="form-control">
            <small class="text-danger">Max 2mb</small>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label"></label>
        <div class="col-sm-9">
            <button name="kirim" class="btn btn-primary">Kirim</button>
        </div>
    </div>
</form> -->
<?php

// if (isset($_POST['kirim'])) {
//     $nama = $_POST['nama'];
//     $via_pembayaran = $_POST['via_pembayaran'];
//     $jumlah = $_POST['jumlah'];
//     $tanggal = date('Y-m-d');

//     $nama_bukti = $_FILES['bukti']['name'];
//     $lokasi_bukti = $_FILES['bukti']['tmp_name'];
//     $tgl_bukti = date('YmdHis') . $nama_bukti;

//     move_uploaded_file($lokasi_bukti, "../assets/foto_bukti/" . $tgl_bukti);

//     // Menyimpan kedalam tabel pembayaran    
//     $koneksi->query("INSERT INTO pembayaran
//     (id_pembelian,nama,via_pembayaran,jumlah,tanggal,bukti)
//     VALUES ('$id_pembelian','$nama','$via_pembayaran','$jumlah','$tanggal','$tgl_bukti')");

//     // update tabel pembelian
//     $koneksi->query("UPDATE pembelian SET status='sedang diproses'
//     WHERE id_pembelian='$id_pembelian'");

//     echo "<script>alert('pembayaran terkirim');</script>";
//     echo "<script>location='index.php?page=pesanan';</script>";
// }

// ?>