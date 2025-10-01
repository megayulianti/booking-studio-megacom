<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Transaksi
      <small>Data Transaksi</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Invoice Booking</h3>
          </div>
          <div class="box-body">

           <?php 
           include '../koneksi.php'; // Include your database connection file
           $id_invoice = $_GET['id'];
           $invoice = mysqli_query($koneksi, "SELECT * FROM invoice WHERE invoice_id='$id_invoice' ORDER BY invoice_id DESC");
           while ($i = mysqli_fetch_array($invoice)) {
            ?>

            <div class="col-lg-12">
              <a href="transaksi.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> KEMBALI</a>
              <a href="transaksi_invoice_cetak.php?id=<?php echo $_GET['id'] ?>" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-print"></i> CETAK</a>

              <br/>
              <br/>

              <h4>INVOICE-00<?php echo $i['invoice_id'] ?></h4>

              <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama Pelanggan:</strong> <?php echo $i['invoice_nama']; ?></p>
                    <p><strong>Alamat:</strong> <?php echo $i['invoice_alamat']; ?></p>
                    <p><strong>No. HP:</strong> <?php echo $i['invoice_hp']; ?></p>
                    <p><strong>Hari Booking:</strong> <?php echo $i['invoice_tanggal']; ?></p>
                    <p><strong>Waktu Booking:</strong> <?php echo $i['invoice_waktu']; ?></p>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-bordered table-striped">
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
                    $transaksi = mysqli_query($koneksi, "SELECT * FROM invoice_detail WHERE invoice_id='$id_invoice'");
                    
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
                        <td class="text-right"><?php echo "Rp. " . number_format($d['layanan_harga'], 0, ',', '.'); ?></td>
                      </tr>
                    <?php 
                      }
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2" class="text-right"><strong>Total Bayar</strong></td>
                      <td class="text-right"><?php echo "Rp. " . number_format($total, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                            <td colspan="2" class="text-right"><strong>Pembayaran Uang DP (20%) yang akan dibayar oleh customer terlebih dahulu untuk melakukan booking</strong></td>
                            <td class="text-right"><?php echo "Rp. ".number_format($total * 0.2, 0, ',', '.'); ?></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <?php
                                $tgl_exp = date("d M Y", strtotime($i['invoice_tanggal']));
                                
                                $dp = $total * 0.2;
                                $sisa_pembayaran = $total - $dp;
                                ?>

                                <h4>Silahkan melakukan pembayaran dengan nominal Rp <?php echo number_format($total, 0, ',', '.'); ?> dengan membayar DP 20% sebesar Rp <?php echo number_format($dp, 0, ',', '.'); ?>. Sisa pembayaran sebesar Rp <?php echo number_format($sisa_pembayaran, 0, ',', '.'); ?> pada kasir tanggal <?php echo $tgl_exp; ?>.</h4>

                                <h4>"Hasil foto dan cetakan bisa diambil maksimal 3 hari setelah status pemberitahuan." </h4>
              <h5>STATUS :</h5> 
              <?php 
              switch ($i['invoice_status']) {
                case 0:
                  echo "<span class='label label-warning'>Menunggu Pembayaran</span>";
                  break;
                case 1:
                  echo "<span class='label label-default'>Menunggu Konfirmasi</span>";
                  break;
                case 2:
                  echo "<span class='label label-default'>konfirmasi diproses</span>";
                  break;
                case 3:
                    echo "<span class='label label-danger'>ditolak</span>";
                  break;
                case 4:
                  echo "<span class='label label-primary'>foto bisa diambil sekarang</span>";
                  break;
                case 5:
                  echo "<span class='label label-success'>Selesai</span>";
                  break;
              }
              ?>

            </div>  

            <?php 
          }
          ?>

        </div>

      </div>
    </section>
  </div>
</section>

</div>
<?php include 'footer.php'; ?>
