<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Ekstrakurikuler</h1>
            </div>
        </div>
    </div>
</div>

<?php
// Kode otomatis untuk id_ekstra
$carikode = mysqli_query($koneksi, "SELECT MAX(id_ekstra016) FROM ekstra_2511500016") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);

if ($datakode[0]) {
    $nilaikode = substr($datakode[0], 2); // ambil angka setelah K-
    $kode = (int)$nilaikode + 1;
    $hasilkode = "K-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "K-001";
}

$_SESSION["Id_EKSTRA"] = $hasilkode;

// Proses simpan data
if (isset($_POST['tambah'])) {

    $id_ekstra016 = mysqli_real_escape_string($koneksi, $_POST['id_ekstra016']);
    $nama_ekstra016 = mysqli_real_escape_string($koneksi, $_POST['nama_ekstra016']);
    $ket016 = mysqli_real_escape_string($koneksi, $_POST['ket016']);
    $semester016 = mysqli_real_escape_string($koneksi, $_POST['semester016']);
    $thn_ajaran016 = mysqli_real_escape_string($koneksi, $_POST['thn_ajaran016']);

    // cek kode sudah ada atau belum
    $cek = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500016 
                                   WHERE id_ekstra016='$id_ekstra016'");

    if (mysqli_num_rows($cek) > 0) {
        echo '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Peringatan!</h5>
                Kode Ekstra sudah ada!
              </div>';
    } else {

        $insert = mysqli_query($koneksi, "INSERT INTO ekstra_2511500016
            (id_ekstra016, nama_ekstra016, ket016, semester016, thn_ajaran016)
            VALUES
            ('$id_ekstra016','$nama_ekstra016','$ket016','$semester016','$thn_ajaran016')");

        if ($insert) {
            echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Sukses!</h5>
                    Data berhasil disimpan
                  </div>';

            echo '<script>
                    setTimeout(function(){
                        window.location="index.php?page=ekstra2511500016";
                    },1000);
                  </script>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Gagal!</h5>
                    Data gagal disimpan : ' . mysqli_error($koneksi) . '
                  </div>';
        }
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambahkan Data Ekstrakurikuler</h3>
            </div>

            <div class="card-body p-2">
                <form method="POST" action="">
                    <div class="form-group">
                        <label>ID Ekstra</label>
                        <input type="text" name="id_ekstra016" value="<?= $hasilkode; ?>" class="form-control" readonly>
                        <small class="text-muted">Kode otomatis (K-001, K-002, dst)</small>
                    </div>

                    <div class="form-group">
                        <label>Nama Ekstra</label>
                        <input type="text" name="nama_ekstra016" class="form-control" required autofocus>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <select name="ket016" class="form-control" required>
                            <option value="">-- Pilih Keterangan --</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester016" class="form-control" required>
                            <option value="">-- Pilih Semester --</option>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text" name="thn_ajaran016" placeholder="2022/2023" class="form-control" required>
                    </div>

                    <div class="card-footer">
                        <input type="submit" name="tambah" value="Simpan" class="btn btn-primary">
                        <a href="index.php?page=ekstra2511500016" class="btn btn-default">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>