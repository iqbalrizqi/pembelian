

   <?php
   session_start();
   include '../config/main.php';
   include '../config/fungsi_rupiah.php';
   $tgl1=$_POST['tgl1'];
   $tgl2=$_POST['tgl2'];
   $status=$_POST['status'];
    if ($status=='all') {

        $query = "SELECT  supplier.*, pembelian.* FROM pembelian
                      INNER JOIN supplier on supplier.id_supplier=pembelian.id_supplier 
                   where tgl_pembelian between '$tgl1' and '$tgl2'"; 
        $total =mysql_fetch_array(mysql_query("SELECT sum(total_harga) as total from pembelian where tgl_pembelian between '$tgl1' and '$tgl2'"));

    } else {

        $query = "SELECT supplier.*, pembelian.* FROM pembelian
                      INNER JOIN supplier on supplier.id_supplier=pembelian.id_supplier
          where tgl_pembelian between '$tgl1' and '$tgl2' and status='$status'";
        $total =mysql_fetch_array(mysql_query("select sum(total_harga) as total from pembelian WHERE status='$status' and tgl_pembelian between '$tgl1' and '$tgl2'"));
    }
   ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Laporan</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <!-- Ionicons 2.0.0 --> 
    <!-- bootstrap wysihtml5 - text editor -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onload="window.print();">
    <center><h3>Laporan Pembelian</h3>
            <p>Periode : <?php echo $tgl1 ." - ". $tgl2 ?></p></center>
    <hr>
    <br>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Tgl Pembelian</th>
          <th>Kode</th>
          <th>Customer</th>
          <th>Jatuh Tempo</th>
          <th>Status</th>
          <th>Sub Total</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $sql = mysql_query($query);
        $no = 1;
        while ($data=mysql_fetch_array($sql)):
      ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $data['tgl_pembelian'] ?></td>
          <td><?php echo $data['kode_pembelian'] ?></td>
          <td><?php echo $data['nama_supplier'] ?></td>
          <td><?php echo $data['jatuh_tempo'] ?></td>
          <td><?php echo $data['status'] ?></td>
          <td>Rp.  <?php echo  format_rupiah($data['total_harga']) ?></td>
        </tr>
      <?php endwhile; ?>
      <tr>
        <td colspan="6"><b>TOTAL</b></td>
        <td colspan=""><b>Rp. <?php echo format_rupiah($total['total']);?></b></td>
      </tr>
      </tbody>
    </table>
  </body>
</html>