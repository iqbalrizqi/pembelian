<?php 
session_start();
$userid=$_SESSION['id'];
require "config/main.php";
$type = trim($_POST['type']);
$cmd = trim($_POST['cmd']);

switch ($type) {
	case 'kategori':
		if ($cmd=="tambah") {
			mysql_query("INSERT INTO kategori(nama_kategori,id_user)
			VALUES('$_POST[nama]','$_SESSION[id]')");
		}
		elseif($cmd=="edit") {
			mysql_query("UPDATE kategori SET nama_kategori='$_POST[nama]'
				WHERE id_kategori='$_POST[id]'");
		}
		else {
			die(); 
		}
		header('Location:index.php?page=kategori');
		break;
	case 'produk':
		if ($cmd=="tambah") {
			mysql_query("INSERT INTO produk
			VALUES('',
					'$_POST[nama]',
					'$_POST[kategori]',
					'$_POST[satuan]',
					'$_POST[jumlah]',
					'$_POST[harga]',
					'$_POST[ukuran]',
					'$_POST[desk]',
					'$_SESSION[id]')");
		}
		elseif($cmd=="edit") {
			mysql_query("UPDATE produk SET 
					nama_produk='$_POST[nama]',
					id_kategori='$_POST[kategori]',
					satuan='$_POST[satuan]',
					stok='$_POST[jumlah]',
					harga='$_POST[harga]',
					ukuran='$_POST[ukuran]',
					deskripsi='$_POST[desk]'
					WHERE id_produk='$_POST[id]'");
		}
		else {
			die(); 
		}
		header('Location:index.php?page=produk');
		break;
	case 'supplier':
		if ($cmd=="tambah") {
			mysql_query("INSERT INTO supplier
			VALUES('',
					'$_POST[nama]',
					'$_POST[alamat]',
					'$_POST[telp]',
					'$_SESSION[id]')");
		}
		elseif($cmd=="edit") {
			mysql_query("UPDATE supplier SET
					nama_supplier='$_POST[nama]',
					alamat_supplier='$_POST[alamat]',
					no_telp='$_POST[telp]'
					WHERE id_supplier='$_POST[id]'");
		}
		else {
			die(); 
		}
		header('Location:index.php?page=supplier');
		break;
	case 'data_user':
		if ($cmd=="tambah") {
			mysql_query("INSERT INTO tb_user(username,nama,alamat,password,level)
			VALUES('$_POST[username]',
					'$_POST[nama]',
					'$_POST[alamat]',
					'$_POST[password]',
					'admin')");
		}
		elseif($cmd=="edit") {
			mysql_query("UPDATE tb_user SET username='$_POST[username]',
				nama='$_POST[nama]',
				alamat='$_POST[alamat]',
				password='$_POSxT[password]',
				WHERE id_user='$_POST[id]'");
		}
		else {
			die(); 
		}
		header('Location:index.php?page=data_user');
		break;

	case 'bayar':
			$tgl=date('Y-m-d');
		  	$sql=mysql_query("INSERT INTO pembayaran(tgl_pembayaran,kode_pembelian,id_user,jumlah_bayar,ket)
			VALUES('$tgl',
					'$_POST[id]',
					'$_SESSION[id]',
					'$_POST[jumlah]',
					'$_POST[ket]')");
		  	$sisa=$_POST['sisa']-$_POST['jumlah'];
		  	if ($sql) {
		  		mysql_query("UPDATE pembelian SET sisa_pembayaran='$sisa'");
		  		if ($sisa==0) {
		  			mysql_query("UPDATE pembelian SET status='lunas',id_user_edit='$_SESSION[id]',tanggal_edit='$tgl' where kode_pembelian='$_POST[id]'");
		  		}
		  	echo "<script>alert('Berhasil menyiman');
            window.location='index.php?page=cek_barang';</script>";
		  	}
		
		break;
		
	case 'cek_barang':
		if ($cmd=="tambah") {
			$sql=mysql_query("INSERT INTO cek_barang(kode_pembelian,jumlah,ket,id_user)
			VALUES('$_POST[id]',
			'$_POST[jumlah]',
			'$_POST[ket]',
			'$_SESSION[id]')");
			
			if ($sql) {
			 echo "<script>alert('Berhasil menyiman');
            window.location='index.php?page=cek_barang';</script>";
			} else{
				echo "Gagal";
			}

		}
		break;
	
	default:
		require_once("pages/404.php");
		break;
}

 ?>