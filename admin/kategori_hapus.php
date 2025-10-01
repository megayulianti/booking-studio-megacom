<?php 
include '../koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "delete from kategori where kategori_id='$id'");


mysqli_query($koneksi,"update layanan set layanan_kategori='1' where layanan_kategori='$id'");

header("location:kategori.php");
