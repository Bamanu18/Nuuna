<?php

include 'koneksi/koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>

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

        <!-- Outer Row -->
        <div class="row justify-content-center" id="login">

            <div class="col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Daftar</h1>
                                    </div>
                                    <form method="post" enctype="multipart/form-data" class="user">

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                Nama Lengkap
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                E-mail
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="email" name="email" class="form-control" placeholder="Masukan E-mail" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                Password
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                No.hp
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="number" name="telepon" class="form-control" placeholder="Masukan No.Hp" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                Alamat Lengkap
                                            </label>
                                            <div class="col-sm-8">
                                                <textarea type="text" name="alamat" class="form-control" placeholder="Masukan Alamat Lengkap" required></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">
                                                Foto
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="file" name="foto" class="form-control">
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <button name="daftar" class="btn btn-primary">
                                                Daftar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

<?php

if(isset($_POST['daftar'])){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    $nama_foto = $_FILES['foto']['name'];
    $lokasi_foto = $_FILES['foto']['tmp_name'];

    move_uploaded_file($lokasi_foto, "./assets/foto_pelanggan/".$nama_foto);

    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
    $ada_email = $ambil->num_rows;
    if($ada_email==1){
        echo "<script>alert('pendaftaran gagal, email sudah digunakan');</script>";
        echo "<script>location='daftar.php';</script>";
    } else {
        $koneksi->query("INSERT INTO pelanggan(nama_pelanggan,email_pelanggan,password_pelanggan,notlp_pelanggan,alamat_pelanggan,foto_pelanggan) VALUES('$nama','$email','$password','$telepon','$alamat','$nama_foto')");

        echo "<script>alert('pendaftaran Sukses, Silahkan login');</script>";
        echo "<script>location='login.php';</script>";
    }
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