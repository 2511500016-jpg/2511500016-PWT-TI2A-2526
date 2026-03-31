<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Mata Pelajaran</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_GET['kd'])){
    $kd = mysqli_real_escape_string($koneksi, $_GET['kd']);

    $query = mysqli_query($koneksi,"SELECT * FROM tabel_mapel WHERE kd_mapel='$kd'");
    $data = mysqli_fetch_array($query);
} else {
    echo "<script>alert('Kode tidak ditemukan');window.location='index.php?page=mapel';</script>";
    exit;
}

if(isset($_POST['tambah'])){
    $nm_mapel = mysqli_real_escape_string($koneksi, $_POST['nm_mapel']);
    $kkm      = mysqli_real_escape_string($koneksi, $_POST['kkm']);

    $update = mysqli_query($koneksi,
        "UPDATE tabel_mapel 
         SET nm_mapel='$nm_mapel', kkm='$kkm' 
         WHERE kd_mapel='$kd'"
    );

    if($update){
        echo '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <h5><i class="icon fas fa-info"></i> Info</h5>
        <h4>Berhasil Disimpan</h4></div>
        <meta http-equiv="refresh" content="1;url=index.php?page=mapel">';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <h5><i class="icon fas fa-info"></i> Info</h5>
        <h4>Gagal Disimpan</h4></div>';
    }
}
?>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body p-2">

        <form method="POST">

          <div class="form-group">
            <label>Kode Mapel</label>
            <input type="text" name="kd_mapel" 
                   value="<?= $data['kd_mapel']; ?>" 
                   class="form-control" readonly>
          </div>

          <div class="form-group">
            <label>Nama Mapel</label>
            <input type="text" name="nm_mapel" 
                   value="<?= $data['nm_mapel']; ?>" 
                   class="form-control" required>
          </div>

          <div class="form-group">
            <label>KKM</label>
            <input type="number" name="kkm" 
                   value="<?= $data['kkm']; ?>" 
                   class="form-control" required>
          </div>

          <div class="card-footer">
            <input type="submit" class="btn btn-primary" 
                   name="tambah" value="Simpan">
          </div>

        </form>

      </div>
    </div>
  </div>
</section>