<?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$nolembar=$_POST['nolembar'];

$x=$_POST['x'];
$y=$_POST['y'];

$jam=$_POST['jam'];
$menit=$_POST['menit'];
$rr=$_POST['rr'];
$sat=$_POST['sat'];
$ao=$_POST['ao'];
$alat=$_POST['alat'];
$temp=$_POST['temp'];
$td=$_POST['td'];
$hr=$_POST['hr'];
$lk=$_POST['lk'];
$gd=$_POST['gd'];
$sn=$_POST['sn'];
$uo=$_POST['uo'];
$tdd=$_POST['tdd'];


$ekg=$_POST['ekg'];
$scan=$_POST['scan'];
$eskalasi=$_POST['eskalasi'];

 date_default_timezone_set('Asia/Jakarta');
 $tgl = date("Y-m-d H:i");


 



include '../../config.php';



if ($rr >= 25){
$rry=55;
$rrn=3;

}else if($rr <= 8){
$rry=127;
$rrn=3;
}else if ($rr >= 9 && $rr <= 11){
$rry=109;
$rrn=1;
}else if ($rr >= 12 && $rr <= 20){
$rry=91;
$rrn=0;
}else if ($rr >= 21 && $rr <= 24){
$rry=73;
$rrn=2;
}else{
echo "no";
 }


if ($sat >= 96){
$saty=145;
$satn=0;
}else if($sat <= 91){
$saty=199;
$satn=3;
}else if ($sat >= 92 && $sat <= 93){
$saty=181;
$satn=2;
}else if ($sat >= 94 && $sat <= 95){
$saty=163;
$satn=1;



}else{
echo "no";
 }


$aoy=217;

if (!empty($ao))
{
   $aon=2;
}
else
{
      $aon=0;
}


$alaty=235;



if ($temp  < 35){
$tempy=325;
$tempn=3;
}else if($temp < 36){
$tempy=307;
$tempn=1;

}else if ($temp < 37){
$tempy=289;
$tempn=0;

}else if ($temp < 38 ){
$tempy=271;
$tempn=1;
}else if ($temp < 39 ){
$tempy=253;
$tempn=2;

}else if ($temp >= 39 ){
$tempy=253;
$tempn=2;

}else{
echo "no";
 }



if ($td < 50){
$tdy=667;
	$tdn=3;
}else if($td < 60){
$tdy=649;
	$tdn=3;
}else if ($td < 70) {
	# code...
$tdy=631;
	$tdn=3;
}else if ($td < 80) {
	# code...
$tdy=613;
	$tdn=3;
}else if ($td < 90) {
	# code...
	$tdy=595;
	$tdn=2;
}else if ($td < 100) {
	# code...
$tdy=577;
$tdn=2;
}else if ($td < 110) {
	# code...
		$tdy=559;
	$tdn=1;
}else if ($td < 120) {
	# code...
	$tdy=541;
	$tdn=0;
}else if ($td < 130) {
	# code...
	$tdy =523;
	$tdn=0;
}else if ($td < 140) {
	# code...
	$tdy=505;
	$tdn=0;
}else if($td < 150){
		$tdy = 487;
	$tdn=0;
}else if ($td < 160) {
	# code...
		$tdy =469;
	$tdn=0;
}else if ($td < 170) {
	# code...
		$tdy =451;
	$tdn=0;
}else if ($td < 180) {
	# code...
	$tdy=433;
	$tdn=0;
}else if ($td < 190) {
	# code...
$tdy=415;
$tdn=0;
}else if ($td < 200) {
	# code...
	# code...
$tdy =397;
$tdn=0;
}else if ($td < 210) {
	# code...
	# code...
	$tdy=379;
	$tdn=0;
}else if ($td < 220) {
	# code...
	$tdy=361;
$tdn=0;
}else if ($td < 230) {
	# code...
$tdy=343;
$tdn=0;
}else if($td >= 230){
$tdy=343;
$tdn=0;
}
 



if ($tdd < 50){
$tddy=667;

}else if($tdd < 60){
$tddy=649;

}else if ($tdd < 70) {
	# code...
$tddy=631;

}else if ($tdd < 80) {
	# code...
$tddy=613;

}else if ($tdd < 90) {
	# code...
	$tddy=595;

}else if ($tdd < 100) {
	# code...
$tddy=577;

}else if ($tdd < 110) {
	# code...
		$tddy=559;

}else if ($tdd < 120) {
	# code...
	$tddy=541;
	
}else if ($tdd < 130) {
	# code...
	$tddy =523;
	
}else if ($tdd < 140) {
	# code...
	$tddy=505;

}else if($tdd < 150){
		$tddy = 487;

}else if ($td < 160) {
	# code...
		$tddy =469;
	
}else if ($tdd < 170) {
	# code...
		$tddy =451;
	
}else if ($tdd < 180) {
	# code...
	$tddy=433;

}else if ($tdd < 190) {
	# code...
$tddy=415;

}else if ($tdd < 200) {
	# code...
	# code...
$tddy =397;

}else if ($tdd < 210) {
	# code...
	# code...
	$tddy=379;

}else if ($tdd < 220) {
	# code...
	$tddy=361;

}else if ($tdd < 230) {
	# code...
$tddy=343;

}else if($tdd >= 230){
$tddy=343;

}



// echo $tdy;



if($hr < 30){
# code...
	$hry=883;
	$hrn=3;

}else if ($hr < 40) {
$hry=865;
	$hrn=3;

}else if($hr < 50){
$hry=847;
	$hrn=1;
}else if ($hr < 60) {
	# code...
		$hry=829;
	$hrn=0;

}else if ($hr < 70) {
	# code...
		$hry=811;
	$hrn=0;
}else if ($hr < 80) {
	# code...
$hry=793;
	$hrn=0;
}else if ($hr < 90) {
	# code...
	# code...
	$hry=775;
	$hrn=1;

}else if ($hr < 100) {
	# code...
$hry=757;
$hrn=1;
}else if ($hr < 110) {
	# code...
	# code...
	$hry=739;
	$hrn=1;
}else if ($hr < 120) {
	# code...
# code...
	$hry=721;
	$hrn=2;

}else if ($hr < 130) {
	# code...
	$hry =703;
	$hrn=2;
}else if ($hr < 140) {
	# code...
$hry=685;
$hrn=3;
}else if ($hr >= 140 ) {
	# code...
$hry=685;
$hrn=3;
}


if($lk == 'Alert'){
$lky=901;
$lkn=0;

}else if($lk == 'V'){
$lky=919;
$lkn=3;
}else if ($lk == 'P') {
	# code...
	$lky=919;
	$lkn=3;
}else if($lk == 'U'){
	$lky=919;
	$lkn=3;

}

$gdy=937;
$totalskory=955;
$skornyeriy=973;
$uoy=991;
$freky=1009;

$totalskor = $rrn + $satn + $tempn + $tdn + $hrn + $lkn + $aon;


// echo "tskor=".$totalskor."<br>"; 


if ($totalskor == 0){
	$fm=12;
}else if ($totalskor >= 1 && $totalskor <= 4 ) {
	# code...
	$fm=6;
}else if ($totalskor == 5 ){
$fm=1;
}else if ($totalskor == 6) {
	# code...
	$fm=1;
}else if ($totalskor > 7) {
	# code...
	$fm=0.5;
}


$sql="UPDATE ERMEWSWAKTUL set jam='$jam',menit='$menit' where notrans='$notrans' and nolembar='$nolembar' and jamx='$x'";

// $sql="INSERT INTO ERMEWSWAKTU (notrans, norm, nolembar, jam, menit, jamx, jamy)
// VALUES ('$notrans','$norm','$nolembar','$jam','$menit','$x','$y')";
$sqlq=sqlsrv_query($conn,$sql);



$sqls ="UPDATE ERMEWSHASILFIXL set rr='$rr', rrx='$x', rry='$rry', sat='$sat', satx='$x', saty='$saty', ao='$ao', aox='$x', aoy='$aoy', alat='$alat', alatx='$x', alaty='$alaty', temp='$temp', tempx='$x', tempy='$tempy', td='$td', tdx='$x', tdy='$tdy', hr='$hr', hrx='$x', hry='$hry', lk='$lk', lkx='$x', lky='$lky', gd='$gd', 
                       gdx='$x', gdy='$gdy', totalskor='$totalskor', totalskorx='$x', totalskory='$totalskory', sn='$sn', snx='$x', sny='$skornyeriy', uo='$uo', uox='$x', uoy='$uoy', fm='$fm', fmx='$x', fmy='$freky',tdd='$tdd',tddy='$tddy',ekg='$ekg',scan='$scan',eskalasi='$eskalasi'

                        where notrans='$notrans' and nolembar='$nolembar' and rrx='$x'";

 $sqlqs=sqlsrv_query($conn,$sqls);


// $sqls="INSERT INTO ERMEWSHASILFIX (tanggal, notrans, norm, nolembar, rr, rrx, rry, sat, satx, saty, ao, aox, aoy, alat, alatx, alaty, temp, tempx, tempy, td, tdx, tdy, hr, hrx, hry, lk, lkx, lky, gd, 
//                          gdx, gdy, totalskor, totalskorx, totalskory, sn, snx, sny, uo, uox, uoy, fm, fmx, fmy,tdd,tddy)
// VALUES ('$tgl', '$notrans', '$norm', '$nolembar', '$rr', '$x', '$rry', '$sat', '$x', '$saty', '$ao', '$x', '$aoy', '$alat', '$x', '$alaty', '$temp', '$x', '$tempy', '$td', '$x', '$tdy', '$hr', '$x', '$hry', '$lk', '$x', '$lky', '$gd', 
//                          '$x', '$gdy', '$totalskor', '$x', '$totalskory', '$sn', '$x', '$skornyeriy', '$uo', '$x', '$uoy', '$fm', '$x', '$freky','$tdd','$tddy')";
// $sqlqs=sqlsrv_query($conn,$sqls);


// echo "<script> setTimeout(function(){ 
//  window.location.href = 'ews.php?notrans=$notrans&norm=$norm&nolembar=$nolembar'}, 0);</script>";

echo "<script> setTimeout(function(){ 
 window.location.href = 'mows.php?notrans=$notrans&norm=$norm&nolembar=$nolembar&kduser=$kduser'}, 0);</script>";

?> 
