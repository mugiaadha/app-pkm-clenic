<?php



$notrans=$_POST['notrans'];

$x=$_POST['x'];
$y=$_POST['y'];
$kg=$_POST['kg'];
$nomor=$_POST['nomor'];
 date_default_timezone_set('Asia/Jakarta');

 $tgl = date("Y-m-d H:i:s");



 



  include '../../../koneksi.php';
 
 $sql="SELECT keterangan FROM odontogram WHERE  notrans='$notrans' and nomor='$nomor' order by tgl desc ";

$result=mysqli_query($conn,$sql);
 $rowcount=mysqli_num_rows($result);
  
if($rowcount > 0){
 
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

      $keterangan = $row['keterangan'];

   }

}else{

$keterangan = '';
      
}

$ket = $keterangan.' '.$kg;


$conn -> query("UPDATE odontogram set keterangan='$ket'
WHERE  notrans='$notrans' and nomor='$nomor' ");




     $conn -> query("INSERT INTO odontogram(notrans,kode,x,y,keterangan,
                  nomor,tgl) 
               values('$notrans','$kg','$x','$y','$kg','$nomor','$tgl')");

 

echo "<script> setTimeout(function(){ 
 window.location.href = 'odontogram.php?kdcabang=003&notrans=$notrans&norm=&kddokter='}, 0);</script>";



?> 