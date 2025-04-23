    <?php

$x=$_POST['x'];
$notrans=$_POST['notrans'];
$norm=$_POST['norm'];

 date_default_timezone_set('Asia/Jakarta');
     $tgl = date("Y-m-d H:i");
 // $tgl3= date("Y-m-d");

 $tgl2=date('Y-m-d H:i', strtotime('+30 Minutes', strtotime($tgl)));






    ?>

<!-- <script src="../js/bootstrap.min.js"></script>

 <link rel="stylesheet" href="../waktu/css/bootstrap-material-datetimepicker.css" />
  
<script type="text/javascript" src="../waktu/js/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="../waktu/js/bootstrap-material-datetimepicker.js"></script>

 -->
	

    <form  action="svwaktu" method="POST">
                      
                     


                        <div >  

                        	  <input  type='hidden' name='x' value="<?php echo $x ?>">

                        	    <input  type='hidden' type='hidden' name='notrans' value="<?php echo $notrans ?>">
                        	        <input  type='hidden' name='norm' value="<?php echo $norm ?>">

                        		<input type="text" id="bw" name="waktu" class="form-control floating-label" placeholder="Time">

                          <button type="submit" name="simpan" class="btn">Simpan</button>
                          <button type="button" class="btn" data-dismiss="modal">Batal</button>
                        </div>
                       
                      </form>




                    <script type="text/javascript">
    $(document).ready(function()
    {
    
      $('#bw').bootstrapMaterialDatePicker
      ({
        date: false,
        shortTime: false,
        format: 'HH:mm'
      });
 $.material.init()
    });


    
    </script>