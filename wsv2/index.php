<?php  
$URI 	= @$_GET['url'];
$URI  = @explode('/', $URI);

define('_URL', 'http://'.@$_SERVER['HTTP_HOST'].'/ws/');
define('_ROOT', @$_SERVER['DOCUMENT_ROOT'].'/ws/');
define('_HOME', '1');
date_default_timezone_set('Asia/Jakarta');
error_reporting(E_ALL);

$page    = @$URI[0]; 

/*yang lain udah terlanjur*/
$page1 = @$URI[1];
$nouser  = @$URI[2];








session_start();
if($page === 'auth'){
// token
	include 'token.php';

}else if($page.$page1 === 'antrean'){
// ambilantrian
include 'daftar.php';




}else if($page.$page1 === 'peserta'){
// pasienbaru
include 'pasien.php';



}else if($page.$page1 === 'antreanstatus'){
// statusantrian
	include 'statusan.php';

// echo "statusantrian";


}else if($page.$page1 === 'antreansisapeserta'){
// sisaantrean
include 'sisaan.php';
// echo "sisaantrean";

}else if($page.$page1 === 'antreanbatal'){

// sisaantrean
include 'batal.php';
// echo "batal";


}else{

echo "BASE URL TIDAK ADA ROOT DOKUMEN";


}




		// if (is_file($page.'.php')) 
		// {
		// 	include $page.'.php';
		// }else
		// if (is_file('lembar-pendukung/'.$page.'.php')) 
		// {
		// 	include 'lembar-pendukung/'.$page.'.php';
		// }else
		// if (is_file('icu/'.$page.'.php')) 
		// {
		// 	include 'icu/'.$page.'.php';
		// }else





?>


