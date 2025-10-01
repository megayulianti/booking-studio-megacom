<?php include 'header.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
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
            <?php // include 'sidebar.php'; ?>

            <!-- MAIN -->
            <div id="main" class="col-md-12">
                <!-- store top filter -->
                <form action="" method="get">
                    <div class="store-filter clearfix">
                        <div class="pull-right">
                            <div class="sort-filter">
                                <span class="text-uppercase">Urutkan :</span>
                                <select class="input" name="urutan" onchange="this.form.submit()">
                                    <option <?php if (isset($_GET['urutan']) && $_GET['urutan'] == "terbaru") echo "selected='selected'"; ?> value="terbaru">Terbaru</option>
                                    <option <?php if (isset($_GET['urutan']) && $_GET['urutan'] == "harga") echo "selected='selected'"; ?> value="harga">Harga</option>
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
                        $halaman = 12;
                        $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                        $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;

                        // Query to fetch data from 'layanan' table
                        $result = mysqli_query($koneksi, "SELECT * FROM layanan");
                        $total = mysqli_num_rows($result);
                        $pages = ceil($total / $halaman);

                        // Determine sorting order and search criteria
                        $order_by = isset($_GET['urutan']) && $_GET['urutan'] == "harga" ? " ORDER BY layanan_harga ASC" : " ORDER BY layanan_id DESC";
                        $search_query = isset($_GET['cari']) ? " AND layanan_nama LIKE '%" . $_GET['cari'] . "%'" : "";

                        // Query data from 'layanan' table with pagination and sorting
                        $query = "SELECT * FROM layanan WHERE 1" . $search_query . $order_by . " LIMIT $mulai, $halaman";
                        $data = mysqli_query($koneksi, $query);
                        $no = $mulai + 1;

                        while ($d = mysqli_fetch_array($data)) {
                        ?>

                        <!-- Product Single -->
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <div class="product-label">
                                        <span><?php echo $d['layanan_kategori']; ?></span>
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
                                        <a class="primary-btn add-to-cart btn-block text-center" href="keranjang_masukkan.php?id=<?php echo $d['layanan_id']; ?>&redirect=halaman_pelanggan"><i class="fa fa-shopping-cart"></i> Masukkan Keranjang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Product Single -->

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
                                <?php } else { 
                                    $c = isset($_GET['cari']) ? "&cari=" . $_GET['cari'] : "";
                                    $url = "?halaman=" . $i . $c;
                                    if (isset($_GET['urutan']) && $_GET['urutan'] == "harga") {
                                        $url .= "&urutan=harga";
                                    }
                                ?>
                                    <li><a href="<?php echo $url; ?>"><?php echo $i; ?></a></li>
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
