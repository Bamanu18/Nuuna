<?php

$id_produk = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$pecah = $ambil->fetch_assoc();

$hapus_foto = $pecah['foto_produk'];

if(file_exists("../assets/foto_produk/".$hapus_foto));{
    unlink("../assets/foto_produk/".$hapus_foto);
}

$hapusfotoproduk = array();
$koneksi->query("DELETE FROM produk WHERE id_produk='$id_produk'");
while($hapus = $ambil->fetch_assoc()){
    $hapusfotoproduk[] = $hapus;
}

foreach ($hapusfotoproduk as $key => $value){
    $hapusfoto = $value['nama_produk_foto'];
    if(file_exists("../assets/foto_produk/".$hapusfoto)){
        unlink("../assets/foto_produk".$hapusfoto);
    }

    $koneksi->query("DELETE FROM produk_foto WHERE id_produk='id_produk'");
}

echo "<script>alert('Data Berhasil Dihapus');</script>";
echo "<script>location='index.php?halaman=Produk';</script>";

?>