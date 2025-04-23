    <?php


$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$nolembar=$_POST['nolembar'];
$x=$_POST['x'];
$y=$_POST['y'];
$kduser =$_POST['kduser'];

 date_default_timezone_set('Asia/Jakarta');
     $tgl = date("Y-m-d H:i");
 include '../../config.php';







    ?>






<?php


if(isset($_POST['simpan'])){
 
$yx=$_POST['y']*36; 

$sql="INSERT INTO ERMTTVOBAT (notrans, norm, nolembar, tanggal, obat, jenisobat, obatx, obaty,status)
        VALUES ('$notrans','$norm','$nolembar','$tgl','','','$x','$yx','transfusi')";
$sqlq=sqlsrv_query($conn,$sql);




echo $sql;


echo "<script> setTimeout(function(){ 
 window.location.href = 'ttv.php?notrans=$notrans&norm=$norm&nolembar=$nolembar&kduser=$kduser'}, 0);</script>";


}else{


}


?>




 <form  action="transfusi.php" method="POST">
                       
<h2>Apakah anda yakin transfusi sampe kolom ini ?</h2>


 <input   type="hidden" name='notrans' value="<?php echo $notrans ?>">
                                  <input  type="hidden" name='norm' value="<?php echo $norm ?>">
                                   <input  type="hidden"  name='nolembar' value="<?php echo $nolembar ?>">
   
   
    <input  type="hidden"  name='x' value="<?php echo $x ?>">
<input type="hidden"  name='y' value="<?php echo $y ?>">
<input    type="hidden" name='kduser' value="<?php echo $kduser ?>">


<row>

<td>
   <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
                       
</td>


<td>
     <button type="submit" name="simpan" class="btn w3-red">Setuju</button>
    
  </td>
 
</row>



                     
 </form>







