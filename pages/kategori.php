<?php require_once('config/main.php'); 
require_once('config/modal.php'); 
$query=mysql_query("select * from kategori");
?>
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Kategori </h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalKategori"><i class="fa fa-plus"></i> Tambah Kategori</button>
    <br>
    <br>
		<table class="table table-bordered" id="tabel">
		<thead>
			 <tr>
		    <th>NO</th>
		    <th>NAMA</th>
		    <th>ACTION</th>
		  </tr>
		</thead>
		<tbody>
			<?php
		  $no=1;
		  while($q=mysql_fetch_array($query)){
		  ?>
		  <tr>
		    <td><?php echo $no++ ?></td>          
		    <td><?php echo $q['nama_kategori']?></td>

		    <td>
		    	<a class="" href="edit.php?edit=<?php echo $_GET['page']; ?>&id=<?php echo $q['id_kategori']; ?>"><span class='badge bg-blue'>Edit</span></a>
			    <a class="" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="hapus.php?hapus=<?php echo $_GET['page']; ?>&id=<?php echo $q['id_kategori']; ?>"><span class='badge bg-red'>Hapus</span></a>
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