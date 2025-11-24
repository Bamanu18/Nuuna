<?php

    $id_pelanggan = $_GET['id'];

    $koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");

    echo "<script>alert('Data berhasil dihapus');</script>";
    echo "<script>location='index.php?halaman=Pelanggan';</script>";
?>