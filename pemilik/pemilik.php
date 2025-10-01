<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Pemilik
      <small>Data Pemilik</small>
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
            <h3 class="box-title">Pemilik</h3>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA</th>
                    <th>USERNAME</th>
                    <th width="15%">FOTO</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM pemilik");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['pemilik_nama']; ?></td>
                      <td><?php echo $d['pemilik_username']; ?></td>
                      <td>
                        <center>
                          <?php if($d['pemilik_foto'] == ""){ ?>
                            <img src="../gambar/sistem/user.png" style="width: 40px;height: auto">
                          <?php }else{ ?>
                            <img src="../gambar/user/<?php echo $d['pemilik_foto'] ?>" style="width: 40px;height: auto">
                          <?php } ?>
                        </center>
                      </td>
                      <td>                        
                        <a class="btn btn-warning btn-sm" href="pemilik_edit.php?id=<?php echo $d['pemilik_id'] ?>"><i class="fa fa-cog"></i></a>
                        <?php if($d['pemilik_id'] != 1){ ?>
                          <a class="btn btn-danger btn-sm" href="pemilik_hapus.php?id=<?php echo $d['pemilik_id'] ?>"><i class="fa fa-trash"></i></a>
                        <?php } ?>
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