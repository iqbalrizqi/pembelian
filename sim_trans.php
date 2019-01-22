<?php 
include 'config/main.php';
$total=mysql_fetch_array(mysql_query("select sum(jumlah_harga) as total from tb_sementara"));
		    $totjum=mysql_fetch_array(mysql_query("select sum(jumlah) as total from tb_sementara"));

		    $trans=$_POST['trans'];
		    $cust=$_POST['cust'];
		    $jenis=$_POST['jenis'];
		    $lama=$_POST['lama'];
		    $tgl=$_POST['tgl'];
		    $user=$_POST['user'];

		    if ($jenis=='tempo') {
		      $status='hutang';
		    }else {
		      $status='lunas';
		    }

		    $tgl_buat=date('Y-m-d H:i:s');

		    $lama2="+$lama days";
		    $jatuh_tempo= date('Y-m-d',strtotime($lama2,strtotime($tgl)));

		    $sql = mysql_query("INSERT INTO tb_penjualan (kode_penjualan,
		    												tanggal_penjualan,
		    												kode_customer,
		    												jenis_pembayaran,
		    												lama_tempo,
		    												jatuh_tempo,
		    												total_jumlah,
		    												total_harga,
		    												status,
		    												id_user,
		    												tanggal_buat) 
		    										values ('$trans',
		                                                    '$tgl',
		                                                    '$cust',
		                                                    '$jenis',
		                                                    '$lama',
		                                                    '$jatuh_tempo',
		                                                    '$totjum[total]',
		                                                    '$total[total]',
		                                                    '$status',
		                                                    '$user',
		                                                    '$tgl_buat')");

		    if ($sql) {
		    	$query=mysql_query("SELECT * FROM tb_sementara");
		    	while($r=mysql_fetch_row($query)){
            	mysql_query("INSERT INTO tb_detilpenjualan (kode_penjualan,kode_barang,harga,jumlah,jumlah_harga)
                        values('$trans','$r[0]','$r[1]','$r[2]','$r[3]')");
            	mysql_query("UPDATE tb_barang set stok=stok-'$r[2]'
                        where kode_barang='$r[0]'");
		    	}
			    // bersih
			    mysql_query("truncate table tb_sementara");
				header('location:index.php?page=transaksi');
			} else {
				echo "Gagal";
			}

?>
