   <?php
   session_start();
   include 'config/main.php';
   include 'config/fungsi_rupiah.php';
   ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Laporan</title>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <!-- Ionicons 2.0.0 --> 
    <!-- Theme style -->
  </head>
  <body onload="window.print();">
    <center><h3>Laporan Produk yang terjual</h3>
    <hr>
    <br>
    <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr> 
              <th>No</th>
              <th>Merek</th>
              <th>Jumlah Terjual</th>             
            </tr>
            </thead>
            <tbody>
            <?php 
            $no=1;
    $sql = mysql_query("SELECT tb_barang.*,sum(tb_detilpenjualan.jumlah) as total,tb_merek.* FROM tb_detilpenjualan INNER JOIN tb_barang on tb_barang.kode_barang=tb_detilpenjualan.kode_barang INNER JOIN tb_merek on tb_merek.id_merek=tb_barang.id_merek GROUP BY tb_merek.nama_merek");
     $total =mysql_fetch_array(mysql_query("SELECT sum(jumlah) as total from tb_detilpenjualan"));
    while ($data=mysql_fetch_array($sql)) :?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $data['nama_merek']; ?></td>
              <td><?php echo $data['total']; ?></td>
            </tr>
    <?php endwhile; ?>
            <tr>
              <td colspan="2"><b>TOTAL</b></td>
              <td colspan=""><b><?php echo  $total['total'];?></b></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
  </body>
</html>