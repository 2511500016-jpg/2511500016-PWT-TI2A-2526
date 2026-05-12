<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Jadwal</h1>
      </div>
    </div>
  </div>
</div>

<div class="content">
<div class="container-fluid">
  <div class="card">
    <div class="card-body">

      <table class="table table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th>Kd Jadwal</th>
            <th>Kd Mapel</th>
            <th>Kd Guru</th>
            <th>Hari</th>
            <th>Jam</th>
          </tr>
        </thead>

        <tbody>
        <?php
        $no = 0; $query = mysqli_query($koneksi, "SELECT * FROM jabwal_kelas  jk JOIN detail_jadwal dj ON jk.id_jadwal = dj.id_jadwal JOIN tabel_mapel tm ON tm.kd_mapel = dj.kd_mapel JOIN tabel_guru tg ON tg.kd_guru = dj.kd_guru;");
        while ($result = mysqli_fetch_array($query)) {
          $no++;
        ?>
          <tr>
            <td><?= $no; ?></td>
            <td><?= $result['id_jadwal']; ?></td>
            <td><?= $result['kd_mapel']; ?></td>
            <td><?= $result['kd_guru']; ?></td>
            <td><?= $result['hari']; ?></td>
            <td>
              <?= $result['jam_mulai']; ?> - <?= $result['jam_selesai']; ?>
            </td>
          </tr>
        <?php } ?>
        </tbody>

      </table>
    </div>
  </div>
</div>
</div>