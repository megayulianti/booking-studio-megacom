<?php 
include '../koneksi.php';
$nama  = $_POST['nama'];
$jumlah  = $_POST['jumlah'];

mysqli_query($koneksi, "insert into kategori values (NULL,'$nama','$jumlag')");
header("location:kategori.php");