    <?php


$notrans=$_POST['notrans'];
$norm=$_POST['norm'];

 date_default_timezone_set('Asia/Jakarta');
     $tgl = date("Y-m-d H:i");
 // $tgl3= date("Y-m-d");





    ?>





    <form  action="svair" method="POST">
                      
                      <div >  

 <input  type='hidden' type='hidden' name='notrans' value="<?php echo $notrans ?>">
                                  <input  type='hidden' name='norm' value="<?php echo $norm ?>">

 <div class='w3-row'>
                          <div class='w3-col'>
                                   

                                     <label class='w3-label w3-text'>Air Ketuban </label>
                             <!--    <input type='text' name='barang' id='autocomplete' placeholder='KETIK DJJ' class='w3-input w3-tiny w3-border-0'required> -->
                               <select name='airket' class='w3-select w3-padding'>
 <option value=''></option>                
<option value='U'>Ketuban belum pecah (U)</option>
<option value='J'>Ketuban pecah dan air jernih (J)</option>
<option value='M'>Ketuban pecah dan air bercampur mekonium (M)</option>
<option value='D'>Ketuban pecah dan air bercampur darah (D)</option>
<option value='K'>Ketuban pecah tetapi air kening (K)</option>
              

                  
                  </select>
                                </div>

</div>

 <div class='w3-row'>
                          <div class='w3-col'>
                                   

                                     <label class='w3-label w3-text'>Penyusupan </label>
                             <!--    <input type='text' name='barang' id='autocomplete' placeholder='KETIK DJJ' class='w3-input w3-tiny w3-border-0'required> -->
                               <select name='penyu' class='w3-select w3-padding'>
             <option value=''></option>       
<option value='0'>Tulang Kepala Janin Terpisah (0)</option>
<option value='1'>Tulang Kepala Janin Bersentuhan (1)</option>
<option value='2'>Tulang Kepala Janin Tumpang Tindih tetapi masih dapat di pisahkan (2)</option>
<option value='3'>Tulang Kepala Janin Tumpang tindih dan tidak dapat di pisahkan (3)</option>


                  
                  </select>
                                </div>

</div>


 <label class='w3-label w3-text'>Jam </label>
     <select name='jam' class='w3-select w3-padding'>
                 

                 <?php

include '../../config.php';

$sqls = "SELECT * FROM   ERMVKPWAKTU where notrans='$notrans' order by waktu";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {

 echo "<option value='".$rows['garisx']."'>".date_format ($rows['waktu'],'H:i').' '.$rows['keterangan']."</option>";
              

                                      }


                                      ?>
                  
                  </select>


                          
                        </div><br>

                        <button type="submit" name="simpan" class="btn">Simpan</button>
                          <button type="button" class="btn" data-dismiss="modal">Batal</button>
 </form>


