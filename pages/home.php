<?php require_once('config/main.php');
$hutang=mysql_query("select * from tb_penjualan where status='hutang'");
$lunas=mysql_query("select * from tb_penjualan where status='lunas'");

$data=mysql_query("SELECT tb_barang.*,sum(tb_detilpenjualan.jumlah) as total,tb_merek.* FROM tb_detilpenjualan INNER JOIN tb_barang on tb_barang.kode_barang=tb_detilpenjualan.kode_barang INNER JOIN tb_merek on tb_merek.id_merek=tb_barang.id_merek GROUP BY tb_merek.nama_merek");

 ?>
<div class="row">
	<div class="col-md-6">
	  <!-- Bar chart -->
	  <div class="box box-primary">
	    <div class="box-header">
	      <i class="fa fa-bar-chart-o"></i>
	      <h3 class="box-title">Grafik Batang</h3>
	    </div>
	    <div class="box-body">
	      <div id="bar-chart" style="height: 300px;"></div>
	    </div><!-- /.box-body-->
	  </div><!-- /.box -->
	</div>
	<div class="col-md-6">
		<div class="box box-primary">
            <div class="box-header">
              <i class="fa fa-bar-chart-o"></i>
              <h3 class="box-title">Grafik Status Penjualan</h3> 
            </div>
            <div class="box-body">
              <div id="donut-chart" style="height: 300px;"></div>
            </div><!-- /.box-body-->
          </div><!-- /.box -->
        </div><!-- /.col -->
	</div>
</div>

<script src="plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function() {
		/*
         * BAR CHART
         * ---------
         */

        var bar_data = {
          data: [[
          "Data Merek", <?php echo mysql_num_rows(mysql_query("SELECT * FROM tb_merek")); ?>], ["Data Kategori", <?php echo mysql_num_rows(mysql_query("SELECT * from tb_kategori")); ?>], ["Data barang", <?php echo mysql_num_rows(mysql_query("SELECT * from tb_barang")); ?>], ["Data Penjualan", <?php echo mysql_num_rows(mysql_query("SELECT * from tb_penjualan")); ?>]],
          color: "#00A3CB"
        };
        $.plot("#bar-chart", [bar_data], {
          grid: {
            borderWidth: 1,
            borderColor: "#f3f3f3",
            tickColor: "#F39C12"
          },
          series: {
            bars: {
              show: true,
              barWidth: 0.5,
              align: "center"
            }
          },
          xaxis: {
            mode: "categories",
            tickLength: 0
          }
        });
        /* END BAR CHART */

        /*
         * DONUT CHART
         * -----------
         */

        var donutData = [
          {label: "Lunas", data: <?php echo mysql_num_rows($lunas); ?>, color: "#00A65A"},
          {label: "Piutang", data: <?php echo mysql_num_rows($hutang); ?>, color: "#DD4B39"}
        ];
        $.plot("#donut-chart", donutData, {
          series: {
            pie: {
              show: true,
              radius: 1,
              innerRadius: 0.5,
              label: {
                show: true,
                radius: 2 / 3,
                formatter: labelFormatter,
                threshold: 0.1
              }

            }
          },
          legend: {
            show: false
          }
        });
        /*
         * END DONUT CHART
         */
         function labelFormatter(label, series) {
        	return "<div style='font-size:11px; text-align:center; padding:2px; color: #fff; font-weight: 600;'>"
                + label
                + "<br/>"
                + Math.round(series.percent) + "%</div>";
      }
	});	
</script>