<div class="shadow p-3 mb-3 bg-white rounded">
    <h5><b>Halaman Pembayaran</b></h5>
</div>

<?php

$id_pembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$pecah = $ambil->fetch_assoc();

?>

<div class="card shadow bg-white">
    <div class="card-body row">

        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Nama Pelanggan</th>
                        <td><?php echo $pecah['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Via Pembayaran</th>
                        <td><?php echo $pecah['via_pembayaran']; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td><?php echo $pecah['jumlah']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?php echo $pecah['tanggal']; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <img src="../assets/foto_bukti/<?php echo $pecah['bukti']; ?>" width="250" class="img-thumbnail img-responsive">
        </div>

    </div>
    <div class="card-footer">
        <form method="post">

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Pesan</label>
            <div class="col-sm-9">
                <input type="text" name="pesan" class="form-control" placeholder="masukan pesan">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Status :</label>
            <div class="col-sm-9">
                <select name="status" class="form-control">
                    <option selected disabled>Pilih Status</option>
                    <option value="pembayaran dikonfirmasi">Pembayaran Dikonfirmasi, Pesanan siap diambil</option>
                    <option value="dibatalkan">Pembayaran Dibatalkan</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label"></label>
            <div class="col-sm-9">
                <button name="proses" class="btn btn-primary btn-sm">Proses</button>
            </div>
        </div>

        </form>
    </div>
</div>

<?php

if(isset($_POST['proses'])){
    $pesan = $_POST['pesan'];
    $status = $_POST['status'];

    $koneksi->query("UPDATE pembelian SET pesan='$pesan', status='$status' WHERE id_pembelian='$id_pembelian' ");

    echo "<script>alert('data pembelian berhasil diupdate)</script>";
    echo "<script>location='index.php?halaman=Pembelian';</script>";
}

?>