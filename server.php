<?php 
session_start();
include 'config/main.php';
include 'config/fungsi_rupiah.php';

//$page = isset($_GET['p'])?$_GET['p']:'';
$page=$_GET['p'];
if ($page=='add') {

	  $kode=$_GET['kode'];
    $harga=$_GET['harga'];
    $jumlah=$_GET['jumlah'];
    $subtotal=$jumlah*$harga;
    
    $tambah = mysql_query("INSERT into pembelian_temp
                        values ('','$kode','$harga','$jumlah','$subtotal')");

} elseif ($page=='ambilbarang') {
	$sql = mysql_query("SELECT * FROM produk");
	echo "<option>-- Nama Porduk --</option>";
	while($data=mysql_fetch_array($sql)){
        echo "<option value='$data[id_produk]'>$data[nama_produk]</option>";
    }

} elseif ($page=='ambilsupp') {
  $sql = mysql_query("SELECT * FROM supplier");
  echo "<option>Pilih Supplier</option>";
  while($data=mysql_fetch_array($sql)){
        echo "<option value='$data[id_supplier]'>$data[id_supplier] - $data[nama_supplier]</option>";
    }

} elseif($page=='ambildata'){
    $kode=$_GET['kode'];
    $dt=mysql_query("select * from produk where id_produk='$kode'");
    $d=mysql_fetch_array($dt);
    echo $d['nama_produk']."|".$d['harga']."|".$d['stok'];
} elseif ($page=='table') {
	$q=mysql_query("SELECT produk.*, pembelian_temp.* from pembelian_temp
            						INNER JOIN produk on produk.id_produk = pembelian_temp.id_produk");
     
	echo "<thead>
                  <tr>
                    <th width=10%>NO</th>
                    <th width=30% >Nama Barang</th>
                    <th width=20%>Harga</th>
                    <th width=10%>Jumlah</th>
                    <th width=20%>Subtotal</th>
                    <th width=10%></th>
                  </tr>
                </thead>";
                $no=1;
                $total=mysql_fetch_array(mysql_query("select sum(subtotal) as total from pembelian_temp"));
                $totjum=mysql_fetch_array(mysql_query("select sum(jumlah) as total from pembelian_temp"));
           		while ($data=mysql_fetch_array($q)){
           		       
    echo"       <tbody>
                  <tr>
                    <td> ".$no++."</td>
    	          		<td> $data[nama_produk]</td>
    	          		<td>".format_rupiah($data[harga]). "</td>
    	          		<td> $data[jumlah]</td>
    	          		<td>".format_rupiah($data[subtotal]). "</td>
    	          		<td><a href='server.php?p=hapus&kode=$data[id_produk]' onclick=return confirm('Apakah anda yakin akan menghapus data ini?')  class='btn btn-danger'>Hapus</button></td>
                  </tr>";
         }
     echo" 		<tr>
     				<td colspan=3><b>TOTAL</b></td>
     				<td><b>$totjum[total]</b></td>
     				<td><b>".format_rupiah($total[total]). "</b></td>
     			</tr>        
                </tbody>";

}elseif($page=='hapus'){
    $kode=$_GET['kode'];
    $del=mysql_query("delete from pembelian_temp where id_produk='$kode'");
    if(!$del){
        echo "<script>window.location='index.php?page=transaksi_input';</script>";
    }else{
        echo "<script>alert('Hapus Data Berhasil');
            window.location='index.php?page=transaksi_input';</script>";
    }

} elseif ($page=='transaksi') {

    $total=mysql_fetch_array(mysql_query("select sum(subtotal) as total from pembelian_temp"));
    $totjum=mysql_fetch_array(mysql_query("select sum(jumlah) as total from pembelian_temp"));


    $id=$_POST['id'];
    $userid=$_POST['userid'];
    $supp=$_POST['supp'];
    $lama=$_POST['lama'];
    $tgl=$_POST['tgl'];

    $userid=$_POST['userid'];

    $tgl_buat=date('Y-m-d');

    $lama2="+$lama days";
    $jatuh_tempo= date('Y-m-d',strtotime($lama2,strtotime($tgl)));

    $sql = mysql_query("INSERT INTO pembelian values ('$id',
                                                          '$tgl',
                                                          '$supp',
                                                          '$lama',
                                                          '$jatuh_tempo',
                                                          '$totjum[total]',
                                                          '$total[total]',
                                                          '$total[total]',
                                                          'hutang',
                                                          '$userid',
                                                          '$tgl_buat',
                                                          '',
                                                          '')");
    if ($sql) {
          $query=mysql_query("SELECT * FROM pembelian_temp");
          while($r=mysql_fetch_row($query)){
              mysql_query("INSERT INTO pembelian_detail (kode_pembelian,id_produk,harga,jumlah,subtotal)
                        values('$id','$r[1]','$r[2]','$r[3]','$r[4]')");
              mysql_query("UPDATE produk set stok=stok-'$r[3]'
                        where id_produk='$r[1]'");
          }
          // bersih
          mysql_query("truncate table pembelian_temp");

      echo "<script>alert('Input transaksi berhasil.');
            window.location='index.php?page=transaksi';</script>";

    }


} elseif ($page=='del') {



   $kode=$_GET['kode'];
   mysql_query("delete from tb_sementara where kode_barang='$kode'");
} elseif ($page=='bayar') {
  $tgl = date('Y-m-d');
  $user = $_POST['user'];
  $datetime = date('Y-m-d H:i:s');

  $bay = mysql_query("INSERT INTO tb_pembayaran VALUES('',
                                                        '$tgl',
                                                        '$_POST[kodep]',
                                                        '$_POST[total]',
                                                        '$_POST[ket]')");
  $rubah = mysql_query("UPDATE tb_penjualan SET 
                      status='lunas',
                      denda='$denda',
                      id_user_edit='$userid',
                      tanggal_edit='$datetime'
                      WHERE kode_penjualan='$_POST[kodep]'");
  if ($bay and $rubah) {
    header('location:index.php?page=transaksi');
  } else {echo"Eror";}
} else {
  "error";
}
?>