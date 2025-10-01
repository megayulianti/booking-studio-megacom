<?php 
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "select * from pemilik where pemilik_id='$id'");
$d = mysqli_fetch_assoc($data);
$foto = $d['pemilik_foto'];
unlink("../gambar/user/$foto");
mysqli_query($koneksi, "delete from pemilik where pemilik_id='$id'");
header("location:pemilik.php");