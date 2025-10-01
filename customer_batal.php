<?php
include 'koneksi.php';
session_start();

if(isset($_GET['id'])) {
    $invoice_id = $_GET['id'];
    $customer_id = $_SESSION['customer_id'];

    // Pastikan invoice milik customer yang sedang login
    $cek_invoice = mysqli_query($koneksi, "SELECT * FROM invoice WHERE invoice_id='$invoice_id' AND invoice_customer='$customer_id'");
    
    if(mysqli_num_rows($cek_invoice) > 0) {
        // Update status invoice menjadi dibatalkan (misalnya gunakan status 6 untuk dibatalkan)
        $update_invoice = mysqli_query($koneksi, "UPDATE invoice SET invoice_status=6 WHERE invoice_id='$invoice_id'");

        if($update_invoice) {
            header("location: customer_booking.php?alert=batal");
        } else {
            header("location: customer_booking.php?alert=gagal");
        }
    } else {
        header("location: customer_booking.php?alert=gagal");
    }
} else {
    header("location: customer_booking.php");
}
?>
