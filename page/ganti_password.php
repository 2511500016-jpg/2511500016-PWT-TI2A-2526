<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Ganti Password</h1>
      </div>
    </div>
  </div>
</div>

<?php
// Session & koneksi
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pesan = "";

// Cek login
if (empty($_SESSION['username'])) {
    echo '<div class="alert alert-danger">Anda belum login</div>';
    exit;
}

// Proses form
if (isset($_POST['submit'])) {

    $username       = $_SESSION['username'];
    $password_lama  = $_POST['password_lama'] ?? '';
    $password_baru  = $_POST['password_baru'] ?? '';
    $konfirmasi     = $_POST['konfirmasi'] ?? '';

    // Validasi input
    if (!$password_lama || !$password_baru || !$konfirmasi) {
        $pesan = '<div class="alert alert-warning">Semua field wajib diisi</div>';
    } else {

        // Ambil password dari database
        $query = mysqli_query($koneksi, "SELECT password FROM tabel_user WHERE username='$username'");

        if ($query && mysqli_num_rows($query) > 0) {

            $data = mysqli_fetch_assoc($query);

            // Verifikasi password lama
            if ($password_lama === $data['password']) {

                // Cek konfirmasi
                if ($password_baru === $konfirmasi) {

                    $hash = password_hash($password_baru, PASSWORD_DEFAULT);
                    $update = mysqli_query($koneksi, "UPDATE tabel_user SET password='$password_baru' WHERE username='$username'");

                    if ($update) {
                        $pesan = '<div class="alert alert-success">Password berhasil diganti</div>';
                    } else {
                        $pesan = '<div class="alert alert-danger">Gagal update password</div>';
                    }

                } else {
                    $pesan = '<div class="alert alert-warning">Konfirmasi password tidak cocok</div>';
                }

            } else {
               $pesan = '<div class="alert alert-danger">Password lama salah</div>';
            }

        } else {
            $pesan = '<div class="alert alert-danger">User tidak ditemukan</div>';
        }
    }
}
?>

<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">

        <?= $pesan; ?>

        <form method="POST">

          <div class="form-group">
            <label>Password Lama</label>
            <input type="password" name="password_lama" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Password Baru</label>
            <input type="password" name="password_baru" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="konfirmasi" class="form-control" required>
          </div>

          <button type="submit" name="submit" class="btn btn-primary btn-sm">
            Simpan
          </button>

        </form>

      </div>
    </div>
  </div>
</div>