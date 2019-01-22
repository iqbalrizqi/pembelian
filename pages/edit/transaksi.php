<?php require_once('config/main.php'); 
$query=mysql_query("select * from tb_barang where kode_barang='$_GET[id]'");
$data = mysql_fetch_array($query);
?>
<section>
	<div class="row">
		<div class="col-md-12">
	      <!-- general form elements disabled -->
	      <div class="box box-info">
	        <div class="box-header">
	          <h3 class="box-title">Edit Barang</h3>
	        </div><!-- /.box-header -->
	        <div class="box-body">
	          <form role="form" method="post" action="simpan.php">
	          <input type="hidden" name="id" value="<?php echo $data['kode_barang']; ?>">
	           <input type="hidden" name="type" value="data_barang">
	            <input type="hidden" name="cmd" value="edit">
	            <div class="form-group">
	              <label>Kode Barang</label>
	              <input type="text" class="form-control" name="kode" placeholder="kode" required="" required="" value="<?php echo $data['kode_barang'];?>" />
	            </div>
	            <div class="form-group">
	              <label>Nama Barang</label>
	              <input type="text" class="form-control" name="nama" placeholder="Nama" required="" value="<?php echo $data['nama_barang'];?>" />
	            </div>
	            <div class="form-group">
	              <label>Kategori</label>
	              <select name="kategori" class="form-control">
	              	<?php 
	              	$cek = mysql_query("SELECT * FROM tb_kategori");
		                while ($row=mysql_fetch_array($cek)) {
		                  echo '<option value='.$row['id_kategori'].'>'.$row['nama_kategori'].' </option>';
		                }
			         ?>
	              </select>
	            </div>
	            <div class="form-group">
	              <label>Satuan</label>
	              <input type="text" class="form-control" name="satuan" placeholder="Satuan" required="" value="<?php echo $data['satuan'];?>" />
	            </div>
	            <div class="form-group">
	              <label>Jumlah</label>
	              <input type="number" class="form-control" name="jumlah" placeholder="Jumlah" required="" value="<?php echo $data['stok'];?>" />
	            </div>
	            <div class="form-group">
	              <label>Harga</label>
	              <input type="number" class="form-control" name="harga" placeholder="Harga" required="" value="<?php echo $data['harga'];?>" />
	            </div>
	            <div class="form-group">
	              <label>Deskripsi</label>
	              <textarea class="form-control" rows="3" name="desk" placeholder="Deskripsi"><?php echo $data['deskripsi'];?>"</textarea>
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