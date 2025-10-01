<?php 
include '../koneksi.php';

$id  = $_POST['id'];
$nama  = $_POST['nama'];
$kategori = $_POST['kategori'];
$harga = $_POST['harga'];
$keterangan = $_POST['keterangan'];

$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');

$filename1 = $_FILES['foto1']['name'];

// Update layanan table
mysqli_query($koneksi, "UPDATE layanan SET 
    layanan_nama='$nama', 
    layanan_kategori='$kategori', 
    layanan_harga='$harga', 
    layanan_keterangan='$keterangan' 
    WHERE layanan_id='$id'");

// Handle photo uploads and updates
if($filename1 != ""){
    $ext = pathinfo($filename1, PATHINFO_EXTENSION);

    if(in_array($ext, $allowed)) {
        move_uploaded_file($_FILES['foto1']['tmp_name'], '../gambar/layanan/'.$rand.'_'.$filename1);
        $file_gambar = $rand.'_'.$filename1;

        // Delete old photo
        $lama = mysqli_query($koneksi, "SELECT * FROM layanan WHERE layanan_id='$id'");
        $l = mysqli_fetch_assoc($lama);
        $foto = $l['layanan_foto1'];
        unlink("../gambar/layanan/$foto");

        mysqli_query($koneksi, "UPDATE layanan SET layanan_foto1='$file_gambar' WHERE layanan_id='$id'");
    }
}

// Redirect to layanan.php after processing
header("location: layanan.php");
?>
