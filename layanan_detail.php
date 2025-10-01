<?php include 'header.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active">Detail Layanan</li>
        </ul>
    </div>
</div>
<!-- /BREADCRUMB -->

<?php 
$id_layanan = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM layanan, kategori WHERE kategori_id = layanan_kategori AND layanan_id = '$id_layanan'");
while ($d = mysqli_fetch_array($data)) {
?>
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Service Details -->
            <div class="product product-details clearfix">
                <div class="col-md-6">
                    <div id="product-main-view">
                        <div class="product-view">
                            <?php if ($d['layanan_foto1'] == "") { ?>
                                <img src="gambar/sistem/layanan.png">
                            <?php } else { ?>
                                <img src="gambar/layanan/<?php echo $d['layanan_foto1'] ?>">
                            <?php } ?>
                        </div>
                    </div>
                    <div id="product-view">
                        <div class="product-view">
                            <?php if ($d['layanan_foto1'] == "") { ?>
                                <img src="gambar/sistem/layanan.png">
                            <?php } else { ?>
                                <img src="gambar/layanan/<?php echo $d['layanan_foto1'] ?>">
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-body">
                        <div class="product-label">
                            <span><?php echo $d['kategori_nama']; ?></span>
                            <span class="sale">Kualitas Terbaik</span>
                        </div>
                        <br>
                        <h2 class="product-name"><?php echo $d['layanan_nama']; ?></h2>
                        <br>
                        <h3 class="product-price"><?php echo "Rp. " . number_format($d['layanan_harga']) . ",-"; ?></h3>
                        <br/>
                        <div></div>
                        <br/>
                        <br/>

                        <form action="">
                            <div class="product-btns">
                                <a class="primary-btn add-to-cart" href="keranjang_masukkan.php?id=<?php echo $d['layanan_id']; ?>&redirect=detail">
                                    <i class="fa fa-shopping-cart"></i> Masukkan Keranjang
                                </a>
                                <div class="pull-right"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="product-tab">
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Deskripsi</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab1" class="tab-pane fade in active">
                                <p><?php echo $d['layanan_keterangan']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Service Details -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<?php 
}
?>

<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h2 class="title">Rekomendasi Layanan Lainnya</h2>
                </div>
            </div>
            <!-- /section title -->

            <?php 
            $data = mysqli_query($koneksi, "SELECT * FROM layanan, kategori WHERE kategori_id = layanan_kategori ORDER BY rand() LIMIT 4");
            while ($d = mysqli_fetch_array($data)) {
            ?>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="product product-single">
                    <div class="product-thumb">
                        <div class="product-label">
                            <span><?php echo $d['kategori_nama']; ?></span>
                        </div>
                        <a href="layanan_detail.php?id=<?php echo $d['layanan_id'] ?>" class="main-btn quick-view">
                            <i class="fa fa-search-plus"></i> Quick view
                        </a>
                        <?php if ($d['layanan_foto1'] == "") { ?>
                            <img src="gambar/sistem/layanan.png" style="height: 250px">
                        <?php } else { ?>
                            <img src="gambar/layanan/<?php echo $d['layanan_foto1'] ?>" style="height: 250px">
                        <?php } ?>
                    </div>
                    <div class="product-body">
                        <h3 class="product-price"><?php echo "Rp. " . number_format($d['layanan_harga']) . ",-"; ?></h3>
                        <h2 class="product-name"><a href="layanan_detail.php?id=<?php echo $d['layanan_id'] ?>"><?php echo $d['layanan_nama']; ?></a></h2>
                        <div class="product-btns">
                            <a class="main-btn btn-block text-center" href="layanan_detail.php?id=<?php echo $d['layanan_id'] ?>">
                                <i class="fa fa-search"></i> Lihat
                            </a>
                            <a class="primary-btn add-to-cart btn-block text-center" href="keranjang_masukkan.php?id=<?php echo $d['layanan_id']; ?>&redirect=detail">
                                <i class="fa fa-shopping-cart"></i> Masukkan Keranjang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Service Single -->
            <?php 
            }
            ?>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>

<?php include 'footer.php'; ?>
