<div class="shadow bg-white p-3 rounded">
    <h5><strong>Pesanan Saya</strong></h5>
</div>

<?php

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$pembelian = array();
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pelanggan='$id_pelanggan'");
while ($pecah = $ambil->fetch_assoc()) {
    $pembelian[]=$pecah;
}

?>

<div class="card shadow">
    <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pembelian as $key => $value): ?>
                <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo date("d F Y", strtotime($value['tanggal_pembelian'])); ?></td>
                    <td>Rp.<?php echo number_format($value['total_pembelian']); ?></td>
                    <?php if($value['status']=='pending'): ?>
                        <td class=" text-center text-danger">
                        <?php echo $value['status']; ?><br>
                        <!-- jika pesn tidak kosong -->
                        <?php if(!empty($value['pesan'])): ?>
                        <?php echo $value['pesan']; ?>
                        <?php endif ?>
                        </td>
                    <?php else: ?>
                        <td class=" text-center text-success">
                        <?php echo $value['status']; ?><br>
                        <!-- jika pesn tidak kosong -->
                        <?php if(!empty($value['pesan'])): ?>
                        <?php echo $value['pesan']; ?>
                        <?php endif ?>
                        </td>
                    <?php endif ?>

                    <td class="text-center" width="250">
                        <a href="index.php?page=detail_pembelian&id=<?php echo $value['id_pembelian']; ?>" class="btn btn-primary">Nota Pembayaran</a>

                        <?php if($value['status']=='pending'):?>

                        <a href="index.php?page=pembayaran&id=<?php echo $value['id_pembelian']; ?>" class="btn btn-success">Bayar</a>
                        <?php else: ?>
                        <a href="index.php?page=detail_pembayaran&id=<?php echo $value['id_pembelian']; ?>" class="btn btn-info">Bayar</a>
                        <?php endif ?>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card-footer text-left">
    <h6>Konfirmasi Pembayaran mu ? Click Whatsapp di bawah:</h6>
    <a href="https://wa.me/+6281280374417"><i class="fab fa-whatsapp mt-2" style="font-size: 3rem; color: rgb(0, 168, 107);"></i></a>
</div>