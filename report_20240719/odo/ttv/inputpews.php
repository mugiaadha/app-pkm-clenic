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
include '../../config.php';
$sqlrt = "SELECT

a.tanggal, a.notrans, a.norm, a.nolembar, rr, rrx, rry, sat, satx, saty, ao, aox, aoy, alat, alatx, alaty, temp, tempx, tempy, td, tdx, tdy, hr, hrx, hry, lk, lkx, lky, gd, 
                         gdx, gdy, totalskor, totalskorx, totalskory, sn, snx, sny, uo, uox, uoy, fm, fmx, fmy, tdd, tddy,
             b.jam, menit, nyeri, nyerix, nyeriy, urine, urinex, uriney, lochia, lochiax, lochiay, so2, so2x, so2y

from ERMEWSHASILFIXL a , ERMEWSWAKTUL b
where a.notrans = b.notrans and a.nolembar = b.nolembar and a.rrx = b.jamx  and 
 a.notrans='$notrans' and a.nolembar='$nolembar' and b.jamx='$x'";
$paramsrt = array();
$optionsrt =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmtrt = sqlsrv_query( $conn, $sqlrt , $paramsrt, $optionsrt );

$row_countrt = sqlsrv_num_rows( $stmtrt );
   

if($row_countrt <= 0){


?>




 <form  action="svpwss.php" method="POST">
                       

 <input type='hidden'  name='notrans' value="<?php echo $notrans ?>">
                                  <input  type='hidden'  name='norm' value="<?php echo $norm ?>">
                                   <input type='hidden'  name='nolembar' value="<?php echo $nolembar ?>">
                                   <input type='hidden' name='x' value="<?php echo $x ?>">
<input type='hidden' name='y' value="<?php echo $y ?>">

<input type='hidden' name='kduser' value="<?php echo $kduser ?>">
 <div class='w3-row'>
                          <div class='w3-col'>
                            <table>
                              <tr>
                                <td>
                                   <label class='w3-label w3-text'>Waktu </label>
                                </td>
                                  <td>
                                      <input type="text"  maxlength="2" name="jam" placeholder="Jam" required>
                                </td><td>
                                      <input type="text" maxlength="2" name="menit" placeholder="Menit" required>
                                </td>
                              </tr>

                               <tr>
                                <td>
                                   <label class='w3-label w3-text'>Respiroty Rate </label>
                                </td>
                                  <td>
                                      <input type="text"  name="rr" placeholder="Respiroty Rate" required>
                                </td>
                              </tr>

                             


                              <tr>
                                <td>
                                   <label class='w3-label w3-text'>Aliran</label>
                                </td>
                                  <td>
                                      <input type="text"  name="ao" placeholder="Aliran O2" >
                                </td>
                              </tr>

                                   <tr>
                                <td>
                                   <label class='w3-label w3-text'>Saturasi Oksigen </label>
                                </td>
                                  <td>
                                      <input type="text"  name="sat" placeholder="Saturasi Oksigen " required>
                                </td>
                              </tr>

                                <tr>
                                <td>
                                   <label class='w3-label w3-text'>SO2 II</label>
                                </td>
                                  <td>
                                       <select name="stsao">
                                           <option value="0"> - </option>
                                       <option value="1"> > 97 dg 02 </option>
                                      <option value="2">95-96 dg 02</option>
                                       <option value="3">93-94 dg 02</option>
                                       <option value="4"> > 93 dg udara </option>
                                      <option value="5">88-92</option>
                                       <option value="6">86-87</option>
                                       <option value="7">84-85</option>
                                    <option value="8"><83%</option>
                                    

                                     </select>
                                    
                                </td>
                                <td>
                                 <input type="text"  name="aoii" placeholder="Nilai" required >
                                </td>   
                                </td>

                              </tr>



                              <tr>
                                <td>
                                   <label class='w3-label w3-text'>Alat</label>
                                </td>
                                  <td>
                                     <select name="alat">
                                       <option></option>
                                      <option>M</option>
                                       <option>NRM</option>
                                       <option>RM</option>
                                       <option>NK</option>
                                        <option>TANPA ALAT</option>
                                        <option>HFNC</option>
                                         <option>NIV</option>


                                     </select>
                                </td>
                              </tr>


                              <tr>
                                <td>
                                   <label class='w3-label w3-text'>Temparatur</label>
                                </td>
                                  <td>
                                      <input type="text"  name="temp" placeholder="Temparatur" required>
                                </td>
                              </tr>

                            <tr>
                                <td>
                                   <label class='w3-label w3-text'>Tekanan Darah</label>
                                </td>
                                  <td>
                                      <input type="text"  name="td" placeholder="Systole" required >
                                </td>
                                <td>
                                      <input type="text"  name="tdd" placeholder="Distole" required>
                                </td>

                              </tr>



                              <tr>
                                <td>
                                   <label class='w3-label w3-text'>Heart Rate</label>
                                </td>
                                  <td>
                                      <input type="text"  name="hr" placeholder="Heart Rate" required>
                                </td>
                              </tr>



                              <tr>
                                <td>
                                   <label class='w3-label w3-text'>Level Kesadaran</label>
                                </td>
                                  <td>
                                     <select name="lk">
                                <option value="Alert">Alert</option>
                                
                                       <option value="V">V</option>
                                       <option value="P">P</option>
                                       <option value="U">U</option>
                                     </select>
                                </td>
                              </tr>




<tr>
                                <td>
                                   <label class='w3-label w3-text'>Gula Darah</label>
                                </td>
                                  <td>
                                      <input type="text"  name="gd" placeholder="Gula Darah" >
                                </td>
                              </tr>


                              <tr>
                                <td>
                                   <label class='w3-label w3-text'>Skor Nyeri</label>
                                </td>
                                  <td>
                                      
                                      <select name="sn">
                                <option value="Normal">Normal</option>
                                
                                       <option value="Abnormal">Abnormal</option>
                                    
                                     </select>


                                </td>
                              </tr>

 <tr>
                                <td>
                                   <label class='w3-label w3-text'>Protein Urine</label>
                                </td>
                                  <td>
                                      <!-- <input type="text"  name="uo" placeholder="Urine Output" required> -->


                                        <select name="uo">
                                        <option value="0">0</option>
                                        <option value="+1">+1</option>
                                         <option value=">+2">>+2</option>
                                    
                                     </select>
                                </td>
                              </tr>


<tr>
                                <td>
                                   <label class='w3-label w3-text'>Lochia</label>
                                </td>
                                  <td>
                                      <!-- <input type="text"  name="uo" placeholder="Urine Output" required> -->


                                        <select name="lochia">
                                        <option value="Normal">Normal</option>
                                
                                       <option value="Abnormal">Abnormal</option>
                                    
                                     </select>
                                </td>
                              </tr>








           

                            </table>
                                   

                                    
                             
                       
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





 <form  action="editpews.php" method="POST">
                       

 <input  type='hidden'  name='notrans' value="<?php echo $notrans ?>">
                                  <input  type='hidden'  name='norm' value="<?php echo $norm ?>">
                                   <input  type='hidden' name='nolembar' value="<?php echo $nolembar ?>">
                                   <input type='hidden'  name='x' value="<?php echo $x ?>">
<input type='hidden'  name='y' value="<?php echo $y ?>">
<input type='hidden'  name='kduser' value="<?php echo $kduser ?>">
 <div class='w3-row'>
                          <div class='w3-col'>
                            <table>
                              <tr>
                                <td>
                                   <label class='w3-label w3-text'>Waktu </label>
                                </td>
                                  <td>
                                      <input type="text" maxlength="2"  value="<?php echo $rowsrt['jam']?>" name="jam" placeholder="Jam" required>
                                </td><td>
                                      <input type="text" maxlength="2" value="<?php echo $rowsrt['menit']?>" name="menit" placeholder="Menit" required>
                                </td>
                              </tr>

                               <tr>
                                <td>
                                   <label class='w3-label w3-text'>Respiroty Rate </label>
                                </td>
                                  <td>
                                      <input type="text"  value="<?php echo $rowsrt['rr']?>" name="rr" placeholder="Respiroty Rate" required>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                   <label class='w3-label w3-text'>Saturasi Oksigen </label>
                                </td>
                                  <td>
                                      <input type="text" value="<?php echo $rowsrt['sat']?>" name="sat" placeholder="Saturasi Oksigen " required>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                   <label class='w3-label w3-text'>Aliran O2</label>
                                </td>
                                  <td>
                                      <input type="text"  value="<?php echo $rowsrt['ao']?>"  name="ao" placeholder="Aliran O2" >
                                </td>
                              </tr>


                                  <tr>
                                <td>
                                   <label class='w3-label w3-text'>Saturasi Oksigen </label>
                                </td>
                                  <td>
                                      <input type="text"  name="sat" placeholder="Saturasi Oksigen " required>
                                </td>
                              </tr>

                                <tr>
                                <td>
                                   <label class='w3-label w3-text'>SO2 II</label>
                                </td>
                                  <td>
                                       <select name="stsao">
                                           <option value="0">  </option>
                                       <option value="1"> > 97 dg 02 </option>
                                      <option value="2">95-96 dg 02</option>
                                       <option value="3">93-94 dg 02</option>
                                       <option value="4"> > 93 dg udara </option>
                                      <option value="5">88-92</option>
                                       <option value="6">86-87</option>
                                       <option value="7">84-85</option>
                                    <option value="8"><83%</option>
                                    

                                     </select>
                                    
                                </td>
                                <td>
                                 <input type="text"   value="<?php echo $rowsrt['so2']?>" name="aoii" placeholder="Nilai" required >
                                </td>   
                                </td>

                              </tr>



                              <tr>
                                <td>
                                   <label class='w3-label w3-text'>Alat</label>
                                </td>
                                  <td>
                                     <select name="alat">
                                       <option  value="<?php echo $rowsrt['alat']?>"><?php echo $rowsrt['alat']?></option>
                                      <option>M</option>
                                       <option>NRM</option>
                                       <option>RM</option>
                                       <option>NK</option>
                                     </select>
                                </td>
                              </tr>


                              <tr>
                                <td>
                                   <label class='w3-label w3-text'>Temparatur</label>
                                </td>
                                  <td>
                                      <input type="text" value="<?php echo $rowsrt['temp']?>" name="temp" placeholder="Temparatur" required>
                                </td>
                              </tr>

                            <tr>
                                <td>
                                   <label class='w3-label w3-text'>Tekanan Darah</label>
                                </td>
                                  <td>
                                      <input type="text" value="<?php echo $rowsrt['td']?>"  name="td" placeholder="Systole" required >
                                </td>
                                <td>
                                      <input type="text" value="<?php echo $rowsrt['tdd']?>"  name="tdd" placeholder="Distole" required>
                                </td>

                              </tr>



                              <tr>
                                <td>
                                   <label class='w3-label w3-text'>Heart Rate</label>
                                </td>
                                  <td>
                                      <input type="text" value="<?php echo $rowsrt['hr']?>"   name="hr" placeholder="Heart Rate" required>
                                </td>
                              </tr>



                              <tr>
                                <td>
                                   <label class='w3-label w3-text'>Level Kesadaran</label>
                                </td>
                                  <td>
                                     <select name="lk">
                                       <option value="<?php echo $rowsrt['lk']?>"><?php echo $rowsrt['lk']?></option>
                                <option value="Alert">Alert</option>
                                
                                       <option value="V">V</option>
                                       <option value="P">P</option>
                                       <option value="U">U</option>
                                     </select>
                                </td>
                              </tr>




<tr>
                                <td>
                                   <label class='w3-label w3-text'>Gula Darah</label>
                                </td>
                                  <td>
                                      <input type="text" value="<?php echo $rowsrt['gd']?>"  name="gd" placeholder="Gula Darah" >
                                </td>
                              </tr>


                              <tr>
                                <td>
                                   <label class='w3-label w3-text'>Skor Nyeri</label>
                                </td>
                                  <td>
                                      
                                      <select name="sn">
                                         <option value="<?php echo $rowsrt['sn']?>"><?php echo $rowsrt['sn']?></option>
                                <option value="Normal">Normal</option>
                                
                                       <option value="Abnormal">Abnormal</option>
                                    
                                     </select>


                                </td>
                              </tr>

 <tr>
                                <td>
                                   <label class='w3-label w3-text'>Protein Urine</label>
                                </td>
                                  <td>
                                     
                                        <select name="uo">
                                           <option value="<?php echo $rowsrt['uo']?>"><?php echo $rowsrt['uo']?></option>
                                        <option value="0">0</option>
                                        <option value="+1">+1</option>
                                         <option value=">+2">>+2</option>
                                    
                                     </select>
                                </td>
                              </tr>


<tr>
                                <td>
                                   <label class='w3-label w3-text'>Lochia</label>
                                </td>
                                  <td>
                                     
                                        <select name="lochia">
                                           <option value="<?php echo $rowsrt['lochia']?>"><?php echo $rowsrt['lochia']?></option>
                                        <option value="Normal">Normal</option>
                                
                                       <option value="Abnormal">Abnormal</option>
                                    
                                     </select>
                                </td>
                              </tr>




                            <!--   <tr>
                                <td>
                                   <label class='w3-label w3-text'>Skor Nyeri</label>
                                </td>
                                  <td>
                                      <input type="text" value="<?php echo $rowsrt['sn']?>"  name="sn" placeholder="Skor Nyeri" required>
                                </td>
                              </tr>

 <tr>
                                <td>
                                   <label class='w3-label w3-text'>Urine Output</label>
                                </td>
                                  <td>
                                      <input type="text"  value="<?php echo $rowsrt['uo']?>" name="uo" placeholder="Urine Output" required>
                                </td>
                              </tr> -->






                            </table>
                                   

                                    
                             
                       
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



















   


