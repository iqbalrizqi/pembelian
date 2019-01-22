<?php
require "config/main.php";

$user 	= $_POST['tUser'];
$pwd   	= sha1($_POST['tPwd']);

$hasil  = mysql_query("SELECT * FROM user WHERE username='$user' AND
						password='$pwd'");
$hitung = mysql_num_rows($hasil);
$data   = mysql_fetch_array($hasil);

if ($hitung > 0){
	session_start();
	$_SESSION['username'] = $data['username'];
	$_SESSION['password'] = $data['password'];
	$_SESSION['nama'] = $data['nama'];
	$_SESSION['level'] = $data['level'];
	$_SESSION['id'] = $data['id_user'];
	
	header('Location:index.php');
}else{
   echo "<script>alert('GAGAL..!!!!!, Silakan Ulangi Lagi'); window.location = 'login.php'</script>";
}
?>