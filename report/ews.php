
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
  include '../koneksi.php';

  $kdcabang = $_GET['kdcabang'];
  $notrans = $_GET['notrans'];
$norm = $_GET['norm'];
$kddokter = $_GET['kddokter'];



?>

<div style="text-align: center;border-bottom: 1px dashed black">
<h4>LEMBAR OBSERVASI (RM.LB.68)</h4>


</div>

<div style="text-align: center;color:black">

<p>PENTUNJUK UMUM</p>




</div>



  <div style="padding: 10px;" class="kontener">

     


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