<?php 
include '../koneksi.php';

$nama  = $_POST['nama'];
$kategori = $_POST['kategori'];
$harga = $_POST['harga'];
$keterangan = $_POST['keterangan'];

$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');

$filename1 = $_FILES['foto1']['name'];

// Insert layanan record
mysqli_query($koneksi, "INSERT INTO layanan (layanan_nama, layanan_kategori, layanan_harga, layanan_keterangan, layanan_foto1) VALUES ('$nama', '$kategori', '$harga', '$keterangan', '')");

$last_id = mysqli_insert_id($koneksi);

if($filename1 != ""){
    $ext = pathinfo($filename1, PATHINFO_EXTENSION);

    if(in_array($ext, $allowed)) {
        move_uploaded_file($_FILES['foto1']['tmp_name'], '../gambar/layanan/'.$rand.'_'.$filename1);
        $file_gambar = $rand.'_'.$filename1;

        mysqli_query($koneksi, "UPDATE layanan SET layanan_foto1='$file_gambar' WHERE layanan_id='$last_id'");
    }
}

header("location:layanan.php");
?>
