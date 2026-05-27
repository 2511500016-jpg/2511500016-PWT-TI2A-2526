<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0">Jadwal Guru</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
<div class="container-fluid">

<div class="card">
<div class="card-body">

<table class="table table-striped table-bordered">

<thead>
<tr>
    <th>No</th>
    <th>ID Jadwal</th>
    <th>ID Kelas</th>
    <th>Tahun Ajaran</th>
    <th>Semester</th>
    <th>Hari</th>
    <th>Jam Mulai</th>
    <th>Jam Selesai</th>
</tr>
</thead>

<tbody>

<?php

$no = 1;



if(isset($_SESSION['kd_guru'])){
    $kd_guru = $_SESSION['kd_guru'];

    $query=mysqli_query($koneksi,"
SELECT
dj.id_jadwal,
tg.nm_guru,
jk.semester,
jk.thn_ajaran,
CONCAT(
tm.nm_mapel,' - ',
dj.hari,' - ',
dj.jam_mulai,' - ',
dj.jam_selesai,' - ',


    FROM jabwal_kelas jk

    JOIN detail_jadwal dj
    ON jk.id_adwal = dj.id_jadwal

    WHERE dj.kd_guru='$kd_guru'
    ");

    if(!$query){
        die(mysqli_error($koneksi));
    }

    while($result=mysqli_fetch_assoc($query)){
?>

<tr>

<td><?= $no++ ?></td>

<td><?= $result['id_jadwal'] ?></td>

<td><?= $result['id_kelas'] ?></td>

<td><?= $result['thn_ajaran'] ?></td>

<td><?= $result['semester'] ?></td>

<td><?= $result['hari'] ?></td>

<td><?= $result['jam_mulai'] ?></td>

<td><?= $result['jam_selesai'] ?></td>

</tr>

<?php 
    }
}
?>

</tbody>

</table>

</div>
</div>

</div>
</div>