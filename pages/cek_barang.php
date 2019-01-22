<?php require_once('config/main.php'); 
$query=mysql_query("select * from kategori");
?>
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Cek Barang </h3>
    </div><!-- /.box-header -->
    <div class="box-body">
      	<form role="form" method="post" action="index.php?page=cari">
    		<input type="text" name="id" placeholder="Kode Pembelian" title="Masukan Kode Pembelian" required="">
        <button type="submit"  class="btn btn-primary">Cari</button>
    	</form><br><br><br>
	</div>
</div>


<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>


