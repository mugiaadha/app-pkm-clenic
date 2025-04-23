    <?php


$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$nolembar=$_POST['nolembar'];

$kduser =$_POST['kduser'];



date_default_timezone_set('Asia/Jakarta');
$tgl = date("Y-m-d H:i");
 include '../../config.php';







    ?>






<?php


if(isset($_POST['simpan'])){

 $sql2 ="DELETE ERMEWSWAKTU  where notrans = '$notrans' and nolembar='$nolembar'";
$outp=sqlsrv_query($conn,$sql2);




 $sql2x ="DELETE ERMEWSNOLEMBAR  WHERE        (notrans = '$notrans') AND (status = 'EWS') AND (nolembar = '$nolembar')";
$outp=sqlsrv_query($conn,$sql2x);






 $sql2xx ="DELETE ERMEWSHASILFIX  WHERE   
      (notrans = '$notrans') AND (nolembar = '$nolembar')";
$outp=sqlsrv_query($conn,$sql2xx);


echo "<script> setTimeout(function(){ 
 window.location.href = 'ews.php?notrans=$notrans&norm=$norm&nolembar=$nolembar&kduser=$kduser'}, 0);</script>";


}else{

}


?>




 <form  action="hapuslembar.php" method="POST">
                       
<h2> APAKAH YAKIN AKAN MENGHAPUS LEMBAR INI</h2>


 <input type='hidden'  name='notrans' value="<?php echo $notrans ?>">
                                  <input  type='hidden' name='norm' value="<?php echo $norm ?>">
                                   <input type='hidden'  name='nolembar' value="<?php echo $nolembar ?>">
   
   

<input type='hidden'   name='kduser' value="<?php echo $kduser ?>">







<row>


<td><button type='submit' name='simpan' class='btn w3-green'>SETUJU</button></td>




<td>
    
    
  </td>
</row>



                     
 </form>







