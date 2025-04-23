<html>


 <style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400&display=swap');
</style>

<style>

/*
th {
    border: 1px solid #dddddd;
    text-align: left;
  font-family: 'Outfit', sans-serif;
}*/

 body {
      font-family: 'Outfit', sans-serif;
        
        text-align: center;
        color: #000000;

      }

</style>
<?php  
  include '../koneksi.php';

$kdcabang=$_GET['kdcabang'];
$notransaksi=$_GET['notransaksi'];

$query="
SELECT 
a.*,b.nama,c.pasien,c.tgllahir,c.norm
FROM etiket a , cabang b,pasien c
WHERE a.kdcabang = b.kdcabang AND a.norm =c.norm AND a.kdcabang = c.kdcabang

AND a.kdcabang='$kdcabang' AND a.notransaksi='$notransaksi' and signa <> ''";



$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) { 




 ?> 

 <div style="padding: 10px; margin-bottom: 10px">
<table >

  <tr style="font-size:11px;">

    <td  colspan="2" style="border-bottom: 1px solid black;"><?php echo $row['nama'] ?></td>

  
</tr>


  <tr style="font-size:11px;">

    <td  colspan="2"><b><?php echo $row['pasien'] ?></b></td>

  
</tr>

  <tr style="font-size:11px;">

    <td  colspan="2">Tgl.Lahir : <?php echo $row['tgllahir'] ?> Norm :  <?php echo $row['norm'] ?></td>

  
</tr>
<tr style="font-size:11px;">

    <td  colspan="2"><b><?php echo $row['obat'] ?> (<?php echo $row['qty'] ?>)</td>

  
</tr>
<tr style="font-size:11px;">

    <td  colspan="2"><b><?php echo $row['signa'] ?></td>

  
</tr>
<tr style="font-size:11px;">

    <td  colspan="2"><b><?php echo $row['aturanminum'] ?></td>

  
</tr>
 <tr style="font-size:11px;">

    <td >Pagi : </td>
 <td >Siang : </td>

  
</tr>
 <tr style="font-size:11px;">

    <td >Sore : </td>
 <td >Malam : </td>

  
</tr>
 <tr style="font-size:11px;">

    <td >Ed : </td>
 <td >Paraf : </td>

  
</tr>
</table>
 
</div>
 
 <?php } ?>
  
  
  <script type="text/javascript">
      window.print()
  </script>
  </html>

 

 