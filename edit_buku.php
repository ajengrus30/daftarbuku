<?php
  include('koneksi.php'); 

  if(isset($_GET['id_buku'])) {
      $id_buku       = $_GET["id_buku"];
      $query    = "SELECT * FROM buku where id_buku = '$id_buku'";
      $result   = mysqli_query($koneksi, $query);

      if(!$result) {
          die("Query Error:".mysqli_errno($koneksi). " - ".mysqli_error($koneksi));
      }
      $data = mysqli_fetch_assoc($result);

      if(!count($data)){
        echo "<script>alert('Data yang anda cari tidak ditemukan');window.location='index.php';</script>";    
      }

  } else {
      echo "<script>alert('Masukkan data yang ingin diedit');window.location='index.php';</script>";
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  </head>
  <body>
    <div class="container" style="margin-top: 3%;">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1>Edit Buku</h1>
        </div>
      </div>
      <div class="container-fluid" style="margin-top: 2%;padding-bottom: 3%">
        <div class="card">
          <div class="card-body">
            <form method="POST" action="proses_edit.php" enctype="multipart/form-data" >
              <section class="base">
                <input name="id_buku" value="<?php echo $data['id_buku']; ?>" hidden />
                <div class="mb-3">
                  <label class="form-label">Judul</label>
                  <input class="form-control" type="text" name="judul" autofocus="" required="" value="<?php echo $data['judul'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Pengarang</label>
                  <input class="form-control" type="text" name="pengarang" required="" value="<?php echo $data['pengarang'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Penerbit</label>
                  <input class="form-control" type="text" name="penerbit" required="" required="" value="<?php echo $data['penerbit'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Gambar</label>
                  <img src="gambar/<?php echo $data['gambar']; ?>" style="width: 120px;margin-left: 1%;margin-bottom: 5px;">
                  <input class="form-control" type="file" name="gambar" <?php echo (strlen($data["gambar"]) > 0 ? "" : "required") ?>/>
                </div>
                <div>
                  <button class="btn btn-primary" type="submit">Simpan</button>
                  <button class="btn btn-danger" type="button" ... onclick="history.back();">Batal</button>
                </div>
              </section>
            </form>
          </div>
        </div>    
      </div>
    </div>
  </body>
</html>