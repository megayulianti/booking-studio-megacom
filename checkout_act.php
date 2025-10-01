<?php
include 'koneksi.php';

session_start();

// Ambil data dari form
$id_customer = $_SESSION['customer_id'];
$nama_pelanggan = $_POST['nama'];
$hp_pelanggan = $_POST['hp'];
$alamat_pelanggan = $_POST['alamat'];
$tanggal_booking = $_POST['tanggal_booking'];
$waktu_booking = $_POST['waktu_booking'];
$total_bayar = $_POST['total_bayar'];

// Insert ke dalam tabel invoice
$insert_invoice = mysqli_prepare($koneksi, "INSERT INTO invoice ( invoice_customer, invoice_nama, invoice_hp, invoice_alamat, invoice_tanggal, invoice_waktu, invoice_total_bayar) VALUES (?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($insert_invoice, 'isssssi', $id_customer, $nama_pelanggan, $hp_pelanggan, $alamat_pelanggan, $tanggal_booking, $waktu_booking, $total_bayar);
mysqli_stmt_execute($insert_invoice);
$invoice_id = mysqli_insert_id($koneksi);
mysqli_stmt_close($insert_invoice);

// Insert ke dalam tabel invoice_detail untuk setiap item di keranjang
if (isset($_SESSION['keranjang'])) {
    foreach ($_SESSION['keranjang'] as $item) {
        $id_layanan = $item['layanan'];
        $jumlah = $item['jumlah'];

        // Ambil detail layanan
        $layanan_query = mysqli_prepare($koneksi, "SELECT layanan_nama, layanan_foto1, layanan_harga FROM layanan WHERE layanan_id = ?");
        mysqli_stmt_bind_param($layanan_query, 'i', $id_layanan);
        mysqli_stmt_execute($layanan_query);
        mysqli_stmt_bind_result($layanan_query, $layanan_nama, $layanan_foto1, $layanan_harga);
        mysqli_stmt_fetch($layanan_query);
        mysqli_stmt_close($layanan_query);

        // Insert ke dalam tabel invoice_detail
        $insert_detail = mysqli_prepare($koneksi, "INSERT INTO invoice_detail (invoice_id, layanan_id, layanan_nama, layanan_foto1, layanan_harga) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($insert_detail, 'iissi', $invoice_id, $id_layanan, $layanan_nama, $layanan_foto1, $layanan_harga);
        mysqli_stmt_execute($insert_detail);
        mysqli_stmt_close($insert_detail);
    }

    // Kosongkan keranjang belanja setelah selesai checkout
    unset($_SESSION['keranjang']);
}

// Redirect ke halaman customer_pesanan.php dengan alert sukses
header("location: customer_booking.php?alert=sukses");
?>
