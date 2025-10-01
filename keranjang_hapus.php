<?php 
include 'koneksi.php';
session_start();

$id_layanan = $_GET['id'];
$redirect = $_GET['redirect'];

if(isset($_SESSION['keranjang'])){
	for($a=0; $a<count($_SESSION['keranjang']); $a++){
		if($_SESSION['keranjang'][$a]['layanan'] == $id_layanan){
			unset($_SESSION['keranjang'][$a]);

			// urutkan kembali
			sort($_SESSION['keranjang']);
		}
	}
}

if($redirect == "index"){
	$r = "index.php";
}elseif($redirect == "detail"){
	$r = "layanan_detail.php?id=".$id_layanan;
}elseif($redirect == "keranjang"){
	$r = "keranjang.php";
}

print_r($_SESSION['keranjang']);
header("location:".$r);
?>
