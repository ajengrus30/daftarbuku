<?php
include 'koneksi.php';
$id_buku = $_GET["id_buku"];

    $query = "DELETE FROM buku WHERE id_buku='$id_buku' ";
    $hasil_query = mysqli_query($koneksi, $query);

    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($koneksi).
       " - ".mysqli_error($koneksi));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='index.php';</script>";
    }