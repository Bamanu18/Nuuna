<?php

session_start();
include 'koneksi/koneksi.php';

if (!isset($_SESSION['pelanggan']['id_pelanggan'])) {
    echo "<script>alert('Silahkan Login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

$produk = array();

$ambil = $koneksi->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori LIMIT 8");
while ($pecah = $ambil->fetch_assoc()) {
    $produk[] = $pecah;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko obat & kosmetik Nuuna</title>

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

    <div class="container">

        <!-- hero section start -->
        <section class="hero">
            <div id="owl-nav"></div>
            <div class="owl-carousel owl-theme">

                <div class="item">
                    <img src="assets/img/belakang1.png">
                    <main class="content">
                        <h1>Nuuna</h1>
                        <p>
                            Kami Menjual Berbagai Makanan & Minuman, Tunggu Apa Lagi?
                        </p>
                        <a href="#" class="btn btn-primary">Beli Sekarang</a>
                    </main>
                </div>

                <div class="item">
                    <img src="assets/img/belakang2.png">
                    <main class="content">
                        <h1><span>N</span>uuna</h1>
                        <p>
                            Kami Menjual Berbagai Makanan & Minuman, Tunggu Apa Lagi?
                        </p>
                        <a href="#" class="btn btn-primary">Beli Sekarang</a>
                    </main>
                </div>

            </div>
        </section>
        <!-- hero section end -->

        <!-- about section start -->
        <section class="about" id="tentang">

            <div class="row">
                <div class="col-md-6 about-img">
                    <img src="assets/img/nuuna.jpg">
                </div>
                <div class="col-md-6 content">
                    <br>
                    <h3>Nuuna</h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi eligendi soluta distinctio, dolore
                        eius corporis sit possimus vitae quam laudantium ab suscipit officiis consequatur amet
                        voluptatibus, blanditiis voluptatum. Iusto excepturi maiores nobis facere animi voluptatibus
                        fugiat totam, cum ea suscipit tenetur provident eum qui aliquam rem autem odio optio
                        necessitatibus?
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum omnis laborum consequatur
                        incidunt aut repellendus.
                    </p>
                </div>
            </div>
        </section>
        <!-- about section end -->

        <!-- produk section start -->
        <section class="produk1">
            <div class="produk-box">
                <h2>Produk Kami</h2>
            </div>
            <div class="row produk">

                <?php foreach ($produk as $key => $value): ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="assets/foto_produk/<?php echo $value['foto_produk']; ?>" class="card-img-top">
                            <div class="card-body content">
                                <h5><?php echo $value['nama_produk']; ?></h5>
                                <p>Rp.<?php echo number_format($value['harga_produk']); ?></p>
                                <a href="beli.php?idproduk=<?php echo $value['id_produk']; ?>" class="btn btn-success">
                                    <i class="fas fa-shopping-cart"></i> Keranjang
                                </a>
                                <a href="detail_produk.php?idproduk=<?php echo $value['id_produk']; ?>"
                                    class="btn btn-success">Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

            </div>
        </section>
        <!-- produk section end -->

        <!-- kontak section start -->
        <section class="kontak">
            <h2 class="judul" id="judul"><span>Kontak</span> Kami</h2>
            <div class="row">

                <div class="col-md-6 kontak-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.2899911169347!2d106.73025899999999!3d-6.3564963!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ef64650a826f%3A0x9fc2571e593d04a1!2sSaung%20Bawah%20Sutet%20Samping%20Kali!5e0!3m2!1sid!2sid!4v1717166268958!5m2!1sid!2sid"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="col-md-6 kontak-form">
                    <form method="post" action="#">
                        <div class="card">
                            <div class="card-body">

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Nama Lengkap :</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Masukan Nama Lengkap Anda" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">E-mail :</label>
                                    <div class="col-sm-8">
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Masukan E-mail Anda" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">No Telp :</label>
                                    <div class="col-sm-8">
                                        <input type="number" name="telepon" class="form-control"
                                            placeholder="Masukan No. Telpon Anda" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Pesan :</label>
                                    <div class="col-sm-8">
                                        <textarea type="text" name="pesan" class="form-control"
                                            placeholder="Masukan Pesan Anda" required></textarea>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button name="kirim" class="btn btn-success">Kirim</button>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </section>
        <!-- kontak section end -->
    </div>

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