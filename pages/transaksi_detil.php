<?php require_once('config/main.php'); 
		require_once('config/fungsi_rupiah.php'); 
$query=mysql_query("SELECT tb_customer.*,tb_penjualan.* FROM tb_penjualan 
					INNER JOIN tb_customer on tb_customer.kode_customer=tb_penjualan.kode_customer");
?>
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Transaksi ( Terdapat <?php echo mysql_num_rows($query); ?> Data)</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <?php if (isset($_SESSION['username'])): ?>
    <a href="tambah.php?tambah=transaksi" style="margin-bottom: 10px;" class="btn btn-md btn-primary"> <i class="fa fa-plus"></i> Tambah Transaksi</a>
    <?php endif; ?>
    <br>
		<table class="table table-bordered" id="tabel">
		<thead>
			 <tr>
		    <th>KODE</th>
		    <th>NAMA CUST</th>
			<th>STATUS</th>
			<th>TGL PENJUALAN</th>
		    <th>TGL JTH TEMPO</th>
		    <th>TOTAL</th>
		    <th>DENDA</th>
		    <th></th>
		  </tr>
		</thead>
		<tbody>
			<?php
		  $no=1;
		  while($q=mysql_fetch_array($query)){
		  ?>
		  <tr>
		    <td><?php echo $q['kode_penjualan'] ?></td>          
		    <td><?php echo $q['nama_customer']?></td>
			<td><?php
					if ($q['status']=='hutang') {
						echo "<span class='label label-danger'>hutang</span>";
					} else {
						echo "<span class='label label-success'>lunas</span>";
					}?></td>		
			<td><?php echo $q['tanggal_penjualan']?></td>
		    <td><?php echo $q['jatuh_tempo']?></td>
		    <td><?php echo format_rupiah ($q['total_harga'])?></td>
		    <td><?php echo format_rupiah($q['denda'])?></td>

		    <td>
		    	<a class="btn btn-success" href="edit.php?edit=<?php echo $_GET['page']; ?>&id=<?php echo $q['kode_barang']; ?>">Detil</a>
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