<?php include 'header.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active">Check Out</li>
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
                <div class="order-summary clearfix">
                    <div class="section-title">
                        <h3 class="title">Buat Booking</h3>
                    </div>

                    <div class="row">
                        <form method="post" action="checkout_act.php">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <br>
                                        <h4 class="text-center">INFORMASI Customer</h4>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="input" name="nama" placeholder="Masukkan nama pemesan .." required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor HP</label>
                                            <input type="number" class="input" name="hp" placeholder="Masukkan no.hp aktif .." required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Lengkap</label>
                                            <textarea name="alamat" class="form-control" style="resize: none;" rows="6" placeholder="Masukkan alamat lengkap .." required="required"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Booking</label>
                                            <input type="date" class="input" name="tanggal_booking" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Waktu Booking</label>
                                            <input type="time" class="input" name="waktu_booking" required="required">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="pull-left">
                                            <a class="main-btn" href="keranjang.php">Kembali Ke Keranjang</a>
                                        </div>
                                        <div class="pull-right">
                                            <input type="submit" class="primary-btn" value="Buat Pesanan">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6">

                                <?php 
                                if (isset($_SESSION['keranjang'])) {
                                    $jumlah_isi_keranjang = count($_SESSION['keranjang']);
                                    if ($jumlah_isi_keranjang != 0) {
                                        ?>
                                        <table class="shopping-cart-table table">
                                            <thead>
                                                <tr>
                                                    <th>Layanan</th>
                                                    <th class="text-center">Harga</th>
                                                    <th class="text-center">Jumlah</th>
                                                    <th class="text-center">Total Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $jumlah_total = 0;
                                                $total = 0;
                                                for ($a = 0; $a < $jumlah_isi_keranjang; $a++) {
                                                    $id_layanan = $_SESSION['keranjang'][$a]['layanan'];
                                                    $jml = $_SESSION['keranjang'][$a]['jumlah'];
                                                    $isi = mysqli_query($koneksi, "SELECT * FROM layanan WHERE layanan_id='$id_layanan'");
                                                    $i = mysqli_fetch_assoc($isi);
                                                    $total += $i['layanan_harga'] * $jml;
                                                    $jumlah_total += $total;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <a href="layanan_detail.php?id=<?php echo $i['layanan_id'] ?>"><?php echo $i['layanan_nama'] ?></a>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php echo "Rp. ".number_format($i['layanan_harga']) . " ,-"; ?>
                                                        </td>
                                                        <td class="qty text-center">
                                                            <?php echo $_SESSION['keranjang'][$a]['jumlah']; ?>
                                                        </td>
                                                        <td class="text-center"><strong class="primary-color total_harga" id="total_<?php echo $i['layanan_id'] ?>"><?php echo "Rp. ".number_format($total) . " ,-"; ?></strong></td>
                                                    </tr>
                                                    <?php
                                                    $total = 0;
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="empty" colspan="2"></th>
                                                    <th>TOTAL BAYAR</th>
                                                    <th class="text-center"><span id="tampil_total"><?php echo "Rp. ".number_format($jumlah_total) . " ,-"; ?></span></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <input type="hidden" name="total_bayar" id="total_bayar" value="<?php echo $jumlah_total; ?>">
                                        <?php
                                    } else {
                                        echo "<br><br><br><h3><center>Keranjang Masih Kosong. Yuk <a href='index.php'>belanja</a> !</center></h3><br><br><br>";
                                    }
                                } else {
                                    echo "<br><br><br><h3><center>Keranjang Masih Kosong. Yuk <a href='index.php'>belanja</a> !</center></h3><br><br><br>";
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->

<?php include 'footer.php'; ?>
