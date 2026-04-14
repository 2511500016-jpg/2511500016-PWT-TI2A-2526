<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Kelas</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_GET['kd'])){
    $kd = mysqli_real_escape_string($koneksi, $_GET['kd']);

    $query = mysqli_query($koneksi,"SELECT * FROM tabel_guru WHERE kd_guru='$kd'");
    $data = mysqli_fetch_array($query);
} else {
    echo "<script>alert('Kode tidak ditemukan');window.location='index.php?page=guru';</script>";
    exit;
}

if(isset($_POST['tambah'])){
    $nm_guru = mysqli_real_escape_string($koneksi, $_POST['nm_guru']);
    $jenkel = mysqli_real_escape_string($koneksi, $_POST['jenkel']);
    $pend_terakhir = mysqli_real_escape_string($koneksi, $_POST['pend_terakhir']);
    $hp = mysqli_real_escape_string($koneksi, $_POST['hp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $update = mysqli_query($koneksi,
        "UPDATE tabel_guru 
         SET nm_guru='$nm_guru', jenkel='$jenkel', pend_terakhir='$pend_terakhir', hp='$hp', alamat='$alamat' 
         WHERE kd_guru='$kd'"
    );

    if($update){
        echo '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <h5><i class="icon fas fa-info"></i> Info</h5>
        <h4>Berhasil Disimpan</h4></div>
        <meta http-equiv="refresh" content="1;url=index.php?page=guru">';
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
            <label>Kode Guru</label>
            <input type="text" name="kd_guru" 
                   value="<?= $data['kd_guru']; ?>" 
                   class="form-control" readonly>
          </div>

          <div class="form-group">
            <label>Nama Guru</label>
            <input type="text" name="nm_guru" 
                   value="<?= $data['nm_guru']; ?>" 
                   class="form-control" required>
          </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenkel" class="form-control" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" <?= $data['jenkel'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                <option value="Perempuan" <?= $data['jenkel'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            </div>
                    <div class="form-group">
                        <label for="pend_terakhir">Pendidikan Terakhir</label>
                        <select name="pend_terakhir" id="pend_terakhir" class="form-control" required>
                            <option value="">-- Pilih Pendidikan Terakhir --</option>
                            <option value="SMA/Sederajat">SMA/Sederajat</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
            </div>
            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="hp" 
                       value="<?= $data['hp']; ?>" 
                       class="form-control" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" 
                          placeholder="Alamat" required><?= $data['alamat']; ?></textarea>
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