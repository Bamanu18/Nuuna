<?php

session_start();

include 'koneksi/koneksi.php';

$id_produk = $_GET['idproduk'];

$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$produk = $ambil->fetch_assoc();

$produkfoto = array();
$ambil = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk='$id_produk'");
while ($pecah = $ambil->fetch_assoc()) {
    $produkfoto[] = $pecah;
}

// // PROSES TOMBOL BELI
// if (isset($_POST['beli'])) {

//     // DEBUG DISINI
//     var_dump($_POST);
//     exit;
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Detail Produk</title>

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

    <section class="page-produk">
        <div class="container">

            <ul class="breadcrumb">
                <li><a href="index.php">Beranda</a></li>
                <li>Detail Produk</li>
            </ul>

            <div class="row">

                <div class="col-md-3">
                    <?php include 'include/sidebar.php'; ?>
                </div>

                <div class="col-md-9 detail-produk">

                    <div class="row">

                        <div class="col-6 mt-3">
                            <div id="owl-nav"></div>
                            <div class="owl-carousel owl-theme">
                                <?php foreach ($produkfoto as $key => $value): ?>
                                    <div class="item">
                                        <img src="assets/foto_produk/<?php echo $value['nama_produk_foto']; ?>">
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>

                        <div class="col-6 detail-form">
                            <form method="post">
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <h3><?php echo $produk['nama_produk']; ?></h3>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Jumlah :</label>
                                            <div class="col-sm-9">
                                                <input type="number" name="jumlah" class="
                                                form-control" value="1" min="1"
                                                    max="<?php echo $produk['stok_produk']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Stok :</label>
                                            <div class="col-sm-9">
                                                <input disabled class="form-control"
                                                    value="<?php echo $produk['stok_produk'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <input type="hidden" name="id_produk" class="form-control"
                                                    value="<?php echo $produk['id_produk']; ?>">
                                            </div>
                                        </div>
                                        <h5>Rp.<?php echo number_format($produk['harga_produk']); ?></h5>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button name="beli" class="btn btn-success">
                                            <i class="fas fa-shopping-cart"></i>Keranjang
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="card-footer text-left">
                                <h6>Mau bertanya terlebih dahulu? Click Whatsapp di bawah:</h6>
                                <a href="https://wa.me/+62895414564318"><i class="fab fa-whatsapp mt-2"></i></a>
                            </div>

                        </div>

                    </div>

                    <div class="card detail">
                        <div class="card-body">
                            <h2>Detail produk</h2>
                            <p>
                                <?php echo $produk['deskripsi_produk']; ?>
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <?php

    if (isset($_POST['beli'])) {

        $id_produk = $_POST['id_produk'];
        $jumlah = $_POST['jumlah'];

        // jika produk sudah ada di keranjang 
        if (!empty($id_produk)) {

            if (isset($_SESSION['keranjang_belanja'][$id_produk])) {
                $_SESSION['keranjang_belanja'][$id_produk] += $jumlah; //tambahkan jumlah
            } else {

                $_SESSION['keranjang_belanja'][$id_produk] = $jumlah;
            }
        }

        echo "<script>alert('Produk berhasil masuk ke keranjang');</script>";
        echo "<script>location='keranjang.php';</script>";

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