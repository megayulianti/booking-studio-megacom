<?php include 'header.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="customer.php">Home</a></li>
            <li class="active">Booking</li>
        </ul>
    </div>
</div>
<!-- /BREADCRUMB -->

<div class="section">
    <div class="container">
        <div class="row">
            
            <?php 
            include 'customer_sidebar.php'; 
            ?>

            <div id="main" class="col-md-9">
                
                <h4>BOOKING</h4>

                <div id="store">
                    <div class="row">

                        <div class="col-lg-12">

                            <?php 
                            if(isset($_GET['alert'])){
                                if($_GET['alert'] == "gagal"){
                                    echo "<div class='alert alert-danger'>Gambar gagal diupload!</div>";
                                } elseif($_GET['alert'] == "sukses"){
                                    echo "<div class='alert alert-success'>Booking berhasil dibuat, silahkan melakukan pembayaran!</div>";
                                } elseif($_GET['alert'] == "upload"){
                                    echo "<div class='alert alert-success'>Konfirmasi pembayaran berhasil tersimpan, silahkan menunggu konfirmasi dari admin!</div>";
                                } elseif($_GET['alert'] == "batal"){
                                    echo "<div class='alert alert-success'>Booking berhasil dibatalkan!</div>";
                                }
                            }
                            ?>

                            <small class="text-muted">
                                invoice Customer
                            </small>

                            <br/>
                            <br/>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>No.Invoice</th>
                                            <th>Tanggal</th>
                                            <th>Nama Penerima</th>
                                            <th>Total Bayar</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">OPSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $id = $_SESSION['customer_id'];
                                        $invoice = mysqli_query($koneksi, "SELECT * FROM invoice WHERE invoice_customer='$id' ORDER BY invoice_id DESC");
                                        while($i = mysqli_fetch_array($invoice)){
                                            ?>
                                            <tr>
                                                <td><?php echo $i['invoice_id'] ?></td>
                                                <td>INVOICE-00<?php echo $i['invoice_id'] ?></td>
                                                <td><?php echo $i['invoice_tanggal'] ?></td>
                                                <td><?php echo $i['invoice_nama'] ?></td>
                                                <td><?php echo "Rp. ".number_format($i['invoice_total_bayar'])." ,-" ?></td>
                                                <td class="text-center">
                                                    <?php 
                                                    switch($i['invoice_status']) {
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
                                                            echo "<span class='label label-warning'>foto bisa diambil sekarang</span>";
                                                            break;
                                                        case 5:
                                                            echo "<span class='label label-success'>Selesai</span>";
                                                            break;
                                                        default:
                                                            echo "<span class='label label-default'>Unknown</span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php 
                                                    if($i['invoice_status'] == 0 || $i['invoice_status'] == 1){
                                                        ?>
                                                        <a class='btn btn-sm btn-primary' href="customer_pembayaran.php?id=<?php echo $i['invoice_id']; ?>"><i class="fa fa-money"></i> Konfirmasi Pembayaran</a>
                                                        <a class='btn btn-sm btn-danger' href="customer_batal.php?id=<?php echo $i['invoice_id']; ?>" onclick="return confirm('uang dp yang telah dibayarkan tidak bisa dikembalikan !! , Apakah Anda yakin ingin membatalkan pesanan ini?');"><i class="fa fa-times"></i> Batalkan Pesanan</a>
                                                        <?php
                                                    }
                                                    ?>
                                                    <a class='btn btn-sm btn-success' href="customer_invoice.php?id=<?php echo $i['invoice_id']; ?>"><i class="fa fa-print"></i> Invoice</a>
                                                </td>
                                            </tr>
                                            <?php 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            


                        </div>    

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
