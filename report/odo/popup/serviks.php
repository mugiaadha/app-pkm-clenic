    <?php


$notrans=$_POST['notrans'];
$norm=$_POST['norm'];

 date_default_timezone_set('Asia/Jakarta');
     $tgl = date("Y-m-d H:i");
 // $tgl3= date("Y-m-d");





    ?>





    <form  action="svserviks" method="POST">
                      
                      <div >  

 <input  type='hidden' type='hidden' name='notrans' value="<?php echo $notrans ?>">
                                  <input  type='hidden' name='norm' value="<?php echo $norm ?>">

 <div class='w3-row'>
                          <div class='w3-col'>
                                   

                                     <label class='w3-label w3-text'>Besar Pembukaan </label>
                             <!--    <input type='text' name='barang' id='autocomplete' placeholder='KETIK DJJ' class='w3-input w3-tiny w3-border-0'required> -->
                               <select name='pembukaan' class='w3-select w3-padding'>
                                 <option value=''></option>
             <?php

include '../../config.php';

$sqls = "SELECT * FROM   ERMVKRUMUS where ket='serviks' order by ynilai";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {

 echo "<option value='".$rows['ynilai']."'>".$rows['ynilai']."</option>";
              

                                      }


                                      ?>
              

                  
                  </select>
                                </div>

</div>

 <div class='w3-row'>
                          <div class='w3-col'>
                                   

                                     <label class='w3-label w3-text'>Besar Penurunan </label>
                            
                               <select name='turun' class='w3-select w3-padding'>
     <option value=''></option>
       <?php

include '../../config.php';

$sqls = "SELECT * FROM   ERMVKRUMUS where ket='serviks' order by ynilai";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {

 echo "<option value='".$rows['ynilai']."'>".$rows['ynilai']."</option>";
              

                                      }


                                      ?>
                  
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


