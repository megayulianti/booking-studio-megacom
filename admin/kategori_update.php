<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$nama  = $_POST['nama'];
$jumlah  = $_POST['jumlah'];

mysqli_query($koneksi, "update kategori set kategori_nama='$nama', jumlah='$jumlah' where kategori_id='$id'");
header("location:kategori.php");