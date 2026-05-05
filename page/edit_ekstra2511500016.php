<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Ekstrakurikuler</h1>
            </div>
        </div>
    </div>
</div>

<?php
$kd = $_GET['kd'];

// PERBAIKAN: SELECT harus pakai *
$query = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500016 WHERE id_ekstra016='$kd'");
$edit  = mysqli_fetch_array($query);

// Proses update
if (isset($_POST['tambah'])) {
    $id_ekstra016 = $_POST['id_ekstra016'];
    $nama_ekstra016 = $_POST['nama_ekstra016'];
    $ket016 = $_POST['ket016'];
    $semester016 = $_POST['semester016'];
    $thn_ajaran016 = $_POST['thn_ajaran016'];

    // PERBAIKAN: tanda kutip kkm diperbaiki
    $update = mysqli_query($koneksi, "UPDATE ekstra_2511500016 
        SET nama_ekstra016='$nama_ekstra016', ket016='$ket016', semester016='$semester016', thn_ajaran016='$thn_ajaran016' 
        WHERE id_ekstra016='$id_ekstra016'
    ");

    if ($update) {
        echo '
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Berhasil Disimpan</h4>
        </div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra2511500016">';
    } else {
        echo '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Gagal Disimpan</h4>
        </div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-2">

                <form method="POST" action="">

                    <div class="form-group">
                        <label for="id_ekstra016">Kode Ekstrakurikuler</label>
                        <input 
                            type="text" 
                            name="id_ekstra016" 
                            value="<?= $edit['id_ekstra016']; ?>" 
                            class="form-control" 
                            readonly>
                    </div>

                    <div class="form-group">
                        <label for="nama_ekstra016">Nama Ekstrakurikuler</label>
                        <input 
                            type="text" 
                            name="nama_ekstra016" 
                            value="<?= $edit['nama_ekstra016']; ?>" 
                            id="nn_siswa" 
                            placeholder="Nama siswa" 
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="ket016">Keterangan</label>
                        <select class="form-control" name="ket016" id="ket016">
                            <option disabled selected>-- Pilih Keterangan -- </option>
                            <option value="Aktif" <?= ($edit['ket016'] == 'Aktif') ? 'selected' : '' ?>>Aktif</option>
                            <option value="Tidak Aktif" <?= ($edit['ket016'] == 'Tidak Aktif') ? 'selected' : '' ?>>Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="semester016">Semester</label>
                        <select class="form-control" name="semester016" id="semester016">
                            <option disabled selected>-- Pilih Semester -- </option>
                            <option value="ganjil" <?= ($edit['semester016'] == 'ganjil') ? 'selected' : '' ?>>ganjil</option>
                            <option value="genap" <?= ($edit['semester016'] == 'genap') ? 'selected' : '' ?>>genap</option>
                        
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="thn_ajaran016">Tahun Ajaran</label>
                        <input 
                            type="text" 
                            name="thn_ajaran016" 
                            value="<?= $edit['thn_ajaran016']; ?>"
                            id="thn_ajaran016"
                            placeholder="2022/2023" 
                            class="form-control">
                    </div>
                            
                    <div class="card-footer">
                        <input 
                            type="submit" 
                            class="btn btn-primary" 
                            name="tambah" 
                            value="Simpan">
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>