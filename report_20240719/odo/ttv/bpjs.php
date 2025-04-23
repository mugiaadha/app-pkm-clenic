
<!DOCTYPE html>
<html>
<head>
    <title>Vk Pengawasan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../js/jquery-ui/jquery-ui.css">
     <link rel="shortcut icon" href="../favicon.ico" />
    <style>

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

.block {
  display: block;
  width: 100%;
  border: none;
  background-color: #4CAF50;
  padding: 14px 28px;
  font-size: 16px;
  cursor: pointer;
  text-align: center;
}

* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 30%;
  /*padding: 10px;*/
  height: 300px;
   /* Should be removed. Only for demonstration */
}

.column1 {
  float: left;
  width: 70%;
  /*padding: 10px;*/
  height: 300px;
   /* Should be removed. Only for demonstration */
}


/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
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




<div>
<h3>BPJS</h3>
</div>
<div class="row" style="padding: 20px">



   <form  action="asesmenvk.php" method="POST">
                       




<table>
    <tr>
<td>
     <label class='w3-label w3-text'><a href="http://192.168.2.189:8049/rjx/ws_antrianbpjs/kirimantrianall.php">Kirim Pasien</a> </label>
</td>
<td>
   <label class='w3-label w3-text'><a href="http://192.168.2.189:8049/rjx/ws_antrianbpjs/waktuTunggu3.php">Waktu Tunggu 3</a> </label> 
                        
</td>
<td>
   <label class='w3-label w3-text'><a href="http://192.168.2.189:8049/rjx/ws_antrianbpjs/waktuTunggu4.php">Waktu Tunggu 4</a> </label> 
                        
</td>

<td>
   <label class='w3-label w3-text'><a href="http://192.168.2.189:8049/rjx/ws_antrianbpjs/waktuTunggu5.php">Waktu Tunggu 5</a> </label> 
                        
</td>

<td>
   <label class='w3-label w3-text'><a href="http://192.168.2.189:8049/rjx/ws_antrianbpjs/waktuTunggu6.php">Waktu Tunggu 6</a> </label> 
                        
</td>

<td>
   <label class='w3-label w3-text'><a href="http://192.168.2.189:8049/rjx/ws_antrianbpjs/waktuTunggu7.php">Waktu Tunggu 7</a> </label> 
                        
</td>

  </tr>
  
</table>


               
                        
 </form>



</div>







<div class="modal fade" id="tanggal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header w3-white"> -->
                  <div  style="text-align: center;">
                     
                    <h5 class="modal-title w3-pink">Edit</h5>
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
           
             var no = $(e.relatedTarget).data('no');
             var notrans = $(e.relatedTarget).data('notrans');
             var norm = $(e.relatedTarget).data('norm');
             var kduser = $(e.relatedTarget).data('kduser');



            $.ajax({
                type : 'post',
                url : 'hapusvk.php',
                // data :  'no='+no,

                data :  'notrans='+notrans+'&'+'norm='+norm+'&'+'no='+no+'&kduser='+kduser,
         


                success : function(data){
                $('.modal-data').html(data);
             
                }
            });
         });







</script>


    

     



</body>




</html>