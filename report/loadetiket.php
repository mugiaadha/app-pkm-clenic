  <?php



  include '../koneksi.php';
  
    $query="SELECT a.*,b.nama,c.pasien,c.tgllahir,c.norm,b.nama AS klinik ,d.obat
FROM ermcpptintruksi a , cabang b,pasien c,obat d WHERE a.kdcabang = b.kdcabang 
AND a.norm =c.norm AND a.kdcabang = c.kdcabang AND a.kdcabang='180'
 AND a.notransaksi='RJ-TR0761241220-013' AND a.kdpruduk = d.kdobat 
 ORDER BY a.nama ASC";



$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) { 


$pasienx = $row['pasien'];

$pasien = substr($pasienx, 0, 25);


$nama = $row['nama'];
$obat = substr($row['obat'], 0, 25);
$qty = $row['qty'];



$signa = substr($row['signa'], 0, 25);
$tgllahir = $row['tgllahir'];

$norm = $row['norm'];
$keterangan =  substr($row['keterangan'], 0, 25);



$frekuensi = $row['frekuensi'];
$jmlpakai = $row['jmlpakai'];

echo $jmlpakai;



}

?>