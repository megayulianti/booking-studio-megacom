<?php 
include 'header.php'; 
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Layanan
      <small>Tambah Layanan Baru</small>
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
            <h3 class="box-title">Tambah Layanan</h3>
            <a href="layanan.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">

            <form action="layanan_act.php" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label>Nama Layanan</label>
                <input type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama ..">
              </div>

              <div class="form-group">
                <label>Kategori Layanan</label>
                <div class="row">
                  <div class="col-lg-4">
                    <select name="kategori" required="required" class="form-control">
                      <option value="">- Pilih Kategori Layanan -</option>
                      <?php 
                      include '../koneksi.php';
                      $data = mysqli_query($koneksi,"SELECT * FROM kategori");
                      while($d = mysqli_fetch_array($data)){
                        ?>
                        <option value="<?php echo $d['kategori_id']; ?>"><?php echo $d['kategori_nama']; ?></option>
                        <?php 
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Harga</label>
                <div class="row">
                  <div class="col-lg-4">
                    <input type="number" class="form-control" name="harga" required="required" placeholder="Masukkan Harga ..">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control textarea" required="required" style="resize: none" rows="10"></textarea>
              </div>

              <div class="form-group">
                <label>Foto 1 (Foto Utama)</label>
                <input type="file" name="foto1">
              </div>

              <div class="form-group">
                <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
              </div>

            </form>

          </div>

        </div>
      </section>
    </div>
  </section>

</div>

<?php include 'footer.php'; ?>
