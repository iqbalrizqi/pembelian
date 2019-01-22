<?php require_once('config/main.php'); 
$query=mysql_query("select * from supplier where id_supplier='$_GET[id]'");
$data = mysql_fetch_array($query);
?>
<section>
	<div class="row">
		<div class="col-md-12">
	      <!-- general form elements disabled -->
	      <div class="box box-info">
	        <div class="box-header">
	          <h3 class="box-title">Edit Supplier</h3>
	        </div><!-- /.box-header -->
	        <div class="box-body">
	          <form role="form" method="post" action="simpan.php">
	          <input type="hidden" name="id" value="<?php echo $data['id_supplier']; ?>">
	           <input type="hidden" name="type" value="supplier">
	            <input type="hidden" name="cmd" value="edit">
	            <div class="form-group">
	              <label>Nama Supplier</label>
	              <input type="text" class="form-control" name="nama" placeholder="Nama Supplier" required="" value="<?php echo $data['nama_supplier']; ?>" />
	            </div>
	            <div class="form-group">
	              <label>Alamat</label>
	              <textarea class="form-control" rows="3" name="alamat" placeholder="Alamat"> <?php echo $data['alamat_supplier']; ?></textarea>
	            </div>
	            <div class="form-group">
	              <label>No Telp</label>
	              <input type="text" class="form-control" name="telp" placeholder="No Telp/Hp" required="" value="<?php echo $data['no_telp']; ?>" />
	            </div>

	            <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
	            <button type="reset" class="btn btn-warning"> <i class="fa fa-backward"></i> Kembalikan Data</button>
	            <a href="index.php?page=supplier" class="btn btn-danger"> <i class="fa fa-times"></i>  Batal</a>
	          </form>
	        </div><!-- /.box-body -->
	      </div><!-- /.box -->
	    </div><!--/.col (right) -->
	</div>
</section>