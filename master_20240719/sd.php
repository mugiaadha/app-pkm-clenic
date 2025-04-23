<?php


date_default_timezone_set( 'Asia/Bangkok' );


$tgl = date("Y-m-d");




$tgl1 = "2013-01-23";// pendefinisian tanggal awal
$tgl2 = date('Y-m-d', strtotime('-7 days', strtotime($tgl))); //operasi penjumlahan tanggal sebanyak 6 hari
echo $tgl2; //print tanggal


?>