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
  } else {
    echo "Error: Database connection failed.";
  }
  ?>

  <script>
    window.print();
  </script>
</body>
</html>
