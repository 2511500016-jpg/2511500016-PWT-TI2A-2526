<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Ekstrakurikuler</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_GET['action'])) {
  if($_GET['action'] == "hapus") {
    $kd = $_GET['kd'];
    $query = mysqli_query($koneksi, "DELETE FROM ekstra_2511500016 WHERE id_ekstra016 = '$kd'") or die(mysqli_error($koneksi));
    
    if($query){
      echo '
      <div class="alert alert-warning alert-dismissible">
        Berhasil Di Hapus
      </div>';
      echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra2511500016">';
    }
  }
}
?>
<div class="content">
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <a href="index.php?page=tambah_ekstra2511500016" class="btn btn-primary btn-sm">
        Tambah Ekstrakurikuler
      </a>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th>Id Ekstrakurikuler</th>
            <th>Nama Ekstrakurikuler</th>
            <th>Ket</th>
            <th>Semester</th>
            <th>Tahun Ajaran</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <?php
        $no = 0;
        $query = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500016");
        while ($result = mysqli_fetch_array($query)) {
          $no++;
        ?>
        <tbody>
          <tr>
            <td><?= $no; ?></td>
            <td><?= $result['id_ekstra016']; ?></td>
            <td><?= $result['nama_ekstra016']; ?></td>
            <td><?= $result['ket016']; ?></td>
            <td><?= $result['semester016']; ?></td>
            <td><?= $result['thn_ajaran016']; ?></td>
            <td>
              <a href="index.php?page=ekstra2511500016&action=hapus&kd=<?= $result['id_ekstra016'] ?>" title="">
                <span class="badge badge-danger">Hapus</span>
              </a>

              <a href="index.php?page=edit_ekstra2511500016&action=edit&kd=<?= $result['id_ekstra016'] ?>" title="">
                <span class="badge badge-warning">Edit</span>
              </a>
            </td>
          </tr>
        </tbody>
        <?php } ?>
      </table>
    </div>
  </div>
</div>