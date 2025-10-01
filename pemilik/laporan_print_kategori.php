<!DOCTYPE html>
<html>
<head>
  <title>Laporan Kategori</title>
  <style type="text/css">
    body {
      font-family: sans-serif;
    }
    .table {
      width: 100%;
    }
    th, td {
      padding: 5px;
      border: 1px solid black;
      border-collapse: collapse;
    }
  </style>
</head>
<body>
  <center>
    <h2>Laporan Kategori Megacom Studio</h2>
  </center>

  <?php
  // Adjust the path to your actual 'koneksi.php' file
  $koneksi_path = __DIR__ . '/../koneksi.php';
  if (file_exists($koneksi_path)) {
    include $koneksi_path;
  } else {
    echo "Error: Unable to load koneksi.php";
    exit;
  }

  if (isset($koneksi)) {
    ?>
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
          $no = 1;
          $data = mysqli_query($koneksi, "SELECT kategori_nama, jumlah FROM kategori");
          while ($i = mysqli_fetch_array($data)) {
            ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $i['kategori_nama']; ?></td>
              <td><?php echo $i['jumlah']; ?></td>
            </tr>
            <?php 
          }
          ?>
        </tbody>
      </table>
    </div>
    <?php
  } else {
    echo "Error: Database connection failed.";
  }
  ?>

  <script>
    window.print();
  </script>
</body>
</html>
