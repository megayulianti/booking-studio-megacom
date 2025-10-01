<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>


  <section class="content">


    <div class="row">    
      <section class="col-lg-7">

        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Detail Login</h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th width="30%">Nama</th>
                <td><?php echo $_SESSION['nama']; ?></td>
              </tr>
              <tr>
                <th>Username</th>
                <td><?php echo $_SESSION['username']; ?></td>
              </tr>
              <tr>
                <th>Level Hak Akses</th>
                <td>
                  <span class="label label-success text-uppercase"><?php echo $_SESSION['status']; ?></span>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </section>
    </div>

  </section>

</div>
<?php include 'footer.php'; ?>