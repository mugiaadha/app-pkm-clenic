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

$sqlrt = "SELECT * FROM  ERMTTVOPERASI where  notrans='$notrans' and nolembar='$nolembar' and status='TITIKATAS'";
$paramsrt = array();
$optionsrt =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmtrt = sqlsrv_query( $conn, $sqlrt , $paramsrt, $optionsrt );

$row_countrt = sqlsrv_num_rows( $stmtrt );
   

if($row_countrt <= 0){




$sql="INSERT INTO ERMTTVOPERASI (tanggal,notrans, norm, nolembar, x, y, x1, y1, status, kduser
)
        VALUES ('$tgl','$notrans','$norm','$nolembar','$x','$y','x','x','TITIKATAS','$kduser')";
$sqlq=sqlsrv_query($conn,$sql);






}else{
 $sql="UPDATE ERMTTVOPERASI set x1='$x', y1='$y'
where  nolembar = '$nolembar'  and notrans='$notrans' and status='TITIKATAS'";

$sqlq=sqlsrv_query($conn,$sql);




}

 



echo "<script> setTimeout(function(){ 
 window.location.href = 'ttv.php?notrans=$notrans&norm=$norm&nolembar=$nolembar&kduser=$kduser'}, 0);</script>";

}else if(isset($_POST['simpan1'])){

$sqlrt = "SELECT * FROM  ERMTTVOPERASI where  notrans='$notrans' and nolembar='$nolembar' and status='TITIKBAWAH'";
$paramsrt = array();
$optionsrt =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmtrt = sqlsrv_query( $conn, $sqlrt , $paramsrt, $optionsrt );

$row_countrt = sqlsrv_num_rows( $stmtrt );
   

if($row_countrt <= 0){




$sql="INSERT INTO ERMTTVOPERASI (tanggal,notrans, norm, nolembar, x, y, x1, y1, status, kduser
)
        VALUES ('$tgl','$notrans','$norm','$nolembar','$x','$y','x','x','TITIKBAWAH','$kduser')";
$sqlq=sqlsrv_query($conn,$sql);






}else{
 $sql="UPDATE ERMTTVOPERASI set x1='$x', y1='$y'
where  nolembar = '$nolembar'  and notrans='$notrans' and status='TITIKBAWAH'";

$sqlq=sqlsrv_query($conn,$sql);




}

 



echo "<script> setTimeout(function(){ 
 window.location.href = 'ttv.php?notrans=$notrans&norm=$norm&nolembar=$nolembar&kduser=$kduser'}, 0);</script>";
}else if(isset($_POST['hapus'])){

// SELECT * FROM  ERMTTVOPERASI where  notrans='RBI-21-03-823' and nolembar='LBR220321002'



 $sql2 ="DELETE ERMTTVOPERASI where   notrans='$notrans' and nolembar='$nolembar'";
$outp=sqlsrv_query($conn,$sql2);


echo "<script> setTimeout(function(){ 
 window.location.href = 'ttv.php?notrans=$notrans&norm=$norm&nolembar=$nolembar&kduser=$kduser'}, 0);</script>";
}else{

}


?>




 <form  action="operasi.php" method="POST">
                       
<h2>Apakah anda yakin operasi sampe kolom ini ?</h2>


 <input  type="hidden" name='notrans' value="<?php echo $notrans ?>">
                                  <input  type="hidden"  name='norm' value="<?php echo $norm ?>">
                                   <input  type="hidden"  name='nolembar' value="<?php echo $nolembar ?>">
   
   
    <input   type="hidden"   name='x' value="<?php echo $x ?>">
<input  type="hidden" name='y' value="<?php echo $y ?>">
<input  type="hidden"   name='kduser' value="<?php echo $kduser ?>">


<row>





  <?php


$sqlrtx = "SELECT * FROM  ERMTTVOPERASI where  notrans='$notrans' and nolembar='$nolembar' and status='TITIKATAS'";
$paramsrtx = array();
$optionsrtx =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmtrtx = sqlsrv_query( $conn, $sqlrtx , $paramsrtx, $optionsrtx );

$row_countrtx = sqlsrv_num_rows( $stmtrtx );

if($row_countrtx <= 0){


echo "<td><button type='submit' name='simpan' class='btn w3-green'>SETUJU 1</button></td>";

echo "<td><button type='submit' name='hapus' class='btn w3-red'>HAPUS</button></td>";

}else{

   $sqls = "SELECT * FROM   ERMTTVOPERASI where notrans='$notrans' and nolembar='$nolembar' and status='TITIKATAS'";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {

              
if($rows['x1'] == 'x' && $rows['y1'] == 'x' ){
echo "<td><button type='submit' name='simpan' class='btn w3-green'>SETUJU 1</button></td>";
echo "<td><button type='submit' name='hapus' class='btn w3-red'>HAPUS</button></td>";


}else{

echo "<td>
     <button type='submit' name='simpan1' class='btn w3-red'>SETUJU 2</button>
    
  </td>";

echo "<td><button type='submit' name='hapus' class='btn w3-red'>HAPUS</button></td>";

}





                                      }

}











  


  ?>




  
                       




 
</row>



                     
 </form>







