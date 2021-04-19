<?php
  include('koneksi.php'); 
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Form Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style type="text/css">
    * {
        font-family: "Trebuchet MS";
    }
    table thead th {
        background-color: #DDEFEF;
        border: solid 1px #DDEEEE;
        color: #336B6B;
        padding: 10px;
        text-align: left;
        text-shadow: 1px 1px 1px #fff;
        text-decoration: none;
    }
    a {
        background-color: red;
        color: #fff;
        padding: 10px;
        text-decoration: none;
        font-size: 12px;
    }
    </style>
    </head>
    <body>
        <div class="container" style="margin-top: 3%;">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Daftar Buku</h1>
                </div>
            </div>
        <div class="container-fluid" style="margin-top: 3%;">
            <div class="card">
            <div class="card-header" style="padding: 15px;">
                <div class="d-flex justify-content-between align-center">
                    <div class="judul">
                        <a href="tambah_buku.php">+ &nbsp; Tambah Buku</a>
                    </div>
                    <div class="cari">
                        <form action="index.php" method="get">
	                    <input type="text" name="cari">
	                    <input type="submit" value="Cari">
                        </form>
                    </div>
                </div>
            <div class="card-body" style="margin-top: 1%;">
            <div class="table-responsive">
            <table class="table table-bordered text-center" cellspacing="0">
                <thead>
                    <tr class="tabel" style="color: white;">
                        <th class="text-center">No</th>
                        <th class="text-center">Judul</th>
                        <th class="text-center">Pengarang</th>
                        <th class="text-center">Penerbit</th>
                        <th class="text-center">Gambar</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT * FROM buku ORDER BY id_buku ASC";
                        $result = mysqli_query($koneksi, $query);
                        if(!$result){
                        die ("Query Error: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
                        }
                    ?>
                    <?php
                        if(isset($_GET['cari'])) {
                            $cari = $_GET['cari'];
                            $result = mysqli_query($koneksi, "SELECT * FROM buku WHERE judul LIKE '%".$cari."%'");				
                        } else {
                            $result = mysqli_query($koneksi, $query);
                        }
                        $no = 1;
                        while($row = mysqli_fetch_assoc($result))
                        {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row['judul']; ?></td>
                        <td><?php echo $row['pengarang']; ?></td>
                        <td><?php echo $row['penerbit']; ?></td>
                        <td style="text-align: center;"><img src="gambar/<?php echo $row['gambar']; ?>" style="width: 120px;"></td>
                        <td>
                            <a type="button" class="btn btn-warning" style="color: white;" href="edit_buku.php?id_buku=<?php echo $row['id_buku']; ?>"><i class="fa fa-cog"></i> Edit</a>
                            <a type="button" class="btn btn-danger" style="margin-left: 4px" href="proses_hapus.php?id_buku=<?php echo $row['id_buku']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')"><i class="fa fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
                    <?php
                        $no++; 
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>