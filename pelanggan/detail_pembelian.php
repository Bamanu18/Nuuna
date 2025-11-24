<div class="shadow p-3 mb-3 bg-white rounded">
    <h5><b>Halaman Detail Pembelian</b></h5>
</div>

<?php
    $id_pembelian = $_GET['id'];
    $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$id_pembelian'");
    $detail = $ambil->fetch_assoc();

    $idpembelian = $detail['id_pelanggan'];
    $idpelanggan = $_SESSION['pelanggan']['id_pelanggan'];

    if($idpembelian!==$idpelanggan)
    {
        echo "<script>alert('session tidak ditemukan');</script>";
        echo "<script>location='index.php?page=pesanan';</script>";
    }
?>



<div class="row">
    <div class="col-md-4">
        <h5>Data Pelanggan</h5>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Nama : </th>
                    <td><?php echo $detail['nama_pelanggan']; ?></td>
                </tr>
                <tr>
                    <th>Email : </th>
                    <td><?php echo $detail['email_pelanggan']; ?></td>
                </tr>
                <tr>
                    <th>Telepon : </th>
                    <td><?php echo $detail['notlp_pelanggan']; ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow bg-white text-center">
        <h5>Data Pembelian</h5>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>No.Pembelian : </th>
                    <td><?php echo $detail['id_pelanggan']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal : </th>
                    <td><?php echo $detail['tanggal_pembelian']; ?></td>
                </tr>
                <tr>
                    <th>Total : </th>
                    <td><?php echo number_format($detail['total_pembelian']); ?></td>
                </tr>
            </table>
        </div>
        </div>
    </div>
</div>

<?php
    $pembelianproduk = array();
    $ambil = $koneksi->query("SELECT * FROM pembelian_produk 
    WHERE pembelian_produk.id_pembelian='$id_pembelian'");
    while($pecah = $ambil->fetch_assoc()){
        $pembelianproduk[] = $pecah;
    }
?>

<div class="card shadow bg-white mt-3">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Sub Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pembelianproduk as $key => $value): ?>
                <tr>
                    <td width="50"><?php echo $key+1; ?></td>
                    <td><?php echo $value['nama']; ?></td>
                    <td>Rp<?php echo number_format($value['harga']); ?></td>
                    <td><?php echo $value['jumlah']; ?></td>
                    <td>Rp.<?php echo number_format($value['subharga']); ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div class="alert alert-primary shadow mt-3">
    <p>
        Silahkan Lakukan Pembayaran Sebesar: Rp. <?php echo number_format($detail['total_pembelian']); ?><br>
    </p>
</div>