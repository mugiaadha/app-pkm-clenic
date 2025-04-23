
<!DOCTYPE html>
<html>
<head>
    <title>TTV</title>
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
$notrans=$_GET['notrans'];
$norm=$_GET['norm'];
$nolembar=$_GET['nolembar'];
$kduser=$_GET['kduser'];
include '../../config.php';

if (empty($notrans) || empty($nolembar)) 
{
  echo 'Anda Belum Menambah Lembar atau memilih lembar';
  exit();
}



// echo $nolembar;
// $sql = "SELECT * from ERMEWSNOLEMBAR where notrans='$notrans' and nolembars='$nolembar' and status='EWS' order by nolembars";
// $result = sqlsrv_query( $conn, $sql );




//   $nomor = 0;
//     $angka = 0;
//  while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
//  { 

// $nomor++;


// echo $nomor;

// }



?>

<div style="text-align: center;border-bottom: 1px dashed black">
<h4>LEMBAR OBSERVASI (RM.LB.68)</h4>


</div>

<div style="text-align: center;color:black">

<p>PENTUNJUK UMUM</p>


<?php

$sqlsd = "SELECT top 1 *  FROM  ERMEWSHASILFIX where  notrans='$notrans' and nolembar='$nolembar' order by tanggal desc";
 $stmtsd = sqlsrv_query( $conn, $sqlsd );
while( $rows = sqlsrv_fetch_array( $stmtsd, SQLSRV_FETCH_ASSOC) ) {

echo "<p>Total Skor Terkahir : ".$rows['totalskor']."</p>";
$totalskor = $rows['totalskor'];

if ($totalskor == 0){
  $fxm ='Minamal 8-12 Jam';
 $alert = 'Perawat Yang Bertugas';
 $responklinik ="Lanjutkan pemantauan rutin";
}else if ($totalskor >= 1 && $totalskor <= 4 ) {
  # code...
    $fxm ='Minamal 4-6 Jam';
  $fm=6;
   $alert = 'Perawat Yang Bertugas';
   $responklinik ="<b>1.</b>Informasikan PJ Shift yang harus menilai pasien<br>
<b>2.</b>perawat yang memutuskan apakah peningkatan frekuensi pemantauan dan atau peningkatan perawatan klinis (eskalasi di perlukan)";

}else if ($totalskor == 5 ){
    $fxm ='Meningkatkan frekuensi observasi setiap 1 jam';
$fm=1;
 $alert = 'Perawat Yang Bertugas dan dokter jaga ruangan';
 $responklinik ='<b>1.</b>PJ Shift memberitahukan tim medis yang merawat pasien<br>
<b>2.</b>Pengkajian dan asesmen oleh dokter dengan kompetensi inti untuk menilai pasien akut<br>
<b>3.</b>Perawatan klinis di lingkungan dengan fasilitas monitoring<br>';
}else if ($totalskor == 6) {
  # code...
   $fxm ='Meningkatkan frekuensi observasi setiap 1 jam';
  $fm=1;
   $alert = 'Perawat Yang Bertugas dan dokter jaga ruangan';
    $responklinik ='<b>1.</b>PJ Shift memberitahukan tim medis yang merawat pasien<br>
<b>2.</b>Pengkajian dan asesmen oleh dokter dengan kompetensi inti untuk menilai pasien akut<br>
<b>3.</b>Perawatan klinis di lingkungan dengan fasilitas monitoring<br>';
}else if ($totalskor >= 7) {
  # code...

  $fxm ='Pemantauan terus menerus terhadap tanda-tanda vital(tiap 1/2 jam)';
  $fm=1/2;
   $alert = 'Perawat Yang Bertugas,dokter jaga ruangan dan DPJP (Tim kode biru sesuai indikasi)';
    $responklinik ='<b>1.</b>PJ Shift memberitahukan tim medis yang merawat pasien<br>
<b>2.</b>Pengkajian dan asesmen oleh dokter dengan kompetensi inti untuk menilai pasien akut<br>
<b>3.</b>Perawatan klinis di lingkungan dengan fasilitas monitoring<br>';
}

echo "<span style='color:red'>Frekuensi  : </span>".$fxm."<br>";
echo "<span style='color:red'>Alert : </span>".$alert."<br>";
echo "<span style='color:red'>Respon Klinik :</span> ".$responklinik."";



}

?>


</div>



  <div style="padding: 10px;
  " class="kontener">


<svg height="1100" width="991" style="background: url(tblewsc.jpg) no-repeat 0 0;border-bottom: 1px solid black" >
   <text x='105' y='20' fill='black' style='font-size: 12px'>


    <a data-x='105' data-y='20' data-notrans='<?php echo $notrans?>' data-norm='<?php echo $norm?>'
data-nolembar='<?php echo $nolembar?>' data-kduser='<?php echo $kduser ?>'
     data-toggle='modal' fill='transparent' data-target='#tanggal' >15.0XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</a>


   </text>

   <?php 


$sqlsd = "SELECT * FROM  ERMEWSTGL where  notrans='$notrans' and nolembar='$nolembar' ";
 $stmtsd = sqlsrv_query( $conn, $sqlsd );
while( $rowsd = sqlsrv_fetch_array( $stmtsd, SQLSRV_FETCH_ASSOC) ) {



  echo "<text x='".$rowsd['x']."' y='".$rowsd['y']."' fill='black' style='font-size: 12px;font-style: bold'>".date_format($rowsd['tanggal'],'Y-m-d')."</text>";


}

   ?>




<?php  
for ($x = 103; $x <= 952; $x+=26) {


  echo "<text x='$x' y='34' fill='red' style='font-size: 11px;font-style: bold'>

<a data-x='$x' data-y='34' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar' data-kduser='$kduser'
     data-toggle='modal' fill='transparent' data-target='#tandavital' >15x</a>

  </text>";
}


$sqlsd = "SELECT * FROM  ERMEWSWAKTU where  notrans='$notrans' and nolembar='$nolembar' order by jamx";
 $stmtsd = sqlsrv_query( $conn, $sqlsd );
while( $rowsd = sqlsrv_fetch_array( $stmtsd, SQLSRV_FETCH_ASSOC) ) {


$menity = $rowsd['jamy'] + 9;
  echo "<text x='".$rowsd['jamx']."' y='".$rowsd['jamy']."' fill='black' style='font-size: 12px;'>".$rowsd['jam'].'.'."</text>";

 echo "<text x='".$rowsd['jamx']."' y='".$menity."' fill='black' style='font-size: 12px;'>".$rowsd['menit']."</text>";


echo "<text x='".$rowsd['jamx']."' y='34' fill='red' style='font-size: 11px;font-style: bold'>
<a data-x='".$rowsd['jamx']."' data-y='34' data-notrans='$notrans' data-norm='$norm'
data-nolembar='$nolembar'
     data-toggle='modal' fill='transparent' data-target='#tandavital' >15x</a>
     </text>";





}

   ?>



?>




<!-- RR -->

 <polyline points=
"<?php
$sqls = "SELECT * FROM  ERMEWSHASILFIX where  notrans='$notrans' and nolembar='$nolembar' order by rrx ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {
$xf=$rows['rrx'];
$yf=$rows['rry'];
$polidjj=$xf.','.$yf.' ';
echo $polidjj;
}?>"style="fill:none;stroke:black;stroke-width:1" />



 <polyline points=
"<?php
$sqls = "SELECT * FROM  ERMEWSHASILFIX where  notrans='$notrans' and nolembar='$nolembar' order by rrx ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {
$xf=$rows['satx'];
$yf=$rows['saty'];
$polidjj=$xf.','.$yf.' ';
echo $polidjj;
}?>"style="fill:none;stroke:black;stroke-width:1" />




 <polyline points=
"<?php
$sqls = "SELECT * FROM  ERMEWSHASILFIX where  notrans='$notrans' and nolembar='$nolembar' order by rrx ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {
$xf=$rows['tempx'];
$yf=$rows['tempy']+20;
$polidjj=$xf.','.$yf.' ';
echo $polidjj;
}?>"style="fill:none;stroke:black;stroke-width:1" />



 <polyline points=
"<?php
$sqls = "SELECT * FROM  ERMEWSHASILFIX where  notrans='$notrans' and nolembar='$nolembar' order by rrx ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {
$xf=$rows['tdx'];
$yf=$rows['tdy']+20;
$polidjj=$xf.','.$yf.' ';
echo $polidjj;
}?>"style="fill:none;stroke:black;stroke-width:1" />



 <polyline points=
"<?php
$sqls = "SELECT * FROM  ERMEWSHASILFIX where  notrans='$notrans' and nolembar='$nolembar' order by rrx ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {
$xf=$rows['tdx'];
$yf=$rows['tddy']+20;
$polidjj=$xf.','.$yf.' ';
echo $polidjj;
}?>"style="fill:none;stroke:black;stroke-width:1" />




 <polyline points=
"<?php
$sqls = "SELECT * FROM  ERMEWSHASILFIX where  notrans='$notrans' and nolembar='$nolembar' order by rrx ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {
$xf=$rows['tdx'];
$yf=$rows['tdy']+20;
$polidjj=$xf.','.$yf.' ';
echo $polidjj;
}?>"style="fill:none;stroke:black;stroke-width:1" />



 <polyline points=
"<?php
$sqls = "SELECT * FROM  ERMEWSHASILFIX where  notrans='$notrans' and nolembar='$nolembar' order by rrx ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {
$xf=$rows['hrx'];
$yf=$rows['hry']+20;
$polidjj=$xf.','.$yf.' ';
echo $polidjj;
}?>"style="fill:none;stroke:black;stroke-width:1" />



 <polyline points=
"<?php
$sqls = "SELECT * FROM  ERMEWSHASILFIX where  notrans='$notrans' and nolembar='$nolembar' order by rrx ";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                     

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {
$xf=$rows['lkx'];
$yf=$rows['lky'];
$polidjj=$xf.','.$yf.' ';
echo $polidjj;
}?>"style="fill:none;stroke:black;stroke-width:1" />


 <?php  


$sqlsd = "SELECT * FROM  ERMEWSHASILFIX where  notrans='$notrans' and nolembar='$nolembar' order by rrx ";
 $stmtsd = sqlsrv_query( $conn, $sqlsd );
while( $rows = sqlsrv_fetch_array( $stmtsd, SQLSRV_FETCH_ASSOC) ) {


echo "<circle cx='".$rows['rrx']."' cy='".$rows['rry']."' r='4'   fill='black' />";
echo "<text x='".$rows['rrx']."' y='".$rows['rry']."' fill='red' style='font-size: 11px;'>".$rows['rr']."</text>";


echo "<text x='".$rows['satx']."' y='".$rows['saty']."' fill='red' style='font-size: 11px;'>".$rows['sat']."</text>";

echo "<circle cx='".$rows['satx']."' cy='".$rows['saty']."' r='4'   fill='black' />";

$aoxt=$rows['aox']+5;
$aoyt=$rows['aoy']+5;

echo "<text x='".$aoxt."' y='".$aoyt."' fill='black' style='font-size: 11px;'>".$rows['ao']."</text>";
echo "<text x='".$rows['alatx']."' y='".$rows['alaty']."' fill='black' style='font-size: 11px;'>".$rows['alat']."</text>";


$ytemp=$rows['tempy']+20;

echo "<circle cx='".$rows['tempx']."' cy='".$ytemp."' r='4'   fill='black' />";
echo "<text x='".$rows['tempx']."' y='".$ytemp."' fill='red' style='font-size: 11px;'>".$rows['temp']."</text>";




$tdy=$rows['tdy']+20;

echo "<circle cx='".$rows['tdx']."' cy='".$tdy."' r='4'   fill='black' />";

echo "<text x='".$rows['tdx']."' y='".$tdy."' fill='red' style='font-size: 11px;'>".$rows['td']."</text>";



$tddy=$rows['tddy']+20;

echo "<circle cx='".$rows['tdx']."' cy='".$tddy."' r='4'   fill='black' />";

echo "<text x='".$rows['tdx']."' y='".$tddy."' fill='red' style='font-size: 11px;'>".$rows['tdd']."</text>";





$hry=$rows['hry']+20;

echo "<circle cx='".$rows['hrx']."' cy='".$hry."' r='4'   fill='black' />";
echo "<text x='".$rows['hrx']."' y='".$hry."' fill='red' style='font-size: 11px;'>".$rows['hr']."</text>";


echo "<circle cx='".$rows['lkx']."' cy='".$rows['lky']."' r='4'   fill='black' />";


echo "<text x='".$rows['gdx']."' y='".$rows['gdy']."' fill='red' style='font-size: 11px;'>".$rows['gd']."</text>";

$tsx = $rows['totalskorx']+5;
$tsy = $rows['totalskory']+5;

echo "<text x='".$tsx."' y='".$tsy."' fill='red' style='font-size: 12px;'>".$rows['totalskor']."</text>";

$snx = $rows['snx']+5;
$sny = $rows['sny']+5;


$uox = $rows['uox']+5;
$uoy = $rows['uoy']+5;


$fmx = $rows['fmx']+5;
$fmy = $rows['fmy']+5;





echo "<text x='".$snx."' y='".$sny."' fill='red' style='font-size: 12px;'>".$rows['sn']."</text>";



echo "<text x='".$uox."' y='".$uoy."' fill='red' style='font-size: 12px;'>".$rows['uo']."</text>";


echo "<text x='".$fmx."' y='".$fmy."' fill='red' style='font-size: 12px;'>".$rows['fm']."</text>";


$fmyh = $rows['fmy']+40;




if($rows["kduser"] === '$kduser'){
$array_1= "-";

}else{
$array_1= $rows['kduser'];

}

$val = $fmyh;

$pemisah = strlen($array_1);
 for ($x=0;$x<$pemisah; $x++){
  $pecah1 = substr($array_1,$x,1);

  // echo $pecah1.' '.$val."<br>";

    echo "<text x='".$fmx."' y='".$val."' fill='black' style='font-size: 12px;font-weight:bold'>".$pecah1."</text>";


  $val += 10;




 }
 





}

?> 


</svg>
<br>


<a data-notrans='<?php echo $notrans?>'
data-nolembar='<?php echo $nolembar ?>'
data-norm='<?php echo $norm ?>'
data-kduser='<?php echo $kduser ?>'
     data-toggle='modal'  data-target='#hapuslembar' >
       
       <b style="color:red">HAPUS LEMBAR INI</b>
     </a>

     


</div>


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
                     
                    <h5 class="modal-title w3-pink">Tanggal</h5>
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
           
            var notrans = $(e.relatedTarget).data('notrans');
            var norm = $(e.relatedTarget).data('norm');
var nolembar = $(e.relatedTarget).data('nolembar');
var x = $(e.relatedTarget).data('x');
var y = $(e.relatedTarget).data('y');

var kduser = $(e.relatedTarget).data('kduser');
       console.log(notrans,norm,nolembar,x,y);
         
            $.ajax({
                type : 'post',
                url : 'tglews.php',
              
                 data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'nolembar='+nolembar+'&'+'x='+x+'&'+'y='+y+'&kduser='+kduser,
            
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




</html>