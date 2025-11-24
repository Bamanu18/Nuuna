<nav class="navbar sticky-top">
    <a href="index.php" class="navbar-logo"><span>N</span>uuna</a>

    <div class="navbar-menu">
        <a href="index.php">Beranda</a>
        <a href="index.php#tentang">Tentang Kami</a>
        <a href="produk.php">Produk</a>
        <a href="index.php#judul">Kontak</a>
    </div>

    <div class="navbar-icon">
        <a href="#" id="btn-search"><i class="fas fa-search"></i></a>

        <?php if (empty($_SESSION['keranjang_belanja'])): ?>
            <a href="keranjang.php"><i class="fas fa-shopping-cart">(0)</i></a>
        <?php else: ?>
            <?php
            $items = 0;
            foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah) {
                $items++;
            }
            ?>
            <a href="keranjang.php"><i class="fas fa-shopping-cart">(<?php echo $items; ?>)</i></a>
        <?php endif; ?>

        <a href="#" id="btn-user"><i class="fas fa-user"></i></a>
        <a href="#" id="btn-menu"><i class="fas fa-bars"></i></a>

        <form action="produk.php" method="get">
            <div class="search-form">
                <input type="search" name="keyword" id="search-box" class="form-control" placeholder="Search">
                <button for="search-box" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="user">
        <?php if (isset($_SESSION['pelanggan'])): ?>
            <li><a href="pelanggan/index.php">Profil</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="daftar.php">Daftar</a></li>
        <?php endif; ?>
    </div>

</nav>