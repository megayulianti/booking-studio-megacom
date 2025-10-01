<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      LAPORAN
      <small>Data Laporan Customer</small>
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
            <h3 class="box-title">Laporan Customer</h3>
          </div>
          <div class="box-body">

          <a href="laporan_print_customer.php" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>

              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table-datatable">
                  <thead>
                    <tr>
                      <th width="1%">NO</th>
                      <th>NAMA CUSTOMER</th>
                      <th>EMAIL</th>
                      <th>NOMOR TELEPON</th>
                      <th>ALAMAT</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no=1;
                    $data = mysqli_query($koneksi, "SELECT customer_nama, customer_email, customer_hp, customer_alamat FROM customer");
                    while($i = mysqli_fetch_array($data)){
                      ?>
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $i['customer_nama'] ?></td>
                        <td><?php echo $i['customer_email'] ?></td>
                        <td><?php echo $i['customer_hp'] ?></td>
                        <td><?php echo $i['customer_alamat'] ?></td>
                      </tr>
                      <?php 
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <?php 
              ?>
              <div class="alert alert-info text-center">
                Silahkan Filter Laporan Terlebih Dulu.
              </div>
              <?php
            
            ?>
          </div>
        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>
