<?php 
include 'koneksi.php';

$id_layanan = $_GET['id'];
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'customer'; // Default redirect to 'customer' if not set

$data = mysqli_query($koneksi, "select * from layanan, kategori where kategori_id=layanan_kategori and layanan_id='$id_layanan'");
$d = mysqli_fetch_assoc($data);

session_start();

if (isset($_SESSION['keranjang'])) {
    $jumlah_isi_keranjang = count($_SESSION['keranjang']);

    $sudah_ada = 0;
    for ($a = 0; $a < $jumlah_isi_keranjang; $a++) {
        // cek apakah layanan sudah ada dalam keranjang
        if ($_SESSION['keranjang'][$a]['layanan'] == $id_layanan) {
            $sudah_ada = 1;
            break;
        }
    }

    if ($sudah_ada == 0) {
        $_SESSION['keranjang'][$jumlah_isi_keranjang] = array(
            'layanan' => $id_layanan,
            'jumlah' => 1
        );
    }
} else {
    $_SESSION['keranjang'][0] = array(
        'layanan' => $id_layanan,
        'jumlah' => 1
    );
}

switch ($redirect) {
    case "index":
        $r = "index.php";
        break;
    case "detail":
        $r = "layanan_detail.php?id=" . $id_layanan;
        break;
    case "keranjang":
        $r = "keranjang.php";
        break;
    default:
        $r = "customer.php";
        break;
}

header("location:".$r);
?>
