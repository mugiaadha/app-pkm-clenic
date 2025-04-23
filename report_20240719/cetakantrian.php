<?php

// require_once __DIR__ . '/vendor/autoload.php';


// // Define a default page size/format by array - page will be 190mm wide x 236mm height
// $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [58, 40]]);

  
//   include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$notransaksi=$_GET['notransaksi'];




    
//     $mpdf = new \Mpdf\Mpdf();
//     $mpdf->AddPage("P","","","","","2","0","2","2","","","","","","","","","","","",[58,40]);
//     // $mpdf->WriteHTML($content);


//     $query="SELECT 
// a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
// d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas
// FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g
// WHERE a.norm = b.norm 
// AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND
// a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' and a.notransaksi='$notransaksi'  order by a.kddokter,c.noantrian asc";



// $result=mysqli_query($conn, $query);
// while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) { 


//                     $noantrian = $row['noantrian'];
//                     $pasien = $row['pasien'];
//                     $norm = $row['norm'];
//                     $tgllahir = $row['tgllahir'];
//                     $tglpriksa = $row['tglpriksa'];
//                     $nampoli = $row['nampoli'];
//                     $namdokter = $row['namdokter'];

// $mpdf->WriteHTML("

// <span style='font-size:11px'><b>DPP DR NANIK</b>
// <br>
// ANTRIAN<br>

// -------------------------------------------------------------
// <span><br>

// <b>$pasien</b><br>
// <br>
// <b>ANTRIAN : A  $noantrian</b><br>









//     ");
       
// }
    
// $mpdf->Output();
// exit;


?>

<?php

  include '../koneksi.php';


 $notransan=$_GET['notransaksi'];

 









$query="SELECT 
a.norm,a.kdpoli,a.tglpriksa,a.kddokter,a.kdkostumerd,a.notransaksi,b.pasien,b.tgllahir,c.noantrian,
d.nampoli,e.namdokter,f.nama,g.costumer,b.alamat,g.kdtarif,a.kelas,i.kodeantrian
FROM kunjunganpasien a , pasien b,antrian c,poliklinik d, dokter e,kelompokkostumerd f,kelompokkostumer g,dokterklinik i
WHERE a.norm = b.norm 
AND a.notransaksi = c.notransaksi AND a.kdpoli = d.kdpoli AND a.kddokter = e.kddokter AND a.kdpoli = i.kdpoli and a.kddokter = i.kddokter and 
a.kdkostumerd = f.kdkostumerd AND f.kdkostumer = g.kdkostumer AND a.kdcabang='$kdcabang' and a.notransaksi='$notransan'  order by a.kddokter,c.noantrian asc";


                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {

                    $noantrian = $row['noantrian'];
                    $pasien = $row['pasien'];
                    $norm = $row['norm'];
                    $tgllahir = $row['tgllahir'];
                    $tglpriksa = $row['tglpriksa'];
                    $nampoli = $row['nampoli'];
                    $namdokter = $row['namdokter'];
                    $kodeantrian = $row['kodeantrian'];

                    
}

?>
<!DOCTYPE html>
<html>
<head>
    </head>
<style type="text/css">



 


.page {
    background: var(--white);
    display: block;
     margin: 0px; 
    position: relative;
    color:black;
    /*padding-top: 2px;*/
    /*padding-left: 23px;*/
     /*padding-right: 23px;*/
     /*border: 1px solid black;*/
    /*box-shadow: var(--pageShadow);*/
}




td {
    font-size: 14px;
    font-weight: 500px;
}

 </style>

<body >
    <script>
    
    </script>
    
    <div  style="background-color:white">



    
<table   border="0" cellspacing="0">



        <tr align="center">
            <div><td colspan="3" align="left"><b>ANTRIAN POLIKLINIK </b></td></div>
        </tr>
        <tr>
            <!-- <td> Ruang </td>
            <td> : </td> -->
            <td colspan="3"><?php echo $nampoli ?></td>
        </tr>   
        <tr>
            <!-- <td> Dr. Klinik </td>
            <td> : </td> -->
            <td  colspan="3"><?php  echo $namdokter ?></td>
        </tr>
        <tr>
            <td align="center"> Antrian </td>
            <td>  </td>
            <td align="center">No Antrian</td>
        </tr>
        <tr>
            <td align="center"><h1><b><?php echo $kodeantrian ?></b></h1></td>
            <td></td>
            <td align="center"><h1><b><?php  echo $noantrian   ?></b></h1></td>
        </tr>

        <tr>
            <td> Tanggal Periksa </td>
            <td> : </td>
            <td><?php 
                echo $tglpriksa
                ?>
            </td>
        </tr>
        
        <?php
            if(!empty($_SESSION['notransan'])){
        ?>
        <tr>
            <td> No RM </td>
            <td> : </td>
            <td><?php echo $norm  ?></td>
        </tr>
        <tr>
            <td> Nama </td>
            <td> : </td>
            <td><?php  echo $pasien  ?></td>
        </tr>
        <tr>
            <td> Tanggal Lahir </td>
            <td> : </td>
            <td><?php 
                 echo $tgllahir  
                ?>
            </td>
        </tr>
        
    
        <?php
        
            }
            else {
    
        ?>
        <tr>
            <td> Nama </td>
            <td> : </td>
            <td><?php  echo $pasien  ?></td>
        </tr>
    
    
    

        <?php
            }
        ?>
    <!--    <tr align="center">
            <td colspan="3"> TERIMA KASIH </td>
        </tr>
        <tr align="center">
            <td colspan="3"> TELAH MENUNGGU </td>
        </tr> -->
        <tr align="center">
            <td colspan="3"> <?php //$tgl=date_create($tgl);
             date_default_timezone_set( 'Asia/Bangkok' );
                                    echo $tgl=date("d M Y h:i:s");
                             ?> 
            </td>
        </tr>
            
    </table>


    
</div>

<?php
    $db=null;
?>
<script type="text/javascript">
    
    window.print()
</script>

<script src="recta.js"></script>

 <script type="text/javascript">
  var printer = new Recta('apbatech1234!!', '1811')


   function onClick () {
    printer.open().then(function () {
      printer.align('LEFT')
         .mode('A', false, false, false, false)
          .bold(false)
          .text('ANTRIAN POLIKLINIK')
           .text('KLINIK NABIYA')
          // .mode('A',false,false,false,true)
          .feed(1)
          .text('NO ANTRIAN:')
          .feed(1)
           .mode('A', false, true, true, false)
         .font('A')
          .bold(true)
        .text('<?php echo $kodeantrian ?>  <?php echo $noantrian ?>')
          .feed(1)
          .mode('A', false, false, false, false)

            .bold(false)
          .text('NORM : <?php echo $norm ?>')

          .text('PASIEN : <?php echo $pasien ?>')
           .text('TGL.LAHIR : <?php echo $tgllahir ?>')
          .text('POLI : <?php echo $nampoli ?>')
          .text('DOKTER :<?php echo $namdokter ?>')
       
          .text('TGL PRIKSA : <?php echo $tglpriksa ?>')
         .feed(6)
          .cut()
          .print()
    })



  }


 



  // setTimeout(window.close(), 5000);
 </script>
 
 
</body>
</html>