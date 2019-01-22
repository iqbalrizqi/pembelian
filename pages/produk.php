<?php require_once('config/main.php');
require_once('config/modal.php');
require_once('config/fungsi_rupiah.php');

$query=mysql_query("SELECT produk.*,kategori.* from produk
					inner join kategori on kategori.id_kategori=produk.id_kategori");
?>
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Produk</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalProduk"><i class="fa fa-plus"></i> Tambah Produk</button>
    <br>
    <br>
		<table class="table table-bordered" id="tabel">
		<thead>
			 <tr>
		    <th>NO</th>
		    <th>NAMA</th>
			<th>KATEGORI</th>
			<th>SATUAN</th>
		    <th>STOK</th>
		    <th>HARGA</th>
		    <th>UKURAN</th>
		    <th>DESKRIPSI</th>
		    <th>ACTION</th>
		  </tr>
		</thead>
		<tbody>
			<?php
		  $no=1;
		  while($q=mysql_fetch_array($query)){
		  ?>
		  <tr>
		    <td><?php echo $no++; ?></td>      
			<td><?php echo $q['nama_produk']?></td>
			<td><?php echo $q['nama_kategori']?></td>    
		    <td><?php echo $q['satuan']?></td>
		    <td><?php echo $q['stok']?></td>
		    <td><?php echo format_rupiah($q['harga'])?></td>
		    <td><?php echo $q['ukuran']?></td>
		    <td><?php echo $q['deskripsi']?></td>

		    <td>
		    	<a class="" href="edit.php?edit=<?php echo $_GET['page']; ?>&id=<?php echo $q['id_produk']; ?>"><span class='badge bg-blue'>Edit</span></a>
		    	<a class="" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="hapus.php?hapus=<?php echo $_GET['page']; ?>&id=<?php echo $q['id_produk']; ?>"><span class='badge bg-red'>Hapus</span></a>
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