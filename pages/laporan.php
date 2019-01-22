<?php include 'config/main.php'; ?>
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Laporan</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    	<div class="row">
            <div class="col-md-6">
              <form action="pages/lap_pembelian.php" method="POST" target="_blank" >
              <div class="form-group">
                <label>Periode Awal</label>
                <input type="date" class="form-control" name="tgl1" />
              </div>
              <div class="form-group">
                <label>Periode Ahir</label>
                <input type="date" class="form-control" name="tgl2" />
                </select>
              </div>
              <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                	<option value="all">Pilih</option>
                	<option value="hutang">Hutang</option>
                	<option value="lunas">Lunas</option>
                </select>
              </div>
              <div class="form-group">
              	<button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Submit</button>
              </div>

              </form>
            </div>

          <div class="col-md-6">
            <form action="print_detil.php" method="get" target="_blank">
              <div class="form-group">
                <label>No Invoice</label>
                <select name="kode" class="form-control">
                    <?php
                    $sql = mysql_query("SELECT * from tb_penjualan");
                    while ($q=mysql_fetch_array($sql)) {
                      echo "<option value=$q[kode_penjualan]>$q[kode_penjualan]</option>";
                    }
                     ?>
                </select>

            </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Submit</button>

          </div>
        </div>


        <hr>


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