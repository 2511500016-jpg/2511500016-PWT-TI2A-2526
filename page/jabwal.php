<?php
if (isset($_GET['hapus'])) {
    $kd_jadwal = $_GET['hapus'];

    // Hapus detail jadwal dulu
    mysqli_query($koneksi, "DELETE FROM detail_jadwal WHERE id_jadwal = '$kd_jadwal'");

    // Lalu hapus jadwal
    $hapus = mysqli_query($koneksi, "DELETE FROM tabel_jadwal WHERE id_jadwal = '$kd_jadwal'");

    if ($hapus) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> Data jadwal telah dihapus.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> Tidak dapat menghapus data.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
}
?>

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
                <a href="index.php?page=tambah_jabwal" class="btn btn-primary btn-sm">
                    Tambah Jadwal
                </a>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Kode Jadwal</th>
                            <th>Guru</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Detail Jadwal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT  dj.id_Jadwal,tg.nm_guru,jk.semester,jk.thn_ajaran,
CONCAT(tm.nm_mapel , ' - ' , dj.hari , ' - ' , dj.jam_mulai , ' - ' , dj.jam_selesai , ' - ' , tk.nm_kelas) as detail
FROM detail_jadwal dj 
JOIN tabel_guru tg ON dj.kd_guru = tg.kd_guru
JOIN tabel_mapel tm ON dj.kd_mapel = tm.kd_mapel
JOIN jabwal_kelas jk  ON dj.id_jadwal = jk.id_jadwal
join tabel_kelas tk on jk.id_kelas = tk.kd_kelas");

                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr>
                            <td>{$row['id_Jadwal']}</td>
                            <td>{$row['nm_guru']}</td>
                            <td>{$row['semester']}</td>
                            <td>{$row['thn_ajaran']}</td>
                        
                            <td>
                            <ul>";

                            $det = mysqli_query($koneksi, "SELECT tk.nm_kelas,d.*, tm.nm_mapel 
                                FROM detail_jadwal d
                                JOIN tabel_mapel tm ON d.kd_mapel = tm.kd_mapel
                                JOIN jabwal_kelas jk  ON d.id_jadwal = jk.id_jadwal
                                join tabel_kelas tk ON jk.id_kelas = tk.kd_kelas
                                WHERE d.id_Jadwal = '{$row['id_Jadwal']}'");

                            while ($d = mysqli_fetch_assoc($det)) {
                                echo "<li>{$d['nm_mapel']} - {$d['hari']} - {$d['jam_mulai']} - {$d['jam_selesai']} - {$d['nm_kelas']}</li>";
                            }

                            echo "</ul>
                            </td>
                            <td>
                            <a href='index.php?page=jabwal&hapus={$row['id_Jadwal']}'
                            onclick=\"return confirm('Yakin ingin menghapus data ini?')\"
                            class='btn btn-danger btn-sm'>Hapus</a>
                            </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>