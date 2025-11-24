<?php
    session_start();
    include '../koneksi/koneksi.php';

    if(!isset($_SESSION['admin'])){
        echo "<script>alert('anda harus login');</script>";
        echo "<script>location='login.php';</script>";
        exit();
    }

    //data pembayaran
    $data_pem = array();
    $item_pem=0;
    $ambil = $koneksi->query("SELECT * FROM pembayaran LIMIT 5");
    while ($pem = $ambil->fetch_assoc()) {
        $data_pem[]=$pem;
        $item_pem++;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Warung Sembako Kaka Heni</title>

    <!-- Font Style-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Css Style-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- data table -->
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-store-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-2">Warung Sembako Kaka Heni</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=Kategori">
                    <i class="fas fa-list"></i>
                    <span>Kategori</span></a>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=Produk">
                    <i class="fas fa-cubes"></i>
                    <span>Produk</span></a>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=Pembelian">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Pembelian</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=Pelanggan">
                    <i class="fas fa-users"></i>
                    <span>Pelanggan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=laporan_pembelian">
                    <i class="fas fa-file"></i>
                    <span>Laporan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=Logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter"><?php echo $item_pem; ?>+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Data pembayaran
                                </h6>

                                <?php foreach ($data_pem as $key => $value): ?>
                                <a class="dropdown-item d-flex align-items-center" href="index.php?halaman=detail_pembayaran&id=<?php echo $value['id_pembelian']; ?>">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500"><?php echo date("d F Y", strtotime($value['tanggal'])); ?></div>
                                        Rp. <?php echo number_format($value['jumlah']); ?>
                                        <br>
                                        <?php echo $value['nama']; ?>
                                    </div>
                                </a>
                                <?php endforeach ?>

                                <a href="index.php?halaman=Pembelian" class="dropdown-item text-center small text-gray-500">
                                    Show All Data
                                </a>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['admin']['nama_lengkap']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="../assets/img/undraw_profile_3.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.php?halaman=Logout" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <?php
                        //halaman kategori
                        if(isset($_GET['halaman'])){
                            if($_GET['halaman']=="Kategori"){
                                include 'kategori.php';
                            }else if($_GET['halaman']=="tambah_kategori"){
                                include 'tambah/tambah_kategori.php';
                            }elseif($_GET['halaman']=="edit_kategori"){
                                include 'edit/edit_kategori.php';
                            }elseif($_GET['halaman']== "hapus_kategori"){
                                include 'hapus/hapus_kategori.php';
                            }
                            
                            //halaman produk
                            elseif($_GET['halaman']=="Produk"){
                                include 'produk.php';
                            }elseif($_GET['halaman']=="tambah_produk"){
                                include 'tambah/tambah_produk.php';
                            }elseif($_GET['halaman']=="detail_produk"){
                                include 'detail/detail_produk.php';
                            }elseif($_GET['halaman']=="hapus_foto"){
                                include 'hapus/hapus_foto.php';
                            }elseif($_GET['halaman']=="edit_produk"){
                                include 'edit/edit_produk.php';
                            }elseif($_GET['halaman']== "hapus_produk"){
                                include 'hapus/hapus_produk.php';
                            }
                            
                            //halaman pembelian
                            elseif($_GET['halaman']=="Pembelian"){
                                include 'pembelian.php';
                            } else if($_GET['halaman']=="detail_pembelian") {
                                include 'detail/detail_pembelian.php';
                            } else if($_GET['halaman']=="detail_pembayaran") {
                                include 'detail/detail_pembayaran.php';
                            }
                            elseif($_GET['halaman']=="laporan_pembelian")
                            {
                                include 'laporan_pembelian.php';
                            }

                            elseif($_GET['halaman']=="Logout"){
                                include 'logout.php';
                            }
                            
                            //halaman pelanggan
                            elseif($_GET['halaman']=="Pelanggan"){
                                include 'pelanggan.php';
                            }elseif($_GET['halaman']== "hapus_pelanggan"){
                                include 'hapus/hapus_pelanggan.php';
                            }
                            }else{
                                include 'dashboard.php';
                            }
                        ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>

    <script>
        $(document).ready(function(){
            $(".btn-tambah").on("click", function(){
                $(".input-foto").append("<input type='file' name='foto' class='form-control'>");  
            })
        })
    </script>

</body>

</html>