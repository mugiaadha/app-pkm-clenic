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

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}



</style>




<?php
include '../../config.php';
$sqlrt = "SELECT   * FROM            ERMTTVOBAT
WHERE        (nolembar = '$nolembar')  AND (obatx = '$x') AND (obaty = '$y') and notrans='$notrans' ";
$paramsrt = array();
$optionsrt =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmtrt = sqlsrv_query( $conn, $sqlrt , $paramsrt, $optionsrt );

$row_countrt = sqlsrv_num_rows( $stmtrt );
   

if($row_countrt <= 0){


?>





   <form  action="svsigna.php" method="POST">
 <input  type='hidden'  name='notrans' value="<?php echo $notrans ?>">
 <input type='hidden'  name='norm' value="<?php echo $norm ?>">
<input  type='hidden' name='nolembar' value="<?php echo $nolembar ?>">
<input    type='hidden' name='x' value="<?php echo $x ?>">
<input  type='hidden' name='y' value="<?php echo $y ?>">
<input  type="hidden"  name='kduser' value="<?php echo $kduser ?>">
<div  class='w3-row'>
<table>
  <tr>
<td>
     <label class='w3-label w3-text'>Signa </label>
</td>
<td>
   <input type="text" name="signa" placeholder="Signa" required>
                   
</td>
  </tr>
  
 <tr>
  <td>
     <label class='w3-label w3-text'>Jenis Obat </label>
  </td>
    <td>
       <select name="sobat" required>
         <option value=""></option>
         <option value="Injeksi">Injeksi (M)</option>
        <option value="Non Injeksi">Non Injeksi (H)</option>
       </select>
  </td>
</tr>
</table>

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


   <form  action="editsigna.php" method="POST">
 <input  type='hidden'  name='notrans' value="<?php echo $notrans ?>">
 <input type='hidden'  name='norm' value="<?php echo $norm ?>">
<input  type='hidden' name='nolembar' value="<?php echo $nolembar ?>">
<input   type='hidden' name='x' value="<?php echo $x ?>">
<input type='hidden' name='y' value="<?php echo $y ?>">
<input  type="hidden"  name='kduser' value="<?php echo $kduser ?>">
<div  class='w3-row'>
<table>
  <tr>
<td>
     <label class='w3-label w3-text'>Signa </label>
</td>
<td>
   <input type="text" name="signa" value="<?php echo $rowsrt['obat']?>" placeholder="Signa" required>
                   
</td>
  </tr>
  
 <tr>
  <td>
     <label class='w3-label w3-text'>Jenis Obat </label>
  </td>
    <td>
       <select  name="sobat" required>
         <option  value="<?php echo $rowsrt['jenisobat']?>" ><?php echo $rowsrt['jenisobat']?></option>
         <option value="Injeksi">Injeksi (M)</option>
        <option value="Non Injeksi">Non Injeksi (H)</option>
       </select>
  </td>
</tr>
</table>

 </div>
 <br>
<button type="submit" name="simpan" class="btn w3-red">Simpan</button>
 <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
 </form>



<?php }?>


   


<?php





}

?>











 


