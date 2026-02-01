<?php

$id_kategori = $_GET['id'];

$ambil=$koneksi->query("DELETE FROM kategori WHERE id_kategori='$id_kategori'");

echo "<script>alert('Data berhasil dihapus');</script>";
echo "<script>location='index.php?halaman=Kategori';</script>";
?>