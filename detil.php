<?php session_start();
if(!isset($_SESSION['nama'])){
  header('location:login.php');
} else {
include 'config/main.php';
include 'config/fungsi_auto.php';
include 'config/fungsi_rupiah.php';
include 'config/transaksi_fungsi.php';

$kode=$_GET['kode'];

$query=mysql_query("SELECT tb_customer.*,tb_penjualan.*,tb_user.* from tb_penjualan
                  INNER JOIN tb_customer on tb_customer.kode_customer = tb_penjualan.kode_customer 
                  INNER JOIN tb_user on tb_user.id_user = tb_penjualan.id_user
                  where kode_penjualan='$kode'");
$data=mysql_fetch_array($query);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Detil Penjualan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link href="dist/css/fa/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo"><b>Piutang </b>App</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          
        </nav>
      </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['nama']; ?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <ul class="sidebar-menu">
            <li class="header">MENU UTAMA</li>
            <li class="treeview <?php if(!isset($_GET['page'])) { echo "active"; } ?>">
              <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
            </li>
            <li class="treeview <?php if(isset($_GET['page']) && $_GET['page']=="kategori") { echo "active"; } ?>">
              <a href="./?page=kategori">
                <i class="fa fa-pie-chart"></i> <span>Kategori</span> 
              </a>
            </li>
            <li class="treeview <?php if(isset($_GET['page']) && $_GET['page']=="merek") { echo "active"; } ?>">
              <a href="./?page=merek">
                <i class="fa fa-list"></i> <span>Merek</span> 
              </a>
            </li>
            <li class="treeview <?php if(isset($_GET['page']) && $_GET['page']=="data_barang") { echo "active"; } ?>">
              <a href="./?page=data_barang">
                <i class="fa fa-inbox"></i> <span>Data Barang</span> 
              </a>
            </li>
            <li class="treeview <?php if(isset($_GET['page']) && $_GET['page']=="data_customer") { echo "active"; } ?>">
              <a href="./?page=data_customer">
                <i class="fa fa-users"></i> <span>Data Customer</span> 
              </a>
            </li>
            <li class="treeview <?php if(isset($_GET['page']) && $_GET['page']=="transaksi") { echo "active"; } ?>">
              <a href="./?page=transaksi">
                <i class="fa fa-money"></i> <span>Transaksi</span> 
              </a>
            </li>
            <li class="treeview <?php if(isset($_GET['page']) && $_GET['page']=="data_user") { echo "active"; } ?>">
              <a href="./?page=laporan">
                <i class="fa fa-files-o"></i> <span>Laporan</span> 
              </a>
            </li>
            <?php if(!isset($_SESSION['username'])): ?>
             <li class="treeview">
              <a href="login.php">
                <i class="fa fa-lock"></i> <span>Login</span> 
              </a>
            </li>
          <?php else: ?>
            <li class="header">MENU ADMIN</li>
            <li class="<?php if(isset($_GET['page']) && $_GET['page']=="admin") { echo "active"; } ?>">
            <a href="./?page=admin"><i class="fa fa-user text-warning"></i> Managemen User</a></li>
            <li class="treeview">
              <a href="logout.php">
                <i class="fa fa-backward text-danger"></i> <span>Log Out</span> 
              </a>
            </li>
          <?php endif; ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#<?php echo $kode; ?></small>
      </h1>
    </section>
<!--
    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
      </div>
    </div>
-->

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Toko Komputer
            <small class="pull-right">Tanggal: <?php echo $data['tanggal_penjualan']; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>Toko Komputer</strong><br>
            Bitung - Tangerang<br>
            Phone: (021) 595-012470<br>
            Email: iqbalrizqipurnama@gmail.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong><?php echo $data['nama_customer']; ?></strong><br>
            <?php echo $data['alamat_customer']; ?><br>
            Phone: <?php echo $data['no_telp']; ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #<?php echo $kode; ?></b><br>
          <br>
          <b>Tempo:</b> <?php echo $data['lama_tempo']; ?> hari<br>
          <b>Tgl Jatuh Tempo:</b> <?php echo $data['jatuh_tempo']; ?><br>
          <b>Admin:</b> <?php echo $data['nama']; ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr> 
              <th>Kode Brg</th>
              <th>Nama Brg</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Subtotal</th>              
            </tr>
            </thead>
            <tbody>
            <?php 
            $b=mysql_query("SELECT tb_barang.*, tb_detilpenjualan.* from tb_detilpenjualan
                            INNER JOIN tb_barang on tb_barang.kode_barang = tb_detilpenjualan.kode_barang
                             where kode_penjualan='$kode'");
            while ($q=mysql_fetch_array($b)) :
             ?>
            <tr>
              <td><?php echo $q['kode_barang'] ?></td>
              <td><?php echo  $q['nama_barang'] ?></td>
              <td><?php echo  format_rupiah($q['harga']) ?></td>
              <td><?php echo  $q['jumlah'] ?></td>
              <td><?php echo  format_rupiah($q['jumlah_harga']) ?></td>
            </tr>
          <?php endwhile ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          

        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead"></p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Total:</th>
                <td><?php echo format_rupiah($data['total_harga']) ?></td>
              </tr>
              <tr>
                <th>Denda:</th>
                <td><?php
                        $tgl_dateline=$data['jatuh_tempo'];
                        $tgl_kembali=date('Y-m-d');
                        $lambat=terlambat($tgl_dateline, $tgl_kembali);
                        $denda1 = 0.01 * $data['total_harga'];
                        $denda=$lambat*$denda1;
                        if ($lambat>0) {
                            $hasil_denda=$denda;
                            }
                              else {
                                            $hasil_denda=0;
                                        }
                        echo format_rupiah($denda);
                        ?></td>
              </tr>
              <tr>
                <th>Grand Total:</th>
                <td><?php $a= $data['total_harga'] + $denda;
                echo format_rupiah($a)  ?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="index.php?page=transaksi"  class="btn btn-default"><i class="fa fa-backward"></i> Kembali</a>
          <?php if ($data['status']=='hutang'):?>
          <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modalBayar"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
        <?php endif ?> 
        <a href="print_detil.php?kode=<?php echo $kode; ?>" target="_blank" class="btn btn-primary pull-right"><i class="fa fa-print"></i>  Print</a>
          </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>



  <!-- Modal Ambil Barang -->

<div class="modal fade" id="modalBayar">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
      <div class="modal-body">
          <form action="server.php?p=bayar" method="POST"> 
          <input type="hidden" name="user" value="1">         
          <div class="form-group">
            <label class="control-label">Invoice:</label>
            <input type="text" class="form-control" name="kodep" id="kodep" placeholder="kodep Barang" value="<?php echo $kode ?>" readonly="">
          </div>
          <div class="form-group">
            <label class="control-label">Subtotal:</label>
            <input type="text" class="form-control" name="subtotal" id="subtotal" placeholder="subtotal" value="<?php echo $data['total_harga'] ?>" readonly="">
          </div>
          <div class="form-group">
            <label class="control-label">Denda:</label>
            <input type="text" class="form-control" name="denda" id="denda" placeholder="denda" value="<?php echo $denda; ?>" readonly="">
          </div> 
          <div class="form-group">
            <label class="control-label">Total:</label>
            <input type="number" class="form-control" name="total" id="total" placeholder="total" value="<?php echo $a; ?>" readonly="">
          </div>
          <div class="form-group">
            <label class="control-label">Ket:</label>
            <textarea class="form-control" name="ket"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="tambah" class="btn btn-primary">Bayar</button>
      </div>
</form>
    </div>
  </div>
</div>

  <!-- /.content-wrapper -->
  <footer class="main-footer no-print">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2017<a href="#">Iqbal Rizqi Purnama</a>.</strong>
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js" type="text/javascript"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="plugins/jQueryUI/jquery-ui.min.js" type="text/javascript"></script>

<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>

<?php } ?>