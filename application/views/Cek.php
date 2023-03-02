<html>
<head>
<title>Koneksi Multi Database</title>
</head>
<body>

<h2>Database Pengguna</h2>
<table>
<thead>
<th>ID</th>
<th>Nama</th>
</thead>
<tbody>
<?php
foreach($data1->result() as $pengguna){
 echo "<tr>
 <td>$pengguna->id</td>
 <td>$pengguna->nama</td>
</tr>";
}
?>
</tbody>
</table>

<h2>Database User Profil</h2>
<table>
<thead>
<th>ID</th>
<th>Nama</th>
</thead>
<tbody>
<?php
foreach($data2->result() as $user){
 echo "<tr>
 <td>$user->userid</td>
 <td>$user->namauser</td>
 </tr>";
}
?>
</tbody>
</table>
</body>
</html>