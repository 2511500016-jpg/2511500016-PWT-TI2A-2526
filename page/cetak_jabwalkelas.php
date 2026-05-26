<?php
?>

<style>

body{
    font-family:Arial;
}

h2{
    text-align:center;
}

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
    text-align:center;
}

.btn{
    padding:8px 15px;
    background:green;
    color:white;
    border:none;
    cursor:pointer;
    margin-bottom:10px;
}

</style>

<h2>JADWAL KELAS</h2>

<button class="btn" onclick="window.print()">
Cetak Jadwal
</button>

<table>

<tr>
    <th>No</th>
    <th>ID Jadwal</th>
    <th>ID Kelas</th>
    <th>Tahun Ajaran</th>
    <th>Semester</th>
</tr>

<?php

$no=1;

$query=mysqli_query(
$koneksi,
"SELECT * FROM jabwal_kelas"
);

while($result=mysqli_fetch_array($query)){
?>

<tr>

<td><?= $no++ ?></td>
<td><?= $result['id_jadwal'] ?></td>
<td><?= $result['id_kelas'] ?></td>
<td><?= $result['thn_ajaran'] ?></td>
<td><?= $result['semester'] ?></td>

</tr>

<?php } ?>

</table>