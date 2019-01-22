<?php require_once('config/main.php'); 
$query=mysql_query("select * from tb_user where id_user=".$_GET['id']);
$data = mysql_fetch_array($query);

?>
<section>
	<div class="row">
		<div class="col-md-12">
	      <!-- general form elements disabled -->
	      <div class="box box-info">
	        <div class="box-header">
	          <h3 class="box-title">Edit User</h3>
	        </div><!-- /.box-header -->
	        <div class="box-body">
	          <form role="form" method="post" action="simpan.php">
	          <input type="hidden" name="id" value="<?php echo $data['id_user']; ?>">
	           <input type="hidden" name="type" value="data_user">
	            <input type="hidden" name="cmd" value="edit">
	            <!-- text input -->
	            <div class="modal-body">
		          <input type="hidden" name="type" value="data_user">
		          <input type="hidden" name="cmd" value="edit">
		          <div class="form-group">
		            <label>Username</label>
		            <input type="text" class="form-control" name="username" placeholder="username" required="" value="<?php echo $data['username']; ?>" />
		          </div>
		          <div class="form-group">
		            <label>Nama</label>
		            <input type="text" class="form-control" name="nama" placeholder="Nama" required="" value="<?php echo $data['nama']; ?>" />
		          </div>
		          <div class="form-group">
		            <label>Alamat</label>
		            <textarea name="alamat" class="form-control"><?php echo $data['alamat']; ?></textarea>
		          </div>
		          <div class="form-group">
		            <label>Password</label>
		            <input type="password" class="form-control" name="password" placeholder="Password" value="" required="" value="<?php echo $data['password']; ?>" />
		          </div>
		      	</div>

	            <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
	            <button type="reset" class="btn btn-warning"> <i class="fa fa-backward"></i> Kembalikan Data</button>
	            <a href="index.php?page=data_user" class="btn btn-danger"> <i class="fa fa-times"></i>  Batal</a>
	          </form>
	        </div><!-- /.box-body -->
	      </div><!-- /.box -->
	    </div><!--/.col (right) -->
	</div>
</section>