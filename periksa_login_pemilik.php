<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($koneksi, "SELECT * FROM pemilik WHERE pemilik_username='$username' AND pemilik_password='$password'");
$cek = mysqli_num_rows($login);

if($cek > 0){
	session_start();
	$data = mysqli_fetch_assoc($login);
	$_SESSION['id'] = $data['pemilik_id'];
	$_SESSION['nama'] = $data['pemilik_nama'];
	$_SESSION['username'] = $data['pemilik_username'];
	$_SESSION['status'] = "login";

	header("location:pemilik/");
}else{
	header("location:login_pemilik.php?alert=gagal");
}
