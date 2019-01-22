<?php 
if (isset($_GET['hapus'])) {
	require "config/main.php";
	switch ($_GET['hapus']) {
		case 'kategori':
			mysql_query("DELETE FROM kategori WHERE id_kategori=".$_GET['id']);
			header('Location:index.php?page='.$_GET['hapus']);
			break;
		case 'produk':
			mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
			header('Location:index.php?page='.$_GET['hapus']);
			break;
		case 'supplier':
			mysql_query("DELETE FROM supplier WHERE id_supplier='$_GET[id]'");
			header('Location:index.php?page='.$_GET['hapus']);
			break;
		case 'data_user':
			mysql_query("DELETE FROM tb_user WHERE id_user=".$_GET['id']);
			header('Location:index.php?page='.$_GET['hapus']);
			break;
		case 'data_pembelian':
			mysql_query("DELETE FROM user WHERE id=".$_GET['id']);
			header('Location:index.php?page='.$_GET['hapus']);
			break;
		case 'data_teknisi':
			mysql_query("DELETE FROM teknisi1 WHERE id=".$_GET['id']);
			header('Location:index.php?page='.$_GET['hapus']);
			break;
		case 'spk':
			mysql_query("DELETE FROM teknisi WHERE id=".$_GET[id]);
			header('Location:index.php?page='.$_GET['hapus']);
			break;
		case 'admin':
			mysql_query("DELETE FROM admin WHERE id=".$_GET[id]);
			header('Location:index.php?page='.$_GET['hapus']);
			break;
		
		default:
			require_once("pages/404.php");
			break;
	}
}
else {
	require_once("pages/home.php");
}

 ?>