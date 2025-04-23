

<?php 
$x=$_POST['x'];
$y=$_POST['y'];
$norm=$_POST['norm'];
$notrans=$_POST['notrans'];




?>

<b>PERMUKAAN GIGI </b>



<table>
    <tr>
        <td>
                   <form  action="svkeadaangigi.php" method="POST">
<input   type='hidden'  name='x' value="<?php echo $x ?>">
<input    type='hidden'  name='y' value="<?php echo $y ?>">
 <input  type='hidden'   name='notrans' value="<?php echo $notrans ?>">
      <select name="kg" style="width:50%;height:30%">
                                           <option value="0"> - </option>
                                       <option value="M">Mesial</option>
                                      <option value="O">Occlusal</option>
                                       <option value="D">Distal</option>
                                       <option value="V">Vestibular/Bukal/Labial</option>
                                  
                                    
                                    

                                     </select>
                                      <input  style="border: 1px solid grey;width: 50px;"  name='nomor' placeholder="Gigi Nomor">
                                      <button type="submit" name="simpan" class="btn w3-green">Simpan</button>
           </form>

        </td>
    

    
    </tr>

     


</table>




<b>KEADAAN GIGI</b>

<table>
    <tr>
        <td>
                   <form  action="svkeadaangigi.php" method="POST">
<input   type='hidden'  name='x' value="<?php echo $x ?>">
<input    type='hidden'  name='y' value="<?php echo $y ?>">
 <input  type='hidden'   name='notrans' value="<?php echo $notrans ?>">
      <select name="kg" style="width:50%;height:30%">
                                           <option value="0"> - </option>
                                       <option value="sou"> Gigi Sehat</option>
                                      <option value="non">Gigi Tidak ada</option>
                                       <option value="une">Un-erupted</option>
                                       <option value="pre"> Partial Erupted </option>
<option value="imv"> Impaksi </option>
<option value="ano"> Anomali </option>
<option value="dia"> Diastema </option>
<option value="att"> Atrisi </option>
<option value="abr"> Abrasi </option>
<option value="car">Caries</option>
<option value="cfr">Crown Fracture</option>
<option value="nvt">Gigi Non Vital</option>
<option value="rrx">Sisa Akar</option>
<option value="mis">Gigi Hilang</option>
 <option value="mis">Gigi elongasi </option>
                                     
                                

                                     </select>
                                      <input  style="border: 1px solid grey;width: 50px;"  name='nomor' placeholder="Gigi Nomor">
                                      <button type="submit" name="simpan" class="btn w3-green">Simpan</button>
           </form>

        </td>
    

    
    </tr>

     


</table>


<b>BAHAN RESTORASI</b>



<table>
    <tr>
        <td>
                   <form  action="svkeadaangigi.php" method="POST">
<input   type='hidden'  name='x' value="<?php echo $x ?>">
<input    type='hidden'  name='y' value="<?php echo $y ?>">
 <input  type='hidden'   name='notrans' value="<?php echo $notrans ?>">
      <select name="kg" style="width:50%;height:30%">
                                           <option value="0"> - </option>
                                       <option value="amf"> amalgam filling</option>
                                      <option value="gif">GIC/Silika</option>
                                       <option value="cof">Composite Filling</option>
                                       <option value="fis">Fissure Sealant </option>
                                   <option value="inl">Inlay </option>
                                   <option value="onl">Onlay </option>
                                   
                                    
                                    

                                     </select>
                                      <input  style="border: 1px solid grey;width: 50px;"  name='nomor' placeholder="Gigi Nomor">
                                      <button type="submit" name="simpan" class="btn w3-green">Simpan</button>
           </form>

        </td>
    

    
    </tr>

     


</table>




<b> RESTORASI</b>

<table>
    <tr>
        <td>
                   <form  action="svkeadaangigi.php" method="POST">
<input   type='hidden'  name='x' value="<?php echo $x ?>">
<input    type='hidden'  name='y' value="<?php echo $y ?>">
 <input  type='hidden'   name='notrans' value="<?php echo $notrans ?>">
      <select name="kg" style="width:50%;height:30%">
                                           <option value="0"> - </option>
                                       <option value="fmc">full metal crown</option>
                                      <option value="poc">porcelain crown</option>
                                       <option value="mpc">metal porcelain crown</option>
                                       <option value="gmc">gold metal crown </option>
                                    <option value="rct">Root Canal treatment </option>
                                     <option value="ipx">Implan </option>
                                    <option value="meb">Metal Bridge </option>
                                    <option value="pob">Porcelain Bridge </option>
                                    <option value="pon">Pontic </option>
                                    <option value="abu">Gigi abutment </option>
                                    
                                    

                                     </select>
                                      <input  style="border: 1px solid grey;width: 50px;"  name='nomor' placeholder="Gigi Nomor">
                                      <button type="submit" name="simpan" class="btn w3-green">Simpan</button>
           </form>

        </td>
    

    
    </tr>

     


</table>




<b> PROTESA</b>

<table>
    <tr>
        <td>
                   <form  action="svkeadaangigi.php" method="POST">
<input   type='hidden'  name='x' value="<?php echo $x ?>">
<input    type='hidden'  name='y' value="<?php echo $y ?>">
 <input  type='hidden'   name='notrans' value="<?php echo $notrans ?>">
      <select name="kg" style="width:50%;height:30%">
                                           <option value="0"> - </option>
                                       <option value="prd">Partial denture</option>
                                      <option value="fld">full denture</option>
                                       <option value="acr">acrilic</option>
                                     
                                   
                                    
                                    

                                     </select>
                                      <input  style="border: 1px solid grey;width: 50px;"  name='nomor' placeholder="Gigi Nomor">
                                      <button type="submit" name="simpan" class="btn w3-green">Simpan</button>
           </form>

        </td>
    

    
    </tr>

     


</table>


<!-- <table>
    <tr>
        <td>
        prd
        </td>
         <td>
Partial denture
        </td>
          <td >
<button type='submit' name='simpan' class='btn w3-green'>P</button>
        </td>
    </tr>

      <tr>
        <td>
        fld
        </td>
         <td>
full denture
        </td>
          <td >
<button type='submit' name='simpan' class='btn w3-green'>P</button>
        </td>
    </tr>

   <tr>
        <td>
        acr
        </td>
         <td>
acrilic
        </td>
          <td >
<button type='submit' name='simpan' class='btn w3-green'>P</button>
        </td>
    </tr>
 
</table>
 -->
<!-- 
<ul class="nav nav-tabs" >
  <li class="active"><a    href="#gigi" data-toggle="tab">PERMUKAAN GIGI</a></li>
  <li ><a   href="#ke" data-toggle="tab">KEADAAN GIGI</a></li>
  <li><a href="#br" data-toggle="tab">BAHAN RESTORASI</a></li>
  <li><a href="#rs" data-toggle="tab">RESTORASI</a></li>
</ul>
<div class="panel-body" >



 <div class="tab-content">
<div  class="tab-pane fade in active"  id="gigi" >

 </div>
 <div  class="tab-pane fade" id="ke">
dddd
sadsd
 </div>
  <div  class="tab-pane fade" id="br">
dddd
sadsd
 </div>

  <div  class="tab-pane fade" id="rs">
dddd
sadsd
 </div>
 </div>
</div> -->
<!-- 
 <form   method="POST">


 <input type='hidden'  name='notrans' value="<?php echo $notrans ?>">
                                  <input  type='hidden' name='norm' value="<?php echo $norm ?>">
                                   <input type='hidden'  name='nolembar' value="<?php echo $nolembar ?>">
   
   

<input type='hidden'   name='kduser' value="<?php echo $kduser ?>">







<row>


<td><button type='submit' name='simpan' class='btn w3-green'>SETUJU</button></td>




<td>
    
    
  </td>
</row>



                     
 </form> -->







