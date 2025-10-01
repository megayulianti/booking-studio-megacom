<?php 
include 'header.php'; 

$id = $_GET['id'];
$data = mysqli_query($koneksi,"SELECT * FROM layanan WHERE layanan_id='$id'");
$d = mysqli_fetch_array($data);
?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Layanan
      <small>Ubah Layanan</small>
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
            <h3 class="box-title">Ubah Layanan</h3>
            <a href="layanan.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">

            <form action="layanan_update.php" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label>Nama Layanan</label>
                <input type="hidden" name="id" value="<?php echo $d['layanan_id']; ?>">
                <input type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama .." value="<?php echo $d['layanan_nama']; ?>">
              </div>

              <div class="form-group">
                <label>Kategori Layanan</label>
                <div class="row">
                  <div class="col-lg-4">
                    <select name="kategori" required="required" class="form-control">
                      <option value="">- Pilih Kategori Layanan -</option>
                      <?php 
                      $kategori = mysqli_query($koneksi,"SELECT * FROM kategori");
                      while($k = mysqli_fetch_array($kategori)){
                        ?>
                        <option <?php if($k['kategori_id'] == $d['layanan_kategori']){echo "selected='selected'";} ?> value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori_nama']; ?></option>
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
                    <input type="number" class="form-control" name="harga" required="required" placeholder="Masukkan Harga .." value="<?php echo $d['layanan_harga']; ?>">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control textarea" required="required" style="resize: none" rows="10"><?php echo $d['layanan_keterangan']; ?></textarea>
              </div>

              <div class="form-group">
                <label>Foto 1 (Foto Utama)</label>
                <input type="file" name="foto1">

                <?php if($d['layanan_foto1'] == ""){ ?>
                  <img src="../gambar/sistem/layanan.png" style="width: 120px;height: auto">
                <?php }else{ ?>
                  <img src="../gambar/layanan/<?php echo $d['layanan_foto1'] ?>" style="width: 120px;height: auto">
                <?php } ?>

                <br/>
                <small class="text-muted">Kosongkan Jika Tidak Ingin Mengubah Foto</small>

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
