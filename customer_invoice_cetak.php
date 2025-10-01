<!DOCTYPE html>
<html>
<head>
	<title>Invoice Customer</title>
	<style>
		body {
			font-family: Arial, sans-serif;
		}

		.table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
		}

		.table th, .table td {
			border: 1px solid #ddd;
			padding: 8px;
			text-align: left;
		}

		.text-center {
			text-align: center;
		}

		.label {
			display: inline-block;
			padding: 5px 10px;
			border-radius: 3px;
			font-size: 12px;
		}

		.label-warning {
			background-color: #f0ad4e;
			color: #fff;
		}

		.label-default {
			background-color: #777;
			color: #fff;
		}

		.label-danger {
			background-color: #d9534f;
			color: #fff;
		}

		.label-primary {
			background-color: #337ab7;
			color: #fff;
		}

		.label-success {
			background-color: #5cb85c;
			color: #fff;
		}
	</style>
</head>
<body>

<?php 
	session_start();
	include 'koneksi.php';
?>

<div>
	<?php 
	$id_invoice = $_GET['id'];
	$id = $_SESSION['customer_id'];
	$invoice = mysqli_query($koneksi, "SELECT * FROM invoice WHERE invoice_customer='$id' AND invoice_id='$id_invoice' ORDER BY invoice_id DESC");
	while ($i = mysqli_fetch_array($invoice)) {
	?>
	<div>
		<center>
			<h3>MEGACOM STUDIO</h3>
		</center>
		<h4>INVOICE-00<?php echo $i['invoice_id'] ?></h4>
		<br/>
		Nama :<?php echo $i['invoice_nama']; ?><br/>
		Alamat :<?php echo $i['invoice_alamat']; ?><br/>
		Hp. <?php echo $i['invoice_hp']; ?><br/>
		hari booking: <?php echo $i['invoice_tanggal']; ?><br/>
		waktu booking : <?php echo $i['invoice_waktu']; ?><br/>
		<br/>
		<table class="table">
		<div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>Detail Layanan</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" width="5%">NO</th>
                                                        <th>Nama Layanan</th>
                                                        <th class="text-right">Harga Satuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $no = 1;
                                                    $total = 0;
                                                    $transaksi = mysqli_query($koneksi, "SELECT * from invoice_detail where invoice_id='$id_invoice'");
                                                    
                                                    // Debug: Tampilkan query dan jumlah hasil
                                                    if (!$transaksi) {
                                                        die("Query Error: " . mysqli_error($koneksi));
                                                    }
                                                    if (mysqli_num_rows($transaksi) == 0) {
                                                        echo "<tr><td colspan='3' class='text-center'>Tidak ada data transaksi.</td></tr>";
                                                    } else {
                                                        while($d = mysqli_fetch_array($transaksi)){
                                                            $total += $d['layanan_harga'];
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $no++; ?></td>
                                                            <td><?php echo $d['layanan_nama']; ?></td>
                                                            <td class="text-right"><?php echo "Rp. ".number_format($d['layanan_harga'], 0, ',', '.'); ?></td>
                                                        </tr>
                                                    <?php 
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="2" class="text-right"><strong>Total Bayar</strong></td>
                                                        <td class="text-right"><?php echo "Rp. ".number_format($total, 0, ',', '.'); ?></td>
                                                    </tr>
													<tr>
                                                        <td colspan="2" class="text-right"><strong>Pembayaran Uang DP (20%) yang akan dibayar oleh customer terlebih dahulu untuk melakukan booking</strong></td>
                                                        <td class="text-right"><?php echo "Rp. ".number_format($total * 0.2, 0, ',', '.'); ?></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
		</table>
		<?php
                                $tgl_exp = date("d M Y", strtotime($i['invoice_tanggal']));
                                
                                $dp = $total * 0.2;
                                $sisa_pembayaran = $total - $dp;
                                ?>

                                <h4>Silahkan melakukan pembayaran dengan nominal Rp <?php echo number_format($total, 0, ',', '.'); ?> dengan membayar DP 20% sebesar Rp <?php echo number_format($dp, 0, ',', '.'); ?>. Sisa pembayaran sebesar Rp <?php echo number_format($sisa_pembayaran, 0, ',', '.'); ?> pada kasir tanggal <?php echo $tgl_exp; ?>.</h4>

                                <h3>"Hasil foto dan cetakan bisa diambil maksimal 3 hari setelah status pemberitahuan." </h3>
		<h5>STATUS :</h5> 
		<?php 
			if ($i['invoice_status'] == 0) {
				echo "<span class='label label-warning'>Menunggu Pembayaran</span>";
			} elseif ($i['invoice_status'] == 1) {
				echo "<span class='label label-default'>Menunggu Konfirmasi</span>";
			} elseif ($i['invoice_status'] == 2) {
				echo "<span class='label label-default'>konfirmasi diproses</span>";
			} elseif ($i['invoice_status'] == 3) {
				echo "<span class='label label-danger'>ditolak</span>";
			} elseif ($i['invoice_status'] == 4) {
				echo "<span class='label label-warning'>foto bisa diambil sekarang</span>";
			} elseif ($i['invoice_status'] == 5) {
				echo "<span class='label label-success'>Selesai</span>";
			}
		?>
	</div>
	
	<?php } ?>
</div>

<script>
	window.print();
</script>

</body>
</html>
