<?php include 'header.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active">Kategori</li>
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
            <!-- MAIN -->
            <div id="main" class="col-md-12">
                <?php
                $id = $_GET['id'];
                $kategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategori_id='$id'");
                $k = mysqli_fetch_assoc($kategori);
                ?>
                <div class="pull-left">
                    <h4>Kategori Layanan : <?php echo $k['kategori_nama']; ?></h4>
                </div>

                <!-- store top filter -->
                <form action="" method="get">
                    <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id">
                    <div class="store-filter clearfix">
                        <div class="pull-right">
                            <div class="sort-filter">
                                <span class="text-uppercase">Urutkan :</span>
                                <select class="input" name="urutan" onchange="this.form.submit()">
                                    <option <?php if (isset($_GET['urutan']) && $_GET['urutan'] == "terbaru") { echo "selected='selected'"; } ?> value="terbaru">Terbaru</option>
                                    <option <?php if (isset($_GET['urutan']) && $_GET['urutan'] == "harga") { echo "selected='selected'"; } ?> value="harga">Harga</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /store top filter -->

                <!-- STORE -->
                <div id="store">
                    <!-- row -->
                    <div class="row">
                        <?php
                        $kategori = $_GET['id'];
                        $halaman = 12;
                        $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                        $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
                        $result = mysqli_query($koneksi, "SELECT * FROM layanan");
                        $total = mysqli_num_rows($result);
                        $pages = ceil($total / $halaman);

                        if (isset($_GET['urutan']) && $_GET['urutan'] == "harga") {
                            $data = mysqli_query($koneksi, "SELECT * FROM layanan,kategori WHERE kategori_id='$kategori' AND kategori_id=layanan_kategori ORDER BY layanan_harga ASC LIMIT $mulai, $halaman");
                        } else {
                            $data = mysqli_query($koneksi, "SELECT * FROM layanan,kategori WHERE kategori_id='$kategori' AND kategori_id=layanan_kategori ORDER BY layanan_id DESC LIMIT $mulai, $halaman");
                        }

                        $no = $mulai + 1;

                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                            <!-- Product Single -->
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <div class="product-label">
                                            <span><?php echo $d['kategori_nama']; ?></span>
                                        </div>
                                        <a href="layanan_detail.php?id=<?php echo $d['layanan_id']; ?>" class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</a>
                                        <?php if ($d['layanan_foto1'] == "") { ?>
                                            <img src="gambar/sistem/layanan.png" style="height: 250px">
                                        <?php } else { ?>
                                            <img src="gambar/layanan/<?php echo $d['layanan_foto1']; ?>" style="height: 250px">
                                        <?php } ?>
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-price"><?php echo "Rp. " . number_format($d['layanan_harga']) . ",-"; ?></h3>
                                        <h2 class="product-name"><a href="layanan_detail.php?id=<?php echo $d['layanan_id']; ?>"><?php echo $d['layanan_nama']; ?></a></h2>
                                        <div class="product-btns">
                                            <a class="main-btn btn-block text-center" href="layanan_detail.php?id=<?php echo $d['layanan_id']; ?>"><i class="fa fa-search"></i> Lihat</a>
                                            <a class="primary-btn add-to-cart btn-block text-center" href="keranjang_masukkan.php?id=<?php echo $d['layanan_id']; ?>&redirect=detail"><i class="fa fa-shopping-cart"></i> Masukkan Keranjang</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Single -->
                        <?php } ?>

                        <?php if (mysqli_num_rows($data) == 0) { ?>
                            <center><h3>Belum Ada Layanan</h3></center>
                        <?php } ?>
                    </div>
                    <!-- /row -->
                </div>
                <!-- /STORE -->

                <!-- Pagination -->
                <div class="store-filter clearfix">
                    <div class="pull-right">
                        <ul class="store-pages">
                            <li><span class="text-uppercase">Page:</span></li>
                            <?php for ($i = 1; $i <= $pages; $i++) { ?>
                                <?php if ($page == $i) { ?>
                                    <li class="active"><?php echo $i; ?></li>
                                <?php } else { ?>
                                    <li><a href="?halaman=<?php echo $i; ?>&urutan=<?php echo isset($_GET['urutan']) ? $_GET['urutan'] : ''; ?>"><?php echo $i; ?></a></li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <!-- /Pagination -->
            </div>
            <!-- /MAIN -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->

<?php include 'footer.php'; ?>
