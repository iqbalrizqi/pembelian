<?php 
include 'config/main.php';
include 'config/fungsi_rupiah.php';
$sql=mysql_query("SELECT pembelian.*,supplier.*,user.* from pembelian
          INNER JOIN supplier on supplier.id_supplier=pembelian.id_supplier
          INNER JOIN user on user.id_user=pembelian.id_user
                   where kode_pembelian='$_GET[id]'");
$data=mysql_fetch_array($sql);

 ?>
 <body onload="window.print();"></body>
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-home"></i> Transaksi Pemelian
            <small class="pull-right">Tanggal: <?php echo $data['tgl_pembelian']; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>Toko Wijaya Foam</strong><br>
            Bitung - Tangerang<br>
            Phone: (021) 595-012470<br>
            Email: iqbalrizqipurnama@gmail.com
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong><?php echo $data['nama_supplier']; ?></strong><br>
            <?php echo $data['alamat_supplier']; ?><br>
            Phone: <?php echo $data['no_telp']; ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #<?php echo $_GET['id']; ?></b><br>
          <b>Tempo:</b> <?php echo $data['lama_tempo']; ?> hari<br>
          <b>Tgl Jatuh Tempo:</b> <?php echo $data['jatuh_tempo']; ?><br>
          <b>Status:</b> <span class="label label-danger"><?php echo $data['status']; ?></span><br>
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
              <th>No</th>
              <th>Produk</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Subtotal</th>              
            </tr>
            </thead>
            <tbody>
            <?php 
            $b=mysql_query("SELECT produk.*, pembelian_detail.* from pembelian_detail
                            INNER JOIN produk on produk.id_produk = pembelian_detail.id_produk
                             where kode_pembelian='$_GET[id]'");
            while ($q=mysql_fetch_array($b)) :
             ?>
            <tr>
              <td><?php echo $q['id_produk'] ?></td>
              <td><?php echo  $q['nama_produk'] ?></td>
              <td><?php echo  format_rupiah($q['harga']) ?></td>
              <td><?php echo  $q['jumlah'] ?></td>
              <td><?php echo  format_rupiah($q['subtotal']) ?></td>
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
<?php 
$dibayar=mysql_fetch_array(mysql_query("SELECT sum(jumlah_bayar) as total from pembayaran where kode_pembelian='$_GET[id]'"));
 ?>
        <div class="col-xs-6">
          <p class="lead"></p>
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Total:</th>
                <td><?php echo format_rupiah($data['total_harga']) ?></td>
              </tr>
              <tr>
                <th style="width:50%">Dibayar:</th>
                <td><?php echo format_rupiah($dibayar['total']) ?></td>
              </tr>
              <tr>
                <th style="width:50%">Sisa Bayar:</th>
                <td><?php echo format_rupiah($data['sisa_pembayaran']) ?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>



<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
