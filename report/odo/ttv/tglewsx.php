    <?php



$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$nolembar=$_POST['nolembar'];
$x=$_POST['x'];
$y=$_POST['y'];
$kduser=$_POST['kduser'];
 date_default_timezone_set('Asia/Jakarta');
     $tgl = date("Y-m-d H:i");
 





    ?>

<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}


</style>





<?php




$sqlsd = "SELECT * FROM  ERMEWSTGL where  notrans='$notrans' and nolembar='$nolembar' ";
$paramsrt = array();
$optionsrt =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmtrt = sqlsrv_query( $conn, $sqlrt , $paramsrt, $optionsrt );

$row_countrt = sqlsrv_num_rows( $stmtrt );
   

   // echo $row_countrt;

if($row_countrt <= 0){


?>


    <form  action="svtglews.php" method="POST">
                       

 <input  type='hidden'  name='notrans' value="<?php echo $notrans ?>">
                                  <input  type='hidden'  name='norm' value="<?php echo $norm ?>">
                                   <input  type='hidden'  name='nolembar' value="<?php echo $nolembar ?>">
                                   <input  type='hidden'  name='x' value="<?php echo $x ?>">
<input  type='hidden' name='y' value="<?php echo $y ?>">
<input type='hidden' name='kduser' value="<?php echo $kduser ?>">
 <div class='w3-row'>
                          <div class='w3-col'>
                                   

                                     <label class='w3-label w3-text'>Tanggal </label>
                             
                         <input type="date" name="tanggal" placeholder="Tanggal" required>

                         
                                </div>

                       

</div>



                          
                        <br>

                        <button type="submit" name="simpan" class="btn w3-red">Simpan</button>
                          <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
 </form>



<?php?><?php

}else{


 
?> 


<?php

 $stmtrt = sqlsrv_query( $conn, $sqlrt );
                                     
 while( $rowsrt = sqlsrv_fetch_array( $stmtrt, SQLSRV_FETCH_ASSOC) ) {

?>






    <form  action="svtglews.php" method="POST">
                       

 <input  type='hidden'  name='notrans' value="<?php echo $notrans ?>">
                                  <input  type='hidden'  name='norm' value="<?php echo $norm ?>">
                                   <input  type='hidden'  name='nolembar' value="<?php echo $nolembar ?>">
                                   <input  type='hidden'  name='x' value="<?php echo $x ?>">
<input  type='hidden' name='y' value="<?php echo $y ?>">
<input type='hidden' name='kduser' value="<?php echo $kduser ?>">
 <div class='w3-row'>
                          <div class='w3-col'>
                                   

                                     <label class='w3-label w3-text'>Tanggal </label>
                             
                         <input type="date" value="<?php echo $rowsrt['tanggal'] ?>" name="tanggal" placeholder="Tanggal" required>

                         
                                </div>

                       

</div>



                          
                        <br>

                        <button type="submit" name="simpan" class="btn w3-red">Edit</button>
                          <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
 </form>











<?php }?>


   


<?php





}

?>