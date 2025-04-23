
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


<?php


$notrans = $_GET['notrans'];
$norm = $_GET['norm'];
$user = $_GET['user'];



// echo $notrans.$norm;

include '../../config.php';



if (isset($_POST['simpan'])){

  $notrans = $_POST['notrans'];
$norm = $_POST['norm'];
$user = $_POST['user'];


 date_default_timezone_set('Asia/Jakarta');

     $tglx = date("Y-m-d H:i:s");
// $nomerews = '001';
// $tgl = $_POST["tgl"];



// $p = $_POST["p"];       
// $q = $_POST["q"];
// $r = $_POST["r"];
// $s = $_POST["s"];
// $t = $_POST["t"];
// $intervensi = $_POST["infar"];

$tgl = $_POST["tgl"];
$ku = $_POST["ku"];
$td = $_POST["td"];
$n = $_POST["n"];
$s = $_POST["s"];
$rr = $_POST["rr"];
$his = $_POST["his"];
$djj= $_POST["djj"];
$Bandiring = $_POST["Bandiring"];
$PPV = $_POST["PPV"];
$tanda = $_POST["tanda"];

  
     $sql ="INSERT INTO ERMVKPENGAWASAN (tgl,notrans, norm, jam, ku, td, n, s, rr, his, djj, bandiring, ppv, tandakal2, nmuser, status) 
     values('$tglx','$notrans','$norm','$tgl','$ku','$td','$n','$s','$rr','$his','$djj','$Bandiring','$PPV','$tanda','$user','A')";
      $outp=sqlsrv_query($conn,$sql);



// echo $sql;
echo "<script> setTimeout(function(){ 
 window.location.href = 'asesmenvk.php?notrans=$notrans&norm=$norm&user=$user'}, 0);</script>";



}else if(isset($_POST['edit'])){


// echo "asdas";

// $nomerews = '001';
// $tgl = $_POST["tgl"];
// $tgltime = $_POST["tgltime"];
// $no = $_POST["no"];



// $notrans = $_POST['notrans'];
// $norm = $_POST['norm'];


// $p = $_POST["p"];       
// $q = $_POST["q"];
// $r = $_POST["r"];
// $s = $_POST["s"];
// $t = $_POST["t"];
// $intervensi = $_POST["infar"];
  
//      $sql ="UPDATE ERMEWSNYERI set tanggal='$tgl',tgltime='$tgltime',p='$p',q='$q',r='$r',s='$s',t='$t',intervensi='$intervensi' where no='$no'";
//       $outp=sqlsrv_query($conn,$sql);




// echo "<script> setTimeout(function(){ 
//  window.location.href = 'asesmennyeri.php?notrans=$notrans&norm=$norm'}, 0);</script>";
// }else if(isset($_POST['hapus'])){


// $nomerews = '001';
// $tgl = $_POST["tgl"];
// $tgltime = $_POST["tgltime"];
// $no = $_POST["no"];



// $notrans = $_POST['notrans'];
// $norm = $_POST['norm'];


// $p = $_POST["p"];       
// $q = $_POST["q"];
// $r = $_POST["r"];
// $s = $_POST["s"];
// $t = $_POST["t"];
// $intervensi = $_POST["infar"];



//   $sql ="DELETE ERMEWSNYERI  where no='$no'";
//       $outp=sqlsrv_query($conn,$sql);



// echo "<script> setTimeout(function(){ 
//  window.location.href = 'asesmennyeri.php?notrans=$notrans&norm=$norm'}, 0);</script>";
}else if(isset($_POST['hapus'])){
$no = $_POST["no"];
  $sql ="DELETE ERMVKPENGAWASAN  where no='$no'";
      $outp=sqlsrv_query($conn,$sql);


echo "<script> setTimeout(function(){ 
 window.location.href = 'asesmenvk.php?notrans=$notrans&norm=$norm&user=$user'}, 0);</script>";

}else{

}
?>


<div>
<h3>VK PENGAWASAN</h3>
</div>
<div class="row" style="padding: 20px">



   <form  action="asesmenvk.php" method="POST">
                       




<table>
    <tr>
<td>
     <label class='w3-label w3-text'>Tanggal </label>
</td>
<td>
   <input type="text" name="tgl" placeholder="tgl" required>
     
                        
</td>
  </tr>
  <tr>
<td>
     <label class='w3-label w3-text'>KU </label>
</td>
<td>
   <input type="text" name="ku" placeholder="KU" required>
                        
      <input type="hidden" name="notrans" value="<?php echo $notrans?>" required>
        <input type="hidden" name="norm" value="<?php echo $norm?>" required>
          <input type="hidden" name="user" value="<?php echo $user ?>" required>
                   
</td>
  </tr>
  <tr>
    <td>
 <label class='w3-label w3-text'>TD </label>
    </td>
        <td>
   <input type="text" name="td" placeholder="TD" required>
                    
    </td>
  </tr>
  <tr>
<td>
 <label class='w3-label w3-text'>N </label>
</td>

<td>
   <input type="text" name="n" placeholder="N" >
                     
</td>
  </tr>




 <tr>
<td>
     <label class='w3-label w3-text'>S </label>
</td>
<td>
   <input type="text" name="s" placeholder="S" required>
                        
                        
</td>
  </tr>
  <tr>
    <td>
 <label class='w3-label w3-text'>RR </label>
    </td>
        <td>
   <input type="text" name="rr" placeholder="RR" required>
                    
    </td>
  </tr>
  <tr>
<td>
 <label class='w3-label w3-text'>HIS </label>
</td>

<td>
   <input type="text" name="his" placeholder="HIS" >
                     
</td>
  </tr>

    <tr>
<td>
 <label class='w3-label w3-text'>DJJ </label>
</td>

<td>
   <input type="text" name="djj" placeholder="DJJ" >
                     
</td>
  </tr>



    <tr>
<td>
 <label class='w3-label w3-text'>Bandiring </label>
</td>

<td>
   <input type="text" name="Bandiring" placeholder="Bandiring" >
                     
</td>
  </tr>


   <tr>
<td>
 <label class='w3-label w3-text'>PPV </label>
</td>

<td>
   <input type="text" name="PPV" placeholder="PPV" >
                     
</td>
  </tr>




   <tr>
<td>
 <label class='w3-label w3-text'>Tanda Kala 2 </label>
</td>

<td>
   <input type="text" name="tanda" placeholder="Tanda Kala 2" >
                     
</td>
  </tr>




</table>



                          
                        <br>


<row>

 <button type="submit" name="simpan" class="btn w3-yellow block">Simpan</button>


</row>
                       
                        
 </form>

<br>


  <table>
  <tr>
      <th>Jam</th>
    <th>KU</th>
    <th>TD</th>
    <th>N</th>
      <th>S</th>
        <th>RR</th>
          <th>HIS</th>
            <th>DJJ</th>


            <th>Bandiring</th>
        <th>PPV</th>
          <th>Tanda Kala 2</th>
            <th>User</th>
   <th>Act</th>

  </tr>

<?php


$sqls = "SELECT * FROM  ERMVKPENGAWASAN where  notrans='$notrans' order by tgl asc ";
  $stmts = sqlsrv_query( $conn, $sqls );
  while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) 
  {
  

$no = $rows['no'];

  
echo "<tr>
    <td>".$rows['jam']."</td>
    <td>".$rows['ku']."</td>
    <td>".$rows['td']."</td>
       <td>".$rows['n']."</td>
          <td>".$rows['s']."</td>
             <td>".$rows['rr']."</td>
              <td>".$rows['his']."</td>

  <td>".$rows['djj']."</td>
             <td>".$rows['bandiring']."</td>
              <td>".$rows['ppv']."</td>

  <td>".$rows['tandakal2']."</td>
    <td>".$rows['nmuser']."</td>
       <td><a data-toggle='modal' data-no='$no' data-notrans='$notrans' data-norm='$norm' data-kduser='$kduser'  data-target='#tanggal' >HAPUS</a>





              </td>       
  </tr>";


}

?> 
  
</table>


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