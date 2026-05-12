<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Jadwal Kelas</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_GET['kd'])){
    $kd = mysqli_real_escape_string($koneksi, $_GET['kd']);

    $query = mysqli_query($koneksi,"SELECT * FROM jabwal_kelas WHERE id_jadwal='$kd'");
    $data = mysqli_fetch_array($query);
} else {
    echo "<script>alert('Kode tidak ditemukan');window.location='index.php?page=jadwal';</script>";
    exit;
}

if(isset($_POST['tambah'])){
    $id_jadwal = mysqli_real_escape_string($koneksi, $_POST['id_jadwal']);
    $id_kelas = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
    $thn_ajaran = mysqli_real_escape_string($koneksi, $_POST['thn_ajaran']);
    $semester = mysqli_real_escape_string($koneksi, $_POST['semester']);

    $update = mysqli_query($koneksi,
        "UPDATE jabwal_kelas 
         SET id_kelas='$id_kelas', thn_ajaran='$thn_ajaran', semester='$semester' 
         WHERE id_jadwal='$id_jadwal'"
    );

    if($update){
        echo '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <h5><i class="icon fas fa-info"></i> Info</h5>
        <h4>Berhasil Disimpan</h4></div>
        <meta http-equiv="refresh" content="1;url=index.php?page=jabwal_kelas">';
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
            <label>Id Jadwal</label>
            <input type="text" name="id_jadwal" 
                   value="<?= $data['id_jadwal']; ?>" 
                   class="form-control" readonly>
          </div>

          <div class="form-group">
            <label>Id Kelas</label>
            <input type="text" name="id_kelas" 
                   value="<?= $data['id_kelas']; ?>" 
                   class="form-control" required>
          </div>
          <div class="form-group">
            <label>Tahun Ajaran</label>
            <input type="text" name="thn_ajaran" 
                   value="<?= $data['thn_ajaran']; ?>" 
                   class="form-control" required>
          </div>
          <div class="form-group">
            <label>Semester</label>
            <input type="text" name="semester" 
                   value="<?= $data['semester']; ?>" 
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