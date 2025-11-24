<?php
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$ambil = $koneksi->query("SELECT * FROM pelanggan 
    WHERE id_pelanggan='$id_pelanggan'");
    $pecah = $ambil->fetch_assoc();
?>

<div class="p-3 mb-3 shadow rounded">
    <h4>Selamat Datang <strong><?php echo $pecah['nama_pelanggan']; ?></strong></h4>
</div>

<div class="p-3 mb-3 shadow rounded">
    <form method="post" enctype="multipart/form-data">

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama :</label>
            <div class="col-sm-9">
                <input type="text" name="judul" class="form-control" value="<?php echo $pecah['nama_pelanggan']; ?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Email :</label>
            <div class="col-sm-9">
                <input type="text" name="judul" class="form-control" value="<?php echo $pecah['email_pelanggan']; ?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">No HP :</label>
            <div class="col-sm-9">
                <input type="text" name="judul" class="form-control" value="<?php echo $pecah['notlp_pelanggan']; ?>" readonly>
            </div>
        </div>
    </form>

</div>