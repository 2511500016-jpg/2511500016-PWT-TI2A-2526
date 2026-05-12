<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Jabwal</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_GET['action'])) {
  if($_GET['action'] == "hapus") {
    $kd = $_GET['kd'];
    $query = mysqli_query($koneksi, "DELETE FROM tabel_jabwal WHERE kd_jabwal = '$kd'");
   
    if($query){
      echo '
      <div class="alert alert-warning alert-dismissible">
        Berhasil Di Hapus
      </div>';
      echo '<meta http-equiv="refresh" content="1;url=index.php?page=jabwal">';
    }
  }
}
?>

<div class="content">
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <a href="index.php?page=tambah_jabwal" class="btn btn-primary btn-sm">
        Tambah Jabwal
      </a>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th>Kelas</th>
            <th>Tahun Ajaran</th>
            <th>Semester</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
        <?php
        $no = 0;
        $query = mysqli_query($koneksi, "SELECT * FROM jabwal_kelas");
        while ($result = mysqli_fetch_array($query)) {
          $no++;
        ?>
          <tr>
            <td><?= $no; ?></td>
            <td><?= $result['id_kelas']; ?></td>
            <td><?= $result['thn_ajaran']; ?></td>
            <td><?= $result['semester']; ?></td>
            <td>
              <a href="index.php?page=jabwal&action=hapus&kd=<?= $result['kd_Jadwal'] ?>">
                <span class="badge badge-danger">Hapus</span>
              </a>

                              
              <a href="index.php?page=detail_jabwal&kd=<?= $result['id_jadwal'] ?>">
    <span class="badge badge-info">Detail</span>
</a>
            </td>
          </tr>
        <?php } ?>
        </tbody>

      </table>
    </div>
  </div>
</div>