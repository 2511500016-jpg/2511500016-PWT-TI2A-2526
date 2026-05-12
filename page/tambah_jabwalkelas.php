<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<?php
// Auto increment manual untuk id_jadwal integer
$carikode = mysqli_query(
    $koneksi,
    "SELECT MAX(id_jadwal) as maxkode FROM jabwal_kelas"
) or die(mysqli_error($koneksi));

$datakode = mysqli_fetch_array($carikode);

if ($datakode['maxkode']) {
    $hasilkode = $datakode['maxkode'] + 1;
} else {
    $hasilkode = 1;
}

if (isset($_POST['tambah'])) {

    $id_jadwal  = mysqli_real_escape_string($koneksi, $_POST['id_jadwal']);
    $id_kelas   = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
    $thn_ajaran = mysqli_real_escape_string($koneksi, $_POST['thn_ajaran']);
    $semester   = mysqli_real_escape_string($koneksi, $_POST['semester']);

    // cek id sudah ada
    $cek = mysqli_query(
        $koneksi,
        "SELECT * FROM jabwal_kelas WHERE id_jadwal='$id_jadwal'"
    );

    if (mysqli_num_rows($cek) > 0) {
        echo '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                ID Jadwal sudah ada!
              </div>';
    } else {

        $insert = mysqli_query(
            $koneksi,
            "INSERT INTO jabwal_kelas 
            (id_jadwal, id_kelas, Thn_ajaran, Semester)
            VALUES 
            ('$id_jadwal','$id_kelas','$thn_ajaran','$semester')"
        );

        if ($insert) {
            echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Data berhasil disimpan
                  </div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal">';
        } else {
            echo '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Gagal menyimpan: '.mysqli_error($koneksi).'
                  </div>';
        }
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Jadwal</h3>
            </div>

            <div class="card-body p-2">
                <form method="POST">

                    <div class="form-group">
                        <label>ID Jadwal</label>
                        <input type="text"
                               name="id_jadwal"
                               value="<?= $hasilkode; ?>"
                               class="form-control"
                               readonly>
                    </div>

                    <div class="form-group">
                        <label>ID Kelas</label>
                        <input type="text"
                               name="id_kelas"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text"
                               name="thn_ajaran"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <input type="text"
                               name="semester"
                               class="form-control"
                               required>
                    </div>

                    <div class="card-footer">
                        <input type="submit"
                               name="tambah"
                               value="Simpan"
                               class="btn btn-primary">
                        <a href="index.php?page=jadwal"
                           class="btn btn-secondary">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>