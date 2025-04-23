<?php


$notrans    = $_POST['notrans'];
$notransibs = $_POST['notransibs'];
$kduser     = $_POST['kduser'];
$x          = $_POST['x'];
$y          = $_POST['y'];
$id         = $_POST['id'];
date_default_timezone_set('Asia/Jakarta');
$tgl = date("Y-m-d H:i");
 
?>

<style>

  /* Style the tab */
  .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
  }

  /* Style the buttons inside the tab */
  .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }

  /* Create an active/current tablink class */
  .tab button.active {
    background-color: #ccc;
  }

  /* Style the tab content */
  .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
  }
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


if (isset($_POST['simpan'])) 
{
 
$sql="INSERT INTO ERMIBSINFASIF (tanggal, x, y, notransibs, notrans, status
)
        VALUES ('".$_POST['tanggal']."','".$_POST['x']."','".$_POST['y']."','".$_POST['notransibs']."','".$_POST['notrans']."','TGLATAS')";
$sqlq=sqlsrv_query($conn,$sql);

echo "<script> setTimeout(function(){ 
 window.location.href = 'inafis.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";


  }else if (isset($_POST['simpanwaktu'])){




$sqlx="INSERT INTO ERMIBSINFASIF (tanggal, x, y, notransibs, notrans, status
)
        VALUES ('".$_POST['tanggal']."','".$_POST['x']."','".$_POST['y']."','".$_POST['notransibs']."','".$_POST['notrans']."','JAMATAS')";
$sqlqx=sqlsrv_query($conn,$sqlx);

echo "<script> setTimeout(function(){ 
 window.location.href = 'inafis.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";

}else if(isset($_POST['simpanjamatas'])) {
   
$sqlx="INSERT INTO ERMIBSINFASIF (tanggal, x, y, notransibs, notrans, status
)
        VALUES ('".$_POST['tanggal']."','".$_POST['x']."','".$_POST['y']."','".$_POST['notransibs']."','".$_POST['notrans']."','WAKTUATAS')";
$sqlqx=sqlsrv_query($conn,$sqlx);


$sqlx="INSERT INTO ERMIBSINFASIF (tanggal, x, y, notransibs, notrans, status
)
        VALUES ('".$_POST['menit']."','".$_POST['x']."','".$_POST['y']."','".$_POST['notransibs']."','".$_POST['notrans']."','MENITATAS')";
$sqlqx=sqlsrv_query($conn,$sqlx);

echo "<script> setTimeout(function(){ 
 window.location.href = 'inafis.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";



}else if(isset($_POST['simpaniv1'])){

$sqlx="INSERT INTO ERMIBSINFASIF (tanggal, x, y, notransibs, notrans, status
)
        VALUES ('".$_POST['tanggal']."','".$_POST['x']."','".$_POST['y']."','".$_POST['notransibs']."','".$_POST['notrans']."','IV1')";
$sqlqx=sqlsrv_query($conn,$sqlx);

echo "<script> setTimeout(function(){ 
 window.location.href = 'inafis.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";




}else if(isset($_POST['simpaniv2'])){
$sqlx="INSERT INTO ERMIBSINFASIF (tanggal, x, y, notransibs, notrans, status
)
        VALUES ('".$_POST['tanggal']."','".$_POST['x']."','".$_POST['y']."','".$_POST['notransibs']."','".$_POST['notrans']."','IV2')";
$sqlqx=sqlsrv_query($conn,$sqlx);

echo "<script> setTimeout(function(){ 
 window.location.href = 'inafis.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";


}else if(isset($_POST['simpancvp'])){
$sqlx="INSERT INTO ERMIBSINFASIF (tanggal, x, y, notransibs, notrans, status
)
        VALUES ('".$_POST['tanggal']."','".$_POST['x']."','".$_POST['y']."','".$_POST['notransibs']."','".$_POST['notrans']."','CVP')";
$sqlqx=sqlsrv_query($conn,$sqlx);

echo "<script> setTimeout(function(){ 
 window.location.href = 'inafis.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";


}else if(isset($_POST['simpantemp'])){
$sqlx="INSERT INTO ERMIBSINFASIF (tanggal, x, y, notransibs, notrans, status
)
        VALUES ('".$_POST['tanggal']."','".$_POST['x']."','".$_POST['y']."','".$_POST['notransibs']."','".$_POST['notrans']."','TEMP')";
$sqlqx=sqlsrv_query($conn,$sqlx);

echo "<script> setTimeout(function(){ 
 window.location.href = 'inafis.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";


}else if(isset($_POST['simpanpu'])){
$sqlx="INSERT INTO ERMIBSINFASIF (tanggal, x, y, notransibs, notrans, status
)
        VALUES ('".$_POST['tanggal']."','".$_POST['x']."','".$_POST['y']."','".$_POST['notransibs']."','".$_POST['notrans']."','PU')";
$sqlqx=sqlsrv_query($conn,$sqlx);

echo "<script> setTimeout(function(){ 
 window.location.href = 'inafis.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";


}else if(isset($_POST['simpanjp'])){
$sqlx="INSERT INTO ERMIBSINFASIF (tanggal, x, y, notransibs, notrans, status
)
        VALUES ('".$_POST['tanggal']."','".$_POST['x']."','".$_POST['y']."','".$_POST['notransibs']."','".$_POST['notrans']."','JP')";
$sqlqx=sqlsrv_query($conn,$sqlx);

echo "<script> setTimeout(function(){ 
 window.location.href = 'inafis.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";

}else if(isset($_POST['simpannadi'])){
$sqlx="INSERT INTO ERMIBSINFASIF (tanggal, x, y, notransibs, notrans, status
)
        VALUES ('".$_POST['tanggal']."','".$_POST['x']."','".$_POST['y']."','".$_POST['notransibs']."','".$_POST['notrans']."','NADI')";
$sqlqx=sqlsrv_query($conn,$sqlx);

echo "<script> setTimeout(function(){ 
 window.location.href = 'inafis.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";

}else if(isset($_POST['simpanrp'])){
$sqlx="INSERT INTO ERMIBSINFASIF (tanggal, x, y, notransibs, notrans, status
)
        VALUES ('".$_POST['tanggal']."','".$_POST['x']."','".$_POST['y']."','".$_POST['notransibs']."','".$_POST['notrans']."','RESP')";
$sqlqx=sqlsrv_query($conn,$sqlx);

echo "<script> setTimeout(function(){ 
 window.location.href = 'inafis.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";

}else if(isset($_POST['simpanan'])){
$sqlx="INSERT INTO ERMIBSINFASIF (tanggal, x, y, notransibs, notrans, status
)
        VALUES ('".$_POST['tanggal']."','".$_POST['x']."','".$_POST['y']."','".$_POST['notransibs']."','".$_POST['notrans']."','ANAS')";
$sqlqx=sqlsrv_query($conn,$sqlx);

echo "<script> setTimeout(function(){ 
 window.location.href = 'inafis.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";

}else if(isset($_POST['simpanop'])){
$sqlx="INSERT INTO ERMIBSINFASIF (tanggal, x, y, notransibs, notrans, status
)
        VALUES ('".$_POST['tanggal']."','".$_POST['x']."','".$_POST['y']."','".$_POST['notransibs']."','".$_POST['notrans']."','OP')";
$sqlqx=sqlsrv_query($conn,$sqlx);

echo "<script> setTimeout(function(){ 
 window.location.href = 'inafis.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";

}else if(isset($_POST['simpantds'])){
$sqlx="INSERT INTO ERMIBSINFASIF (tanggal, x, y, notransibs, notrans, status
)
        VALUES ('".$_POST['tanggal']."','".$_POST['x']."','".$_POST['y']."','".$_POST['notransibs']."','".$_POST['notrans']."','TDS')";
$sqlqx=sqlsrv_query($conn,$sqlx);

echo "<script> setTimeout(function(){ 
 window.location.href = 'inafis.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";

}else if(isset($_POST['simpantdd'])){
$sqlx="INSERT INTO ERMIBSINFASIF (tanggal, x, y, notransibs, notrans, status
)
        VALUES ('".$_POST['tanggal']."','".$_POST['x']."','".$_POST['y']."','".$_POST['notransibs']."','".$_POST['notrans']."','TDD')";
$sqlqx=sqlsrv_query($conn,$sqlx);

echo "<script> setTimeout(function(){ 
 window.location.href = 'inafis.php?notrans=$notrans&notransibs=$notransibs&kduser=$kduser'}, 0);</script>";

}

 
?>





<?php

if($id === '1')
{
  ?>
  <form  action="svinafis.php" method="POST">
    <input type='hidden'   name='notrans' value="<?php echo $notrans ?>">
    <input type='hidden'   name='notransibs' value="<?php echo $notransibs ?>">
    <input type='hidden'   name='kduser' value="<?php echo $kduser ?>">
    <input type='hidden'  name='x' value="<?php echo $x ?>">
    <input type='hidden'  name='y' value="<?php echo $y ?>">

    <div class='w3-row'>
      <div class='w3-col'>                           
        <label class='w3-label w3-text'>Tanggal </label>
        <input type="text" name="tanggal" placeholder="Tanggal" required>
      </div>
    </div>

    <br>

    <button type="submit" name="simpan" class="btn w3-red">Simpan</button>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
   </form>
  <?php
}else 
if ($id === '2')
{
  ?>
  <form  action="svinafis.php" method="POST">
    <input type='hidden'   name='notrans' value="<?php echo $notrans ?>">
    <input type='hidden'   name='notransibs' value="<?php echo $notransibs ?>">
    <input type='hidden'   name='kduser' value="<?php echo $kduser ?>">
    <input type='hidden'   name='x' value="<?php echo $x ?>">
    <input  type='hidden'  name='y' value="<?php echo $y ?>">
    <div class='w3-row'>
      <div class='w3-col'>
        <label class='w3-label w3-text'>Jam </label>
        <input type="text" name="tanggal" placeholder="Jam" required>
      </div>
    </div>
    <br>
    <button type="submit" name="simpanwaktu" class="btn w3-red">Simpan</button>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
  </form>
  <?php
}else 
if($id === '3')
{
  ?>
  <form  action="svinafis.php" method="POST">
    <input type='hidden'   name='notrans' value="<?php echo $notrans ?>">
    <input  type='hidden'  name='notransibs' value="<?php echo $notransibs ?>">
    <input type='hidden'   name='kduser' value="<?php echo $kduser ?>">
    <input type='hidden'  name='x' value="<?php echo $x ?>">
    <input type='hidden'   name='y' value="<?php echo $y ?>">
    <div class='w3-row'>
      <div class='w3-col'>
        <label class='w3-label w3-text'>Jam </label>
        <input type="text" name="tanggal" placeholder="Jam" required>
      </div>
      <div class='w3-col'>
        <label class='w3-label w3-text'>Menit </label>
        <input type="text" name="menit" placeholder="Menit" required>
      </div>
    </div>
    <br>
    <button type="submit" name="simpanjamatas" class="btn w3-red">Simpan</button>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
  </form>
  <?php
}else 
if($id === '4')
{
  ?>
  <form  action="svinafis.php" method="POST">
    <input type='hidden'  name='notrans' value="<?php echo $notrans ?>">
    <input type='hidden'   name='notransibs' value="<?php echo $notransibs ?>">
    <input type='hidden'   name='kduser' value="<?php echo $kduser ?>">
    <input type='hidden'   name='x' value="<?php echo $x ?>">
    <input type='hidden'   name='y' value="<?php echo $y ?>">
    <div class='w3-row'>
      <div class='w3-col'>
        <label class='w3-label w3-text'>IV LINE 1 </label>
        <input type="text" name="tanggal" placeholder="IV LINE 1" required>
      </div>
    </div>
    <br>
    <button type="submit" name="simpaniv1" class="btn w3-red">Simpan</button>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
  </form>
  <?php
}else 
if($id === '5')
{
  ?>
  <form  action="svinafis.php" method="POST">
    <input type='hidden'  name='notrans' value="<?php echo $notrans ?>">
    <input type='hidden'   name='notransibs' value="<?php echo $notransibs ?>">
    <input  type='hidden'  name='kduser' value="<?php echo $kduser ?>">
    <input  type='hidden'  name='x' value="<?php echo $x ?>">
    <input  type='hidden' name='y' value="<?php echo $y ?>">
    <div class='w3-row'>
      <div class='w3-col'>
        <label class='w3-label w3-text'>IV LINE 2 </label>
        <input type="text" name="tanggal" placeholder="IV LINE 2" required>
      </div>
    </div>
    <br>
    <button type="submit" name="simpaniv2" class="btn w3-red">Simpan</button>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
  </form>
  <?php
}else 
if($id === '6')
{
  ?>
  <form  action="svinafis.php" method="POST">
    <input  type='hidden' name='notrans' value="<?php echo $notrans ?>">
    <input  type='hidden'  name='notransibs' value="<?php echo $notransibs ?>">
    <input   type='hidden' name='kduser' value="<?php echo $kduser ?>">
    <input  type='hidden' name='x' value="<?php echo $x ?>">
    <input   type='hidden' name='y' value="<?php echo $y ?>">
    <div class='w3-row'>
      <div class='w3-col'>
        <label class='w3-label w3-text'>CVP </label>
        <input type="text" name="tanggal" placeholder="CVP" required>
      </div>
    </div>
    <br>
    <button type="submit" name="simpancvp" class="btn w3-red">Simpan</button>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
  </form>
  <?php
}else 
if($id === '7')
{
  ?>
  <form  action="svinafis.php" method="POST">
    <input type='hidden'  name='notrans' value="<?php echo $notrans ?>">
    <input  type='hidden'  name='notransibs' value="<?php echo $notransibs ?>">
    <input  type='hidden'  name='kduser' value="<?php echo $kduser ?>">
    <input type='hidden'  name='x' value="<?php echo $x ?>">
    <input  type='hidden'  name='y' value="<?php echo $y ?>">
    <div class='w3-row'>
      <div class='w3-col'>
        <label class='w3-label w3-text'>Temp </label>
        <input type="text" name="tanggal" placeholder="Temp" required>
      </div>
    </div>
    <br>
    <button type="submit" name="simpantemp" class="btn w3-red">Simpan</button>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
  </form>
  <?php
}else 
if($id === '8')
{
  ?>
  <form  action="svinafis.php" method="POST">
    <input  type='hidden' name='notrans' value="<?php echo $notrans ?>">
    <input  type='hidden'  name='notransibs' value="<?php echo $notransibs ?>">
    <input  type='hidden'  name='kduser' value="<?php echo $kduser ?>">
    <input  type='hidden' name='x' value="<?php echo $x ?>">
    <input  type='hidden'  name='y' value="<?php echo $y ?>">
    <div class='w3-row'>
      <div class='w3-col'>
        <label class='w3-label w3-text'>Produksi Urine </label>
        <input type="text" name="tanggal" placeholder="Produksi Urine" required>
      </div>
    </div>
    <br>
    <button type="submit" name="simpanpu" class="btn w3-red">Simpan</button>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
  </form>
  <?php
}else 
if($id === '9')
{
  ?>
  <form  action="svinafis.php" method="POST">
    <input  type='hidden' name='notrans' value="<?php echo $notrans ?>">
    <input   type='hidden' name='notransibs' value="<?php echo $notransibs ?>">
    <input  type='hidden'  name='kduser' value="<?php echo $kduser ?>">
    <input  type='hidden' name='x' value="<?php echo $x ?>">
    <input  type='hidden'  name='y' value="<?php echo $y ?>">
    <div class='w3-row'>
      <div class='w3-col'>
        <label class='w3-label w3-text'>Jumlah Pendarahan </label>
        <input type="text" name="tanggal" placeholder="Jumlah Pendarahan " required>
      </div> 
    </div>
    <br>
    <button type="submit" name="simpanjp" class="btn w3-red">Simpan</button>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
  </form>
  <?php
}else 
if($id === 'isigrafik')
{
  $arr = ['nadi','resp','anastesi','operasi','tds','tdd'];
  ?>
  <div class="text-center">
    <?php
    foreach ($arr as  $key => $value) 
    {
      ?>
      <div class="radio-inline">
        <label>
          <input type="radio" name="selection__form" data-id="<?= $value ?>" class="selection__form" style="width: auto !important; height: auto !important;">
          <?= $value ?>
        </label>
      </div>
      <?php
    }
    ?>
  </div>

  <form action="svinafis.php" method="POST" class="__selection" id="nadi" style="display: none">
    <input type='hidden' name='notrans' value="<?php echo $notrans ?>">
    <input  type='hidden' name='notransibs' value="<?php echo $notransibs ?>">
    <input  type='hidden' name='kduser' value="<?php echo $kduser ?>">
    <input type='hidden' name='x' value="<?php echo $x ?>">
    <input type='hidden' name='y' value="<?php echo $y ?>">
    <div class='w3-row'>
      <div class='w3-col'>
        <label class='w3-label w3-text'>Nadi</label>
        <input type="text" name="tanggal" placeholder="Nadi " required>
      </div>
    </div>
    <br>
    <button type="submit" name="simpannadi" class="btn w3-red">Simpan</button>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
  </form>

  <form  action="svinafis.php" method="POST" class="__selection" id="resp" style="display: none">
    <input type='hidden' name='notrans' value="<?php echo $notrans ?>">
    <input  type='hidden' name='notransibs' value="<?php echo $notransibs ?>">
    <input  type='hidden' name='kduser' value="<?php echo $kduser ?>">
    <input type='hidden' name='x' value="<?php echo $x ?>">
    <input type='hidden' name='y' value="<?php echo $y ?>">
    <div class='w3-row'>
      <div class='w3-col'>
        <label class='w3-label w3-text'>Resp</label>
        <input type="text" name="tanggal" placeholder="Resp " required>
      </div>
    </div>
    <br>
    <button type="submit" name="simpanrp" class="btn w3-red">Simpan</button>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
  </form>

  <form  action="svinafis.php" method="POST" class="__selection" id="anastesi" style="display: none;">
    <input type='hidden' name='notrans' value="<?php echo $notrans ?>">
    <input  type='hidden' name='notransibs' value="<?php echo $notransibs ?>">
    <input  type='hidden' name='kduser' value="<?php echo $kduser ?>">
    <input type='hidden' name='x' value="<?php echo $x ?>">
    <input type='hidden' name='y' value="<?php echo $y ?>">
    <div class='w3-row'>
      <div class='w3-col'>
        <label class='w3-label w3-text'>Anastesi</label>
        <input type="text" name="tanggal" placeholder="Anastesi " required>
      </div>
    </div>
    <br>
    <button type="submit" name="simpanan" class="btn w3-red">Simpan</button>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
  </form>

  <form  action="svinafis.php" method="POST" class="__selection" id="operasi" style="display: none">
    <input type='hidden' name='notrans' value="<?php echo $notrans ?>">
    <input  type='hidden' name='notransibs' value="<?php echo $notransibs ?>">
    <input  type='hidden' name='kduser' value="<?php echo $kduser ?>">
    <input type='hidden' name='x' value="<?php echo $x ?>">
    <input type='hidden' name='y' value="<?php echo $y ?>">
    <div class='w3-row'>
      <div class='w3-col'>
        <label class='w3-label w3-text'>Operasi</label>
        <input type="text" name="tanggal" placeholder="Operasi " required>
      </div>
    </div>
    <br>
    <button type="submit" name="simpanop" class="btn w3-red">Simpan</button>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
  </form>

  <form  action="svinafis.php" method="POST" class="__selection" id="tds" style="display: none;">
    <input type='hidden' name='notrans' value="<?php echo $notrans ?>">
    <input  type='hidden' name='notransibs' value="<?php echo $notransibs ?>">
    <input  type='hidden' name='kduser' value="<?php echo $kduser ?>">
    <input type='hidden' name='x' value="<?php echo $x ?>">
    <input type='hidden' name='y' value="<?php echo $y ?>">
    <div class='w3-row'>
      <div class='w3-col'>
        <label class='w3-label w3-text'>TDS</label>
        <input type="text" name="tanggal" placeholder="TDS " required>
      </div>
    </div>
    <br>
    <button type="submit" name="simpantds" class="btn w3-red">Simpan</button>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
  </form>

  <form  action="svinafis.php" method="POST" class="__selection" id="tdd" style="display: none;">
    <input type='hidden' name='notrans' value="<?php echo $notrans ?>">
    <input  type='hidden' name='notransibs' value="<?php echo $notransibs ?>">
    <input  type='hidden' name='kduser' value="<?php echo $kduser ?>">
    <input type='hidden' name='x' value="<?php echo $x ?>">
    <input type='hidden' name='y' value="<?php echo $y ?>">
    <div class='w3-row'>
      <div class='w3-col'>
        <label class='w3-label w3-text'>TDD</label>
        <input type="text" name="tanggal" placeholder="TDD " required>
      </div>
    </div>
    <br>
    <button type="submit" name="simpantdd" class="btn w3-red">Simpan</button>
    <button type="button" class="btn w3-green" data-dismiss="modal">Batal</button>
  </form>
  <?php
}
?>