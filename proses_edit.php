<?php
include 'koneksi.php';

  $id_buku    = $_POST['id_buku'];
  $judul      = $_POST['judul'];
  $pengarang  = $_POST['pengarang'];
  $penerbit   = $_POST['penerbit'];
  $gambar     = $_FILES['gambar']['name'];
  
  if($gambar!= "") {
    $ekstensi_diperbolehkan = array('png','jpg'); 
    $x = explode('.', $gambar); 
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar']['tmp_name'];   
    $angka_acak = rand(1,999);
    $gambar_edit = $angka_acak.'-'.$gambar; 

    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
      move_uploaded_file($file_tmp, 'gambar/'.$gambar_edit);   
        $query  = "UPDATE buku SET judul = '$judul', pengarang = '$pengarang', penerbit = '$penerbit', gambar = '$gambar_edit'";
        $query .= "WHERE id_buku = '$id_buku'";
        $result = mysqli_query($koneksi, $query);
        
        if(!$result){
          die ("Query gagal dijalankan: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
        } else {
          echo "<script>alert('Data buku berhasil diubah.');window.location='index.php';</script>";
        }

      } else {     
        echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_buku.php';</script>";
      }

    } else {
      $query  = "UPDATE buku SET judul = '$judul', pengarang = '$pengarang', penerbit = '$penerbit'";
      if(strlen($gambar) > 0){
          $query .= ", gambar = '$gambar'";
      }
      $query .= "WHERE id_buku = '$id_buku'";
      $result = mysqli_query($koneksi, $query);
      
      if(!$result){
        die ("Query gagal dijalankan: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
      } else {
          echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
      }
    }