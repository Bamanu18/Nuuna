<?php

session_start();
include 'koneksi/koneksi.php';

if(empty($_SESSION['keranjang_belanja']) OR !isset($_SESSION['keranjang_belanja'])){
    echo "<script>alert('Keranjang kosong, silakan belanja');</script>";
    echo "<script>location='produk.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Keranjang</title>

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

            <div class="card box">
                <div class="card-body">
                    <h2>Keranjang Belanja</h2>
                    <?php if(empty($_SESSION['keranjang_belanja'])): ?>
                        <p> Anda mempunyai () items di dalam keranjang belanja</p>
                    <?php else: ?>
                    <?php  
                        $items = 0;
                        foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah)   {
                            $items++;
                        } 
                    ?>
                    <p> Anda mempunyai (<?php echo $items; ?>) items di dalam keranjang belanja</p>
                    <?php endif; ?>

                </div>
            </div>

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
                                <th>Subtotal</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah): 
                                $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                $pecah = $ambil->fetch_assoc();
                                $subtotal = $pecah['harga_produk']*$jumlah;    
                            ?>
                            <tr>
                                <td width="25px"><?php echo $no++; ?></td>
                                <td><img src="./assets/foto_produk/<?php echo $pecah['foto_produk']; ?>" width="50"></td>
                                <td><?php echo $pecah['nama_produk']; ?></td>
                                <td><?php echo $jumlah; ?></td>
                                <td>Rp.<?php echo number_format($pecah['harga_produk']); ?></td>
                                <td>Rp.<?php echo number_format($subtotal); ?></td>
                                <td>
                                    <a href="hapus_keranjang.php?idproduk=<?php echo $pecah['id_produk']; ?>" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <a href="produk.php" class="btn btn-info">
                                Kembali Belanja
                            </a>
                        </div>
                        <div class="col-md-2 text-right">
                            <a href="checkout.php" class="btn btn-success">
                                Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>
    </section>

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