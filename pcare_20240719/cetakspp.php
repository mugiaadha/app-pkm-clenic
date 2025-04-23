

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan Pelayanan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-10">
    <div class="bg-white p-8 rounded shadow-md max-w-2xl mx-auto">
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
                <p>Surat Pernyataan Pelayanan di FKTP</p>
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
            <h2 class="text-lg font-semibold">Pelayanan:</h2>
            <!--<p>1. Pelayanan Ambulance</p>-->
                     <?php

  	  

                  $query="SELECT 
a.produk
FROM transaksipasiend a ,kunjunganpasien b
WHERE a.notransaksi = b.notransaksi AND b.nokunjungan='$noRujukan'";
                    $result=mysqli_query($conn, $query);
                     $no = 0;
                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                      $no ++;
                      
                      echo "<p>".$no.".".$row['produk']."</p>";
                      
                  }
                  
                  ?>
            
            
        </div>

        <div class="border-t my-4"></div>

        <div>
            <p>Pasien / Keluarga menyatakan bahwa benar, pasien telah mendapatkan pelayanan tanpa dikenakan iur biaya serta memberikan persetujuan kepada BPJS Kesehatan untuk menggunakan informasi medis yang tertera di status kesehatan pasien sebagai salah satu syarat pengajuan klaim pelayanan program JKN.</p>
        </div>

        <div class="mt-8">
            <p>Pasien / Keluarga</p>
            <p class="mt-8"><?php echo $nmPst ?></p>
            <p>No telp yang dapat dihubungi:</p>
        </div>
    </div>
</body>
</html>