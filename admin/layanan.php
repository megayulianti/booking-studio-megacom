<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Layanan
      <small>Data Layanan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-10 col-lg-offset-1">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Layanan</h3>
            <a href="layanan_tambah.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i> &nbsp Tambah Layanan Baru</a>              
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA LAYANAN</th>
                    <th>KATEGORI</th>
                    <th>HARGA</th>
                    <th width="15%">FOTO</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM layanan, kategori WHERE layanan_kategori=kategori_id ORDER BY layanan_id DESC");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['layanan_nama']; ?></td>
                      <td><?php echo $d['kategori_nama']; ?></td>
                      <td><?php echo "Rp. ".number_format($d['layanan_harga']).",-"; ?></td>
                      <td>
                        <center>
                          <?php if($d['layanan_foto1'] == ""){ ?>
                            <img src="../gambar/sistem/produk.png" style="width: 80px;height: auto">
                          <?php }else{ ?>
                            <img src="../gambar/layanan/<?php echo $d['layanan_foto1'] ?>" style="width: 80px;height: auto">
                          <?php } ?>
                        </center>
                      </td>
                      <td>                        
                        <a class="btn btn-warning btn-sm" href="layanan_edit.php?id=<?php echo $d['layanan_id'] ?>"><i class="fa fa-cog"></i></a>
                        <a class="btn btn-danger btn-sm" href="layanan_hapus.php?id=<?php echo $d['layanan_id'] ?>"><i class="fa fa-trash"></i></a>
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
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>
