<?php 
include '../koneksi.php';
$id = $_GET['id'];

// Fetch data of the service
$data = mysqli_query($koneksi, "SELECT * FROM layanan WHERE layanan_id='$id'");
$d = mysqli_fetch_assoc($data);

// Delete associated photos
$foto1 = $d['layanan_foto1'];

unlink("../gambar/layanan/$foto1");


// Delete the service entry from the layanan table
mysqli_query($koneksi, "DELETE FROM layanan WHERE layanan_id='$id'");

// Check and delete associated transactions
$data_transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE transaksi_layanan='$id'");
while ($transaksi = mysqli_fetch_array($data_transaksi)) {
    $id_invoice = $transaksi['transaksi_invoice'];
    
    // Delete invoice entry
    mysqli_query($koneksi, "DELETE FROM invoice WHERE invoice_id='$id_invoice'");
}

// Delete transactions related to the service
mysqli_query($koneksi, "DELETE FROM transaksi WHERE transaksi_layanan='$id'");

// Redirect to the products page
header("location:layanan.php");
?>
