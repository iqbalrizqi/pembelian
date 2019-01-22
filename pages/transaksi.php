<?php require_once('config/main.php'); 
		require_once('config/fungsi_rupiah.php'); 
		include 'config/transaksi_fungsi.php';

$query=mysql_query("SELECT pembelian.*,supplier.nama_supplier from pembelian
					INNER JOIN supplier on supplier.id_supplier=pembelian.id_supplier");
?>
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Transaksi ( Terdapat <?php echo mysql_num_rows($query); ?> Data)</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php if (isset($_SESSION['username'])): ?>
    <a href="?page=transaksi_input" style="margin-bottom: 10px;" class="btn btn-md btn-primary"> <i class="fa fa-plus"></i> Tambah Transaksi</a>
    <?php endif; ?>
    <br>
		<table class="table table-bordered" id="tabel">
		<thead>
			 <tr>
		    <th>KODE</th>
		    <th>NAMA SUPPLIER</th>
			<th>TGL PEMBELIAN</th>
			<th>STATUS</th>
		    <th>TOTAL</th>
		    <th>JATUH TEMPO</th>
		    <th>AKSI</th>
		  </tr>
		</thead>
		<tbody>
			<?php
		  $no=1;
		  while($q=mysql_fetch_array($query)){
		  ?>
		  <tr>
		    <td><?php echo $q['kode_pembelian'] ?></td>          
		    <td><?php echo $q['nama_supplier']?></td>
			<td><?php echo $q['tgl_pembelian']?></td>
			<td><?php
					if ($q['status']=='hutang') {
						echo "<span class='label label-danger'>hutang</span>";
					} else {
						echo "<span class='label label-success'>lunas</span>";
					}?>
				</td>
		    <td><?php echo format_rupiah ($q['total_harga'])?></td>
			<td><?php echo $q['jatuh_tempo']?></td>
		    <td>
		    	<a class="btn btn-success" href="index.php?page=detail&id=<?php echo $q['kode_pembelian'] ?>" >Detil</a>
		    	<a class="btn btn-primary" href="index.php?page=pembayaran&id=<?php echo $q['kode_pembelian'] ?>" >Pembayaran</a>
		    </td>
		  </tr>
		  <?php
		  }
		  ?>
		</tbody>
		</table>
	</div>
</div>

<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
 <script type="text/javascript">
	 $(document).ready(function() {
	 	$('#tabel').dataTable({
	          "bPaginate": true,
	          "bLengthChange": true,
	          "bFilter": true,
	          "bSort": true,
	          "bInfo": true,
	          "bAutoWidth": true
	    });
	 });
</script>