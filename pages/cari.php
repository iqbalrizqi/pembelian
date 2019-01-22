<?php require_once('config/main.php'); 
require_once('config/modal.php'); 
$query=mysql_query("SELECT pembelian.*,supplier.* from pembelian 
					inner join supplier on supplier.id_supplier=pembelian.id_supplier
					where kode_pembelian='$_POST[id]'
					");

$q=mysql_fetch_array($query);

$jml=mysql_fetch_array(mysql_query("SELECT sum(jumlah) as jml FROM cek_barang where kode_pembelian='$_POST[id]'"));


$cek2=mysql_query("SELECT * FROM cek_barang where kode_pembelian='$_POST[id]'");

$brg=mysql_fetch_array($cek2);
$cek3=mysql_num_rows($cek2);
if ($cek3<1) {
	$ket="<span class='label label-danger'>Belum di input</span>";
} else {
	$ket="<span class='label label-success'>$brg[ket]</span>";
}


?>
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Cek Barang </h3>
    </div><!-- /.box-header -->
    <div class="box-body">


    	<form role="form" method="post" action="index.php?page=cari">
    		<input type="text" name="id" placeholder="Kode Pembelian" title="Masukan Kode Pembelian" required="">
        <button type="submit" class="btn btn-primary">Cari</button>
    	</form><br><br><br>



    	<?php 
    	if (mysql_num_rows($query)==1) {
    	 ?>
    	<div class="col-xs-6">
    	<table class="table">
    		<tr>
    			<td>Kode Pembelian</td>
    			<td>: <b><?php echo $q['kode_pembelian']?></b></td>
    		</tr>
    		<tr>
    			<td>Tanggal Pembelian</td>
    			<td>: <?php echo $q['tgl_pembelian']?></td>
    		</tr>
    		<tr>
    			<td>Supplier</td>
    			<td>: <?php echo $q['nama_supplier']?></td>
    		</tr>
    		<tr>
    			<td>Jumlah Barang</td>
    			<td>: <?php echo $q['total_jumlah']?></td>
    		</tr>
    		<tr>
    			<td>Jumlah Yang Datang</td>
    			<td>: <?php echo $jml['jml']; ?> &nbsp;&nbsp; <?php echo $ket; ?>
    		</tr>
    	</table>

    	<?php if ($cek3==$q['total_jumlah']): ?>
    		
    <button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#modalCekBarang"><i class="fa fa-plus"></i> Input Jumlah Barang Datang</button>
    	<?php endif;

    	} else {

    	echo "<i>Kode Pembelian Tidak Ditemukan....</i>";
    	 }
    	 ?>

    	</div>


		<table class="table table-bordered" id="tabel">
		</table>



	</div>
</div>


<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>

<!-- Modal Ambil Cek Barang -->
<div class="modal fade" id="modalCekBarang">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
      <form role="form" method="post" action="simpan.php">

      <div class="modal-body">
          <input type="hidden" name="type" value="cek_barang">
          <input type="hidden" name="cmd" value="tambah">
          <input type="hidden" name="id" value="<?php echo $q['kode_pembelian']?>">
          <div class="form-group">
            <label>Jumlah Barang Yang Datang</label>
            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah Barang Yang Datang" value="<?php echo $q['total_jumlah']?>"/>
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control" name="ket" placeholder="Keterangan"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="tambah" class="btn btn-primary">Simpan</button>
      </div>

    </form>
    </div>
  </div>
</div>