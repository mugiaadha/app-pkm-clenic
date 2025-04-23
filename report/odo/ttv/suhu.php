    <?php


$notrans=$_POST['notrans'];
$norm=$_POST['norm'];
$nolembar=$_POST['nolembar'];
$x=$_POST['x'];
$y=$_POST['y'];
$kduser =$_POST['kduser'];

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

<script src="../js/jquery-1.12.2.min.js"></script>
<script src="../js/jquery-ui/jquery-ui.min.js"></script>






<?php
include '../../config.php';
$sqlrt = "SELECT top 1  a.notrans, a.norm, a.nolembar, suhu, suhux, suhuy, nadi, nadix, nadiy, resp, respx, respy, tds, tdsx, tdsy, tdd, tddx, tddy, e, ex, ey, m, mx, my, v, vx, 
                         vy, username
,b. spo, spox, spoy, balance, balancex, balancey, input, inputx, inputy, b.output, outputx, outputy, urine, urinex, uriney, 
 muntah, muntahx, muntahy, defeksi, defeksix, defeksiy FROM ERMTTVVITAL a,ERMTTVVITALD b
WHERE       
a.notrans = b.notrans and 
a.nolembar = b.nolembar and (a.notrans = '$notrans')  and a.nolembar='$nolembar' AND (a.suhux = '$x') and b.spox='$x' ";
$paramsrt = array();
$optionsrt =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmtrt = sqlsrv_query( $conn, $sqlrt , $paramsrt, $optionsrt );

$row_countrt = sqlsrv_num_rows( $stmtrt );
   

   // echo $row_countrt;

if($row_countrt <= 0){


?>






    <form  action="svttv.php" method="POST">
                       

 <input  type='hidden'  name='notrans' value="<?php echo $notrans ?>">
                                  <input type='hidden'  name='norm' value="<?php echo $norm ?>">
                                   <input type='hidden'   name='nolembar' value="<?php echo $nolembar ?>">
   
   
    <input  type='hidden'   name='x' value="<?php echo $x ?>">
<input type='hidden'   name='y' value="<?php echo $y ?>">
<input  type="hidden"  name='kduser' value="<?php echo $kduser ?>">

 <div  class='w3-row'>
  <p>Tulis bilangin koma pada kolom koma</p>
                         



<table>
  <tr>
<td>
     <label class='w3-label w3-text'>Suhu </label>
</td>
<td>
   <input type="text" name="suhu" placeholder="Suhu" required>
                         ,
                          <input type="text" name="ssuhu" placeholder="Koma" >
</td>
  </tr>
  <tr>
    <td>
 <label class='w3-label w3-text'>Nadi </label>
    </td>
        <td>
   <input type="text" name="nadi" placeholder="Nadi" required>
                         ,
                          <input type="text" name="snadi" placeholder="Koma" >
    </td>
  </tr>
  <tr>
<td>
 <label class='w3-label w3-text'>Resp </label>
</td>

<td>
   <input type="text" name="resp" placeholder="Resp" >
                         ,
                          <input type="text" name="sresp" placeholder="Koma" >
</td>
  </tr>

<tr>
  <td>
      <label class='w3-label w3-text'>Sistole </label>
  </td>
    <td>
         <input type="text" name="sis" placeholder="Sistole" required>
  </td>
</tr>

<tr>
  <td>
      <label class='w3-label w3-text'>Distole </label>
  </td>
    <td>
       <input type="text" name="dis" placeholder="Distole" required>
  </td>
</tr>

<tr>
  <td>
     <label class='w3-label w3-text'>Eye </label>
  </td>
    <td>
        <input type="text" name="e" placeholder="E" required>
  </td>
</tr>

<tr>
  <td>
     <label class='w3-label w3-text'>Motorik </label>
  </td>
    <td>
       <input type="text" name="m" placeholder="M" required>
  </td>
</tr>

<tr>
  <td>
     <label class='w3-label w3-text'>Verbal </label>
  </td>
    <td>
       <input type="text" name="v" placeholder="V" required>
  </td>
</tr>



</table>

<table>
  <tr>
    <td>
      <p class="dfn w3-medium w3-green">TTV Tambahan</p>
    </td>
        <td>
 
    </td>
  </tr>

  <tr>
  <td>
      <label class='w3-label w3-text'>Spo </label>
  </td>
    <td>
         <input type="text" name="spo" placeholder="Spo" >
  </td>
</tr>



<tr>
  <td>
     <label class='w3-label w3-text'>Input </label>
  </td>
    <td>
        <input type="text" name="input" placeholder="Input" >
  </td>
</tr>



<tr>
  <td>
     <label class='w3-label w3-text'>Urine </label>
  </td>
    <td>
       <input type="text" name="urine" placeholder="urine" >
  </td>
</tr>


<tr>
  <td>
     <label class='w3-label w3-text'>Muntah </label>
  </td>
    <td>
       <input type="text" name="muntah"  placeholder="Muntah" >
  </td>
</tr>


<tr>
  <td>
     <label class='w3-label w3-text'>Defeksi </label>
  </td>
    <td>
       <input type="text" name="defeksi" id='defekasi' placeholder="Defeksi" >
  </td>
</tr>

<tr>
  <td>
     <label class='w3-label w3-text'>Output </label>
  </td>
    <td>
       <input type="text" name="out" placeholder="Output" >
  </td>
</tr>

<tr>
  <td>
      <label class='w3-label w3-text'>Balance </label>
  </td>
    <td>
       <input type="text" name="bal"  placeholder="Balance" >
  </td>
</tr>




</table>





                               


                            </div>



                          
                        <br>


<row>
<td>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>

</td>
<td>
 <button type="submit" name="simpan" class="btn w3-red">Simpan</button>
</td>

</row>
                       
                        
 </form>






<?php?><?php

}else{


 
?> 


<?php

 $stmtrt = sqlsrv_query( $conn, $sqlrt );
                                     
 while( $rowsrt = sqlsrv_fetch_array( $stmtrt, SQLSRV_FETCH_ASSOC) ) {

?>


 <form  action="editttv.php" method="POST">
                       

 <input  type='hidden'  name='notrans' value="<?php echo $notrans ?>">
                                  <input type='hidden'  name='norm' value="<?php echo $norm ?>">
                                   <input type='hidden'   name='nolembar' value="<?php echo $nolembar ?>">
   
   
    <input   type='hidden'  name='x' value="<?php echo $x ?>">
<input  type='hidden'  name='y' value="<?php echo $y ?>">
<input  type="hidden"  name='kduser' value="<?php echo $kduser ?>">

 <div  class='w3-row'>
  <p>Tulis bilangin koma pada kolom koma 



   </p>
                         



<table>
  <tr>
<td>
     <label class='w3-label w3-text'>Suhu </label>
</td>
<td>
<input type="text" name="suhu" value="<?php echo floor($rowsrt['suhu']); ?>" placeholder="Suhu" required>
                         ,
                          <input type="text" name="ssuhu" placeholder="Koma" >
</td>
  </tr>
  <tr>
    <td>
 <label class='w3-label w3-text'>Nadi </label>
    </td>
        <td>
   <input type="text" name="nadi" placeholder="Nadi" value="<?php echo floor( $rowsrt['nadi']); ?>" required>
                         ,
                          <input type="text" name="snadi" placeholder="Koma" >
    </td>
  </tr>
  <tr>
<td>
 <label class='w3-label w3-text'>Resp </label>
</td>

<td>
   <input type="text" name="resp"  value="<?php echo floor($rowsrt['resp']); ?>" placeholder="Resp" >
                         ,
                          <input type="text" name="sresp" placeholder="Koma" >
</td>
  </tr>

<tr>
  <td>
      <label class='w3-label w3-text'>Sistole </label>
  </td>
    <td>
         <input type="text" name="sis" placeholder="Sistole" value="<?php echo $rowsrt['tds']; ?>" required>
  </td>
</tr>

<tr>
  <td>
      <label class='w3-label w3-text'>Distole </label>
  </td>
    <td>
       <input type="text" name="dis" placeholder="Distole" value="<?php echo $rowsrt['tdd']; ?>"  required>
  </td>
</tr>

<tr>
  <td>
     <label class='w3-label w3-text'>Eye </label>
  </td>
    <td>
        <input type="text" name="e" value="<?php echo $rowsrt['e']; ?>" placeholder="E" required>
  </td>
</tr>

<tr>
  <td>
     <label class='w3-label w3-text'>Motorik </label>
  </td>
    <td>
       <input type="text" name="m" value="<?php echo $rowsrt['m']; ?>" placeholder="M" required>
  </td>
</tr>

<tr>
  <td>
     <label class='w3-label w3-text'>Verbal </label>
  </td>
    <td>
       <input type="text" name="v" value="<?php echo $rowsrt['v']; ?>" placeholder="V" required>
  </td>
</tr>



</table>

<table>
  <tr>
    <td>
      <p class="dfn w3-medium w3-green">TTV Tambahan</p>
    </td>
        <td>
 
    </td>
  </tr>

  <tr>
  <td>
      <label class='w3-label w3-text'>Spo </label>
  </td>
    <td>
         <input type="text" name="spo" value="<?php echo $rowsrt['spo']; ?>" placeholder="Spo" >
  </td>
</tr>



<tr>
  <td>
     <label class='w3-label w3-text'>Input </label>
  </td>
    <td>
        <input type="text" name="input" value="<?php echo $rowsrt['input']; ?>" placeholder="Input" >
  </td>
</tr>



<tr>
  <td>
     <label class='w3-label w3-text'>Urine </label>
  </td>
    <td>
       <input type="text" name="urine"  value="<?php echo $rowsrt['urine']; ?>" placeholder="urine" >
  </td>
</tr>


<tr>
  <td>
     <label class='w3-label w3-text'>Muntah </label>
  </td>
    <td>
       <input type="text" name="muntah" value="<?php echo $rowsrt['muntah']; ?>"  placeholder="Muntah" >
  </td>
</tr>


<tr>
  <td>
     <label class='w3-label w3-text'>Defeksi </label>
  </td>
    <td>
       <input type="text" name="defeksi" id='defekasi'  value="<?php echo $rowsrt['defeksi']; ?>" placeholder="Defeksi" >
  </td>
</tr>

<tr>
  <td>
     <label class='w3-label w3-text'>Output </label>
  </td>
    <td>
       <input type="text" name="out" value="<?php echo $rowsrt['output']; ?>" placeholder="Output" >
  </td>
</tr>

<tr>
  <td>
      <label class='w3-label w3-text'>Balance </label>
  </td>
    <td>
       <input type="text" name="bal"  value="<?php echo $rowsrt['balance']; ?>"  placeholder="Balance" >
  </td>
</tr>




</table>





                               


                            </div>



                          
                        <br>


<row>

<td>
   <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
                       
</td>

<td>
    <button type="submit" class="btn w3-green" name="hapus" >Hapus</button>
  </td>
<td>
     <button type="submit" name="simpan" class="btn w3-red">Edit</button>
    
  </td>
 
</row>



                     
 </form>





<?php }?>


   


<?php





}

?>







<script type="text/javascript">
   $('#defekasi').keyup(function(){






 });


</script>