    <?php


$no=$_POST['no'];

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

$sqlrt = "SELECT * FROM  ERMEWSNYERI
WHERE  no='$no'";
$paramsrt = array();
$optionsrt =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmtrt = sqlsrv_query( $conn, $sqlrt , $paramsrt, $optionsrt );

$row_countrt = sqlsrv_num_rows( $stmtrt );
   

if($row_countrt <= 0){


?>


<?php?><?php

}else{


?> 


<?php

 $stmtrt = sqlsrv_query( $conn, $sqlrt );
                                     
 while( $rowsrt = sqlsrv_fetch_array( $stmtrt, SQLSRV_FETCH_ASSOC) ) {

?>
<form  action="asesmennyeri.php" method="POST">
                       




<table>
    <tr>
<td>
     <label class='w3-label w3-text'>Tanggal </label>
</td>
<td>
   <input type="date" name="tgl" placeholder="tgl"  value="<?php echo date_format($rowsrt['tanggal'],'Y-m-d') ?>" required>
     ,                   
    <input type="time" name="tgltime" placeholder="menit"  value="<?php echo date_format($rowsrt['tgltime'],'H:i') ?>" required>
                        
</td>
  </tr>
  <tr>
<td>
     <label class='w3-label w3-text'>Provokasi </label>
</td>
<td>
   <input type="text" name="p" placeholder="Provokasi" value="<?php echo $rowsrt['p'] ?>" required>
   <input type="hidden" name="no" placeholder="Provokasi" value="<?php echo $rowsrt['no'] ?>" required>
   <input type="hidden" name="notrans" placeholder="Provokasi" value="<?php echo $rowsrt['notrans'] ?>" required>
                        
   <input type="hidden" name="norm" placeholder="Provokasi" value="<?php echo $rowsrt['norm'] ?>" required>
                        
                        
                        
</td>
  </tr>
  <tr>
    <td>
 <label class='w3-label w3-text'>Kualitas </label>
    </td>
        <td>
   <input type="text" name="q" placeholder="Kualitas" value="<?php echo $rowsrt['q'] ?>" required>
                    
    </td>
  </tr>
  <tr>
<td>
 <label class='w3-label w3-text'>Lokasi </label>
</td>

<td>
   <input type="text" name="r" placeholder="Lokasi" value="<?php echo $rowsrt['r'] ?>" >
                     
</td>
  </tr>




 <tr>
<td>
     <label class='w3-label w3-text'>Skala </label>
</td>
<td>
   <input type="text" name="s" placeholder="Skala" value="<?php echo $rowsrt['s'] ?>" required>
                        
                        
</td>
  </tr>
  <tr>
    <td>
 <label class='w3-label w3-text'>Waktu </label>
    </td>
        <td>
   <input type="text" name="t" placeholder="Waktu"  value="<?php echo $rowsrt['t'] ?>" required>
                    
    </td>
  </tr>
  <tr>
<td>
 <label class='w3-label w3-text'>Intervensi </label>
</td>

<td>
   <input type="text" name="infar" placeholder="Intervensi" value="<?php echo $rowsrt['intervensi'] ?>" >
                     
</td>
  </tr>

</table>



                          
                        <br>



<table>
  <td>
     <button type="submit" name="hapus" class="btn w3-red block">Hapus</button>

  </td>
    <td>
       <button type="submit" name="edit" class="btn w3-yellow block">Edit</button>
  </td>

</table>
<!-- <row>
<tr>
  
</tr>
<tr>
  
</tr>



</row> -->
                       
                        
 </form>




<?php }?>


   


<?php





}

?>





    


