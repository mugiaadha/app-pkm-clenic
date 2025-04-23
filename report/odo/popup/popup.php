
<!DOCTYPE html>
<html>
<head>
    <title>.:: SP FARMASI RS KSH ::.</title>
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
    </style>
    <script src="../js/jquery-1.12.2.min.js"></script>
    <script src="../js/jquery-ui/jquery-ui.js"></script>
    <script src="../js/jquery.maskedinput.min.js"></script>
    <script src="../js/jquery.number.js"></script>
    <script src="../js/infusion-jquery/jquery.webcam.js"></script>
    <script src="../js/w3codecolors.js"></script>
    <script src="../js/jquery.freezeheader.js"></script>


    <script language="javascript" type="text/javascript">
        $(document).ready(function () {
            $("#table1").freezeHeader();
            /*$("#table1").freezeHeader({ 'height': '300px' });
            $("#table2").freezeHeader();
                
            $("#tbex1").freezeHeader();
            $("#tbex2").freezeHeader();
            $("#tbex3").freezeHeader();
            $("#tbex4").freezeHeader();*/
                
        });
    </script>
</head>
<body onload="window.print()">
    <div class="w3-container">
 <h4 class="w3-text-blue" style="padding-bottom:0;margin-bottom:0;"><b>INSTALASI FARMASI RS.BHINA BHAKTI HUSADA</b></h4>
<div class="w3-row">
    <div class="w3-col s6 w3-tiny">Jl. P.Sudirman,Margorejo Pati<br>
        Telp. (0295) 386111 Fax. (0295) 384422
    </div>
 
</div>
<div style="border-bottom:3px solid #ccc;"></div>
<center><h5>SURAT PEMESANAN FARMASI</h5></center>
<div class="w3-row">

      <?php 

$nomorpo = $_GET['nomorpo'];
$kdbagi = $_GET['kdbagi'];
$kdklinik = $_GET['kdklinik'];
$kodesup = $_GET['kodesup'];

            include '../lib/koneksi.php';
            $sqls = "SELECT *  from prencanaobat  WHERE        (nomorpo = '$nomorpo') AND (kodebagi = '$kdbagi') AND (kodeklinik = '$kdklinik') AND (kodesup = '$kodesup')";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                   
                                      if( $stmts === false) {
                                      die( print_r( sqlsrv_errors(), true) );
                                      }

                                      while( $rowsx = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {
                                  

    $nosp=$rowsx['nomorpo'].'/'.$rowsx['kodebagi'].'/'.$rowsx['kodeklinik'].'/'.$rowsx['kodesup'];

    $supplier=$rowsx['supplier'];

          }
            ?>


    <div class="w3-col s6 w3-tiny"><b>NO SP: <?php echo $nosp?></b><br>
     Mohon dikrim, <br>

    </div>
    <div class="w3-col s6 w3-tiny">
        <span class="w3-right">
        <b>Kepada Yth:</b><br>
        <?php echo $supplier?>
       <br>
       _________________________
    </span>
    </div>
</div>

    <div style='height:5px;'></div>

   <table class='w3-table w3-tiny w3-hoverable w3-bordered tbl' cellpadding='0'>
        <thead>
        <tr class='w3-dark-grey'>
            <th>#</th>
            <th>Banyaknya</th>
           
            <th>Nama Barang</th>
            <th>Harga Satuan</th>
            <th>Jumlah Harga</th>
             <th>Keterangan</th>
        </tr>
        </thead>

        <tbody>

            <?php 

            include '../lib/koneksi.php';
            $sqls = "SELECT *  from prencanaobat  WHERE    (nomorpo = '$nomorpo') AND (kodebagi = '$kdbagi') AND (kodeklinik = '$kdklinik') AND (kodesup = '$kodesup')";
                                      $stmts = sqlsrv_query( $conn, $sqls );
                                      $nomors = 0;
                                      if( $stmts === false) {
                                      die( print_r( sqlsrv_errors(), true) );
                                      }

                                      while( $rows = sqlsrv_fetch_array( $stmts, SQLSRV_FETCH_ASSOC) ) {
                                      //echo $row['nama'];
                                        $nomors++;


                                                           if ($rows['ambil']== 'BESAR'){


$jmlpesanfix= $rows['jmlpesan'].' '.$rows['besar'];
$satuanfix = $rows['besar'];

}else if($rows['ambil']== 'KECIL'){

$jmlpesanfix= $rows['jumlahkemasan'].' '.$rows['kecil'];
$satuanfix = $rows['kecil'];
}else{

}   


            ?>

        <tr>
            <td><?php echo $nomors ?></td>
            <td><?php echo $jmlpesanfix ?></td>
           
             <td><?php echo $rows['obat'] ?></td>
            <td>-</td>
           
          <td>-</td>
             <td><?php echo $rows['keterangan'] ?> </td>
        </tr>

    <?php }?>
    </tbody>

    </table>
<br>
<div class="w3-row-padding w3-tiny">
    <div class="w3-col s4 w3-center">
        <br>
        <p>Tanda Terima,</p>
        <br>
        <br>

        <p>( _________________________ )</p>
    </div>

    <div class="w3-col s4">
        <div class="w3-border w3-padding" style="font-size:8px;text-align:justify;">
                * Harap dikirim obat seperti list di atas apabila stok kosong harap konfirmasi kami<br>
               
            <br>
            
        </div>

    </div>

    <div class="w3-col s4 w3-center">
        <p>Pati, 
        <br>Hormat Kami,</p>
        <br>
        <br>

        <p>( _________________________ )</p>
    </div>

</div>
    </div>

</body>
</html>