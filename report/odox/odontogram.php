
<!DOCTYPE html>
<html>
<head>
    <title>ODONTOGRAM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../js/jquery-ui/jquery-ui.css">
     <link rel="shortcut icon" href="../favicon.ico" />

    <style>
    .w3-theme {color:#fff !important;background-color:#4CAF50 !important;}
    .w3-btn {background-color:#4CAF50 ;margin-bottom:4px;}
    .w3-code{border-left:4px solid #4CAF50}
    @media only screen and (max-width: 601px) {.w3-top{position:static;} #main{margin-top:0px !important}}


    .tbl th.header { 
        background-image: url(../js/table.sorter/themes/blue/bg.gif);
        cursor: pointer; 
        font-weight: bold; 
        background-repeat: no-repeat; 
        background-position: center left; 
        padding-left: 20px; 
        margin-left: -1px; 
    }

    .tbl th.headerSortUp { 
      background-image: url(../js/table.sorter/themes/blue/asc.gif);
      cursor: pointer; 
        font-weight: bold; 
        background-repeat: no-repeat; 
        background-position: center left; 
        padding-left: 20px; 
        margin-left: -1px; 

    } 
    .tbl th.headerSortDown { 
      background-image: url(../js/table.sorter/themes/blue/desc.gif);
      cursor: pointer; 
        font-weight: bold; 
        background-repeat: no-repeat; 
        background-position: center left; 
        padding-left: 20px; 
        margin-left: -1px; 
    } 
    .ui-datepicker {
        font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
        font-size: 80.5%;
    }
    .ui-tooltip-content {
        font-size: 80.5%;
    }

    .centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}


.container {
  position: relative;
  text-align: center;
  color: white;
}
input {
    background-color: transparent;
    border: 0px solid;
    height: 20px;
    width: 160px;
   
}

.hitam{
  color:black;
}
.sd{
  font-size: 17px;
}

.kontener{
  width: 100%;
  min-height: 100px;
}



    </style>
<script src="../js/jquery-1.12.2.min.js"></script>
  
<script src="../js/bootstrap.min.js"></script>
<link href="../css/bootstrap.min.css" rel="stylesheet"/>

<script src="../js/jquery-ui/jquery-ui.min.js"></script>
<script src="../js/perfect-scrollbar.min.js"></script>
<script src="../js/sweetalert2.min.js"></script>
<script src="../js/jquery.number.js"></script>
<script src="../js/table.sorter/jquery.tablesorter.js"></script>
<script src="../js/w3codecolors.js"></script>
<script src="../js/pace.min.js"></script>
   
  <link rel="stylesheet" href="../waktu/css/bootstrap-material-datetimepicker.css" />
  
<script type="text/javascript" src="../waktu/js/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="../waktu/js/bootstrap-material-datetimepicker.js"></script>


  

</head>
</html>

<?php
  include '../../koneksi.php';

  $kdcabang = $_GET['kdcabang'];
  $notrans = $_GET['notrans'];
$norm = $_GET['norm'];
$kddokter = $_GET['kddokter'];

 $query="SELECT * from cabang where kdcabang='$kdcabang'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $namaklinik=$row['nama'];
                    $alamat=$row['alamat'];
                    $hp=$row['hp'];
                    
                    
                  }


?>

<div style="text-align: center;">
<h4>FORMULIR PEMERIKSAAN ODONTOGRAM</h4>
<span><?php echo $namaklinik ?></span>

</div>

<div style="text-align: left;color:black;border-bottom: 3px solid black;">

<table>
     <?php
$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' and a.notransaksi='$notrans'   order by a.kddokter,c.noantrian asc";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                  
                    ?>

                     No Transaksi : <?php echo $row['notransaksi'] ?></br>
            Nama  : <?php echo $row['pasien'] ?></br>
            Tgl Lahir   : <?php echo $row['tgllahir'] ?></br>
             Alamat : <?php echo $row['alamat'] ?></br>
            Klinik  : <?php echo $row['nampoli'] ?></br>
            Dokter   : <?php echo $row['namdokter'] ?></br>
                  Kostumer   : <?php echo $row['nama'] ?></br>    
                 <?php }


          ?>
          
</table>




</div>



  <div style="padding: 10px;" class="kontener">

     <table style="width:100%">
         <tr >
            <td style="width:10%;border:1px solid black;">
11[51]
            </td>

            <td style="width:40%;border:1px solid black;">

            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
[61]21
            </td>



         </tr>

            <tr >
            <td style="width:10%;border:1px solid black;">
12[52]
            </td>

            <td style="width:40%;border:1px solid black;">

            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
[62]22
            </td>

         </tr>


         <tr >
            <td style="width:10%;border:1px solid black;">
13[53]
            </td>

            <td style="width:40%;border:1px solid black;">

            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
[63]23
            </td>

         </tr>

 <tr >
            <td style="width:10%;border:1px solid black;">
14[54]
            </td>

            <td style="width:40%;border:1px solid black;">

            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
[64]24
            </td>

         </tr>

 <tr >
            <td style="width:10%;border:1px solid black;">
15[55]
            </td>

            <td style="width:40%;border:1px solid black;">

            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
[65]25
            </td>

         </tr>


 <tr >
            <td style="width:10%;border:1px solid black;">
16
            </td>

            <td style="width:40%;border:1px solid black;">

            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
26
            </td>

         </tr>

 <tr >
            <td style="width:10%;border:1px solid black;">
17
            </td>

            <td style="width:40%;border:1px solid black;">

            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
27
            </td>

         </tr>
 <tr >
            <td style="width:10%;border:1px solid black;">
18
            </td>

            <td style="width:40%;border:1px solid black;">

            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
28
            </td>

         </tr>
     </table>

<br>
<div style="text-align:center;">

<img src="odonx.png" alt="Workplace" usemap="#workmap" width="662" height="335">


<!--  <a 
     data-toggle='modal' fill='red' data-target='#tanggal' >15.0XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</a> -->


<map name="workmap">

  <area shape="rect" coords="38,54,75,56" alt="Computer" href="#tanggal" data-toggle='modal' fill='red'  >
  <!-- <area shape="rect" coords="290,172,333,250" alt="Phone" href="phone.htm">
  <area shape="circle" coords="337,300,44" alt="Cup of coffee" href="coffee.htm"> -->
</map>
<br>
<br>
  <table style="width:100%">
         <tr >
            <td style="width:10%;border:1px solid black;">
48
            </td>

            <td style="width:40%;border:1px solid black;">

            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
38
            </td>



         </tr>



    <tr >
            <td style="width:10%;border:1px solid black;">
47
            </td>

            <td style="width:40%;border:1px solid black;">

            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
37
            </td>



         </tr>



<tr >
            <td style="width:10%;border:1px solid black;">
46
            </td>

            <td style="width:40%;border:1px solid black;">

            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
36
            </td>



         </tr>



<tr >
            <td style="width:10%;border:1px solid black;">
45[85]
            </td>

            <td style="width:40%;border:1px solid black;">

            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
75[35]
            </td>



         </tr>




         <tr >
            <td style="width:10%;border:1px solid black;">
44[84]
            </td>

            <td style="width:40%;border:1px solid black;">

            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
74[34]
            </td>



         </tr>





       <tr >
            <td style="width:10%;border:1px solid black;">
43[83]
            </td>

            <td style="width:40%;border:1px solid black;">

            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
73[33]
            </td>



         </tr>








       <tr >
            <td style="width:10%;border:1px solid black;">
42[82]
            </td>

            <td style="width:40%;border:1px solid black;">

            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
72[32]
            </td>



         </tr>


       <tr >
            <td style="width:10%;border:1px solid black;">
41[81]
            </td>

            <td style="width:40%;border:1px solid black;">

            </td>
           <td style="width:40%;border:1px solid black;">

            </td>

                       <td style="width:10%;border:1px solid black;">
71[31]
            </td>



         </tr>




     </table>





</div>


<b>Occlusi : </b>  <br>

<b>Torus Palatinus : </b>  <br>
<b>Torus Mandibularis : </b>  <br>
<b>Palatum : </b>  <br>
<b>Diastema : </b>  <br>
<b>Gigi Anomali : </b>  <br>
<b>Lain - Lain : </b>  <br>
<b>D :     M:        F:            </b>  <br>

<p>Jumlah photo yang di ambil </p>
<p>Jumlah rontgen photo yang di ambil </p>
</div>
   
<!-- <ul class="nav nav-tabs" >
  <li class="active"><a    href="#gigi" data-toggle="tab">PERMUKAAN GIGI</a></li>
  <li ><a   href="#ke" data-toggle="tab">KEADAAN GIGI</a></li>
  <li><a href="#br" data-toggle="tab">BAHAN RESTORASI</a></li>
  <li><a href="#rs" data-toggle="tab">RESTORASI</a></li>
</ul>
<div class="panel-body" >



 <div class="tab-content">
<div  class="tab-pane fade in active"  id="gigi" >
<table>
    <tr>
        <td>
        M
        </td>
         <td>
Mesial
        </td>
          <td >
<button type='submit' name='simpan' class='btn w3-green'>P</button>
        </td>
    </tr>

      <tr>
        <td>
        O
        </td>
         <td>
Occlusal
        </td>
          <td >
<button type='submit' name='simpan' class='btn w3-green'>P</button>
        </td>
    </tr>


 <tr>
        <td>
        D
        </td>
         <td>
Distal
        </td>
          <td >
<button type='submit' name='simpan' class='btn w3-green'>P</button>
        </td>
    </tr>
<tr>
        <td>
        V
        </td>
         <td>
Vestibular/Bukal/Labial
        </td>
          <td >
<button type='submit' name='simpan' class='btn w3-green'>P</button>
        </td>
    </tr>
</table>
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
<div class="modal fade" id="hapuslembar" role="hapuslembar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     
                    <h5 class="modal-title w3-pink">HAPUS LEMBAR</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>

<div class="modal fade" id="tandavital" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     
                    <h5 class="modal-title w3-pink">Input Tanda Vital</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>


<div class="modal fade" id="tanggal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     
                    <h5 class="modal-title w3-pink">Status</h5>
                  </div>
                 
                <!-- </div> -->
                <div class="modal-body">
                    <div class="modal-data"></div>
                </div>
            </div>
      </div>
</div>








  <script type="text/javascript">

$('#tanggal').on('show.bs.modal', function (e) {
           
//             var notrans = $(e.relatedTarget).data('notrans');
//             var norm = $(e.relatedTarget).data('norm');
// var nolembar = $(e.relatedTarget).data('nolembar');
// var x = $(e.relatedTarget).data('x');
// var y = $(e.relatedTarget).data('y');

// var kduser = $(e.relatedTarget).data('kduser');
//        console.log(notrans,norm,nolembar,x,y);
         
            $.ajax({
                type : 'post',
                url : 'pilihan.php',
              
                 data :  'notrans=x',
            
                success : function(data){
                $('.modal-data').html(data);
             
                }
            });
         });




$('#tandavital').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
var nolembar = $(e.relatedTarget).data('nolembar');
var x = $(e.relatedTarget).data('x');
var y = $(e.relatedTarget).data('y');
var kduser = $(e.relatedTarget).data('kduser');
       console.log(notrans,norm,nolembar,x,y,kduser);
         
            $.ajax({
                type : 'post',
                url : 'inputews.php',
               
data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'nolembar='+nolembar+'&'+'x='+x+'&'+'y='+y+'&kduser='+kduser,
            
                success : function(data){
                $('.modal-data').html(data);
             
                }
            });
         });










$('#hapuslembar').on('show.bs.modal', function (e) {
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
var nolembar = $(e.relatedTarget).data('nolembar');
var x = $(e.relatedTarget).data('x');
var y = $(e.relatedTarget).data('y');
var kduser = $(e.relatedTarget).data('kduser');
       console.log(notrans,norm,nolembar,x,y,kduser);
         
            $.ajax({
                type : 'post',
                url : 'hapuslembar.php',
               
data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'nolembar='+nolembar+'&kduser='+kduser,
            
                success : function(data){
                $('.modal-data').html(data);
             
                }
            });
         });


</script>


 
    

     



</body>

 <button class="btn btn-primary noprint" onclick="window.print()" style="position: fixed;top: 0; margin: 10px;right: 50px">PRINT</button>
  



</html>