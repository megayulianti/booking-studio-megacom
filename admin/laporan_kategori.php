<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      LAPORAN
      <small>Data Laporan Kategori</small>
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
            <h3 class="box-title">Laporan Kategori</h3>
          </div>
          <div class="box-body">

          <a href="laporan_print_kategori.php" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>

              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table-datatable">
                  <thead>
                    <tr>
                      <th width="1%">NO</th>
                      <th>NAMA KATEGORI</th>
                      <th>JUMLAH</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no=1;
                    $data = mysqli_query($koneksi, "SELECT kategori_nama, jumlah FROM kategori");
                    while($i = mysqli_fetch_array($data)){
                      ?>
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $i['kategori_nama'] ?></td>
                        <td><?php echo $i['jumlah'] ?></td>
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
