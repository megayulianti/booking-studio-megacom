<?php
include 'header.php'; 
include 'koneksi.php'; // Pastikan koneksi ke database

// Debug: Pastikan session dan parameter ada
if (!isset($_SESSION['customer_id']) || !isset($_GET['id'])) {
    die("Session customer_id atau parameter id tidak tersedia");
}

$id_invoice = $_GET['id'];
$id = $_SESSION['customer_id'];
?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="customer.php">Home</a></li>
            <li><a href="customer_pesanan.php">Invoice Customer</a></li>
            <li class="active">Detail Invoice</li>
        </ul>
    </div>
</div>
<!-- /BREADCRUMB -->

<div class="section">
    <div class="container">
        <div class="row">

            <?php include 'customer_sidebar.php'; ?>

            <div id="main" class="col-md-9">

                <h4>INVOICE DETAIL</h4>
                <a href="customer_invoice_cetak.php?id=<?php echo $_GET['id'] ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Cetak Invoice</a>

                <div id="store">
                    <div class="row">

                        <?php 
                        $invoice = mysqli_query($koneksi, "SELECT * FROM invoice WHERE invoice_customer='$id' AND invoice_id='$id_invoice' ORDER BY invoice_id DESC");
                        
                        // Debug: Tampilkan query dan jumlah hasil
                        if (!$invoice) {
                            die("Query Error: " . mysqli_error($koneksi));
                        }
                        if (mysqli_num_rows($invoice) == 0) {
                            die("Invoice tidak ditemukan.");
                        }

                        while ($i = mysqli_fetch_array($invoice)) {
                        ?>

                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>INVOICE-00<?php echo $i['invoice_id'] ?></h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Nama Pelanggan:</strong> <?php echo $i['invoice_nama']; ?></p>
                                                <p><strong>Alamat:</strong> <?php echo $i['invoice_alamat']; ?></p>
                                                <p><strong>No. HP:</strong> <?php echo $i['invoice_hp']; ?></p>
                                                <p><strong>Hari Booking:</strong> <?php echo $i['invoice_tanggal']; ?></p>
                                                <p><strong>Waktu Booking:</strong> <?php echo $i['invoice_waktu']; ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Status:</strong> 
                                                <?php 
                                                switch ($i['invoice_status']) {
                                                    case 0:
                                                        echo "<span class='label label-warning'>Menunggu Pembayaran</span>";
                                                        break;
                                                    case 1:
                                                        echo "<span class='label label-default'>Menunggu Konfirmasi</span>";
                                                        break;
                                                    case 2:
                                                        echo "<span class='label label-default'>konfirmmasi diproses</span>";
                                                        break;
                                                    case 3:
                                                        echo "<span class='label label-danger'>ditolak</span>";
                                                        break;
                                                    case 4:
                                                        echo "<span class='label label-warning'>foto bisa diambil sekarang</span>";
                                                        break;
                                                    case 5:
                                                        echo "<span class='label label-success'>Selesai</span>";
                                                        break;
                                                    default:
                                                        echo "<span class='label label-default'>Unknown</span>";
                                                }
                                                ?></p>
                                                <p><strong>Tanggal:</strong> <?php echo $i['invoice_tanggal']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

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
                                                        while ($d = mysqli_fetch_array($transaksi)) {
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

                                <?php
                                $tgl_exp = date("d M Y", strtotime($i['invoice_tanggal']));
                                
                                $dp = $total * 0.2;
                                $sisa_pembayaran = $total - $dp;
                                ?>

                                <h4>Silahkan melakukan pembayaran dengan nominal Rp <?php echo number_format($total, 0, ',', '.'); ?> dengan membayar DP 20% sebesar Rp <?php echo number_format($dp, 0, ',', '.'); ?>. Sisa pembayaran sebesar Rp <?php echo number_format($sisa_pembayaran, 0, ',', '.'); ?> pada kasir tanggal <?php echo $tgl_exp; ?>.</h4>

                                <h3>"Hasil foto dan cetakan bisa diambil maksimal 3 hari setelah status pemberitahuan." </h3>
                            </div>    

                        <?php 
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
