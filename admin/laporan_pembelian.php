<div class="shadow p-3 mb-3 bg-white rounded">
    <h5><b>Halaman Laporan Pembelian</b></h5>
</div>

<?php

if(isset($_POST['cari']))
{
    $tgl_mulai = $_POST['tglm'];
    $tgl_selesai = $_POST['tgls'];


    $semuadata = array();
    $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
    ON pembelian.id_pelanggan=pelanggan.id_pelanggan
    WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai'");
    while($pecah = $ambil->fetch_assoc())
    {
        $semuadata[] = $pecah;
    }

    //echo "<pre>";
    //print_r($semuadata);
    //echo "</pre>";
}

?>

<?php if(!empty($semuadata)):?>
<div class="alert alert-info shadow">
    <h3>
        Laporan Pembelian dari <?php echo date("d F Y", strtotime($tgl_mulai)); ?> Sampai - <?php echo date("d F Y", strtotime($tgl_selesai)); ?>
    </h3>
</div>
<?php endif ?>



<div class="card shadow bg-white">
    <div class="card-body">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-grup-row">
                        <label class="col-sm-3 col-form-label">Mulai :</label>
                            <div class="col-sm9">
                                <input type="date" name="tglm" class="form-control" value="<?php echo $tgl_mulai; ?>">
                            </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-grup-row">
                        <label class="col-sm-3 col-form-label">Selesai :</label>
                            <div class="col-sm9">
                                <input type="date" name="tgls" class="form-control" value="<?php echo $tgl_selesai; ?>>
                            </div>
                    </div>
                </div>
                <div class="col-md-">
                    <button name="cari" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow  bg-white mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($semuadata)):?>
                    <?php $total = 0; ?>
                    <?php foreach ($semuadata as $key => $value): ?>
                    <?php $total+=$value['total_pembelian']?>
                    <tr>
                        <td width="50"><?php echo $key+1; ?></td>
                        <td><?php echo $value['nama_pelanggan']?></td>
                        <td><?php echo $value['tanggal_pembelian']?></td>
                        <td>Rp. <?php echo number_format($value['total_pembelian'])?></td>
                    </tr>
                    <?php endforeach?>
                    <?php else: ?>
                        <tr class="text-center">
                            <td colspan="4" class="alert alert-danger">
                                Tidak ada Laporan Pembelian
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>
                <tfoot>
                    <?php if(!empty($semuadata)):?>
                    <tr>
                        <th colspan="3">Total</th>
                        <th>Rp.<?php echo number_format($total)?></th>
                    </tr>
                    <?php endif ?>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?php if(!empty($semuadata)):?>
<div class="alert alert-primary shadow mt-3">
    <a href="#" class="btn btn-success">Download Laporan</a>
</div>
<?php endif?>