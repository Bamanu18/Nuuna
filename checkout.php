<?php

session_start();
include 'koneksi/koneksi.php';

//jika pelanggan login dan belum
if(!isset($_SESSION['pelanggan']['id_pelanggan'])){
    echo "<script>alert('Silahkan Login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

//jika keranjang kosong
if(empty($_SESSION['keranjang_belanja']) OR !isset($_SESSION['keranjang_belanja'])){
    echo "<script>alert('Keranjang kosong, silakan belanja');</script>";
    echo "<script>location='produk.php';</script>";
    exit();
}

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- Font Style-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Css Style-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- data table -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- navbar start -->
    <?php include 'include/navbar.php'; ?>
    <!-- navbar end -->

    <section class="page-keranjang">
        <div class="container">

            <ul class="breadcrumb">
                <li><a href="index.php">Beranda</a></li>
                <li>Keranjang Belanja</li>
            </ul>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subharga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    $subtotal = 0;
                                    foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah): 
                                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                    $pecah = $ambil->fetch_assoc();
                                    $subharga = $pecah['harga_produk']*$jumlah;   
                                    $totalbelanja = $subtotal+=$subharga; 
                                ?>
                                <tr>
                                    <td width="25px"><?php echo $no++; ?></td>
                                    <td><img src="./assets/foto_produk/<?php echo $pecah['foto_produk']; ?>" width="50"></td>
                                    <td><?php echo $pecah['nama_produk']; ?></td>
                                    <td><?php echo $jumlah; ?></td>
                                    <td>Rp.<?php echo number_format($pecah['harga_produk']); ?></td>
                                    <td>Rp.<?php echo number_format($subharga); ?></td>
                                    
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5">Total Belanja</th>
                                    <th>Rp.<?php echo number_format($totalbelanja); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>

            <div class="row mt-3">

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>" readonly>
                            <br>
                            <input type="text" class="form-control" value="<?php echo $_SESSION['pelanggan']['email_pelanggan']; ?>" readonly>
                            <br>
                            <input type="text" class="form-control" value="<?php echo $_SESSION['pelanggan']['notlp_pelanggan']; ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="post">

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Pengiriman :</label>
                                    <div class="col-sm-9">
                                        <select name="pengiriman" class="form-control">
                                            <option selected disabled>Pilih Pengiriman</option>
                                            <option >Ambil Di Tempat</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="text-right">
                                    <button name="checkout" class="btn btn-success">Checkout</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </section>

    <?php 
    
    if(isset($_POST['checkout'])){
        $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
        $tanggal_pembelian = date('y-m-d');
        $pengiriman = $_POST['pengiriman'];
        $total_pembelian = $totalbelanja;
        
        $koneksi->query("INSERT INTO pembelian(id_pelanggan,tanggal_pembelian,total_pembelian,pengiriman) VALUES('$id_pelanggan','$tanggal_pembelian','$total_pembelian','$pengiriman')");
        
        $id_pembelian_baru = $koneksi->insert_id;

        foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah) {
            $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
            $pecah = $ambil->fetch_assoc();
            $nama = $pecah['nama_produk'];
            $harga = $pecah['harga_produk'];
            $subharga = $pecah['harga_produk']*$jumlah;

        $koneksi->query("INSERT INTO pembelian_produk(id_pembelian,id_produk,nama,harga,subharga,jumlah) VALUES('$id_pembelian_baru','$id_produk','$nama','$harga','$subharga','$jumlah')");
        
        $koneksi->query("UPDATE produk SET stok_produk=stok_produk -$jumlah WHERE id_produk='$id_produk'");

        }

        unset($_SESSION['keranjang_belanja']);
        echo "<script>alert('Pembelian Berhasil');</script>";
        echo "<script>location='pelanggan/index.php?page=pesanan';</script>";
    }

    ?>

    <!-- footer start -->
    <?php include 'include/footer.php'; ?>
    <!-- footer end -->

<!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>

    <!-- banner -->
    <script src="assets/js/owl.carousel.min.js"></script>
    
    <!-- btn menu -->
    <script src="assets/js/main.js"></script>
</body>
</html>