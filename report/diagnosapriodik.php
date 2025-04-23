<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>KUNJUNGAN</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
     <style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400&display=swap');
</style>
    <style>
      body {
          font-family: 'Outfit', sans-serif;
        
        text-align: center;
        color: #000000;

      }

      body h1 {
        font-weight: 300;
        margin-bottom: 0px;
        padding-bottom: 0px;
        color: #000;
      }

      body h3 {
        font-weight: 300;
        margin-top: 10px;
        margin-bottom: 20px;
        font-style: italic;
        color: #555;
      }

      body a {
        color: #06f;
      }

      .invoice-box {
        max-width: 1500px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
     
        font-size: 10px;
        line-height: 24px;
        font-family: 'Outfit', sans-serif;
        color: #555;
      }

      .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
        border-collapse: collapse;
      }

      .invoice-box table td {
        padding: 5px;
        vertical-align: top;
      }

      .invoice-box table tr td:nth-child(2) {
        text-align: right;
      }

      .invoice-box table tr.top table td {
        padding-bottom: 20px;
      }

      .invoice-box table tr.top table td.title {
        font-size: 10px;
        line-height: 45px;
        color: #333;
      }

      .invoice-box table tr.information table td {
        padding-bottom: 40px;
      }

      .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
      }

      .invoice-box table tr.details td {
        padding-bottom: 0px;
        font-size: 11px;
      }

      .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
      }

      .invoice-box table tr.item.last td {
        border-bottom: none;
      }

      .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
      }

      @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
          width: 100%;
          display: block;
          text-align: center;
        }

        .invoice-box table tr.information table td {
          width: 100%;
          display: block;
          text-align: center;
        }
      }
    </style>
  </head>

  <?php
  include '../koneksi.php';
    include 'terbilang.php';

  $kdcabang = $_GET['kdcabang'];

$tgldari = $_GET['tgldari'];
$tglsampai = $_GET['tglsampai'];



 date_default_timezone_set( 'Asia/Bangkok' );


$tgl = date("Y-m-d");

  ?>

  <body>
  
    <div class="invoice-box">
      <table>
        <tr class="top">
          <td colspan="17">
            <table>
              <tr>
                <td class="title">
                  <?php
                  $query="SELECT * from cabang where kdcabang='$kdcabang'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $namaklinik=$row['nama'];
                    $alamat=$row['alamat'];
                    $hp=$row['hp'];
                    
                    
                  }


                  ?>
                 <b><?php echo $namaklinik ?></b><br>

                   <b>DIAGNOSA PERIODIK RAWAT JALAN</b>

                </td>
                


                <td>
                 
                  Tanggal: <br />
                  <?php echo $tgldari ?> -  <?php echo $tglsampai ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>

       

        <tr class="heading">
        <td>Pasien</td>
          <td style="text-align:left;">Poli</td>
          <td>Norm</td>
             <td>Tgl Lahir</td>
                 <td>JK</td>
          <td>Agama</td>
      <td>Marital</td>
      <td>Golda</td>
       <td>Umur</td>
      <td>Perkerjaan</td>
      <td>Alamat</td>
       <td>Tgl Priksa</td>
      
      <td>Kd Diag</td>
       <td>Diagnosa</td>
      
      <td>Kd Tindakan</td>
       <td>Tindakan</td>
      <td>No</td>
      
    
        </tr>


    <?php 






$query="SELECT a.notransaksi,
a.norm,a.tglpriksa,e.pasien,d.nampoli,e.tgllahir,e.jeniskelamin,e.agama,e.statusmarital,e.golda,e.perkerjaan
,xc.city_name,f.kddiagnosa,f.diagnosa,g.kddiagnosa AS  kdtindakan,g.diagnosa AS tindakan,e.alamat
FROM kunjunganpasien a 

left join kelompokkostumerd b ON  a.kdkostumerd = b.kdkostumerd 

left join kelompokkostumer c ON  b.kdkostumer = c.kdkostumer

LEFT JOIN  poliklinik d ON a.kdpoli = d.kdpoli 

left join pasien e ON a.norm = e.norm

left join keluarahan re ON  e.kdkelurahan = re.subdis_id
left join kecamatan xb ON     re.dis_id = xb.dis_id
left join kabupaten xc ON  xb.city_id = xc.city_id 
LEFT JOIN ermcpptdiagnosa f ON a.notransaksi = f.notrans
AND f.no = (SELECT  no FROM ermcpptdiagnosa WHERE notrans=a.notransaksi AND STATUS='diagnosa' ORDER BY NO ASC LIMIT 1) 
LEFT JOIN ermcpptdiagnosa g ON a.notransaksi = g.notrans AND 
g.no = (SELECT  no FROM ermcpptdiagnosa WHERE notrans=a.notransaksi AND STATUS='tindakan' ORDER BY NO ASC LIMIT 1) 
WHERE 
a.tglpriksa BETWEEN '$tgldari' AND '$tglsampai'
and a.kdcabang='$kdcabang' and d.filter='1' order by a.tglpriksa  asc
";

          $result=mysqli_query($conn, $query);
                        $no = 0;
                     
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
              $no ++;
               
           $tanggal_lahir = new DateTime($row['tgllahir']);
    $sekarang = new DateTime("today");

    if ($tanggal_lahir > $sekarang) { 
    $thn = "0";
    $bln = "0";
    $tgl = "0";
    }
    $thn = $sekarang->diff($tanggal_lahir)->y;
    $bln = $sekarang->diff($tanggal_lahir)->m;
    $tgl = $sekarang->diff($tanggal_lahir)->d;
 
                echo   "<tr class='details'>
                   <td>".$row['pasien']."</td>
          <td style='text-align:left;'>".$row['nampoli']."</td>
    <td>".$row['norm']."</td>
    <td>".$row['tgllahir']."</td>
         
 <td>".$row['jeniskelamin']."</td>
    <td>".$row['agama']."</td>
     <td>".$row['statusmarital']."</td>
    <td>".$row['golda']."</td>
     <td>".$thn." tahun ".$bln." bulan ".$tgl." hari"."</td>
    <td>".$row['perkerjaan']."</td>
     <td>".$row['alamat']."</td>
    <td>".$row['tglpriksa']."</td>
     <td>".$row['kddiagnosa']."</td>
    <td>".$row['diagnosa']."</td>
     <td>".$row['kdtindakan']."</td>
    <td>".$row['tindakan']."</td>
     <td>".$no."</td>
       
    
        </tr>";



                  }

                  ?> 
                    
                 


     

      
      
      </table>
    </div>
  </body>

</html>
