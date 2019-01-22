<?php 
$sql2 = mysql_query("SELECT max(kode_pembelian) as maxKode FROM pembelian");
$data  = mysql_fetch_array($sql2);
$kodePembelian = $data['maxKode'];
$noUrut = (int) substr($kodePembelian, 2, 6);
$noUrut++;
$char = "TR";
$newID = $char . sprintf("%06s", $noUrut);

 ?>