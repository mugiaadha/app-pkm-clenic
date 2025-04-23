<?php

$notrans  = $_POST['notrans'];
$norm     = $_POST['norm'];
$nolembar = $_POST['nolembar'];
$x        = $_POST['x'];

echo $x;

$y        = $_POST['y'];
$kduser   = $_POST['kduser'];

date_default_timezone_set('Asia/Jakarta');
$tgl = date("Y-m-d H:i");
 
?>
<style type="text/css">

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
$sqlrt       = "SELECT   * FROM ERMTTVOBAT WHERE (nolembar = '$nolembar') AND (obatx = '$x') AND (obaty = '$y') and notrans='$notrans' ";
$paramsrt    = array();
$optionsrt   = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmtrt      = sqlsrv_query( $conn, $sqlrt , $paramsrt, $optionsrt );
$row_countrt = sqlsrv_num_rows( $stmtrt );

$sqlget = sqlsrv_query($conn, "SELECT obat FROM ERMFPOC WHERE notrans = '{$notrans}'", array(), array('Scrollable' => SQLSRV_CURSOR_KEYSET));

$ys = [];
if (!empty(sqlsrv_num_rows($sqlget))) 
{
  while ($x = sqlsrv_fetch_array($sqlget,2)) 
  {
    $ys[] = $x['obat'];
  }
}
   
if($row_countrt <= 0)
{
  ?>
  <form  action="svobat.php" method="POST">
    <input  type='hidden'  name='notrans' value="<?php echo $notrans ?>">
    <input type='hidden'  name='norm' value="<?php echo $norm ?>">
    <input type='hidden' name='nolembar' value="<?php echo $nolembar ?>">
   
    <input  type="hidden" name='y' value="<?php echo $y ?>">
    <input  type="hidden"  name='kduser' value="<?php echo $kduser ?>">
    <div  class='w3-row'>
      <table class="table">
        <tr>
          <td colspan="2">
            <button type="button" class="btn btn-block w3-green collapsible">Data Obat Pasien</button>
            <div class="content" style="max-height: 400px; overflow-y: scroll;">
              <?php  
              if (!empty($ys)) 
              {
                echo '<ul class="list-group" style="margin-top:15px">';
                foreach ($ys as $value) 
                {
                  echo '<li class="list-group-item">'.$value.'</li>';
                }
                echo '</ul>';
              }
              ?>
            </div>
          </td>
        </tr>
        <tr>

          <td width="100" style="border: none; vertical-align: middle;"> <label class='w3-label w3-text'>Nama Obat </label> </td>
          <td style="border: none; vertical-align: middle;"> <input type="text" name="obat" class="form-control" placeholder="Obat" required> 

  <input  type="hidden"  name='x' value="<?php echo $x ?>">
          </td>
        </tr>
        <tr>
          <td style="border: none; vertical-align: middle;"> <label class='w3-label w3-text'>Jenis Obat </label> </td>
          <td style="border: none; vertical-align: middle;">
            <select name="sobat"  class="form-control" required>
              <option value=""></option>
              <option value="Injeksi">Injeksi</option>
              <option value="Non Injeksi">Non Injeksi</option>
            </select>
          </td>
        </tr>
      </table>
    </div>
    <br>
    <button type="submit" name="simpan" class="btn w3-red">Simpan</button>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
 </form>
<?php

}else{

  $stmtrt = sqlsrv_query( $conn, $sqlrt );
                                     
  while( $rowsrt = sqlsrv_fetch_array( $stmtrt, SQLSRV_FETCH_ASSOC) ) 
  {
    ?>
    <form  action="editobat.php" method="POST">
      <input type='hidden' name='notrans' value="<?php echo $notrans ?>">
      <input type='hidden' name='norm' value="<?php echo $norm ?>">
      <input type='hidden' name='nolembar' value="<?php echo $nolembar ?>">
      <input  type='hidden'  name='x' value="<?php echo $x ?>">
      <input  type="hidden" name='y' value="<?php echo $y ?>">
      <input  type="hidden"  name='kduser' value="<?php echo $kduser ?>">
      <div  class='w3-row'>
        <table>
          <td colspan="2">
            <button type="button" class="btn btn-block w3-green collapsible">Data Obat Pasien</button>
            <div class="content" style="max-height: 400px; overflow-y: scroll;">
              <?php  
              if (!empty($ys)) 
              {
                echo '<ul class="list-group" style="margin-top:15px">';
                foreach ($ys as $value) 
                {
                  echo '<li class="list-group-item">'.$value.'</li>';
                }
                echo '</ul>';
              }
              ?>
            </div>
          </td>          
          <tr>
            <td> <label class='w3-label w3-text'>Nama Obat </label> </td>
            <td> <input type="text" name="obat" value="<?php echo $rowsrt['obat'] ?>" placeholder="Obat" required> </td>
          </tr>
          <tr>
            <td> <label class='w3-label w3-text'>Jenis Obat </label> </td>
            <td>
              <select name="sobat" required>
                <option  value="<?php echo $rowsrt['jenisobat']?>" ><?php echo $rowsrt['jenisobat']?></option>
                <option value="Injeksi">Injeksi</option>
                <option value="Non Injeksi">Non Injeksi</option>
              </select>
            </td>
          </tr>
        </table>
      </div>
      <br>
      <button type="submit" name="simpan" class="btn w3-red">Simpan</button>
      <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
    </form>
    <?php 
  }
}
?>
<script>
  $('.collapsible').click(function(e){
    e.preventDefault();

    $('.content').toggle('slow')
  })
</script>
<style>
.content {
  display: none;
  overflow: hidden;
}
</style>