<?php

$uang = 83250;
$ratusan = substr($uang, -2);


 if($ratusan < 100){
 $akhir = $uang - $ratusan;
 }else{
 $akhir = $uang + (100-$ratusan);
}


echo $akhir;


?>