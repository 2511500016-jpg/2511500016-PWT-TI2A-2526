<?php
?>

<style>
    

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table,th,td{
    border:1px solid black;
}

th,td{
    padding:8px;

}

.btn{
    padding:8px 15px;
    background:green;
    color:white;
    border:none;
    cursor:pointer;
    margin-bottom:10px;
}

@media print{
    .btn{
        display:none;
    }
}

</style>

<h2 align="center">DATA JADWAL KELAS</h2>

<button class="btn" onclick="window.print()">
Cetak Jadwal
</button>

<table>

<thead>
<tr>
    <th>No</th>
    <th>ID Jadwal</th>
    <th>KD Guru</th>
    <th>Guru</th>
    <th>Semester</th>
    <th>Tahun Ajaran</th>
    <th>Detail Jadwal</th>
</tr>
</thead>

<tbody>

<?php

$no=1;

$query=mysqli_query($koneksi,"
SELECT
dj.id_jadwal,
tg.kd_guru,
tg.nm_guru,
jk.semester,
jk.thn_ajaran,
CONCAT(
tm.nm_mapel,' - ',
dj.hari,' - ',
dj.jam_mulai,' - ',
dj.jam_selesai,' - ',
tk.nm_kelas
) AS detail

FROM detail_jadwal dj
JOIN tabel_guru tg ON dj.kd_guru=tg.kd_guru
JOIN tabel_mapel tm ON dj.kd_mapel=tm.kd_mapel
JOIN jabwal_kelas jk ON dj.id_jadwal=jk.id_jadwal
JOIN tabel_kelas tk ON jk.id_kelas=tk.kd_kelas
");

if(!$query){
    die(mysqli_error($koneksi));
}

while($row=mysqli_fetch_assoc($query)){
?>

<tr>

<td><?= $no++ ?></td>
<td><?= $row['id_jadwal'] ?></td>
<td><?= $row['kd_guru'] ?></td>
<td><?= $row['nm_guru'] ?></td>
<td><?= $row['semester'] ?></td>
<td><?= $row['thn_ajaran'] ?></td>
<td><?= $row['detail'] ?></td>
</tr>

<?php } ?>

</tbody>
</table>