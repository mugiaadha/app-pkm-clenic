<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Klaim Pelayanan Primer</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-10">
    <div class="bg-white p-8 rounded shadow-md max-w-4xl mx-auto">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="https://mpp.palembang.go.id/static/logo/1661780974.png.png" alt="BPJS Kesehatan Logo" class="w-20 h-20">
                <div>
                    <h1 class="text-xl font-bold">BPJS Kesehatan</h1>
                    <p class="text-sm">Badan Penyelenggara Jaminan Sosial</p>
                </div>
            </div>
                      <?php

  	    include '../koneksi.php';

  	    $noRujukan = $_GET['nokunjungan'];

                  $query="SELECT 
a.*,b.tgllahir,b.jeniskelamin,TIMESTAMPDIFF (YEAR, b.tgllahir, CURDATE())  AS umur,b.nopengenal,b.norm,b.hp,b.alamat
FROM riwayatkunjungan a,pasien b
WHERE a.nokaPst = b.noasuransi and a.noRujukan='$noRujukan'";
                    $result=mysqli_query($conn, $query);
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
               
                 		$nmPst=$row['nmPst'];
                     $nokaPst=$row['nokaPst'];
                                          $nik=$row['nopengenal'];
                     $noRujukan=$row['noRujukan'];
                     $tglKunjungan=$row['tglKunjungan'];
                     $tglEstRujuk=$row['tglEstRujuk'];
                     $tglAkhirRujuk=$row['tglAkhirRujuk'];
                     $nmPPK=$row['nmPPK'];
                  
                     $nmPoli=$row['nmPoli'];
                 
                     $kdDiag=$row['kdDiag'];
                     $nmDiag=$row['nmDiag'];
                     $nmPPKa=$row['nmPPKa'];
                
                     $nmDokter=$row['nmDokter'];
                 
                     $nmDati=$row['nmDati'];
                     $nmKR=$row['nmKR'];
                 
                     $pisa=$row['pisa'];
                     $ketpisa=$row['ketpisa'];
                    $umur=$row['umur'];
                    $tgllahir=$row['tgllahir'];
                      $jeniskelamin=$row['jeniskelamin'];
                     $jadwal=$row['jadwal'];
                        $norm = $row['norm'];
                        $hp =$row['hp'];
                        $alamat = $row['alamat'];
                        
                        
                        
                  
                      
                  }
                  


                  ?>
          
          
            <div class="text-right">
                <p>Formulir Klaim Pelayanan Primer</p>
               <p>01030301  - Puskesmas Kuta Baro</p>
                <b class="mt-2">No Kunjungan: <?php echo $noRujukan ?></b>
            </div>
        </div>

        <div class="border-t my-4"></div>

   
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p>Nomor Rekam Medis: <?php echo $norm ?></p>
                <p>Nomor Kartu Peserta: <?php echo $nokaPst ?></p>
                <p>NIK: <?php echo $nik ?></p>
                <p>Nama: <?php echo $nmPst ?></p>
                <p>Jenis Kelamin: <?php if($jeniskelamin === 'P'){
                echo "Perempuan";
                
                }else{
                echo "Laki-Laki";
                
                } ?></p>
                <p>Nomor HP: <?php echo $hp ?></p>
            </div>
            <div>
                <p>Tanggal Lahir: <?php echo $tgllahir ?></p>
                <p>Umur:  <?php echo $umur ?> Th</p>
                <p>Tanggal Pelayanan: <?php echo $tglKunjungan ?></p>
                <p>Jenis Pelayanan: RJTP</p>
                <p>Alamat:  <?php echo $alamat ?></p>
            </div>
        </div>

        <div class="border-t my-4"></div>

        <div>
            <p><strong>Keluhan pasien saat datang ke FKTP:</strong> Panas</p>
            <p><strong>Anamnesa:</strong> Panas sudah 3 hari di sertai bab dan bak</p>
        </div>

        <div class="border-t my-4"></div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <h2 class="text-lg font-semibold">PEMERIKSAAN FISIK</h2>
                <p><strong>Tanda Vital:</strong></p>
                <p>Kesadaran : Compos mentis</p>
                <p>Suhu : 40 C</p>
                <p>Sistole : 110 mmHg</p>
                <p>Diastole : 90 mmHg</p>
                <p>Nadi : 75 bpm</p>
                <p>Resp Rate : 20 /menit</p>
                <p>Tinggi Badan : 165 cm</p>
                <p>Berat Badan : 65 kg</p>
                <p>Lila : -</p>
                <p>IMT : 18</p>
            </div>
            <div>
                <h2 class="text-lg font-semibold">PEMERIKSAAN GENERALIS TUBUH</h2>
                <p>Kepala : Konjungtiva Tidak Anemis, Sklera Tidak Ikterik, Pupil Isokor, Refleks, + Palpebra Normal</p>
                <p>Leher : KGB Tidak Membesar, Kelenjar Thyroid Tidak Membesar</p>
                <p>Paru : Ronkhi - Wheezing -</p>
                <p>Jantung : Bising Usus +, Nyeri Tekan-</p>
                <p>Ekstremitas Atas : Edema, - Parese +</p>
                <p>Ekstremitas Bawah : Edema, - Parese +</p>
            </div>
        </div>

        <div class="border-t my-4"></div>

        <div>
            <h2 class="text-lg font-semibold">PEMERIKSAAN PENUNJANG</h2>
            <p>Laboratorium : [T]</p>
            <p>Radiologi : [T]</p>
            <p>Elektrocardiogram : [T]</p>
        </div>

        <div class="border-t my-4"></div>

        <div>
            <p><strong>Riwayat Alergi:</strong> -</p>
            <p><strong>Diagnosa Primer:</strong> S42.20 - Fracture of upper end of humerus, closed</p>
            <p><strong>Diagnosa Sekunder:</strong> S72 - Fracture of femur</p>
            <p><strong>Terapi:</strong></p>
            <p>Medikamentosa: O2:4-5 Liter</p>
            <p>Non Medikamentosa: Imobilisasi pasien senyaman mungkin</p>
            <p>BMHP: Kassa, hanscoon, perban, plester</p>
        </div>

        <div class="border-t my-4"></div>

        <div>
            <p><strong>Tindakan (Prosedure):</strong> -</p>
            <p><strong>Prognosa:</strong> -</p>
        </div>

        <div class="border-t my-4"></div>

        <div>
            <h2 class="text-lg font-semibold">JENIS TAGIHAN NON KAPITASI</h2>
            <p>Evakuasi medis: Ambulance Darat, Tujuan : 0101R007 - RSUD MEURAXA</p>
            <p>Tenaga Kesehatan : dr. JAROT ANAS</p>
            <p>Biaya yang diajukan : Rp438.000</p>
        </div>

        <div class="border-t my-4"></div>

        <div>
            <p>Keterangan ini saya buat sesuai dengan data pelayanan yang diberikan dan dapat dipertanggungjawabkan</p>
            <p>Penanggungjawab Klaim</p>
            <p class="mt-8">dr. JAROT ANAS</p>
        </div>

        <div class="border-t my-4"></div>

        <div class="flex justify-between items-center">
            <p>Nama Petugas Entri: _____________</p>
            <p>24/06/2024 13:17:48</p>
        </div>
    </div>
</body>
</html>
