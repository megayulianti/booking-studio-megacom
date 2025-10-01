<?php include 'header.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Booking</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			
			<div class="col-md-12">
				<form method="post" action="keranjang_update.php">
					<div class="order-summary clearfix">
						<div class="section-title">
							<h3 class="title">Booking Pelanggan</h3>
						</div>

						<?php 
						if(isset($_GET['alert'])){
							if($_GET['alert'] == "keranjang_kosong"){
								echo "<div class='alert alert-danger text-center'>Tidak bisa checkout, karena keranjang belanja masih kosong. <br/> Silahkan belanja terlebih dulu.</div>";
							}
						}
						?>

						<?php 
						if(isset($_SESSION['keranjang'])){

							$jumlah_isi_keranjang = count($_SESSION['keranjang']);

							if($jumlah_isi_keranjang != 0){

								?>

								<table class="shopping-cart-table table">
									<thead>
										<tr>
											<th>Layanan</th>
											<th></th>
											<th class="text-center">Harga</th>
											<th class="text-center">Jumlah</th>
											<th class="text-center">Total Harga</th>
											<th class="text-right"></th>
										</tr>
									</thead>
									<tbody>

										<?php
										$jumlah_total = 0;
										$total = 0;
										for($a = 0; $a < $jumlah_isi_keranjang; $a++){
											$id_layanan = $_SESSION['keranjang'][$a]['layanan'];
											$jml = $_SESSION['keranjang'][$a]['jumlah'];

											$isi = mysqli_query($koneksi,"select * from layanan where layanan_id='$id_layanan'");
											$i = mysqli_fetch_assoc($isi);

											$total += $i['layanan_harga']*$jml;
											$jumlah_total += $total;
											?>

											<tr>
												<td class="thumb">
													<?php if($i['layanan_foto1'] == ""){ ?>
														<img src="gambar/sistem/layanan.png">
													<?php }else{ ?>
														<img src="gambar/layanan/<?php echo $i['layanan_foto1'] ?>">
													<?php } ?>
												</td>
												<td class="details">
													<a href="layanan_detail.php?id=<?php echo $i['layanan_id'] ?>"><?php echo $i['layanan_nama'] ?></a>
												</td>
												<td class="price text-center"><strong><?php echo "Rp. ".number_format($i['layanan_harga']) . " ,-"; ?></strong></td>
												<td class="qty text-center">
													<input class="harga" id="harga_<?php echo $i['layanan_id'] ?>" type="hidden" value="<?php echo $i['layanan_harga']; ?>">
													<input name="layanan[]" value="<?php echo $i['layanan_id'] ?>" type="hidden">
													<input class="input jumlah" name="jumlah[]" id="jumlah_<?php echo $i['layanan_id'] ?>" nomor="<?php echo $i['layanan_id'] ?>" type="number" value="<?php echo $_SESSION['keranjang'][$a]['jumlah']; ?>" min="1">
												</td>
												<td class="total text-center"><strong class="primary-color total_harga" id="total_<?php echo $i['layanan_id'] ?>"><?php echo "Rp. ".number_format($total) . " ,-"; ?></strong></td>
												<td class="text-right"><a class="main-btn icon-btn" href="keranjang_hapus.php?id=<?php echo $i['layanan_id']; ?>&redirect=detail"><i class="fa fa-close"></i></a></td>
											</tr>

											<?php
											$total = 0;

										}

										?>

									</tbody>
									<tfoot>
										<tr>
											<th class="empty" colspan="3"></th>
											<th>TOTAL</th>
											<th colspan="2" class="sub-total"><?php echo "Rp. ".number_format($jumlah_total) . " ,-"; ?></th>
										</tr>
									</tfoot>
								</table>

								<div class="pull-right">
								
									<a class="primary-btn" href="checkout.php">Check Out</a>
								</div>
								<?php
							}else{

								echo "<br><br><br><h3><center>booking Masih Kosong. Yuk <a href='customer.php'>belanja</a> !</center></h3><br><br><br>";
							}

						}else{
							echo "<br><br><br><h3><center>booking Masih Kosong. Yuk <a href='customer.php'>belanja</a> !</center></h3><br><br><br>";
						}
						?>

					</div>
				</form>

			</div>

		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<?php include 'footer.php'; ?>
